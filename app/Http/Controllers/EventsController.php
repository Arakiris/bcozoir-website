<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\Event;
use App\Picture;
use App\Video;

class EventsController extends Controller
{
    use CommonTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['show', 'showall', 'eventpictures', 'eventVideos']]);
     }

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
            'name' => 'required',
            'place' => 'required',
            'date' => 'required|date'
        ]);
        
        $event = Event::create($validatedEvent);
        $event->slug = str_slug($event->name . ' ' . $event->id, '-');
        $event->save();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'évènement a bien été créé');

        if($request->submitbutton == 'save'){
            return redirect('/administration/evenements');
        }
        else {
            $type = 'evenement';
            $data = $event;
            return view('admin.medias.create', compact('type', 'data'));
        }
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

        if($request->submitbutton == 'save'){
            return redirect('/administration/evenements');
        }
        else {
            $type = 'evenement';
            $data = $event;
            return view('admin.pictures.create', compact('type', 'data'));
        }
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
        $event->delete();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'évènement a bien été supprimé');
        return redirect('/administration/evenements');
    }

    public function showall() {
        $events = Event::showevents()->paginate(6);

        return view('events', compact('events'))->with($this->mainSharingFunctionality());
    }

    public function eventpictures($slug) {
        $title = "Photos de l'évènement";

        $event = Event::with('pictures')->where('slug', $slug)->first();
        if(!$event){
            abort(404);
        }

        $pictures = $event->pictures()->paginate(42);
        $allpictures = $event->pictures;

        return view('photos', compact('title', 'event', 'allpictures','pictures'))->with($this->mainSharingFunctionality());
    }

    public function eventVideos($slug) {
        $title = "Videos de l'évènement";
        
        $event = Event::with('videos')->where('slug', $slug)->first();
        if(!$event){
            abort(404);
        }

        $videos = $event->videos()->paginate(4);

        return view('videos', compact('title', 'event', 'videos'))->with($this->mainSharingFunctionality());
    }
}
