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
        'user_id',
    ];

    /**
     * A post belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A post may have many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * A post may have many post attachments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post_attachments()
    {
        return $this->hasMany(PostAttachment::class);
    }

    /**
     * Get all of the post's attachments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /*
     * Get all of comment attachments for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function commentAttachments()
    {
        return $this->hasManyThrough(Attachment::class, Comment::class, 'post_id', 'attachable_id')->where('attachable_type', Comment::class);
    }
}
