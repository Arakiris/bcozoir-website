<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\News;
use App\Tournament;
use App\Podium;
use App\Event;
use App\Picture;
use App\Video;

class VideosController extends Controller
{
    private $pictureTypes = ['gif', 'jpg', 'jpeg', 'png', 'bmp'];
    private $videoTypes = ['mp4', 'webm'];
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
            default:
                $data = News::findOrFail($idtype);
                $cancel = 'admin.actualites.index';
        }

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
                $folderPath = 'public/upload/medias/tournaments/' . $idtype;
                $class = Tournament::findOrFail($idtype);
                $view = "/admin/tournois";
                break;
            case 'evenement':
                $folderPath = 'public/upload/medias/events/' . $idtype;
                $class = Event::findOrFail($idtype);
                $view = "/admin/events";
                break;
            case 'podium':
                $folderPath = 'public/upload/medias/podia/' . $idtype;
                $class = Podium::findOrFail($idtype);
                $view = "/admin/tournois";
                break;
            default:
                $folderPath = 'public/upload/medias/news/' . $idtype;
                $class = News::findOrFail($idtype);
                $view = "/admin/news";
        }

        $path = request()->file('path_mp4')->store($folderPath);
        $video = new Video();
        $video->path_mp4 = substr($path, 6);

        $path = request()->file('path_webm')->store($folderPath);
        $video->path_webm = substr($path, 6);


        $class->videos()->save($video);

        session()->flash('notification_management_admin', 'La vidéo a bien été enregistré');

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
                unlink(storage_path('app/public' . $video->path));
                $video->delete();
            }
        }
        session()->flash('notification_management_admin', 'Les videos ont bien été supprimées');
        return redirect()->back();
    }
}
