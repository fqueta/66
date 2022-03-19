<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $guarded = ['id'];

    public function getType()
    {
    	if($this->bidding_id)
    		return 'bidding';
    	else
    		return 'category';
    }
}
