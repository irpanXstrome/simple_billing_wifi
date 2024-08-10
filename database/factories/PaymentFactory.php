<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Payment;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'customer_id' => CustomerFactory::getRandomCustomerId(Payment::pluck('customer_id')->all()),
            'amount' => 41000 * mt_rand(3,15),
            'paid_at' => fake()->date(),
            'proof_image' => fake()->imageUrl(), // Ini contoh, ganti sesuai kebutuhan
        ];

    }
}
