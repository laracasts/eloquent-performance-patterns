<?php

use App\Customer;
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
        factory(User::class, 3)->create()->each(fn ($user) => $user->customer()
            ->createMany(factory(Customer::class, 25)->make()->toArray())
        );
    }
}
