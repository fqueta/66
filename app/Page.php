<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
  use Sortable, Sluggable;

	protected $guarded = ['id'];

	public static function boot()
	{
		parent::boot();

		self::saving(function($model){
			$model = parseResponse($model);
			if($model->type !== 'link'){
				$model->link == null;
				$model->target = null;
			}
			return $model;
    });
	}

	public function parent(){
		return $this->belongsTo('App\Page', 'page_id')->select(['id', 'title', 'target', 'slug'])->with('activePages');
	}

	public function subpages(){
		return $this->hasMany('App\Page')->select(['id', 'title', 'slug', 'link', 'target', 'type', 'page_id', 'active'])->orderBy('order', 'ASC');
	}

	public function activePages(){
		return $this->hasMany('App\Page')
            ->orderBy('order', 'ASC')
            ->where(['active' => 1])
            ->select(['id', 'title', 'slug', 'link', 'target', 'type', 'page_id', 'active', 'order']);
	}

	public function sluggable(){
    return ['slug' => ['source' => 'title']];
  }
}
