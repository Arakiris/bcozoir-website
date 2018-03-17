<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use App\Partner;
use App\Picture;

/**
 * Controller who manages partners of club
 */
class PartnersController extends Controller
{
    /** Common methods between controller */
    use CommonTrait;
    
     /**
     * Create a new PartnersController instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['show', 'showall']]);
     }

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
        $validatedPartner = request()->validate(['address' => 'required']);
        
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
        $validatedPartner = request()->validate(['address' => 'required']);

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

    /**
     * Display all partners
     *
     * @return \Illuminate\Http\Response
     */
    public function showall() {
        $partners = Partner::with('picture')->paginate(5);

        return view('partners', compact('partners'))->with($this->mainSharingFunctionality());
    }
}
