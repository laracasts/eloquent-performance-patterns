<?php

namespace App\Http\Controllers;

use App\Feature;

class FeaturesController extends Controller
{
    public function index()
    {
        if (config('database.default') === 'mysql' || config('database.default') === 'sqlite') {
            $statuses = Feature::toBase()
                ->selectRaw("count(case when status = 'Requested' then 1 end) as requested")
                ->selectRaw("count(case when status = 'Planned' then 1 end) as planned")
                ->selectRaw("count(case when status = 'Completed' then 1 end) as completed")
                ->first();
        }

        if (config('database.default') === 'pgsql') {
            $statuses = Feature::toBase()
                ->selectRaw("count(*) filter (where status = 'Requested') as requested")
                ->selectRaw("count(*) filter (where status = 'Planned') as planned")
                ->selectRaw("count(*) filter (where status = 'Completed') as completed")
                ->first();
        }

        $features = Feature::query()
            ->withCount('comments')
            ->paginate();

        return view('features', [
            'statuses' => $statuses,
            'features' => $features,
        ]);
    }
}
