<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $fillable = [
        'title', 'thumb', 'introduction',
        'episodes', 'language', 'version',
        'address', 'tag', 'akira','status','is_new','issue_date','update_date'
    ];

    public function files()
    {
        return $this->hasMany('App\VideoFile','video_id');
    }

    public function tags(){
        return $this->belongsToMany(\App\Tag::class, 'video_tags','video_id','tag_id');
    }

    public function akiras(){
        return $this->belongsToMany(\App\Akira::class, 'video_akiras','video_id','akira_id');
    }
}
