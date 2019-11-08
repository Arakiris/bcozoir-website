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

		return view('welcome', compact('ads'))->with($this->mainSharingFunctionality());
	}

	public function version(){
        $content = ContentInformation::findOrFail(3);

        return view('version', compact('content'))->with($this->mainSharingFunctionality());
	}

	public function generalconditions(){
        $content = ContentInformation::findOrFail(4);

        return view('generalconditions', compact('content'))->with($this->mainSharingFunctionality());
	}

	public function proposal(){
        return view('proposal')->with($this->mainSharingFunctionality());
	}

	public function map(){
        return view('map')->with($this->mainSharingFunctionality());
    }

    public function bcozoir() {
        $content = ContentInformation::findOrFail(1);

        return view('bcozoir', compact('content'))->with($this->mainSharingFunctionality());
    }
    
    public function office() {
        $content = ContentInformation::findOrFail(6);

        return view('office', compact('content'))->with($this->mainSharingFunctionality());
    }

    public function addresses() {
        $content = ContentInformation::findOrFail(2);

        return view('addresses', compact('content'))->with($this->mainSharingFunctionality());
    }

    public function contact() {
        return view('contact')->with($this->mainSharingFunctionality());
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