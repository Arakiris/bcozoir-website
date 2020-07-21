<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Document;
use App\DocumentType;

class DocumentsController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::with('type')->get();
        $types = DocumentType::all();

        return view('admin.documents.index', compact('documents', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedType = request()->validate(['document_type_id' => 'required|integer']);
        $validatedDocument = request()->validate([
            'name' => 'bail|nullable|string',
            'file_type' => 'nullable|string|max:5'
        ]);

        $type = DocumentType::findOrFail(intval($validatedType['document_type_id']));

        $document = $type->documents()->create($validatedDocument);

        if($file = $request->file('file_path')){
            $originalname = $file->getClientOriginalName();
            $path = $file->storeAs('public/upload/documents', $originalname);
            $document->file_path = substr($path, 6);
        }

        $document->save();
        
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le document a bien été enregistré');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $types = DocumentType::all();

        return view('admin.documents.edit', compact('document', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedType = request()->validate(['document_type_id' => 'required|integer']);
        $validatedDocument = request()->validate([
            'name' => 'bail|nullable|string',
            'file_type' => 'nullable|string|max:5'
        ]);

        $document = Document::findOrFail($id);
        $type = DocumentType::findOrFail(intval($validatedType['document_type_id']));

        $document->name = $validatedDocument['name'];
        $document->file_type = $validatedDocument['file_type'];

        if($file = $request->file('file_path')){
            if(!is_null($document->file_path)){
                unlink(storage_path('app/public' . $document->file_path));
            }
            $originalname = $file->getClientOriginalName();
            $path = $file->storeAs('public/upload/documents', $originalname);
            $document->file_path = substr($path, 6);
        }

        $document->type()->associate($type);
        $document->save();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le document a bien été mis-à-jour');

        return redirect('/administration/documents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if(isset($document->file_path)){
            unlink(storage_path('app/public' . $document->file_path));
        }
        $document->delete();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le document a bien été supprimé');
        
        return redirect('/administration/documents');
    }
}
