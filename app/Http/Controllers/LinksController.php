<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\CommonTrait;

use App\Link;
use App\Picture;

class LinksController extends Controller
{
    use CommonTrait;
    
    /**
     * Create a new controller instance.
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
        $links = Link::with('picture')->get();
        return view ('admin.links.index', compact('links'));
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
        $validatedLink = request()->validate([
            'title' => 'required',
            'link' => 'required|url',
        ]);

        request()->validate(['image' => 'required|image']);

        $link = Link::create($validatedLink);
        
        if($file = $request->file('image')){
            $path = request()->file('image')->store('public/upload/images/links');
            $picture = new Picture();
            $picture->path = substr($path, 6);

            $link->picture()->save($picture);
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le lien utile a bien été enregistré');

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
        $link = Link::findOrFail($id);
        return view ('admin.links.edit', compact('link'));
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
        $validatedLink = request()->validate([
            'title' => 'required',
            'link' => 'required|url',
        ]);

        request()->validate(['image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg']);

        $link = Link::findOrFail($id);
        $link->save($validatedLink);
        
        if($file = $request->file('image')){
            $previousPicture = $link->picture->first();
            unlink(storage_path('app/public' . $previousPicture->path));
            $previousPicture->delete();

            $path = request()->file('image')->store('public/upload/images/links');
            $picture = new Picture();
            $picture->path = substr($path, 6);

            $link->picture()->save($picture);
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le lien utile a bien été mise-à-jour');

        return redirect('/administration/liens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::findOrFail($id)->delete();
        $this->updateStatisticDate();
        session()->flash('notification_management_admin', 'Le lien utile a bien été supprimé');
        return redirect('/administration/liens');
    }

    public function showall() {
        $links = Link::with('picture')->paginate(5);

        return view('links', compact('links'))->with($this->mainSharingFunctionality());
    }
}
