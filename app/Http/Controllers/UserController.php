<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getIndex()
    {

        $data = DB::table('users')
        ->select(
            'users.name as name',
            'posts.title as title',
            DB::raw("(SELECT COUNT(*) FROM attachments WHERE attachments.attachable_id = posts.id AND attachments.attachable_type = 'App\\\\Models\\\\Post') as count_attachments"),
            DB::raw("(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) as count_comments"),
            DB::raw("(
                SELECT COUNT(*)
                FROM attachments
                LEFT JOIN comments ON comments.id = attachments.attachable_id AND attachments.attachable_type = 'App\\\\Models\\\\Comment'
                WHERE comments.post_id = posts.id
                ) as count_comments_attachments
            ")
        )
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->get();
        
        $res = array();
        foreach ($data as $key => $value) {
            if (empty($res[$value->name])) {
                $res[$value->name] = [$value];
            } else {
                array_push($res[$value->name], $value);
            }
        }

        return view('index', [
            'data' => $res
        ]);
    }
}