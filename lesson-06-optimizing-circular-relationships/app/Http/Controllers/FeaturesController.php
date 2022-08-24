<?php

namespace App\Http\Controllers;

use App\Feature;

class FeaturesController extends Controller
{
    public function index()
    {
        $features = Feature::query()
            ->withCount('comments')
            ->paginate();

        return view('features', ['features' => $features]);
    }

    public function show(Feature $feature)
    {
        $feature->load('comments.user');
        $feature->comments->each->setRelation('feature', $feature);

        return view('feature', ['feature' => $feature]);
    }
}
