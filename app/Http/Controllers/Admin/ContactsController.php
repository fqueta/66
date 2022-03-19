<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route;

use App\Contact;
use App\Section;

use Input;
use Session;

class ContactsController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());
        $contacts = Contact::where('name', 'LIKE', '%'.Session::get("filter_contacts_name").'%')
            ->where('email', 'LIKE', '%'.Session::get("filter_contacts_email").'%')
            ->where('phone', 'LIKE', '%'.Session::get("filter_contacts_phone").'%');
        $contacts->sortable();
        $count = $contacts->count();
        $contacts = $contacts->paginate(20);
        return view('admin.contacts.index', ['contacts' => $contacts, 'count' => $count, 'sections' => Section::lists('name', 'id')]);
    }

    public function create()
    {
        return view('admin.contacts.add', ['contact' => new Contact(), 'sections' => Section::lists('name', 'id')]);
    }

    public function store(Request $request)
    {
        $items = $request->all();
        if (Contact::create($items)) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.contacts.index');
        } else
            Session::flash('flash_warnig', 'record_failed');
            return view('admin.contacts.add');
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        if(AdminController::isEmpty($contact))
            return redirect()->route('admin.contacts.index');
        return view('admin.contacts.edit', ['contact' => $contact, 'sections' => Section::lists('name', 'id')]);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->fill($request->all());
        if(AdminController::isEmpty($contact))
            return redirect()->route('admin.contacts.index');
        if (!AdminController::isEmpty($contact) && $contact->save()){
            \Session::flash('flash_sucess', 'edit_sucess');
            return redirect()->route('admin.contacts.index');
        }
        else{
            \Session::flash('flash_danger', 'record_failed');
            return redirect()->route('admin.contacts.edit', $id);
        }
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if(!AdminController::isEmpty($contact) && Contact::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.contacts.index');
    }
}
