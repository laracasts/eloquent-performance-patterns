<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->whereBirthdayThisWeek()
            ->orderByBirthday()
            // ->orderByUpcomingBirthdays()
            ->orderBy('name')
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
