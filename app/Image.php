<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Image extends Model implements StaplerableInterface
{
	use EloquentTrait;

  	public function __construct(array $attributes = array()) {
  		$this->hasAttachedFile('file', [
			'styles' => [
				'resized' => '1400',
		        'thumbnail' => 'x100',
		    ],
			'url' => '/uploads/images/:attachment/:id/:style/:filename'
		]);
		parent::__construct($attributes);
	}

	protected $table = 'files';
	protected $guarded = ['id'];
	public $timestamps = false;
}
