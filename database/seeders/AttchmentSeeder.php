<?php

namespace Database\Seeders;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class AttchmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = Comment::all();
        $posts = Post::all();

        $comments->each(function($comment){
            foreach ($comment->comment_attachments as $comment_attachment){
                $comment->attachments()->create([
                    'url' => $comment_attachment->url,
                ]);
            }
        });

        $posts->each(function($post){
            foreach ($post->post_attachments as $post_attachments){
                $post->attachments()->create([
                    'url' => $post_attachments->url,
                ]);
            }
        });
    }
}
