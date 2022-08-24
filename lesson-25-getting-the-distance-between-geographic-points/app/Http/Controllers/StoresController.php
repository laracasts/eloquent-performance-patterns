<?php

namespace App\Http\Controllers;

use App\Store;

class StoresController extends Controller
{
    public function index()
    {
        $myLocation = [-79.47, 43.14];

        $stores = Store::query()
            ->selectDistanceTo($myLocation)
            ->paginate();

        return view('stores', ['stores' => $stores]);
    }
}
