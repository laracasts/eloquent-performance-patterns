<?php

namespace App\Http\Controllers;

use App\Feature;

class FeaturesController extends Controller
{
    public function index()
    {
        $features = Feature::query()
            ->withCount('comments', 'votes')
            ->when(request('sort'), function ($query, $sort) {
                switch ($sort) {
                    case 'title': return $query->orderBy('title', request('direction'));
                    case 'status': return $query->orderByStatus(request('direction'));
                    case 'activity': return $query->orderByActivity(request('direction'));
                }
            })
            ->latest()
            ->paginate();

        return view('features', ['features' => $features]);
    }
}
