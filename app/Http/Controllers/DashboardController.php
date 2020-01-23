<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

use App\Http\Traits\CommonTrait;

use Validator;
use App\Advert;
use App\Contact;
use App\ContentInformation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    use CommonTrait;

	public function index(){
        $ads = Advert::showad()->get();

		return view('welcome', compact('ads'));
	}

	public function version(){
        $content = ContentInformation::where('name', 'version')->first();

        return view('version', compact('content'));
	}

	public function generalconditions(){
        $content = ContentInformation::where('name', 'mentions légales')->first();

        return view('generalconditions', compact('content'));
	}

	public function proposal(){
        return view('proposal');
	}

	public function map(){
        return view('map');
    }

    public function bcozoir() {
        $content = ContentInformation::where('name', 'presentation')->first();

        return view('bcozoir', compact('content'));
    }
    
    public function office() {
        $content = ContentInformation::where('name', 'bureau image')->first();

        return view('office', compact('content'));
    }

    public function addresses() {
        $content = ContentInformation::where('name', 'adresses')->first();

        return view('addresses', compact('content'));
    }

    public function contact() {
        return view('contact');
    }

    public function sendmail(request $request) {
        $validatedMail = request()->validate([
            'subject' => 'required',
            'civility' => ['required', Rule::in(['Monsieur', 'Madame', 'Mademoiselle'])],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel' => ['required', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/'],
            'message' => 'required'
        ]);
        $validatedMail['message'] = nl2br($validatedMail['message']);
        $contacts = Contact::where('email', '<>', '')->get();
        foreach($contacts as $contact){
            \Mail::to($contact->email)->send(new \App\Mail\Contact($validatedMail));
        }
        return redirect()->back();
    }
}