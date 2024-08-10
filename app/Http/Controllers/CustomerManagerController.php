<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class CustomerManagerController extends Controller
{

    public static function getCustomersData(){
        $customers = Customer::all();
        return [
            'all' => $customers->sortBy(function ($customer){
                return match ($customer->status){
                    '0' => 2,
                    '1' => 0,
                    '2' => 1
                };
            }),
            'active_members' => $customers->where('status','=',1)->all(),
            'isolation_members' => $customers->where('status','=',0)->all(),
        ];
    }

    public function view(Request $request)
    {
        $routeName = $request->route()->getName();
        switch ($routeName){
            case "customer.list":
                return view($routeName,['customers' => self::getCustomersData()]);
            case "customer.add":
                return view($routeName);
            case "customer.edit":
                if(!$request->has('id') || !is_numeric($request->query('id')) || intval($request->query('id')) < 0){
                    return redirect(route($routeName))->with(['message' => 'Gagal di Muat']);
                }
                return view($routeName,['customer' => Customer::find($request->query('id'))]);
            default:
                return view('errors.404');
        }
    }

    public function store(Request $request)
    {
        switch (($reqName = $request->route()->getName())) {
            case 'api.customer.add':
            case 'api.customer.edit':
                $validated = $request->validate([
                    'name' => 'required|min:3|max:255',
                    'phone' => 'required|min:10|max:20',
                    'address' => 'required|min:3|max:255',
                    'email' => 'required|email',
                    'amount' => 'required|min:1|max:20',
                    'type' => 'required|in:mbps,device',
                    'expired' => 'required|date_format:Y-m-d',
                    'status' => 'required|numeric'
                ]);
                if(str_contains($reqName,'edit')){
                    $request->validate([
                        'id' => 'required|numeric|min:0',
                    ]);
                    /** @var Customer $customer */
                    $customer = Customer::find($request->get('id'));
                    $customer->billing?->update($validated);
                    $customer->update($validated);
                    $customer->save();
                    $customer->billing?->save();
                }else{
                    $subId = Subscription::create($validated)->id;
                    $customer = Customer::create($validated);
                    $customer->subscription_id = $subId;
                    $customer->save();
                }
                return redirect(route('customer.list'))->with(['message' => 'Customer Berhasil di Simpan']);
            case 'api.customer.remove':
                $validated = $request->validate([
                    'id' => 'required|min:0',
                ]);
                /** @var Customer $customer */
                $customer = Customer::find($validated['id']);
                if($customer === null){
                    return response()->json(["type" => "error","message" => "Data Customer Tidak Ditemukan"]);
                }
                $customer->delete();
                return response()->json(["type" => "success","message" => "Customer Berhasil di Hapus"]);
            default:
                return back()->with([
                    'message' => 'Invalid Action'
                ], 400);
        }
    }
}
