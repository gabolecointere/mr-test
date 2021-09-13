<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MigrateAttachmentData extends Command
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
    protected $description = 'Migrate Attachment data from One to Many Relationship to a Polymorphic Relation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::all();
        $comments = Comment::all();
        $total_count = $posts->count() + $comments->count();
        $bar = $this->output->createProgressBar();

        $bar->start();
        try {
            $posts->each(function (Post $post) use ($bar) {
                $attachments = $post->post_attachments();
                $attachments->each(function ($attachment) use ($bar) {
                    Attachment::create(['attachable_id' => $attachment->post_id, 'attachable_type' => Post::class, 'url' => $attachment->url]);
                    $bar->advance();
                });
            });
            $comments->each(function (Comment $comment) use ($bar) {
                $attachments = $comment->comment_attachments();
                $attachments->each(function ($attachment) use ($bar) {
                    Attachment::create(['attachable_id' => $attachment->comment_id, 'attachable_type' => Comment::class, 'url' => $attachment->url]);
                    $bar->advance();
                });
            });
            Log::info('Data Migration Completed, Total Attachments: ' . Attachment::all(['id'])->count());
            $bar->finish();
        } catch (Exception $e) {
            Log::error('A error has occurred while migrating, please try again');
        }
        return 0;
    }
}
