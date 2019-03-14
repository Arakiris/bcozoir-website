<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use Validator;
use App\News;
use App\Tournament;
use App\Podium;
use App\Picture;
use App\Event;

class PicturesController extends Controller
{
    use CommonTrait;
    
    private $pictureTypes = ['gif', 'jpg', 'jpeg', 'png', 'bmp', 'svg'];
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
                $data = Tournament::with('pictures')->findOrFail($idtype);
                break;
            case 'evenement':
                $data = Event::with('pictures')->findOrFail($idtype);
                break;
            case 'podium':
                $data = Podium::with('pictures')->findOrFail($idtype);
                break;
            default:
                $data = News::with('pictures')->findOrFail($idtype);
        }

        return view('admin.pictures.index', compact('type', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $idtype, $title)
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
                $cancel = 'admin.tournois.index';
                break;
            case 'actualite':
                $data = News::findOrFail($idtype);
                $cancel = 'admin.actualites.index';
                break;
            default:
                $data = News::findOrFail($idtype);
                $cancel = 'admin.evenements.index';
        }
        $this->updateStatisticDate();

        return view('admin.pictures.create', compact('type', 'data' , 'cancel', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, $idtype, $title, Request $request)
    {   
        // \Debugbar::alert($request);
        // clock()->info($request->all());
        $validator = Validator::make($request->all(), [
            'media' => 'required|image'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }

        $folderPath;
        switch ($type) {
            case 'tournoi':
                $folderPath = 'public/upload/images/tournaments/' . $idtype;
                $class = Tournament::findOrFail($idtype);
                break;
            case 'evenement':
                $folderPath = 'public/upload/images/events/' . $idtype;
                $class = Event::findOrFail($idtype);
                break;
            case 'podium':
                $folderPath = 'public/upload/images/podia/' . $idtype;
                $class = Podium::findOrFail($idtype);
                break;
            case 'actualite':
                $folderPath = 'public/upload/images/news/' . $idtype;
                $class = News::findOrFail($idtype);
                $class->photos = 1;
                $class->save();
                break;
            default:
                $folderPath = 'public/upload/images/events/' . $idtype;
                $class = Event::findOrFail($idtype);
        }
        $path = request()->file('media');
        $extension = $path->extension();
        $path = $path->store($folderPath);
        $picture = new Picture();
        $picture->path = substr($path, 6);
        $titlepicture = str_replace('61p61', '<p>', $title);
        $titlepicture = str_replace('85br85', '<br>', $titlepicture);
        $picture->title = str_replace('61pbis61', '</p>', $titlepicture);
        $class->pictures()->save($picture);
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
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Les photos ont bien été supprimées');

        return redirect()->back();
    }
}
