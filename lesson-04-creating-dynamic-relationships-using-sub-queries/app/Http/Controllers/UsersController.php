<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->withLastLogin()
            ->orderBy('name')
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
