<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Subscription;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subscription_id' => fake()->randomElement(Subscription::pluck('id')->all()),
            'name' => fake()->name(),
            'address' => fake()->address(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['0','1','2']),
        ];
    }

    public static function getRandomCustomerId(array $usedCustomerIds)
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
