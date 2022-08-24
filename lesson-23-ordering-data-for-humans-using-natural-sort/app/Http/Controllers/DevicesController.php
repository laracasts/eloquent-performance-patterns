<?php

namespace App\Http\Controllers;

use App\Device;

class DevicesController extends Controller
{
    public function index()
    {
        $devices = Device::query()
            ->orderByRaw('naturalsort(name)')
            ->paginate();

        return view('devices', ['devices' => $devices]);
    }
}
