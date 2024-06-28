<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'filename',
        'title',
        'type',
        'owner',
        'width',
        'height',
        'aspect_ratio',
        'display_aspect_ratio'
    ];

    public function tag()
    {
        # Attchment has many tags
        # Define a many-to-many relationship
        return $this->belongsToMany('App\Models\Attachment');
    }

}
