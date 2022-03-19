<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

use Carbon\Carbon;
use App\Intervention;

class Post extends Model implements StaplerableInterface
{
	use Sortable, EloquentTrait, Sluggable;

	protected $guarded = ['id'];
	protected $dates = ['date'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('image_preview', [
			'styles' => [
				'thumbnail_admin' => '400x400',
				'thumbnail' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 430, $height = 430);
				},
				'list' => function($file, $imagine) {
					return Intervention::fitImage($file, $imagine, $width = 1000, $height = 1072);
				},
			],
			'url' => '/uploads/posts/:attachment/:id/:style/:filename'
		]);
		Carbon::setLocale('pt_BR');
    Carbon::setToStringFormat('d/m/Y');
		parent::__construct($attributes);
	}


	public function fromDateTime($value) {
    if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $value)) {
      $value = Carbon::createFromFormat('d/m/Y', $value)
        ->startOfDay()
        ->getTimestamp();
    }
    return parent::fromDateTime($value);
  }

	public function category()
  {
  	return $this->belongsTo('App\Category');
  }

	public function sluggable()
  {
    return ['slug' => ['source' => 'title']];
  }
}
