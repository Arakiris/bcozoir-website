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

    public function showall() {
        $events = Event::showevents()->paginate(12);

        return view('events', compact('events'));
    }

    public function eventpictures($slug) {
        $title = "Photos de l'évènement";

        $event = Event::with(['pictures'])->where('slug', $slug)->first();
        if(!$event){
            abort(404);
        }

        $pictures = $event->pictures()->get()->sortBy('id');

        return view('photos', compact('title', 'event', 'pictures'));
    }

    public function eventVideos($slug) {
        $title = "Vidéos de l'évènement";
        
        $event = Event::with('videos')->where('slug', $slug)->first();
        if(!$event){
            abort(404);
        }

        // $videos = $event->videos()->paginate(4);
        $videos = $event->videos()->get();

        return view('videos', compact('title', 'event', 'videos'));
    }
}
