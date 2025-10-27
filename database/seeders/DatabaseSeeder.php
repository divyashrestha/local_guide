<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function now;
use function rand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $test_user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        foreach (['Food', 'Nature', 'History', 'Shopping'] as $name) {
            Category::create([
                'name' => $name,
                'icon' => 'default-icon.png'
            ]);
        }

        $categoryIds = Category::pluck('id')->toArray();

        $users->each(function ($user) use ($categoryIds) {
            $places = Place::factory(rand(1, 10))->create(['user_id' => $user->id]);

            $places->each(function ($place) use ($categoryIds, $user) {
                // Attach 1–3 random categories to each place
                $place->categories()->attach(
                    collect($categoryIds)->random(rand(1, 3))->all()
                );

                // Create reviews
                Review::factory(rand(1, 10))->create([
                    'place_id' => $place->id,
                    'user_id' => $user->id
                ]);
            });
        });
    }
}
