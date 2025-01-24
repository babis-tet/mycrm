<?php

namespace Database\Factories;

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
            'name' => $this->faker->name(),
            'activity' => $this->faker->word(),
            'vat' => $this->faker->optional()->numerify('VAT#######'), // Optional VAT
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'address' => $this->faker->optional()->address(),
            'zipcode' => $this->faker->optional()->postcode(),
            'city' => $this->faker->optional()->city(),
            'source' => $this->faker->optional()->randomElement(['Website', 'Referral', 'Social Media']),
            'source_id' => $this->faker->optional()->numberBetween(1,2), // Optional source_id
            'category_id' => $this->faker->optional()->numberBetween(1, 2), // Optional category_id
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
