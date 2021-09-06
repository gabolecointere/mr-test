<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(5)
            ->hasPosts(10)
            ->create();

        foreach($users as $user)
        {
            $user->posts->each(function($post) {
                $post->post_attachments()->saveMany(\App\Models\PostAttachment::factory(13)->make());
                $post->comments()->saveMany(\App\Models\Comment::factory(10)->make());

                $post->comments->each(function ($comment) {
                    $comment->comment_attachments()->saveMany(\App\Models\CommentAttachment::factory(17)->make());
                });
            });
        }
    }
}
