<?php

use App\Store;
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
        $stores = array_map('str_getcsv', file(__DIR__.'/stores.csv'));

        collect($stores)->each(fn ($store) => Store::create([
                'address' => $store[0],
                'city' => $store[1],
                'state' => $store[2],
                'postal' => $store[3],
                'location' => (function () use ($store) {
                    if (config('database.default') === 'mysql') {
                        return DB::raw('ST_SRID(Point('.$store[4].', '.$store[5].'), 4326)');
                    }

                    if (config('database.default') === 'sqlite') {
                        throw new \Exception('This lesson does not support SQLite.');
                    }

                    if (config('database.default') === 'pgsql') {
                        return DB::raw('ST_MakePoint('.$store[4].', '.$store[5].')');
                    }
                })(),
            ])
        );
    }
}
