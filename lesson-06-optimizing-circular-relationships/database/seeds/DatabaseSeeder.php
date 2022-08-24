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
        $users = $this->getUsers()->map(fn ($user) => factory(User::class)->create($user));

        factory(Feature::class, 60)->create()->each(function ($feature) use ($users) {
            $feature->comments()->createMany(
                factory(Comment::class, rand(1, 50))->make()->each(function ($comment) use ($users) {
                    $comment->user_id = $users->random()->id;
                })->toArray()
            );
        });
    }

    protected function getUsers()
    {
        return collect([
            ['name' => 'Lacey Kertzmann', 'photo' => 'female-1.jpeg'],
            ['name' => 'Tina Trantow', 'photo' => 'female-2.jpeg'],
            ['name' => 'Vanessa Gerhold', 'photo' => 'female-3.jpeg'],
            ['name' => 'Mina Prohaska', 'photo' => 'female-4.jpeg'],
            ['name' => 'Micah Daugherty', 'photo' => 'female-5.jpeg'],
            ['name' => 'Marianne Kunde', 'photo' => 'female-6.jpeg'],
            ['name' => 'Veronica Johnson', 'photo' => 'female-7.jpeg'],
            ['name' => 'Cecile Volkman', 'photo' => 'female-8.jpeg'],
            ['name' => 'Hannah Feeney', 'photo' => 'female-9.jpeg'],
            ['name' => 'Sandy Ullrich', 'photo' => 'female-10.jpeg'],
            ['name' => 'Christopher Bernier', 'photo' => 'male-1.jpeg'],
            ['name' => 'Angelo Murray', 'photo' => 'male-2.jpeg'],
            ['name' => 'Raleigh Welch', 'photo' => 'male-3.jpeg'],
            ['name' => 'Darby Jenkins', 'photo' => 'male-4.jpeg'],
            ['name' => 'Bart Hirthe', 'photo' => 'male-5.jpeg'],
            ['name' => 'Jarrell Von', 'photo' => 'male-6.jpeg'],
            ['name' => 'Stephon Marvin', 'photo' => 'male-7.jpeg'],
            ['name' => 'Kane Barton', 'photo' => 'male-8.jpeg'],
            ['name' => 'Baron Mayer', 'photo' => 'male-9.jpeg'],
            ['name' => 'John Richards', 'photo' => 'male-10.jpeg'],
        ]);
    }
}
