<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
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
}
