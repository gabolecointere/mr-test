<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('index', ['users' => $users]);
    }

    public function index_fast()
    {
        if (Schema::hasTable('attachments')) {
            $users = User::with(['posts.attachments', 'posts.comments.attachments'])->get();
            return view('index_fast', ['users' => $users]);
        } else {
            $users = User::with(['posts.post_attachments', 'posts.comments.comment_attachments'])->get();
            return view('index_medium', ['users' => $users]);
        }

    }

    public function index_medium()
    {
        $users = User::with(['posts.post_attachments', 'posts.comments.comment_attachments'])->get();
        return view('index_medium', ['users' => $users]);
    }
}
