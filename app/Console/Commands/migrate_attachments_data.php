<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\CommentAttachment;
use App\Models\PostAttachment;
use Illuminate\Console\Command;

class migrate_attachments_data extends Command
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
    protected $description = 'Comando para migrar los datos a la nueva relación polimórfica.';

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
        $post_attachments    = PostAttachment::all();
        $comment_attachments = CommentAttachment::all();

        echo "Espere, esto puede tomar un momento.\n";

        $post_attachments->each(function($post_attachment) {
            $attachment = new Attachment;
            $attachment->url = $post_attachment->url;
            $post_attachment->post->attachments()->save($attachment);
        });

        echo "post_attachments migrados, se procede ahora con comment_attachments.\n";

        $comment_attachments->each(function($comment_attachment){
            $attachment = new Attachment;
            $attachment->url = $comment_attachment->url;
            $comment_attachment->comment->attachments()->save($attachment);
        });

        echo "Listo \n";

        return 0;
    }
}
