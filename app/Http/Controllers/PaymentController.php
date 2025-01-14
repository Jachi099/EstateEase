<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use App\Models\TenantPayment;
use App\Models\Notification;

use App\Models\Property;

class PaymentController extends Controller
{

    //for visitors
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $request->validate([
                'token' => 'nullable|string',
                'payment_method' => 'required|string',
                'amount' => 'required|numeric',
                'visitor_id' => 'required|integer',
            ]);

            // Check if the visitor has already made a payment
            $existingPayment = Payment::where('visitor_id', $request->visitor_id)
                                      ->where('status', 'confirmed')
                                      ->first();

            // If a payment already exists, prevent further payments
            if ($existingPayment) {
                return response()->json(['error' => 'You have already paid for this month.']);
            }

            // Calculate service charge (5% of the amount)
            $serviceCharge = ($request->amount * 5) / 100;

            // Handle payment methods
            if ($request->payment_method === 'debit' || $request->payment_method === 'credit') {
                // Create a PaymentIntent for card payments
                $paymentIntent = PaymentIntent::create([
                    'amount' => $request->amount * 100,  // Amount in cents
                    'currency' => 'BDT',
                    'payment_method_types' => ['card'],
                    'description' => 'Property Rent Payment',
                ]);

                Payment::create([
                    'visitor_id'     => $request->visitor_id,
                    'amount'         => $request->amount,
                    'service_charge' => $serviceCharge,
                    'status'         => 'confirmed',  // Mark as 'confirmed'
                    'payment_method' => $request->payment_method,
                ]);

                return response()->json(['success' => true]);
            } else {
                // Handle other payment methods (bKash/Nagad)
                Payment::create([
                    'visitor_id'     => $request->visitor_id,
                    'amount'         => $request->amount,
                    'service_charge' => $serviceCharge,
                    'status'         => 'confirmed',  // Mark as 'confirmed'
                    'payment_method' => $request->payment_method,
                ]);

                return response()->json(['success' => true]);
            }
        } catch (\Exception $e) {
            Log::error('Payment failed:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    }


//for tenants
public function processTenantPayment(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        // Validate the incoming request
        $request->validate([
            'token' => 'nullable|string',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            'tenant_id' => 'required|integer',
            'property_id' => 'required|integer',  // Ensure the property ID is passed
        ]);

        // Check if the tenant has already made a payment for the current month
        $existingPayment = TenantPayment::where('tenant_id', $request->tenant_id)
                                        ->where('status', 'paid')
                                        ->whereMonth('payment_date', now()->month) // Check if payment exists for the current month
                                        ->first();

        // If a payment already exists for the current month, prevent further payments
        if ($existingPayment) {
            return response()->json(['error' => 'You have already paid for this month.']);
        }

        // Calculate service charge (5% of the amount)
        $serviceCharge = ($request->amount * 5) / 100;

        // Handle payment methods
        if ($request->payment_method === 'debit' || $request->payment_method === 'credit') {
            // Create a PaymentIntent for card payments
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $request->amount * 100,  // Amount in cents
                'currency' => 'BDT',
                'payment_method_types' => ['card'],
                'description' => 'Property Rent Payment',
            ]);

            // Save the payment details in the tenant_payments table
            $payment = TenantPayment::create([
                'tenant_id'      => $request->tenant_id,
                'amount'         => $request->amount,
                'service_charge' => $serviceCharge,
                'status'         => 'paid',  // Mark as 'paid'
                'payment_method' => $request->payment_method,
                'payment_date'   => now(),
                'property_id'    => $request->property_id, // Store property ID
            ]);

            // Send notification to the landlord
            $property = Property::findOrFail($request->property_id);
            $landlord = $property->owner; // Assuming property has an owner relationship
            $landlord->notifications()->create([
                'message' => 'Tenant ' . $payment->tenant->full_name . ' has made a payment of ৳' . number_format($payment->amount, 2) . ' for the property ' . $property->name,
                'user_id' => $landlord->id, // Landlord's ID
                'is_read' => false,
            ]);

            return response()->json(['success' => true, 'payment_intent' => $paymentIntent]);
        } else {
            // Handle other payment methods (bKash/Nagad)
            $payment = TenantPayment::create([
                'tenant_id'      => $request->tenant_id,
                'amount'         => $request->amount,
                'service_charge' => $serviceCharge,
                'status'         => 'paid',  // Mark as 'paid'
                'payment_method' => $request->payment_method,
                'payment_date'   => now(),
                'property_id'    => $request->property_id, // Store property ID
            ]);

           // Send notification to the landlord
$property = Property::findOrFail($request->property_id);

// Ensure the property has a landlord
$landlord = $property->landlord; // Use the `landlord` relationship defined in the Property model

if ($landlord) {
    // Create a notification for the landlord
    Notification::create([
        'message' => 'A tenant has paid ৳' . number_format($payment->amount, 2) . ' for the property: ' . $property->property_ID,
        'landlord_id' => $landlord->landlord_id, // Ensure landlord_id is set correctly
        'status' => 'unread', // Initially mark as unread
    ]);
}

            return response()->json(['success' => true]);
        }
    } catch (\Exception $e) {
        Log::error('Payment failed:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Payment failed: ' . $e->getMessage()]);
    }
}

}
