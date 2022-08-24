<?php

use App\Post;
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
        factory(User::class, 20)->create()->each(fn ($user) => $user->posts()
            ->createMany(factory(Post::class, 5)->make()->toArray())
        );
    }
}
