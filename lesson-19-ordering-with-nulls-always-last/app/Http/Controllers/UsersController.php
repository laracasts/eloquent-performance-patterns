<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->when(request('sort') === 'town', function ($query) {
                if (config('database.default') === 'mysql' || config('database.default') === 'sqlite') {
                    $query->orderByRaw('town is null')
                        ->orderBy('town', request('direction'));
                }

                if (config('database.default') === 'pgsql') {
                    $query->orderByNullsLast('town', request('direction'));
                }
            })
            ->orderBy('name')
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
