<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class File extends Model implements StaplerableInterface
{
	use EloquentTrait;

  public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('file', ['url' => '/uploads/files/:attachment/:id/:style/:filename']); 
		parent::__construct($attributes);
	}

	protected $guarded = ['id'];
	public $timestamps = false;
}
