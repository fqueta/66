<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;
use App\Receiver;
use App\Section;

use Mail;

class ContactsController extends Controller
{
    public function store(Request $request)
    {
        $contact = new Contact();
        $section = Section::find($request->get('section_id'));
        $receiver = Receiver::where('section_id', $request->get('section_id'))->get()->lists('email')->toArray();
        $contact->fill($request->all());
        if ($contact->save()){
            $data = ["contact" => $contact, 'receiver' => $receiver, 'subject' => 'Nova mensagem de contato recebida', 'section' => $section];
            Mail::send('email.contact', $data, function ($message) use ($data, $contact) {
            $message->to($data['receiver'])
                ->from('naoresponda@po.mg.gov.br', 'Município de Presidente Olegário')
                ->replyTo($contact->email, $contact->name)
                ->subject($data['subject']);
            });
        }
        else
            return abort(500, "Could not save");
    }
}
