<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-10 months', 'now');
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            /*'role' => fake()->randomElement(['subscriber', 'author', 'author', 'subscriber', 'subscriber', 'subscriber', 'subscriber', 'subscriber',
                'subscriber', 'subscriber']),*/
            'role' => 'subscriber',
            'email_verified_at' => fake()->randomElement([now(), null]),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => fake()->randomElement([Str::random(10), null]),
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
