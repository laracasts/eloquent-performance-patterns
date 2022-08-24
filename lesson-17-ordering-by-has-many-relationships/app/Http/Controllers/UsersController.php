<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderByLastLogin()
            ->withLastLogin()
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
