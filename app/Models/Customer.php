<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

//    protected $primaryKey = 'customer_id';

    protected $with = ["billing","payments"];

    public function billing()
    {
        return $this->hasOne(Subscription::class,'id','subscription_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
