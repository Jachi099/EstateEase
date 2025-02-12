<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {  Log::info('Payment method accessed');
        // Validate incoming data
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'service_charge' => 'required|numeric',
            'payment_method' => 'required|string',
            'tran_id' => 'required|string|unique:payments', // Make sure tran_id is unique
        ]);

        try {
            // Create new payment instance and populate fields
            $payment = new Payment();
            $payment->tran_id = $validated['tran_id'];
            $payment->visitor_id = auth()->user()->id; // Use authenticated user ID
            $payment->amount = $validated['amount'];
            $payment->service_charge = $validated['service_charge'];
            $payment->payment_method = $validated['payment_method'];
            $payment->status = 'confirmed'; // You can change this based on actual status
            $payment->payment_date = now(); // current timestamp

            // Save the payment to the database
            $payment->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Payment created successfully!');
        } catch (\Exception $e) {
            // Catch and log any exceptions
            return redirect()->back()->with('error', 'Payment creation failed: ' . $e->getMessage());
        }

}
}
