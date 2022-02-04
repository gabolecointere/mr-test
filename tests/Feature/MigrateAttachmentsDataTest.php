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
    public function test_migrate_attachment_data()
    {
        $response = $this->artisan('migrate_attachments_data');
        $response->assertExitCode(0);
    }
}
