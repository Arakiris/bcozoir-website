<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\Member;
use App\Score;

class ScoresController extends Controller
{
    use CommonTrait;

    public function listingtable() {
        $members = Member::with(['score', 'category'])->licenseemember()->paginate(100);

        return view('averagelisting', compact('members'))->with($this->mainSharingFunctionality());
    }
}
