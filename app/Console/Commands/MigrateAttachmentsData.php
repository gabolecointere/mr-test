<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommentAttachment;
use App\Models\PostAttachment;
use App\Models\Attachment;

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
    protected $description = 'Data migration from comment_attachments and post_attachments tables to attachments';

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
        $newData =0;
        $commentAttachments = CommentAttachment::with('comment')->get();
        $postAttachments = PostAttachment::with('post')->get();
        Attachment::truncate();
        foreach ($commentAttachments as $commentAttachment)
        {
            $attachment = new Attachment();
            $attachment->url = $commentAttachment->url;
            $attachment->attachmentable()->associate($commentAttachment->comment)->save();
            $newData++;
        }
        foreach ($postAttachments as $postAttachment)
        {
            $attachment = new Attachment();
            $attachment->url = $postAttachment->url;
            $attachment->attachmentable()->associate($postAttachment->post)->save();
            $newData++;
        }

        $response= ['status' => 'ok', 'message' =>'Migracion finalizada. Total de registros insertados: '.$newData];
        print_r(json_encode($response));
    }
}
