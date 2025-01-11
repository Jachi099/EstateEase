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

    }



}
