<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'body',
        'post_id'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    // protected $with = ['attachments'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comment_attachments()
    {
        return $this->hasMany(CommentAttachment::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachment');
    }
}
