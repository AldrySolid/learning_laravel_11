<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProfileFactory extends Factory
{
    /**
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'  => fake()->firstName(),
            'second_name' => fake()->lastName(),
            'third_name'  => fake()->word(),
            'phone'       => fake()->phoneNumber(),
            'status'      => Profile::STATUS_ACTIVE,
            'birthday'    => fake()->date(),
            'user_id'     => User::factory(),
        ];
    }
}
