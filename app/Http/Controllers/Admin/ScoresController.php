<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Score;

class ScoresController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idMember)
    {
        $member = Member::with('score')->findOrFail($idMember);
        return view('admin.scores.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idMember)
    {
        $member =  Member::with('score')->findOrFail($idMember);
        $score = $member->score;

        if(!isset($member->score)){
            $score = new Score();
            $score->average = 0.0;
            $score->number_lines = 0;

            $member->score()->save($score);
        }

        return view('admin.scores.create', compact('member', 'score'));
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
            'number_lines' => 'required|numeric'
        ]);

        $validatedHistoricalPath = request()->validate(['historical_path' => 'required|image']);

        $member = Member::findOrFail($idMember);
        
        if(is_null($member->score)){
            $score = new Score();
        }
        else {
            $score = $member->score;
        }
        $score->average = $validatedScore['average'];
        $score->number_lines = $validatedScore['number_lines'];

        $member->score()->save($score);

        if($file = $request->file('historical_path')){
            if(!is_null($member->historical_path)){
                unlink(storage_path('app/public' . $member->historical_path));
            }

            $path = request()->file('historical_path')->store('public/upload/images/members/' . $member->id . '/scores' );

            $member->historical_path = substr($path, 6);
        }
        $member->handicap = floor((220 - $score->average)*0.7);
        $member->save();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le score a bien été enregistré');

        return redirect('/administration/membres');
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
        $member = Member::with('score')->findOrFail($idMember);
        $score = $member->score;

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
            'number_lines' => 'required|numeric'
        ]);

        $validatedHistoricalPath = request()->validate(['historical_path' => 'image']);

        $member = Member::findOrFail($idMember);
        
        $score = Score::findOrFail($id);

        $score->average = $validatedScore['average'];
        // $score->month = date('Y-m-d', strtotime($validatedScore['month']));
        $score->number_lines = $validatedScore['number_lines'];
        $member->score()->save($score);

        if($file = $request->file('historical_path')){
            if(is_null($member->historical_path)){
                unlink(storage_path('app/public' . $member->historical_path));
            }

            $path = request()->file('historical_path')->store('public/upload/images/members/' . $member->id . '/scores' );

            $member->historical_path = substr($path, 6);
        }
        $member->handicap = floor((220 - $score->average)*0.7);
        $member->save();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le score a bien été enregistré');

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
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le score a bien été supprimé');

        $member = Member::findOrFail($idMember);
        
        return redirect()->route('admin.scores.index', [$member]);
    }

    public function showAll(){
        $scores = Score::with('member')->get();
        
        return view('admin.scores.showAll', compact('scores'));
    }
}
