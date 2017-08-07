<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoFile extends Model
{
    protected $fillable = [
        'file_name', 'file_url', 'file_thumb', 'video_id'
    ];
}
