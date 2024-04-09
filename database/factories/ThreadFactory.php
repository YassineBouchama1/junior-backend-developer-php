<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    public function definition(): array
    {
        $userId = User::factory()->create()->id;

        return [
            'user_id' => $userId,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'likes_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
