<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MigrateAttachmentsDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_migrate_command()
    {
        $this->artisan('migrate_attachments_data')
        ->expectsOutput('Attachments from post finished migration!')
        ->expectsOutput('Attachments from comment finished migration!')
        ->assertExitCode(0);
    }
}
