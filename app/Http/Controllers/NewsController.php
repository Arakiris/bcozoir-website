<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    use CommonTrait;

    public function showall() {
        $news = News::with(['pictures', 'videos'])->getnews()->get();

        return view('news', compact('news'))->with($this->mainSharingFunctionality());
    }

    public function actualitePhotos($id) {
        $title = "Photos de l'actualité";
        $news = News::with(['pictures' => function($query) { $query->orderby('created_at', 'asc'); }])->findOrFail($id);
        $pictures = $news->pictures()->paginate(48);
        $allpictures = $news->pictures;

        return view('photos', compact('title', 'news', 'allpictures', 'pictures'))->with($this->mainSharingFunctionality());
    }

    public function actualiteVideos($id) {
        $title = "Videos de l'évènement";
        $news = News::with('videos')->findOrFail($id);
        $videos = $news->videos()->paginate(4);

        return view('videos', compact('title', 'news', 'videos'))->with($this->mainSharingFunctionality());
    }
}
