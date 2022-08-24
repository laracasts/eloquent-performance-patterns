<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function index()
    {
        Auth::login(User::where('name', 'Sarah Seller')->first());

        $customers = Customer::query()
            ->visibleTo(Auth::user())
            ->with('salesRep')
            ->orderBy('name')
            ->paginate();

        return view('customers', ['customers' => $customers]);
    }
}
