<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Repositories\Application\UserRepository;

class PostController extends Controller
{
    protected $repUser;

    public function __construct(UserRepository $repUser)
    {
        $this->repUser = $repUser;
    }

    public function index()
    {
        $users = $this->repUser->getUsersWithPosts();

        return view('index', [
            'users' => $users
        ]);
    }
}
