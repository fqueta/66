<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Notice extends Model
{
	use Sortable, Sluggable;

	function __construct(array $attributes = array())
  {
      Carbon::setLocale('pt_BR');
      Carbon::setToStringFormat('d/m/Y');
      parent::__construct($attributes);
  }

  public static function boot() {
    parent::boot();

    self::saving(function($model){
      return parseResponse($model, $markdown = true);
    });
  }

	public function scopeActive($query) {
		return $query->select(['id', 'title', 'content', 'date'])
							->where('expiration_date', '>=', Carbon::now()->toDateString())
							->where('active', true)
							->orderBy('date', 'DESC')
							->orderBy('id', 'DESC');
	}

  public function fromDateTime($value) {
    if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $value)) {
      $value = Carbon::createFromFormat('d/m/Y', $value)
        ->startOfDay()
        ->getTimestamp();
    }
    return parent::fromDateTime($value);
  }

  protected $dates = ['expiration_date', 'date'];

  protected $guarded = ['id'];

  public function sluggable()  {
        return ['slug' => ['source' => 'title']];
    }
}
