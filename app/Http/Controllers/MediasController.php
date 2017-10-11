<?php

namespace App\Http\Controllers;
use Validator;
use App\News;
use App\Tournament;
use App\Podium;
use App\Event;
use App\Picture;
use App\Video;

use Illuminate\Http\Request;

class MediasController extends Controller
{
    private $pictureTypes = ['gif', 'jpg', 'jpeg', 'png', 'bmp'];
    private $videoTypes = ['flv', 'mp4', 'mov', 'avi', 'wmv', '3gp'];
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

        return view('admin.medias.index', compact('type', 'data'));
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
                break;
            case 'evenement':
                $data = Event::findOrFail($idtype);
                break;
            case 'podium':
                $data = Podium::findOrFail($idtype);
                break;
            default:
                $data = News::findOrFail($idtype);
        }

        return view('admin.medias.create', compact('type', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, $idtype, Request $request)
    {   
        //\Debugbar::info($request->picture->guessClientExtension());
        //$path = request()->file('picture')->store('public/upload/images/news/' . $idtype);
        if($type === 'actualite' || $type === 'tournoi' || $type === 'evenement'){
            $validator = Validator::make($request->all(), [
                'media' => 'mimes:jpeg,jpg,gif,png,bmp,flv,mp4,mov,avi,wmv,3gp|required|max:10000'
            ]);
        }
        else {
            $validator = Validator::make($request->all(), [
                'media' => 'mimes:jpeg,jpg,gif,png,bmp|required|max:10000'
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }

        $folderPath;
        switch ($type) {
            case 'tournoi':
                $folderPath = 'public/upload/medias/tournaments/' . $idtype;
                $class = Tournament::findOrFail($idtype);
                break;
            case 'evenement':
                $folderPath = 'public/upload/medias/events/' . $idtype;
                $class = Event::findOrFail($idtype);
                break;
            case 'podium':
                $folderPath = 'public/upload/medias/podia/' . $idtype;
                $class = Podium::findOrFail($idtype);
                break;
            default:
                $folderPath = 'public/upload/medias/news/' . $idtype;
                $class = News::findOrFail($idtype);
        }
        
        $path = request()->file('media');
        $extension = $path->extension();
        $path = $path->store($folderPath);
        if(in_array($extension, $this->pictureTypes)){
            $picture = new Picture();
            $picture->path = substr($path, 6);
            $class->pictures()->save($picture);
        }
        else {
            $video = new Video();
            $video->path = substr($path, 6);
            $class->videos()->save($video);
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
            $pictures = Picture::findOrFail($request->checkBoxArray);
    
            foreach($pictures as $picture){
                unlink(storage_path('app/public' . $picture->path));
                $picture->delete();
            }
        }
        return redirect()->back();
    }
}
