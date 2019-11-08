<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use DB;

class ContactsController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Contact::all()->count() < 1){
            for($i = 1; $i <= 5; $i++){
                Contact::create();
            }
        }
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $validatedContact = request()->validate([
            'name1' => '',
            'email1' => 'nullable|email',
            'name2' => '',
            'email2' => 'nullable|email',
            'name3' => '',
            'email3' => 'nullable|email',
            'name4' => '',
            'email4' => 'nullable|email',
            'name5' => '',
            'email5' => 'nullable|email'
        ]);
        DB::table('contacts')->truncate();
        for( $i=1 ; $i <=5 ; $i++){
            $c = new Contact();
            $c->save();
        }

        for( $i=1 ; $i <=5 ; $i++){
            $contact = Contact::findOrFail($i);
            if(isset($validatedContact['name' . $i]))
                $contact->name = $validatedContact['name' . $i];
            if(isset($validatedContact['email' . $i]))
                $contact->email = $validatedContact['email' . $i];
            $contact->save();
        }
        $this->updateStatisticDate();
        return redirect()->back();
    }
}
