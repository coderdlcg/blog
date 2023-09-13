<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(50),
//            'thumbnail' => $this->faker->image(),
            'body' => $this->faker->text(),
            'status' => rand(0,1),
//            'author_id' => 1,
            'published_at' => now(),
        ];
    }
}
