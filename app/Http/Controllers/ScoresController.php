<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Score;

class ScoresController extends Controller
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
    public function index($idMember)
    {
        $member = Member::with('scores')->findOrFail($idMember);
        return view('admin.scores.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idMember)
    {
        $member = Member::findOrFail($idMember);
        return view('admin.scores.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idMember, Request $request)
    {
        $validatedScore = request()->validate([
            'average' => 'required|numeric',
            'month' => 'required|date_format:Y-m',
            'number_lines' => 'required|numeric'
        ]);

        $validatedHistoricalPath = request()->validate(['historical_path' => 'required|image']);

        $member = Member::findOrFail($idMember);
        
        $score = new Score();
        $score->average = $validatedScore['average'];
        $score->month = date('Y-m-d', strtotime($validatedScore['month']));
        $score->number_lines = $validatedScore['number_lines'];

        $member->scores()->save($score);

        $path = request()->file('historical_path')->store('public/upload/images/members/' . $member->id . '/scores' );

        $member->historical_path = substr($path, 6);
        $member->save();

        session()->flash('notification_management_admin', 'Le score a bien été enregistrer');

        return redirect('/admin/membres');
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
    public function edit($idMember, $id)
    {
        $member = Member::findOrFail($idMember);
        $score = Score::findOrFail($id);
        return view('admin.scores.edit', compact('member', 'score'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idMember, $id)
    {
        $validatedScore = request()->validate([
            'average' => 'required|numeric',
            'month' => 'required|date_format:Y-m',
            'number_lines' => 'required|numeric'
        ]);

        $validatedHistoricalPath = request()->validate(['historical_path' => 'image']);

        $member = Member::findOrFail($idMember);
        
        $score = Score::findOrFail($id);

        $score->average = $validatedScore['average'];
        $score->month = date('Y-m-d', strtotime($validatedScore['month']));
        $score->number_lines = $validatedScore['number_lines'];
        $member->scores()->save($score);

        if($file = $request->file('historical_path')){
            unlink(storage_path('app/public' . $member->historical_path));

            $path = request()->file('historical_path')->store('public/upload/images/members/' . $member->id . '/scores' );

            $member->historical_path = substr($path, 6);
            $member->save();
        }

        session()->flash('notification_management_admin', 'Le score a bien été enregistrer');

        return redirect()->route('admin.scores.index', [$member]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMember, $id)
    {
        $score = Score::findOrFail($id)->delete();

        session()->flash('notification_management_admin', 'Le score a bien été supprimé');

        $member = Member::findOrFail($idMember);
        
        return redirect()->route('admin.scores.index', [$member]) ;
    }

    public function showAll(){
        $scores = Score::with('member')->get();
        return view('admin.scores.showAll', compact('scores'));
    }
}
