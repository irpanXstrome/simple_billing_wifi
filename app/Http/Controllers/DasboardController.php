<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class DasboardController extends Controller
{
    public function view(){
        return view('dashboard',CustomerManagerController::getCustomersData());
    }
}
