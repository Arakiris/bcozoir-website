<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Partner;
use App\Picture;

class PartnersController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::with('picture')->get();
        return view ('admin.partners.index', compact('partners'));
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
        $validatedPartner = request()->validate([
            'address' => 'nullable|string',
            'title' => 'nullable|string',
            'website' => 'nullable|url',
            'url' => 'nullable|url',
            'mail' => 'nullable|string',
            'phone1' => 'nullable|string',
            'phone1' => 'nullable|string',
            ]);
        
        request()->validate(['image' => 'required|image']);

        $partner = Partner::create($validatedPartner);
        
        if($file = $request->file('image')){
            $path = request()->file('image')->store('public/upload/images/partners');
            $picture = new Picture();
            $picture->path = substr($path, 6);

            $partner->picture()->save($picture);
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le partenaire a bien été enregistré');

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
        $partner = Partner::findOrFail($id);
        return view ('admin.partners.edit', compact('partner'));
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
        $validatedPartner = request()->validate([
            'address' => 'nullable|string',
            'title' => 'nullable|string',
            'website' => 'nullable|url',
            'url' => 'nullable|url',
            'mail' => 'nullable|string',
            'phone1' => 'nullable|string',
            'phone1' => 'nullable|string',
            ]);

        request()->validate(['image' => 'nullable|image']);

        $partner = Partner::findOrFail($id);
        $partner->update($validatedPartner);
        
        if($file = $request->file('image')){
            $previousPicture = $partner->picture->first();
            unlink(storage_path('app/public' . $previousPicture->path));
            $previousPicture->delete();

            $path = request()->file('image')->store('public/upload/images/partners');
            $picture = new Picture();
            $picture->path = substr($path, 6);

            $partner->picture()->save($picture);
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le partenaire a bien été modifié');

        return redirect('/administration/partenaires');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        if($partner->picture->count()){
            unlink(storage_path('app/public' . $partner->picture->first()->path));
            $partner->picture->first()->delete();
        }
        $partner->delete();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le partenaire a bien été supprimé');
        
        return redirect('/administration/partenaires');
    }
}
