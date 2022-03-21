<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;


class Atrimestral extends Model
{
    use EloquentTrait;
    
    protected $guarded = ['id'];
    
    public function __construct(array $attributes = array()) {
		//$this->hasAttachedFile('file', ['url' => '/uploads/atrimestrals/:attachment/:id/:style/:filename']);
		parent::__construct($attributes);
	}

    public function bidding()
    {
  	 return $this->belongsTo('App\Btrimestral');
    }
}
