<?php

namespace App\Console\Commands;

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
    protected $description = 'Migrate Attachments Data';

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
        $this->info('Migrating Attachments Data');

        $this->processPostAttachmentData();
    }

    protected function processPostAttachmentData()
    {
        $postAttachments = $this->getPostAttachmentData();
    }

    protected function getPostAttachmentData()
    {
        
    }
}
