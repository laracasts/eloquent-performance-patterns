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
            ->createMany(factory(User::class, 10)->make()->map->getAttributes())
        );

        $user = User::find(10000);
        $user->update([
            'first_name' => 'Bill',
            'last_name' => 'Gates',
            'email' => 'bill.gates@microsoft.com',
        ]);
        $user->company->update([
            'name' => 'Microsoft Corporation',
        ]);

        $user = User::find(20000);
        $user->update([
            'first_name' => 'Tim',
            'last_name' => 'O\'Reilly',
            'email' => 'tim@oreilly.com',
        ]);
        $user->company->update([
            'name' => 'O\'Reilly Media Inc.',
        ]);
    }
}
