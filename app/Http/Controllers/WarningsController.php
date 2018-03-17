<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\Warning;


/**
 * Controller who manages warnings of the website
 */
class WarningsController extends Controller
{
    /** Common methods between controller */
    use CommonTrait;
    
    /**
     * Create a new WarningsController instance.
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
        $warnings = Warning::all();
        return view('admin.warnings.index', compact('warnings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.warnings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedWarning = request()->validate([
            'body' => 'required',
            'date_disappear' => 'required|date'
        ]);
        
        Warning::create($validatedWarning);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'La nouvelle alerte a bien été enregistrée');

        return redirect('/administration/alertes');
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
        $warning = Warning::findOrFail($id);
        
        return view('admin.warnings.edit', compact('warning'));
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
        $validatedWarning = request()->validate([
            'body' => 'required',
            'date_disappear' => 'required|date'
        ]);
        
        Warning::findOrFail($id)->update($validatedWarning);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'alerte a bien été modifiée');
        
        return redirect('/administration/alertes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warning::findOrFail($id)->delete();
        $this->updateStatisticDate();
        
        session()->flash('notification_management_admin', 'L\'alerte a bien été supprimée');
        
        return redirect('/administration/alertes');
    }
}
