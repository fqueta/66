<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Receiver extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    protected $sortable = ['name', 'email'];

    public function category()
    {
    	if($this->doubts && $this->called)
    		echo "Tire suas dúvidas e Ligamos para você";
    	elseif($this->doubts)
    		echo "Tire suas dúvidas";
    	elseif($this->called)
    		echo "Ligamos para você";
    }
}
