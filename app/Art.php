<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $fillable = [
        'images','user_id','title','status','see'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
