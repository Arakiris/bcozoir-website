<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use Validator;
use App\News;
use App\Tournament;
use App\Podium;
use App\Event;
use App\Picture;
use App\Video;

/**
 * Controller who manages videos
 */
class VideosController extends Controller
{
    /** Common methods between controller */
    use CommonTrait;
    
    private $pictureTypes = ['gif', 'jpg', 'jpeg', 'png', 'bmp'];
    private $videoTypes = ['mp4', 'webm'];

    /**
     * Create a new VideosController instance.
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
    public function index($type, $idtype)
    {
        switch ($type) {
            case 'tournoi':
                $data = Tournament::with(['pictures', 'videos'])->findOrFail($idtype);
                break;
            case 'evenement':
                $data = Event::with(['pictures', 'videos'])->findOrFail($idtype);
                break;
            case 'podium':
                $data = Podium::with(['pictures', 'videos'])->findOrFail($idtype);
                break;
            default:
                $data = News::with(['pictures', 'videos'])->findOrFail($idtype);
        }

        return view('admin.videos.index', compact('type', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $idtype)
    {
        switch ($type) {
            case 'tournoi':
                $data = Tournament::findOrFail($idtype);
                $cancel = 'admin.tournois.index';
                break;
            case 'evenement':
                $data = Event::findOrFail($idtype);
                $cancel = 'admin.evenements.index';
                break;
            case 'podium':
                $data = Podium::findOrFail($idtype);
                $cancel = 'admin.podiums.index';
                break;
            case 'actualite':
                $data = News::findOrFail($idtype);
                $cancel = 'admin.actualites.index';
                break;
            default:
                $data = Event::findOrFail($idtype);
                $cancel = 'admin.evenements.index';
        }
        $this->updateStatisticDate();

        return view('admin.videos.create', compact('type', 'data', 'cancel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, $idtype, Request $request)
    {   
        request()->validate([
            'path_mp4' => 'required|mimes:mp4',
            'path_webm' =>  'required|mimes:webm'
        ]);

        $folderPath;
        $class;
        $view;
        switch ($type) {
            case 'tournoi':
                $folderPath = 'public/upload/videos/tournaments/' . $idtype;
                $class = Tournament::findOrFail($idtype);
                $view = "/administration/tournois";
                break;
            case 'evenement':
                $folderPath = 'public/upload/videos/events/' . $idtype;
                $class = Event::findOrFail($idtype);
                $view = "/administration/evenements";
                break;
            case 'podium':
                $folderPath = 'public/upload/videos/podia/' . $idtype;
                $class = Podium::findOrFail($idtype);
                $view = "/administration/tournois";
                break;
            case 'actualite':
                $folderPath = 'public/upload/videos/news/' . $idtype;
                $class = News::findOrFail($idtype);
                $class->videos = 1;
                $view = "/administration/actualites";
                $class->save();
                break;
            default:
                $folderPath = 'public/upload/videos/events/' . $idtype;
                $class = Event::findOrFail($idtype);
                $view = "/administration/evenements";
        }

        $path = request()->file('path_mp4')->store($folderPath);
        $video = new Video();
        $video->path_mp4 = substr($path, 6);

        $path = request()->file('path_webm')->store($folderPath);
        $video->path_webm = substr($path, 6);


        $class->videos()->save($video);

        return redirect($view);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!empty($request->checkBoxArray)){
            $videos = Video::findOrFail($request->checkBoxArray);
    
            foreach($videos as $video){
                unlink(storage_path('app/public' . $video->path_mp4));
                unlink(storage_path('app/public' . $video->path_webm));
                $video->delete();
            }
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Les videos ont bien été supprimées');
        return redirect()->back();
    }
}
