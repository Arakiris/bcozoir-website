<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

use App\Warning;
use App\Tournament;
use App\Picture;
use Carbon\Carbon;


class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['show', 'showall', 'actualitePhotos', 'actualiteVideos']]);
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

        session()->flash('notification_management_admin', 'La nouvelle actualité a bien été enregistré');

        return redirect('/admin/actualites');
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

        session()->flash('notification_management_admin', 'L\'actualité a bien été mise-à-jour');
        
        return redirect('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::findOrFail($id)->delete();
        
        session()->flash('notification_management_admin', 'L\'actualité a bien été supprimée');
        
        return redirect('/admin/news');
    }

    public function showall() {
        $news = News::with(['pictures', 'videos'])->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('actualites', compact('news', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function actualitePhotos($id) {
        $title = "Photos de l'actualité";
        $news = News::with('pictures')->findOrFail($id);
        $pictures = $news->pictures()->paginate(30);
        $allpictures = $news->pictures;
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('photos', compact('title', 'news', 'allpictures','pictures', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function actualiteVideos($id) {
        $title = "Videos de l'évènement";
        $news = News::with('videos')->findOrFail($id);
        $videos = $news->videos()->paginate(4);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('videos', compact('title', 'news','videos', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }
}
