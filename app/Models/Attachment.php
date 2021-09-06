<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table    = "attachments";
    protected $fillable = [
        'name',
        'path'
    ];

    public function attachable()
    {
        return $this->morphTo();
    }
}
