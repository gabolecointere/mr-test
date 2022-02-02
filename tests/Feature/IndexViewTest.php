<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class IndexViewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_index_view()
    {
        Artisan::call('db:seed');

        $response = $this->get('index');

        $response
        ->assertViewIs('index')
        ->assertSuccessful()
        ->assertSeeText('Title')
        ->assertSeeText('Attachments')
        ->assertSeeText('Comments')
        ->assertSeeText('Comment Attachments')
        ->assertSee('13')
        ->assertSee('10')
        ->assertSee('170');

        $users = User::with('posts')->get();

        $userNames = $users->map(function ($user) {
            return $user->name.' posts';
        })->all();

        $response->assertSeeTextInOrder($userNames);

        $postTitles = $users->map(function ($user) {
            return $user->posts->pluck('title');
        })->flatten()->all();

        $response->assertSeeTextInOrder($postTitles);
    }
}
