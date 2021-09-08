<?php

namespace App\Console\Commands;

use App\Repositories\Application\PostAttachmentRepository;
use App\Repositories\Application\CommentAttachmentRepository;
use App\Repositories\Application\AttachmentRepository;
use Illuminate\Console\Command;

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
        $this->info('Migrating Attachments Data');

        $this->processPostAttachmentData();
    }

    protected function processPostAttachmentData()
    {
        $postAttachments = $this->getPostAttachmentData();
        $commentAttachments = $this->getCommentAttachmentData();
        $attachments = $this->getAttachmentData();
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
