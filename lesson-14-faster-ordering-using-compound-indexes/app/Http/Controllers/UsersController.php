<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
