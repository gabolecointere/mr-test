<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display a listing of users, posts, comments and attachments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index', [
            'users' => \App\Models\User::all(),
        ]);
    }
}
