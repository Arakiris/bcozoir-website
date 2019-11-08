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
        $events = Event::showevents()->paginate(6);

        return view('events', compact('events'))->with($this->mainSharingFunctionality());
    }

    public function eventpictures($slug) {
        $title = "Photos de l'évènement";

        $event = Event::with('pictures')->where('slug', $slug)->first();
        if(!$event){
            abort(404);
        }

        $pictures = $event->pictures()->orderBy('id', 'desc')->paginate(42);
        $allpictures = $event->pictures;

        return view('photos', compact('title', 'event', 'allpictures','pictures'))->with($this->mainSharingFunctionality());
    }

    public function eventVideos($slug) {
        $title = "Vidéos de l'évènement";
        
        $event = Event::with('videos')->where('slug', $slug)->first();
        if(!$event){
            abort(404);
        }

        $videos = $event->videos()->paginate(4);

        return view('videos', compact('title', 'event', 'videos'))->with($this->mainSharingFunctionality());
    }
}
