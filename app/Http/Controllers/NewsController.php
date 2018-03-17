<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\News;

/**
 * Controller who manages news
 */
class NewsController extends Controller
{
    /** Common methods between controller */
    use CommonTrait;

    /**
     * Create a new NewsController instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['actualitephotos', 'actualitevideos', 'show', 'showall']]);
     }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedNews = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'date' => 'required|date'
        ]);
        
        News::create($validatedNews);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'La nouvelle actualité a bien été enregistrée');

        return redirect('/administration/actualites');
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
        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('news'));
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
        $validatedNews = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'date' => 'required|date'
        ]);
        
        News::findOrFail($id)->update($validatedNews);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'L\'actualité a bien été modifée');
        
        return redirect('/administration/actualites');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $news = News::findOrFail($id);

        $news = News::with(['pictures', 'videos'])->findOrFail($id);

        if(count($news->pictures)){
            foreach($news->pictures() as $picture){
                unlink(storage_path('app/public' . $picture->path));
                $picture->delete();
            }
        }

        if(count($news->videos)){
            foreach($news->videos() as $video){
                unlink(storage_path('app/public' . $video->path_mp4));
                unlink(storage_path('app/public' . $video->path_webm));
                $video->delete();
            }
        }

        $news->delete();

        $this->updateStatisticDate();
        
        session()->flash('notification_management_admin', 'L\'actualité a bien été supprimée');
        
        return redirect('/administration/actualites');
    }

    /**
     * Display all news.
     *
     * @return \Illuminate\Http\Response
     */
    public function showall() {
        $news = News::with(['pictures', 'videos'])->getnews()->get();

        return view('news', compact('news'))->with($this->mainSharingFunctionality());
    }

    /**
     * Display all pictures of the specified news id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualitePhotos($id) {
        $title = "Photos de l'actualité";
        $news = News::with('pictures')->findOrFail($id);
        $pictures = $news->pictures()->paginate(48);
        $allpictures = $news->pictures;

        return view('photos', compact('title', 'news', 'allpictures', 'pictures'))->with($this->mainSharingFunctionality());
    }

    /**
     * Display all videos of the specified news id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualiteVideos($id) {
        $title = "Videos de l'évènement";
        $news = News::with('videos')->findOrFail($id);
        $videos = $news->videos()->paginate(4);

        return view('videos', compact('title', 'news', 'videos'))->with($this->mainSharingFunctionality());
    }
}
