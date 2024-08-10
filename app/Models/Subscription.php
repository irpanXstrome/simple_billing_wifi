<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

//    protected $primaryKey = 'subscription_id';
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function getRandomSubsId(array $usedCustomerIds)
    {
        //GPT! start
        $customerIds = Customer::pluck('id')->all();

        // Ambil customer_id yang belum memiliki payment
        $availableCustomerIds = array_diff($customerIds, $usedCustomerIds);

        // Jika tidak ada customer_id yang tersedia, maka lempar pengecualian
        if (empty($availableCustomerIds)) {
            throw new Exception('No available customer IDs left to assign to payments.');
        }

        // Pilih customer_id yang belum digunakan
        return fake()->randomElement($availableCustomerIds);
        //GPT! END
    }
}
