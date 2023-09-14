<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function AllServices()
    {
        $allservices = Service::latest()->get();
        return view('admin.service.all_services', compact('allservices'));
    }
}
