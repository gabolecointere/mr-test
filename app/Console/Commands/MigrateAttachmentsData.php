<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\CommentAttachment;
use App\Models\Post;
use App\Models\PostAttachment;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

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
    protected $description = 'Migration of the data from the post_attachments and comment_attachments tables to attachments table';

    /**
     * The attachment data array.
     *
     * @var array
     */
    protected $attachmentArray = [];

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
     */
    public function handle()
    {
        $this->line('Migrating...');
        $this->newLine();

        PostAttachment::all()->each(function ($postAttachment) {
            $this->setAttachmentArray($postAttachment);
        });

        CommentAttachment::all()->each(function ($commentAttachment) {
            $this->setAttachmentArray($commentAttachment);
        });

        $this->withProgressBar(collect($this->attachmentArray)->chunk(100)->toArray(), function ($attachmentArray) {
            Attachment::insert($attachmentArray);
        });

        $this->newLine();
        $this->newLine();
        $this->info('Done!');
    }

    /**
     * Set attachmentArray.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    protected function setAttachmentArray(Model $model)
    {
        $attachable_type = (get_class($model) == PostAttachment::class) ? Post::class : Comment::class;
        $attachable_id = ($attachable_type == Post::class) ? $model->post_id : $model->comment_id;

        $this->attachmentArray[] = [
            'attachable_type' => $attachable_type,
            'attachable_id' => $attachable_id,
            'url' => $model->url,
            'updated_at' => $model->updated_at,
            'created_at' => $model->created_at,
        ];
    }
}
