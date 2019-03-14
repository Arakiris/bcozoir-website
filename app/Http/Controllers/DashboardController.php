<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

use App\Http\Traits\CommonTrait;

use Validator;
use App\Advert;
use App\Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    use CommonTrait;

	public function index(){
        $ads = Advert::showad()->get();
		return view('welcome', compact('ads'))->with($this->mainSharingFunctionality());
	}

	public function version(){
        return view('version')->with($this->mainSharingFunctionality());
	}

	public function generalconditions(){
        return view('generalconditions')->with($this->mainSharingFunctionality());
	}

	public function proposal(){
        return view('proposal')->with($this->mainSharingFunctionality());
	}

	public function map(){
        return view('map')->with($this->mainSharingFunctionality());
    }

    public function bcozoir() {
        return view('bcozoir')->with($this->mainSharingFunctionality());
    }
    
    public function office() {
        return view('office')->with($this->mainSharingFunctionality());
    }

    public function addresses() {
        return view('addresses')->with($this->mainSharingFunctionality());
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