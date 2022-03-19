<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

use App\Intervention;

class Banner extends Model implements StaplerableInterface
{
	use EloquentTrait;

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('image', [
			'styles' => [
				'thumbnail' => '300x300',
				'list' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 1920, $height = 255);
				},
				'desktop' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 1920, $height = 700);
				},
			],
			'url' => '/uploads/banners/:attachment/:id/:style/:filename'
		]);
		parent::__construct($attributes);
	}

	protected $guarded = ['id'];
}
