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

/**
 * Controller who manage different categories
 */
class DashboardController extends Controller
{
    /** Common methods between controller */
    use CommonTrait;

    /**
     * Display the welcome page
     *
     * @return \Illuminate\Http\Response
     */
	public function index(){
        $ads = Advert::showad()->get();
		return view('welcome', compact('ads'))->with($this->mainSharingFunctionality());
	}

    /**
     * Display the version page
     *
     * @return \Illuminate\Http\Response
     */
	public function version(){
        return view('version')->with($this->mainSharingFunctionality());
	}

    /**
     * Display the terms and conditions page
     *
     * @return \Illuminate\Http\Response
     */
	public function generalconditions(){
        return view('generalconditions')->with($this->mainSharingFunctionality());
	}

    /**
     * Display the proposal page
     *
     * @return \Illuminate\Http\Response
     */
	public function proposal(){
        return view('proposal')->with($this->mainSharingFunctionality());
	}

    /**
     * Display the location map of the club
     *
     * @return \Illuminate\Http\Response
     */
	public function map(){
        return view('map')->with($this->mainSharingFunctionality());
    }

    /**
     * Display the about page
     *
     * @return \Illuminate\Http\Response
     */
    public function bcozoir() {
        return view('bcozoir')->with($this->mainSharingFunctionality());
    }
    
    /**
     * Display the office page
     *
     * @return \Illuminate\Http\Response
     */
    public function office() {
        return view('office')->with($this->mainSharingFunctionality());
    }

    /**
     * Display the addresses of the partners
     *
     * @return \Illuminate\Http\Response
     */
    public function addresses() {
        return view('addresses')->with($this->mainSharingFunctionality());
    }

    /**
     * Display the contact page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact() {
        return view('contact')->with($this->mainSharingFunctionality());
    }

    /**
     * Send an email and redirect to previous page
     *
     * @return \Illuminate\Http\Response
     */
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