<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'title','user_id','num', 'price','is_hot','status',
        'is_sale','sale_price','desc','thumb','category_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
