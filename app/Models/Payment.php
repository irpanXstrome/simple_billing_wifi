<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

//    protected $primaryKey = 'payment_id';
    public function customer(){

        return $this->belongsTo(Customer::class);
    }


}
