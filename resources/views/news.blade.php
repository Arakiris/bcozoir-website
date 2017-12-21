@extends('layouts.master')

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Actualités</h1>
    </div>
    @if(isset($news) && $news->count()>0)
        <div class="main-content-news">
            @foreach($news as $singlenews)
                <div class="single-news">
                    <h2>02/07/2017 - {{ $singlenews->title }}</h2>
                    <div>
                        <span class="minimize">{{ $singlenews->body }}</span>
                        @if($singlenews->photos == 1)
                            <a href="{{ route('actualitePhotos', $singlenews->id ) }}"><img class="news-img" src="{{ asset('images/tournament/Tournament-pictures.png') }}" alt="Image désignant la gallerie de photos"></a>
                        @endif
                        
                        @if($singlenews->videos == 1)
                            <a href="{{ route('actualiteVideos', $singlenews->id ) }}"><img class="news-img" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image désignant la gallerie de vidéos"></a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="main-content-news">
            <p>Il n'y a pas encore d'actualités.</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/news.js') }}"></script>
@endsection