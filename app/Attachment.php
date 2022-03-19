<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Attachment extends Model implements StaplerableInterface
{
	use EloquentTrait;
    
    protected $guarded = ['id'];

    public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('file', ['url' => '/uploads/attachments/:attachment/:id/:style/:filename']);
		parent::__construct($attributes);
	}

    public function bidding()
    {
  	 return $this->belongsTo('App\Bidding');
    }
}
