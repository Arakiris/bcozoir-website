<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;

class ClubsController extends Controller
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
        $clubs = Club::all();

        return view('admin.clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedClub = request()->validate([
            'name' => 'required|min:4',
            'address' => ''
        ]);

        Club::create($validatedClub);

        session()->flash('notification_management_admin', 'Le club a bien été enregistré');

        return redirect('/admin/clubs');
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
        $club = Club::findOrFail($id);

        return view('admin.clubs.edit', compact('club'));
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
        $validatedClub = request()->validate([
            'name' => 'required|min:4',
            'address' => ''
        ]);

        Club::findOrFail($id)->update($validatedClub);

        session()->flash('notification_management_admin', 'Le club &agrave; bien &eacute;t&eacute; mise-&agrave;-jour');

        return redirect('/admin/clubs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Club::findOrFail($id)->delete();
        session()->flash('notification_management_admin', 'Le club a bien été supprimée');
        return redirect('/admin/clubs');
    }
}
