<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'attachmentable_id',
        'attachmentable_type',
    ];

    public function attachmentable()
    {
        return $this->morphTo();
    }
}
