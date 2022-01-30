<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\CommentAttachment;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MigrateAttachmentsDataCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_migrate_attachments_data_command()
    {
        $numberOfAttachments = 8;

        $user = User::factory()
            ->has(
                Post::factory()->count(1)
                    ->has(
                        PostAttachment::factory()
                            ->count($numberOfAttachments),
                        'post_attachments'
                    )
                    ->has(
                        Comment::factory()
                            ->count(1)
                            ->has(
                                CommentAttachment::factory()
                                    ->count($numberOfAttachments),
                                'comment_attachments'
                            )
                    )
            )->create();

        $this->artisan('migrate_attachments_data')->assertExitCode(0);

        $user->posts()->first()->post_attachments->pluck('url')
            ->each(function ($url) {
                $this->assertDatabaseHas('attachments', ['url' => $url]);
            });

        $this->assertDatabaseCount('attachments', $numberOfAttachments * 2);
    }
}
