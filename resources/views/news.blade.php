@extends('layouts.master')

@section('content')
<div class="content__title">
    <h1 class="heading-1">Informations</h1>
</div>

<div class="news">
    @if(isset($news) && $news->count()>0)
        <div class="news__content">
            @foreach($news as $singlenews)
                <div class="news__single">
                    <h2 class="news__title">
                        {{ $singlenews->date->format('d/m/Y') }} - {{ $singlenews->title }} &nbsp;&nbsp;
                        @if($singlenews->pictures()->count() > 0)
                            <a href="{{ route('actualitePhotos', $singlenews->id ) }}"><img class="news__img" src="{{ asset('images/tournament/Tournament-pictures.png') }}" alt="Image désignant la gallerie de photos"></a>
                        @endif
                        @if($singlenews->videos()->count() > 0)
                            <a href="{{ route('actualiteVideos', $singlenews->id ) }}"><img class="news__img" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image désignant la gallerie de vidéos"></a>
                        @endif
                    </h2>
                    <div class="news__paragraph">
                        {!! $singlenews->body !!}

                        <p class="news__read-more">
                            <a href="#" class="news__button">Lire la suite</a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="news__content">
            <p>Il n'y a pas encore d'actualités.</p>
        </div>
    @endif
</div>
@endsection


@section('scripts')
    <script src="{{ asset('js/news.js') }}"></script>
@endsection