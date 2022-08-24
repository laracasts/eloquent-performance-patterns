<?php

namespace App\Http\Controllers;

use App\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::query()
            ->with('salesRep')
            ->orderBy('name')
            ->paginate();

        return view('customers', ['customers' => $customers]);
    }
}
