<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Picture;
use App\Video;

class EventsController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedEvent = request()->validate([
            'name' => 'bail|required',
            'place' => 'bail|required',
            'date' => 'required|date'
        ]);
        
        $event = Event::create($validatedEvent);
        $event->slug = str_slug($event->name . ' ' . $event->id, '-');
        $event->save();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'évènement a bien été créé');

        return redirect('/administration/evenements');

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
        $event = Event::findOrFail($id);

        return view('admin.events.edit', compact('event'));
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
        $validatedEvent = request()->validate([
            'name' => 'required',
            'place' => 'required',
            'date' => 'required|date'
        ]);

        $event = Event::findOrFail($id);
        
        $event->update($validatedEvent);
        $event->slug = str_slug($event->name . ' ' . $event->id, '-');
        $event->save();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'évènement a bien été modifié');

        return redirect('/administration/evenements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if($event->pictures->count()){
            foreach($event->pictures as $picture){
                unlink(storage_path('app/public' . $picture->path));
                $picture->delete();
            }
        }

        if($event->videos->count()){
            foreach($event->videos as $video){
                unlink(storage_path('app/public' . $video->path_mp4));
                unlink(storage_path('app/public' . $video->path_webm));
                $video->delete();
            }
        }

        $event->delete();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'évènement a bien été supprimé');
        return redirect('/administration/evenements');
    }
}
