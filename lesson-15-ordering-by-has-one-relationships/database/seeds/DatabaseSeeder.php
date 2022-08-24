<?php

use App\Company;
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
        factory(User::class, 50000)->create()->each(fn ($user) =>
            factory(Company::class)->create(['user_id' => $user->id])
        );
    }
}
