<?php

use App\Login;
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
        factory(User::class, 60)->create()->each(fn ($user) => $user->logins()
            ->createMany(factory(Login::class, 500)->make()->toArray())
        );
    }
}
