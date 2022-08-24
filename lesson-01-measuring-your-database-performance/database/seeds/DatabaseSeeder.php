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
        factory(Company::class, 1000)->create()->each(fn ($company) => $company->users()
            ->createMany(factory(User::class, 50)->make()->map->getAttributes())
        );
    }
}
