<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;
use App\Interest;
use App\Receiver;

use Input;

class ContactsController extends Controller
{
    public function store()
    {
        $contact = new Contact();
        $receiver = Receiver::all()->lists('email', 'id')->toArray();
        $contact->fill(Input::all());
        if ($contact->save())
            Contact::sendMessage(["contact" => $contact, 'receiver' => $receiver], 'email.question');
        else
            return abort(500, "Could not save");
    }
}
