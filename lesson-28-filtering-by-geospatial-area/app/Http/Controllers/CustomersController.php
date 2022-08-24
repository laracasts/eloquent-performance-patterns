<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Region;

class CustomersController extends Controller
{
    public function index()
    {
        // To find the customers for a specific region:
        $regions = Region::all();
        $customers = Customer::query()
            ->inRegion(Region::where('name', 'The Prairies')->first())
            ->get();

        // To find the region from a random customer:
        // $customers = Customer::inRandomOrder()->take(1)->get();
        // $regions = Region::hasCustomer($customers->first())->get();

        return view('customers', [
            'customers' => $customers,
            'regions' => $regions,
        ]);
    }
}
