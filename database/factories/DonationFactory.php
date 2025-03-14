<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'donator_name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'amount' => fake()->randomNumber(4, false),
                'message' => fake()->text(),
                'date' => fake()->dateTime(),
                'user_id' => User::get()->random(),
        ];
    }
}
