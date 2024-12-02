<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Store a new payment
    public function storePayment(Request $request, $tenantId)
    {
        // Find the tenant by ID
        $tenant = Tenant::find($tenantId);
        if (!$tenant) {
            return redirect()->back()->with('error', 'Tenant not found.');
        }

        // Validate the payment data
        $request->validate([
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        // Create the payment record
        $payment = new Payment();
        $payment->tenant_id = $tenantId;
        $payment->amount = $request->amount;
        $payment->payment_date = $request->payment_date;
        $payment->status = 'paid'; // Assuming payment is confirmed as paid immediately
        $payment->save();

        // Optionally update tenant's payment status or rental status
        // $tenant->rental_status = 'paid';
        // $tenant->save();

        // Redirect back with success message
        return redirect()->route('tenant.show', ['tenant' => $tenantId])->with('success', 'Payment recorded successfully.');
    }

    // Show payment history for a tenant (optional)
    public function showPayments($tenantId)
    {
        $tenant = Tenant::find($tenantId);
        if (!$tenant) {
            return redirect()->back()->with('error', 'Tenant not found.');
        }

        // Get all payments for the tenant
        $payments = $tenant->payments;

        return view('tenant.payments', compact('tenant', 'payments'));
    }
}
