<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Upload extends Model implements StaplerableInterface
{
	use EloquentTrait, Sluggable, SluggableScopeHelpers;
    
    protected $guarded = ['id'];

    public function __construct(array $attributes = array()) {
			$this->hasAttachedFile('file', ['url' => '/uploads/uploads/:attachment/:id/:style/:filename']);
			parent::__construct($attributes);
		}

		public function sluggable(){
	    return ['slug' => ['source' => 'title']];
	  }
}