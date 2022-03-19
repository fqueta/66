<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	protected $guarded = ['id'];

	public function receivers(){
		return $this->hasMany('App/Receiver');
	}

	public function contacts(){
		return $this->hasMany('App/Contact');
	}
}