<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class TesterController extends Controller
{
    //
    public function mainTest()
    {
        $cust = Customer::all();
        dump($cust);
        return view('tester',[
            'title' => 'Tester Page',
            'customers' => $cust
        ]);
    }

    public function mainPost(Request $request)
    {
        return response()->json(['message' => 'Data received successfully', 'data' => $request->toArray()]);
    }
}
