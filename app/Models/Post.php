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
        return Comment::where('post_id', $this->attributes['id'])
            ->sum(DB::raw("(select count(*) from attachments 
                where attachmentable_type = 'comments' 
                and attachmentable_id = comments.id)
            "));
    }
}
