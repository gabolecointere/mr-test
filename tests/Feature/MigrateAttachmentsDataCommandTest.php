<?php

namespace Tests\Feature;

use App\Models\CommentAttachment;
use App\Models\PostAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MigrateAttachmentsDataCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_migrate_attachment_data_console_command()
    {
        Artisan::call('db:seed');

        $this->artisan('migrate_attachments_data')->assertExitCode(0);

        $postAttachment = PostAttachment::all();

        $postAttachment->pluck('url')->each(function ($url) {
            $this->assertDatabaseHas('attachments', ['url' => $url]);
        });

        $commentAttachment = CommentAttachment::all();

        $commentAttachment->pluck('url')->each(function ($url) {
            $this->assertDatabaseHas('attachments', ['url' => $url]);
        });

        $totalAttachments = $postAttachment->count() + $commentAttachment->count();

        $this->assertDatabaseCount('attachments', $totalAttachments);
    }
}
