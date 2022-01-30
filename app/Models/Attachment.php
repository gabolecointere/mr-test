<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url'];

    /**
     * Get the parent attachable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }
}
