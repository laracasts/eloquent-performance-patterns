<?php

use App\Comment;
use App\Feature;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 250)->create();

        factory(Feature::class, 60)->create()->each(function ($feature) use ($users) {
            $feature->comments()->createMany(
                factory(Comment::class, rand(1, 50))->make()->each(function ($comment) use ($users) {
                    $comment->user_id = $users->random()->id;
                })->toArray()
            );
        });
    }
}
