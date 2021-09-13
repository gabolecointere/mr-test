<?php

namespace App\Http\Controllers;

use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::with('posts')
        ->withCount('posts')
        ->get();
        return view('index')
            ->with('users', $users);
    }
}
