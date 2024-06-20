<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Metadata extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'height',
        'width',
        'aspect_ratio',
        'display_aspect_ratio',
        'size',
        'location'
    ];

    public $timestamps = false;

    public function attachment(): BelongsTo
    {
        # Metadata belongs to Attachment
        # Defines an inverse One-to-One Relationship
        return $this->belongsTo('App\Models\Attachment');
    }
}
