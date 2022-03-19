<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Floater extends Model implements StaplerableInterface
{
	use EloquentTrait;

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('desktop', [
			'styles' => [
				'thumbnail' => '300x300',
				'list' => '976x610',
			],
			'url' => '/uploads/floaters/:attachment/:id/:style/:filename'
		]);
		$this->hasAttachedFile('mobile', [
			'styles' => [
				'thumbnail' => '300x300',
				'list' => '976x610',
			],
			'url' => '/uploads/floaters/:attachment/:id/:style/:filename'
		]);
		parent::__construct($attributes);
	}

	protected $guarded = ['id'];
}
