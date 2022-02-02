<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of users, posts, comments and attachments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with([
            'posts' => function ($post) {
                $post->withCount('attachments');
                $post->withCount('comments');
                $post->withCount('commentAttachments');
            },
        ])->get();

        return view('index', compact('users'));
    }
}
