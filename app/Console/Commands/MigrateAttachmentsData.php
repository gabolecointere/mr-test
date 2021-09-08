<?php

namespace App\Console\Commands;

use App\Repositories\Application\PostAttachmentRepository;
use App\Repositories\Application\CommentAttachmentRepository;
use App\Repositories\Application\AttachmentRepository;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MigrateAttachmentsData extends Command
{
    protected $repPostAttchment;
    protected $repCommentAttchment;
    protected $repAttchment;

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
    protected $description = 'Migrate Attachments Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PostAttachmentRepository $repPostAttchment,
        CommentAttachmentRepository $repCommentAttchment,
        AttachmentRepository $repAttchment)
    {
        parent::__construct();

        $this->repPostAttchment = $repPostAttchment;
        $this->repCommentAttchment = $repCommentAttchment;
        $this->repAttchment = $repAttchment;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrate Attachments Data...');

        $this->warn('Migrating post attachments');
        $this->processAttachmentData('posts');
        $this->info('Post attachments migrated');

        $this->warn('Migrating comment attachments');
        $this->processAttachmentData('comments');
        $this->info('Comment attachments migrated');

        $this->info('Data Migrated!');
    }

    protected function processAttachmentData(string $type)
    {
        $attachments = array();

        if ($type == 'posts') $attachments = $this->getPostAttachmentData();
        if ($type == 'comments') $attachments = $this->getCommentAttachmentData();
        
        foreach ($attachments as $value)
        {
            $this->repAttchment->create(
                $this->resolveData($type, $value)
            );
        }
    }

    protected function resolveData(string $type, Model $value)
    {
        return new Request([
            'attachmentable_type' => $type,
            'attachmentable_id' => $type == 'posts' ? $value->post_id : $value->comment_id,
            'url' => $value->url
        ]);
    }

    protected function getPostAttachmentData()
    {
        return $this->repPostAttchment->all();
    }

    protected function getCommentAttachmentData()
    {
        return $this->repCommentAttchment->all();
    }

    protected function getAttachmentData()
    {
        return $this->repAttchment->all();
    }
}
