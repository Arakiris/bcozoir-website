<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\News;
use App\Tournament;
use App\Podium;
use App\Picture;
use App\Event;
use Image;

class PicturesController extends Controller
{
    use CommonTrait;
    
    private $pictureTypes = ['gif', 'jpg', 'jpeg', 'png', 'bmp', 'svg'];

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

        $storage = storage_path('app/public');
        $folderPath;
        switch ($type) {
            case 'tournoi':
                // $folderPath = 'public/upload/images/tournaments/' . $idtype;
                $folderPath = '/upload/images/tournaments/' . $idtype . '/';
                $class = Tournament::findOrFail($idtype);
                break;
            case 'evenement':
                // $folderPath = 'public/upload/images/events/' . $idtype;
                $folderPath = '/upload/images/events/' . $idtype . '/';
                $class = Event::findOrFail($idtype);
                break;
            case 'podium':
                // $folderPath = 'public/upload/images/podia/' . $idtype;
                $folderPath = '/upload/images/podia/' . $idtype . '/';
                $class = Podium::findOrFail($idtype);
                break;
            case 'actualite':
                // $folderPath = 'public/upload/images/news/' . $idtype;
                $folderPath = '/upload/images/news/' . $idtype . '/';
                $class = News::findOrFail($idtype);
                $class->photos = 1;
                $class->save();
                break;
            default:
                $folderPath = '/upload/images/events/' . $idtype . '/';
                $class = Event::findOrFail($idtype);
        }
        $save_path = $storage . $folderPath;
        if (!file_exists($save_path)) {
            mkdir($save_path, 0755, true);
            // Storage::makeDirectory();
        }

        $image = request()->file('media');
        $timestamp = Carbon::now()->timestamp . str_random(5);
        $filename = $folderPath . $timestamp . '.' . $image->extension();
        $filename_medium = $folderPath . $timestamp . '_medium.' . $image->extension();
        $filename_thumb = $folderPath . $timestamp . '_thumbnail.' . $image->extension();

        $width_medium = 400;
        $height_medium = 400;
        $width_thumb = 200;
        $height_thumb = 200;

        $img = Image::make($image);
        $img->backup();

        $img->save($storage . $filename, 80);
        $img->reset();

        if ($img->height() > $img->width()) {
            $width_medium = null;
            $width_thumb = null;
        }
        else {
            $height_medium = null;
            $height_thumb = null;
        }

        $img->resize($width_medium, $height_medium, function ($constraint) { $constraint->aspectRatio();})
                            ->save($storage . $filename_medium, 80);
        $img->reset();
        
        $img->resize($width_thumb, $height_thumb, function ($constraint) { $constraint->aspectRatio();})
                            ->save($storage . $filename_thumb, 80);
        
        $picture = new Picture();
        $picture->path = $filename;
        $picture->medium_size = $filename_medium;
        $picture->thumbnail = $filename_thumb;

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
                unlink(storage_path('app/public' . $picture->thumbnail));
                unlink(storage_path('app/public' . $picture->medium_size));
                $picture->delete();
            }
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Les photos ont bien été supprimées');

        return redirect()->back();
    }
}
