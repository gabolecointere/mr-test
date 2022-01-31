<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_information()
    {
        Artisan::call('db:seed');

        $response = $this->get('index');

        $response->assertStatus(200);
        $response->assertViewIs('index');

        User::with('posts.comments')->get()->each(function ($user) use ($response) {
            $response->assertSee($user->name);
            $user->posts->each(function ($post) use ($response) {
                $response->assertSee($post->title);
            });
        });

        $response->assertSee('Attachments');
        $response->assertSee('Comments');
        $response->assertSee('Comment Attachments');
        $response->assertSee('13'); //Attachments
        $response->assertSee('10'); //Comments
        $response->assertSee('170'); //Comment Attachments
    }
}
