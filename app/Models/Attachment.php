<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['attachable_id', 'attachable_type', 'url'];

    public function attachable()
    {
        return $this->morphTo();
    }
}
