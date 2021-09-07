<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with(["posts" => function($query){
            return $query->select(['id', 'user_id','title']);
        },"posts.comments" => function($query){
            return $query->select(['id','post_id']);
        }])->get();

        return view(
            'index',
            compact('users')
        );
    }
}
