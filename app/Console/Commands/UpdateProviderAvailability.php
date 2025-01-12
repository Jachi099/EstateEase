<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceRequest;
use App\Models\ServiceProvider;

class UpdateProviderAvailability extends Command
{
    protected $signature = 'provider:update-availability';
    protected $description = 'Make providers available again once the requested date has passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all service requests with the 'assigned' status and check if the requested date has passed
        $serviceRequests = ServiceRequest::where('status', 'assigned')->get();

        foreach ($serviceRequests as $request) {
            $requestedDate = \Carbon\Carbon::parse($request->requested_date);
            $currentDate = \Carbon\Carbon::now();

            if ($requestedDate->isPast()) {
                // Find the provider and set their availability status back to 'available'
                $provider = $request->serviceProvider;
                $provider->availability_status = 'available';
                $provider->save();
            }
        }

        $this->info('Provider availability updated successfully.');
    }
}
