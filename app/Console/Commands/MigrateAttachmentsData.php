<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\CommentAttachment;
use App\Models\Post;
use App\Models\PostAttachment;
use Illuminate\Console\Command;

class MigrateAttachmentsData extends Command
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
    protected $description = 'Migrate the data from PostAttachment and CommentAttachment models to the Attachment model';

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
        PostAttachment::unguard(true);

        PostAttachment::all()
            ->map(function (PostAttachment $attachment) {
                return [
                    'attachable_id' => $attachment->post_id,
                    'attachable_type' => 'App\Models\Post',
                    'url' => $attachment->url,
                    'created_at' => $attachment->created_at,
                    'updated_at' => $attachment->updated_at,
                ];
            })->each(function ($item) {
                Attachment::create($item);
            });

        CommentAttachment::unguard(true);

        CommentAttachment::all()
            ->map(function (CommentAttachment $attachment) {
                return [
                    'attachable_id' => $attachment->comment_id,
                    'attachable_type' => 'App\Models\Comment',
                    'url' => $attachment->url,
                    'created_at' => $attachment->created_at,
                    'updated_at' => $attachment->updated_at,
                ];
            })
            ->each(function ($item) {
                Attachment::create($item);
            });

        return 0;
    }
}
