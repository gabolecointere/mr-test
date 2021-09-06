<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommentAttachment
 *
 * @property int $id
 * @property int $comment_id
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CommentAttachmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentAttachment whereUrl($value)
 * @mixin \Eloquent
 */
class CommentAttachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'comment_id',
        'url',
    ];
}

