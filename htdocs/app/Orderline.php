<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order')->withDefault();   // an orderline belongs to an order
    }
}
