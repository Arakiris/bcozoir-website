<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use App\Partner;
use App\Picture;
use App\ContentInformation;

class PartnersController extends Controller
{
    use CommonTrait;

    public function showall() {
        $partners = Partner::with('picture')->paginate(8);

        return view('partners', compact('partners'));
    }

    public function becomePartner(){
        $contentInformation = ContentInformation::where('name', 'appel partenaires')->first();

        return view('becomepartner', compact('contentInformation'));
    }
}
