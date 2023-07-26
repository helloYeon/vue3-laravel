<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SampleUser>
 */
class SampleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // fake()->randomElement([1,2,3,4,5]),
        return [
            'name'         => fake()->unique()->userName(),
            'company'      => fake()->unique()->company(),
            'post_number'  => fake()->unique()->postcode(),
            'address'      => fake()->unique()->address(),
            'verify_code'  => fake()->numerify('#####'),
            'verified_at'  => fake()->unique()->dateTimeBetween(Carbon::now(), '+70 minutes')->format('Y-m-d H:i:s'),
            'last_used_at' => null,
            'expires_at'   => fake()->unique()->dateTimeBetween(Carbon::now(), '+90 day')->format('Y-m-d H:i:s'),
        ];
    }
}
