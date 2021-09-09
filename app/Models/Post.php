<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function post_attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function sumCommentsAttachmentCount()
    {
        return $this->comments->reduce(function ($carry, $comment) {
               return $carry + $comment->comment_attachments_count;
            }); 
    }
}
