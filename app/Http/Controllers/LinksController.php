<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\CommonTrait;

use App\Link;
use App\Picture;

class LinksController extends Controller
{
    use CommonTrait;

    public function showall() {
        $links = Link::with('picture')->paginate(8);

        return view('links', compact('links'));
    }
}
