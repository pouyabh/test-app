<?php

namespace Database\Factories;

use App\Enums\UserGender;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'                  => fake()->name(),
            'lastname'              => fake()->name(),
            'phonenumber'           => fake()->unique()->numberBetween(00000000000,99999999999),
            'national_code'         => fake()->unique()->numberBetween(0000000000,9999999999),
            'gender'                => fake()->randomElement(UserGender::values()),
            'email'                 => fake()->unique()->safeEmail(),
            'email_verified_at'     => now(),
            'password'              => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
