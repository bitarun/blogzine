<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Referral;
use App\Models\TrafficStat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(200)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //Article::factory(264)->create();
        //Referral::factory(300)->create();
        //TrafficStat::factory(500)->create();

        /*User::all()->each(function (User $user) {
            return $user->doesntHave('profile')
                ->inRandomOrder()
        });*/

        //Comment::factory(600)->create();


        /* if Profile table is Empty */
        /*User::whereBetween('id', [61, 260])->each(function (User $user) {
            Profile::factory()->create([
                'user_id' => $user->id,
                'avatar' => '',
                'bio' => fake()->realText(300),
                'social_links' => ['telegram' => 'https://telegram.com',
                    'linkedin' => 'https://linkedin.com',
                    'instagram' => 'https://instagram.com'],
                'availability' => fake()->randomElement([1,1,1,1,1,1,0]),
            ]);
        });*/


        /* if Profile table is Not Empty */
        /*User::query()
            ->doesntHave('profile')     // اگر قبلاً ساخته نشده
            ->inRandomOrder()
            ->each(function (User $user) {
                Profile::factory()->create([
                    'user_id' => $user->id,
                      continue...
                ]);
            });*/
    }
}
