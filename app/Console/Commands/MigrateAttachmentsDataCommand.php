<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\CommentAttachment;
use App\Models\PostAttachment;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class MigrateAttachmentsDataCommand extends Command
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
    protected $description = 'Migrate attachments data to the new attachment table';

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
        $allAttachments = PostAttachment::all()->map(function ($postAttachment) {
            return $postAttachment->toArray();
        })->merge(CommentAttachment::all()->map(function ($commentAttachment) {
            return $commentAttachment->toArray();
        }))->map(function ($attachment) {
            $isPost = $this->isPostAttachement($attachment);
            $attachableId = $isPost ? $attachment['post_id'] : $attachment['comment_id'];
            $attachableType = $isPost ? 'App\Models\Post' : 'App\Models\Comment';

            return [
                'attachable_id' => $attachableId,
                'attachable_type' => $attachableType,
                'url' => $attachment['url'],
                'created_at' => \Carbon\Carbon::parse($attachment['created_at']),
                'updated_at' => \Carbon\Carbon::parse($attachment['updated_at']),
            ];
        });

        Attachment::insert($allAttachments->toArray());
    }

    /**
     * Check if the attachment is a post attachment.
     *
     * @param array $attachment
     * @return bool
     */
    public function isPostAttachement(array $attachment)
    {
        return array_key_exists('post_id', $attachment);
    }
}
