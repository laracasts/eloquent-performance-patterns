<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public static function booted()
    {
        static::addGlobalScope(function ($query) {
            if (is_null($query->getQuery()->columns)) {
                $query->select('*');
            }

            $query->selectRaw('ST_AsGeoJSON(geometry) as geometry_as_json');
        });
    }

    public function scopeHasCustomer($query, Customer $customer)
    {
        if (config('database.default') === 'mysql') {
            $query->whereRaw('ST_Contains(regions.geometry, ?)', [$customer->location]);
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            $query->whereRaw('ST_Contains(regions.geometry::geometry, ?)', [$customer->location]);
        }
    }
}
