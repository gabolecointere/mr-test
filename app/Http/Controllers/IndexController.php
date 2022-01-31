<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        $users = User::with([
            'posts:id,title,user_id',
            'posts' => function ($post) {
                $post->withCount('post_attachments');
                $post->withCount('comments');
                $post->withCount('commentAttachments');
            },
        ])->get();

        return view('index', [
            'users' => $users,
        ]);
    }
}
