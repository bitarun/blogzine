<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        $parentComment = Comment::inRandomOrder()->first();
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'parent_id' => $parentComment->id,
            'article_id' => Article::find($parentComment->article_id),
            'body' => fake()->realText(300),
            'is_approved' => fake()->boolean(),


            /* For Make Parents */
            //'article_id' => Article::inRandomOrder()->value('id'),
            //'parent_id' => null,
        ];
    }
}
