<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('company')
            ->search(request('search'))
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
