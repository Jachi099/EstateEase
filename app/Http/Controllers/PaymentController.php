<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;  // Make sure you import User model
use App\Models\Payment;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request, $visitor_id)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    
        $visitor = User::findOrFail($visitor_id);
        $bdtAmount = $request->amount;  // Get the amount passed from the frontend
    
        // Conversion rate from BDT to USD
        $conversionRate = 100;
        $usdAmount = $bdtAmount / $conversionRate;
        $amountInCents = round($usdAmount * 100);  // Amount in cents
    
        try {
            // Create a Stripe Checkout session with USD currency
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Property Payment',
                                'description' => "Payment for Visitor ID: $visitor_id",
                            ],
                            'unit_amount' => $amountInCents,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['visitor_id' => $visitor_id]),
                'cancel_url' => route('payment.cancel', ['visitor_id' => $visitor_id]),
            ]);
    
            // Save the payment in the database
            $payment = new Payment();
            $payment->visitor_id = $visitor_id;
            $payment->payment_date = now();  // Store the payment creation date
            $payment->amount = $bdtAmount;
            $payment->service_charge = ($bdtAmount * 5) / 100;
            $payment->status = 'confirmed';  // Initial status is 'pending'
            $payment->payment_method = 'Stripe';
            $payment->save();
    
            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    public function paymentSuccess(Request $request, $visitor_id)
    {
        $session_id = $request->get('session_id');
        Stripe::setApiKey(config('services.stripe.secret'));
    
        try {
            // Retrieve the session object from Stripe
            $session = Session::retrieve($session_id);
    
            // You can also use the session's `payment_intent` to fetch more details
            $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
    
            // Find the payment record from the database
            $payment = Payment::where('visitor_id', $visitor_id)
                              ->where('status', 'pending')  // Only update pending payments
                              ->first();
    
            if ($payment) {
                if ($paymentIntent->status === 'succeeded') {
                    // Mark the payment as confirmed
                    $payment->status = 'confirmed';  
                    $payment->stripe_payment_id = $paymentIntent->id;  // Save the payment intent ID
                    $payment->save();
    
                    return redirect()->route('visitor.visit_req_list')
                                     ->with('success', 'Payment successful!');
                } else {
                    // Handle failed payment or incomplete payment
                    return redirect()->route('visitor.visit_req_list')
                                     ->with('error', 'Payment verification failed.');
                }
            } else {
                return redirect()->route('visitor.visit_req_list')
                                 ->with('error', 'Payment not found.');
            }
        } catch (\Exception $e) {
            // Log or handle any exceptions that occur
            return redirect()->route('visitor.visit_req_list')
                             ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
    
    public function paymentCancel(Request $request, $visitor_id)
    {
        return redirect()->route('visitor.visit_req_list')
                         ->with('error', 'Payment was canceled.');
    }
    

}
