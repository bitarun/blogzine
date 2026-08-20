<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        $random = rand(1, 43);
        $createdAt = fake()->dateTimeBetween('-2 months', 'now');

        return [
            'author_id' => User::whereBetween('id', [1, 60])->inRandomOrder()->value('id'),
            'title' => fake()->realText(100),
            'type' => Arr::random(['breaking', 'incidents', 'multimedia', 'other', 'news', 'text']),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'likes' => rand(0, 500),
            'slug' => fake()->slug(),
            'status' => Arr::random(['published', 'pending']),
            'description' => fake()->realText(300),
            'body' => fake()->realText(1000),
            'tags' => implode(',', array_map('trim', explode(' ', fake()->realText(50)))),
            'thumbnails' => [
                'large' => "{$random}.jpg",
                'medium' => "{$random}.jpg",
                'small' => "{$random}.jpg",
            ],
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }
}
