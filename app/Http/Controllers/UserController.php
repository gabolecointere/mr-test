<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getIndex()
    {


        $users = User::all();

        $data = array();
        foreach ($users as $key => $value) {
            $object = new \stdClass();
            $object->name = $value->name;
            $object->postData = DB::table('posts')
            ->select(
                'posts.title as title',
                DB::raw("(SELECT COUNT(*) FROM attachments WHERE attachments.post_id = posts.id) as count_attachments"),
                DB::raw("(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) as count_comments"),
                DB::raw("(
                    SELECT COUNT(*)
                    FROM attachments
                    LEFT JOIN comments ON comments.id = attachments.comment_id
                    WHERE comments.post_id = posts.id
                    ) as count_comments_attachments
                ")
            )
            ->where('posts.user_id', '=', $value->id)
            ->get();
            array_push($data, $object);
        }

        return view('index', [
            'data' => $data
        ]);
    }
}