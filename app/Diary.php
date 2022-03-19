<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
// Stapler
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Carbon\Carbon;

use App\Intervention;

class Diary extends Model implements StaplerableInterface
{
	use Sortable, EloquentTrait;	

	protected $guarded = ['id'];
	protected $dates = ['date'];

	public function __construct(array $attributes = array()) {
		Carbon::setLocale('pt_BR');
      	Carbon::setToStringFormat('d/m/Y');
		$this->hasAttachedFile('file', [
			'url' => '/uploads/diaries/:attachment/:id/:style/:filename'
		]);
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
}
