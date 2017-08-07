<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoTag extends Model
{
    //
    protected $fillable = [
        'tag_id', 'video_id'
    ];
}
