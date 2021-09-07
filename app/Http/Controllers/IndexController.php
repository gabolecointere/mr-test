<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::with([
                'posts' => function ($query) {
                    $query->withCount(['attachments', 'comments']);
                },
                'posts.comments' => function ($query) {
                    $query->withCount(['attachments']);
                }
            ])->get();

        return view('index', compact('users'));
    }
}
