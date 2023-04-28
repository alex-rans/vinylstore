<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();   // an order belongs to a user
    }
    public function orderlines()
    {
        return $this->hasMany('App\Orderline');   // an order has many orderlines
    }

}
