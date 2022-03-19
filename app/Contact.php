<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

use Mail;

class Contact extends Model
{
	use Sortable;

	protected $guarded = ['id'];

    protected $sortable = ["created_at", "name", "email", "phone", "schedule", "companySize", "doubts", "message"];

    static function sendMessage($data, $layout){
    	Mail::send($layout, $data, function ($message) use ($data) {
            $message->bcc($data['receiver'])
                ->from('naoresponda@po.mg.gov.br', 'Município de Presidente Olegário')
                ->subject($data['subject']);
        });
    }

    public function section()
    {
        return $this->belongsTo('App/Section');
    }
}