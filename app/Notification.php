<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];

    public function parent()
    {
    	return $this->belongsTo('App\Bidding', 'bidding_id');
    }
}
