<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class IndexRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {

        $view = $this->get('index');

        $oldView = (string) $this->view('/oldindex', ['users' => \App\Models\User::all()]);

        $contentOldView = strip_tags($oldView);

        $view->assertSeeText($contentOldView);
    }
}
