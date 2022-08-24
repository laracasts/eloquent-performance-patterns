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
        factory(User::class)->create(['name' => 'Ted Bossman', 'is_owner' => true]);
        factory(User::class)->create(['name' => 'Sarah Seller']);
        factory(User::class)->create(['name' => 'Chase Indeals']);

        User::all()->each(fn ($user) => $user->customer()
            ->createMany(factory(Customer::class, 25)->make()->toArray())
        );
    }
}
