<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Genre;
use App\Phase;
use App\BiddingCategory;
use Carbon\Carbon;

class Bidding extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['opening'];

    // public static function boot()
    // {
    //     parent::boot();

    //     self::saving(function($model){
    //         $model->opening = Carbon::createFromFormat('dd/mm/YYYY H:mm', $model->opening);
    //         return $model;
    //     });
    // }

    function __construct(array $attributes = array())
    {
        Carbon::setLocale('pt_BR');
        Carbon::setToStringFormat('d/m/Y H:i');
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

    public function attachments()
    {
        return $this->hasMany('App\Attachment')->select(['id', 'title', 'file_file_name as file_name', 'order', 'bidding_id'])->orderBy('order', 'ASC');
    }

    public function notifications()
    {
    	return $this->hasMany('App\Notification');
    }

    public function genre()
    {
    	return $this->belongsTo(Genre::class, 'genre_id', 'id')->select(['id', 'name']);
    }

    public function phase()
    {
    	return $this->belongsTo(Phase::class, 'phase_id', 'id')->select(['id', 'name']);
    }

    public function category()
    {
        return $this->belongsTo(BiddingCategory::class, 'bidding_category_id', 'id')->select(['id', 'name']);
    }

    public function newsletters()
    {
        return $this->hasMany('App\Newsletter');
    }
}
