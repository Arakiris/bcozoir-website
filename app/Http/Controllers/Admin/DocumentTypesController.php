<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DocumentType;

class DocumentTypesController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = DocumentType::all();

        return view('admin.documentTypes.index', compact('types'));
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
        $validatedTypeDoc = request()->validate([
            'name' => 'required|string'
        ]);

        DocumentType::create($validatedTypeDoc);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le type de document a bien été enregistré');

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
        $type = DocumentType::findOrFail($id);

        return view('admin.documentTypes.edit', compact('type'));
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
        $validatedTypeDoc = request()->validate([
            'name' => 'required|string'
        ]);

        $type = DocumentType::findOrFail($id);

        $type->name = $validatedTypeDoc['name'];
        $type->save();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le type de document a bien été mis-à-jour');

        return redirect('/administration/document-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = DocumentType::findOrFail($id);

        $type->delete();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le type de document a bien été supprimé');
        
        return redirect('/administration/document-types');
    }
}
