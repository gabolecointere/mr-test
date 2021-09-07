<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with(["posts" => function($query){
            $query->withCount('post_attachments')->withCount('comments');
        },"posts.comments" => function($query){
            $query->withCount('comment_attachments');
        }])->get();
        //dd($users[0]->posts[0]);
        return view(
            'index',
            compact('users')
        );
    }
}
