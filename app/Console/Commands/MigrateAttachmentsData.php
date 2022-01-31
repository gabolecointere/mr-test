<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Throwable;
use App\Models\Attachment;
use App\Models\PostAttachment;
use App\Models\CommentAttachment;
use Illuminate\Support\Facades\DB;
use Log;

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
    protected $description = 'Command to migrate olds table data to new table.';

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
        $this->info('Migrating data');
        $this->info('-----------------');
        $this->truncateTable();
        $this->migrateAttachmentsFromPost();
        $this->migrateAttachmentsFromComment();
    }

    public function truncateTable(): bool
    {
        Attachment::truncate();
        return true;
    }

    public function migrateAttachmentsFromPost(): bool
    {
        $this->info("Migrating post's attachments...");
        DB::beginTransaction();
        
        try {

            $postsAttachmentsOldTable = PostAttachment::all();
            $this->output->progressStart($postsAttachmentsOldTable->count());

            foreach ($postsAttachmentsOldTable as $key => $value) {

                $attachment = new Attachment;
                $attachment->post_id = $value->post_id;
                $attachment->comment_id = NULL;
                $attachment->url = $value->url;
                $attachment->save();

                $this->output->progressAdvance();
            }

        } catch (Throwable $th) {
            DB::rollBack();
            Log::info("Error posts attachment migrate: $th");
            $this->output->newLine();
            $this->info("Please check laravel.log posts migration failed");
            return false;
        }

        DB::commit();
        $this->output->progressFinish();
        $this->info("Attachments from post finished migration!");
        return true;
    }

    public function migrateAttachmentsFromComment(): bool
    {
        $this->info("Migrating comment's attachments...");
        DB::beginTransaction();
        
        try {

            $commentsAttachmentsOldTable = CommentAttachment::all();
            $this->output->progressStart($commentsAttachmentsOldTable->count());

            foreach ($commentsAttachmentsOldTable as $key => $value) {

                $attachment = new Attachment;
                $attachment->comment_id = $value->comment_id;
                $attachment->post_id = NULL;
                $attachment->url = $value->url;
                $attachment->save();

                $this->output->progressAdvance();
            }

        } catch (Throwable $th) {
            DB::rollBack();
            Log::info("Error comments attachment migrate: $th");
            $this->output->newLine();
            $this->info("Please check laravel.log comments migration failed");
            return false;
        }

        DB::commit();
        $this->output->progressFinish();
        $this->info("Attachments from comment finished migration!");
        return true;
    }
}
