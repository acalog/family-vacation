<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function attachments()
    {
        # Tag has many attachments
        # Define a many-to-many relationship
        return $this->belongsToMany('App\Models\Tag');
    }
}
