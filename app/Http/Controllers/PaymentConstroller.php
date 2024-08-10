<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentConstroller extends Controller
{
    public function view(Request $request,?Customer $customer,int $index = null)
    {
        $routeName = $request->route()->getName();
        switch ($routeName){
            case 'payment.view':
                return view($request->route()->getName(),['customer' => $customer]);
            case 'payment.view.image':
                if(is_null($index) || $index < 0){
                    abort(404);
                }
                $payment = $customer->payments->get($index);
                if(is_null($payment)){
                    abort(404);
                }
                $path = storage_path('app/'.$payment->proof_image);
                if (!File::exists($path)) {
                    abort(404);
                }
                return response()->file($path);
        }
    }

    public function store(Request $request){
        $routeName = explode('.',$request->route()->getName())[2];
        switch($routeName){
            case "add":
                $validated = Validator::make($request->all(),[
                    'proof_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                    'id' => 'required|numeric|min:0',
                    'amount' => 'required|numeric|min:0',
                    'paid_at' => 'required|date_format:Y-m-d'
                ]);
                if($validated->fails()){
                    return response()->json(['message' => 'Failed','type' => 'error','errors' => $validated->errors()->all()]);
                }
                $result = $request->file('proof_image')->store('private/images','local');

                if ($result) {
                    $customerId = Customer::find($request->get('id'))->id;
                    $payment = Payment::create([
                        'customer_id' => $customerId,
                        'amount' => $request->get('amount'),
                        'paid_at' => $request->get('paid_at'),
                        'proof_image' => $result
                    ]);
                    $payment->save();
                    return response()->json(['message' => 'File uploaded successfully','type' => 'success','data' => $request->get('id')]);
                } else {
                    return response()->json(['message' => 'File upload failed','type' => 'error'], 500);
                }
            case 'delete':
                $payment = Payment::find($request->get('id'));
                if($payment === null){
                    return response()->json(["type" => "error","message" => "Data Pembayaran Tidak Ditemukan"]);
                }
                $path = storage_path('app/'.$payment->proof_image);
                if(File::exists($path)){
                    File::delete($path);
                }
                $payment->delete();
                return response()->json(["type" => "success","message" => "Pembayaran Berhasil di Hapus"]);
            default:
                return response()->json(["type" => "error","message" => "Invalid Action"]);

        }
    }
}
