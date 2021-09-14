<?php

namespace App\Http\Controllers;

use App\Services\DataService;

class IndexController extends Controller
{
    public function index(DataService $service)
    {
        $users  = $service->GetData();

        return view('index')
            ->with('users', $users);
    }
}
