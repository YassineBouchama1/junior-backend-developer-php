<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;


    public function definition(): array
    {
        $cities = ['Safi', 'Marrakech', 'Casa', 'Tokyo'];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('pass123456'),
            'location' => $cities[array_rand($cities)], // Randomly cities
            // 'location' => $this->faker->city,
            'followers_count' => $this->faker->numberBetween(0, 1000), // Adjust follower count range as needed
            'remember_token' => Str::random(10),
        ];
    }

    // /**
    //  * Indicate that the model's email address should be unverified.
    //  *
    //  * @return $this
    //  */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
