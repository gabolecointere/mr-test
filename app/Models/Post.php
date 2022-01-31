<?php

namespace App\Models;

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
        return $this->hasMany(PostAttachment::class);
    }

    /**
     * Get all of post attachments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get all of comment attachments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function commentAttachments()
    {
        return $this->hasManyThrough(CommentAttachment::class, Comment::class);
    }
}
