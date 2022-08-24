<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function scopeSelectDistanceTo($query, array $coordinates)
    {
        if (is_null($query->getQuery()->columns)) {
            $query->select('*');
        }

        if (config('database.default') === 'mysql') {
            $query->selectRaw('ST_Distance(
                location,
                ST_SRID(Point(?, ?), 4326)
            ) as distance', $coordinates);
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            $query->selectRaw('ST_Distance(
                location,
                ST_MakePoint(?, ?)::geography
            ) as distance', $coordinates);
        }
    }

    public function scopeWithinDistanceTo($query, array $coordinates, int $distance)
    {
        if (config('database.default') === 'mysql') {
            $query->whereRaw('ST_Distance(
                location,
                ST_SRID(Point(?, ?), 4326)
            ) <= ?', [...$coordinates, $distance]);
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            $query->whereRaw('ST_DWithin(
                location,
                ST_MakePoint(?, ?)::geography,
                ?
            )', [...$coordinates, $distance]);
        }
    }

    public function scopeOrderByDistanceTo($query, array $coordinates, string $direction = 'asc')
    {
        $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';

        if (config('database.default') === 'mysql') {
            $query->orderByRaw('ST_Distance(
                location,
                ST_SRID(Point(?, ?), 4326)
            ) '.$direction, $coordinates);
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            $query->orderByRaw('ST_Distance(
                location,
                ST_MakePoint(?, ?)::geography
            ) '.$direction, $coordinates);
        }
    }
}
