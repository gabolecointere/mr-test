<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DataService 
{
    public function GetData()
    {
        $users = DB::table('users')
        ->select([ 'users.name', 'posts.title'])
        ->selectSub('select count(*) from posts where posts.user_id = users.id', 'posts_count')
        ->selectSub('select count(*) from attachments where attachments.attachable_id = posts.id and attachments.attachable_type = \'App\Models\Post\'', 'posts_attachments_count')
        ->selectSub('select count(*) from comments where comments.post_id = posts.id', 'comments_count')
        ->selectSub('select count(*) from attachments where attachments.attachable_id = comments.id and attachments.attachable_type = \'App\Models\Comment\'', 'comment_attachments_count')
        ->leftJoin('posts', 'posts.user_id', '=', 'users.id')
        ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
        ->distinct()
        ->get();
        
        return collect($users)->groupBy('name');
    }
}