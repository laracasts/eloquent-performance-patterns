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
        factory(Company::class, 10000)->create()->each(fn ($company) => $company->users()
            ->createMany(factory(User::class, 5)->make()->map->getAttributes())
        );
    }
}
