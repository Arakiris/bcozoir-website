<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Member;
use App\Club;
use App\Category;
use App\Picture;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::with(['club', 'category'])->get();
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = Club::all();
        $categories = Category::all();

        return view('admin.members.create', compact('clubs', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Club::findOrFail($request->club_id);
        Category::findOrFail($request->category_id);

        $validatedMember = request()->validate([
            'club_id' => 'required',
            'category_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required|min:1|max:1',
            'birth_date' => 'required|date',
            'is_licensee' => 'required|boolean',
            'id_licensee' => '',
            'bonus' => 'nullable|numeric'
        ]);

        $member = Member::create($validatedMember);

        request()->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if($file = $request->file('image')){
            $path = request()->file('image')->store('public/upload/images/members' . $member->id );
            $picture = new Picture();
            $picture->path = substr($path, 6);

            $member->picture()->save($picture);
        }
        
        session()->flash('notification_management_admin', 'Le nouveau membre a bien été enregistré');

        return redirect("/admin/membres");
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
        $clubs = Club::all();
        $categories = Category::all();
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('clubs', 'categories', 'member'));
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
        Club::findOrFail($request->club_id);
        Category::findOrFail($request->category_id);

        $validatedMember = request()->validate([
            'club_id' => 'required',
            'category_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required|min:1|max:1',
            'birth_date' => 'required|date',
            'is_licensee' => 'required|boolean',
            'id_licensee' => '',
            'bonus' => 'nullable|numeric'
        ]);

        $member = Member::findOrFail($id);

        if($validatedMember['is_licensee'] == 0){
            $validatedMember['id_licensee'] = null;
        }

        $member->update($validatedMember);

        request()->validate([
            'image' => 'nullable|image'
        ]);

        if($file = $request->file('image')){
            $previousPicture = $member->picture->first();
            if(!is_null($previousPicture)){
                unlink(storage_path('app/public' . $previousPicture->path));
                $previousPicture->delete();
            }

            $path = request()->file('image')->store('public/upload/images/members' . $member->id );
            $picture = new Picture();
            $picture->path = substr($path, 6);

            $member->picture()->save($picture);
        }
        session()->flash('notification_management_admin', 'Le membre a bien été édité');

        return redirect('/admin/membres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $previousPicture = $member->picture->first();
        unlink(storage_path('app/public' . $previousPicture->path));
        $previousPicture->delete();

        if(!is_null($member->historical_path)){
            unlink(storage_path('app/public' . $member->historical_path));
        }

        $member->delete();
        
        session()->flash('notification_management_admin', 'Le lien utile a bien été supprimé');
        return redirect('/admin/membres');
    }
}
