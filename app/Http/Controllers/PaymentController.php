<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showPaymentPage($visitor_id)
    {
        $visitor = User::find($visitor_id);
        // Calculate total amount (rent + service charge)
        $rent = $visitor->property->rent;  // Assuming you have property data
        $service_charge = $rent * 0.05;    // 5% service charge

        $total_amount = $rent + $service_charge;

        return view('payment.page', compact('visitor', 'total_amount', 'service_charge'));
    }

    public function processPayment(Request $request, $visitor_id)
    {
        // Validate the payment details
        $request->validate([
            'payment_method' => 'required|string',
            'payment_details' => 'required|string',  // e.g., phone number or card number
        ]);

        // Calculate the rent and service charge
        $visitor = User::find($visitor_id);
        $rent = $visitor->property->rent;
        $service_charge = $rent * 0.05;    // 5% service charge
        $total_amount = $rent + $service_charge;

        // Simulate a payment (you can add actual API calls for each payment method here)
        $payment_status = $this->simulateTransaction($request->payment_method);

        // Save payment data
        $payment = Payment::create([
            'visitor_id' => $visitor_id,
            'payment_date' => Carbon::now(),
            'amount' => $total_amount,
            'service_charge' => $service_charge,
            'status' => $payment_status,
            'payment_method' => $request->payment_method,
        ]);

        // Redirect based on payment status
        if ($payment_status == 'completed') {
            // After payment completion, update visitor account to tenant
            // Update user role or status here if needed
            // Example: $visitor->update(['role' => 'tenant']);

            return redirect()->route('payment.success', ['payment' => $payment]);
        } else {
            return redirect()->route('payment.failed', ['payment' => $payment]);
        }
    }

    private function simulateTransaction($payment_method)
    {
        // Simulating different payment methods (this can be replaced with real payment gateway integration)
        switch ($payment_method) {
            case 'bkash':
                // Simulate bKash transaction success
                return 'completed';
            case 'nogod':
                // Simulate Nogod transaction success
                return 'completed';
            case 'debit':
            case 'credit':
                // Simulate card transaction success
                return 'completed';
            default:
                return 'failed';
        }
    }
}
