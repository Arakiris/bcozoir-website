<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use App\DocumentType;
use App\Document;

class DocumentsController extends Controller
{
    use CommonTrait;

    public function showall(){
        $types = DocumentType::with(['documents' => function($query) { $query->orderBy('name', 'asc');}])
                                ->orderBy('name', 'asc')
                                ->get();

        return view('variousdocuments', compact('types'));
    }
}
