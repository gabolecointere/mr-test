<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostAttachment
 *
 * @property int $id
 * @property int $post_id
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PostAttachmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostAttachment whereUrl($value)
 * @mixin \Eloquent
 */
class PostAttachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'post_id',
        'url',
    ];
}
