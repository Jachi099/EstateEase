<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use App\Models\TenantPayment;
use App\Models\Notification;
use Stripe\Checkout\Session;
use App\Models\Property;

 use Stripe\Charge;

class PaymentController extends Controller
{


public function processPayment(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));  // Your Stripe Secret Key

    $amount = $request->amount;  // Amount passed from frontend (Rent + Platform Charge)

    try {
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100,  // Amount in cents
            'currency' => 'usd',        // Your currency (can be adjusted)
            'description' => 'Rent Payment',  // Custom description
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
}

}
