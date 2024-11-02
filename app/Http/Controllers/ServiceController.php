<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        return view('service.admin'); // Create a view file for your HTML
    }

    public function profile() {
        // Logic to show profile
    }

    public function add() {
        // Logic to add services
    }

    public function checkRequests() {
        // Logic to check service requests
    }
}
