<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amounts = [100000, 120000, 140000,80000,50000];
        $amount = $amounts[array_rand($amounts)];
        $unique_code = $this->faker->numberBetween(111, 999);

        return [
            'invoice_number' => $this->faker->numerify('INV-##-###-####'),
            'status' => 'pending',
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email,
            'payment_method' => 'BCA',
            'amount' => $amount,
            'total' => $amount + $unique_code,
        ];
    }
}
