<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;


class TenantAssignedNotification extends Notification
{
    use Queueable;

    protected $tenant;
    protected $payment;
    protected $landlordId;

    public function __construct($tenant, $payment, $landlordId)
    {
        $this->tenant = $tenant;
        $this->payment = $payment;
        $this->landlordId = $landlordId;
    }

    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'landlord_id' => $this->landlordId, // Ensure landlord_id is set
            'tenant_name' => $this->tenant->full_name,
            'payment_amount' => $this->payment->amount,
            'payment_method' => $this->payment->payment_method,
            'message' => "Your property has been assigned a new tenant: {$this->tenant->full_name}. Payment of {$this->payment->amount} received via {$this->payment->payment_method}.",
        ];
    }
}
