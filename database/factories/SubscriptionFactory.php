<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Subscription;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => mt_rand(2,18),
            'type' => fake()->randomElement(['mbps','device'])
        ];
    }

    public static function getRandomCustomerId(array $usedSubsIds)
    {
        //GPT! start
        $customerIds = Subscription::pluck('id')->all();
        // Ambil customer_id yang belum memiliki payment
        $availableCustomerIds = array_diff($customerIds, $usedSubsIds);

        // Jika tidak ada customer_id yang tersedia, maka lempar pengecualian
        if (empty($availableCustomerIds)) {
            throw new Exception('No available customer IDs left to assign to payments.');
        }

        // Pilih customer_id yang belum digunakan
        return fake()->randomElement($availableCustomerIds);
        //GPT! END
    }
}
