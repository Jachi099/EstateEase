<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceRequest;
use Carbon\Carbon;

class AutoCancelServiceRequests extends Command
{
    protected $signature = 'serviceRequests:autoCancel';
    protected $description = 'Automatically cancels pending service requests where the requested date has passed';

    public function handle()
    {
        // Get all pending service requests where the requested_date has passed
        $serviceRequests = ServiceRequest::where('status', 'pending')
            ->where('requested_date', '<', Carbon::now())
            ->get();

        foreach ($serviceRequests as $request) {
            $request->status = 'canceled';
            $request->save();

            $this->info("Service Request {$request->id} has been canceled.");
        }
    }
}


