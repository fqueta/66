<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

use App\Intervention;

class Player extends Model implements StaplerableInterface
{
	use Sortable, EloquentTrait;

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('desktop', [
			'styles' => [
				'thumbnail' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 400, $height = 107);
				},
				'list' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 1600, $height = 640);
				},
			],
			'url' => '/uploads/players/:attachment/:id/:style/:filename'
		]);
		$this->hasAttachedFile('mobile', [
			'styles' => [
				'thumbnail' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 300, $height = 322);
				},
				'list' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 1000, $height = 1072);
				},
			],
			'url' => '/uploads/players/:attachment/:id/:style/:filename'
		]);
		parent::__construct($attributes);
	}

	protected $guarded = ['id'];
}
