<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),//sentence(3) to generate a title with 3 words fake
            'content' => fake()->sentences(5, true),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
