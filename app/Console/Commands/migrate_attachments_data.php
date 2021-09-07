<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Console\Command;

class migrate_attachments_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_attachments_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from post_attachment and comment_attachment to Attachment model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $comments = Comment::all();
        $posts = Post::all();

        $comments->each(function($comment){
            foreach ($comment->comment_attachments as $comment_attachment){
                $comment->attachments()->create([
                    'url' => $comment_attachment->url,
                    'created_at' => $comment_attachment->created_at ,
                    'update_at' => $comment_attachment->updated_at,
                ]);
            }
        });

        $posts->each(function($post){
            foreach ($post->post_attachments as $post_attachments){
                $post->attachments()->create([
                    'url' => $post_attachments->url,
                    'created_at' => $post_attachments->created_at ,
                    'update_at' => $post_attachments->updated_at,
                ]);
            }
        });

        return 0;
    }
}
