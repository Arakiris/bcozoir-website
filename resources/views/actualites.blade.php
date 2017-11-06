@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Actualités</h1>
    </div>
    @if(isset($news) && $news->count()>0)
        <div class="main-content-news">
            @foreach($news as $singlenews)
                <div class="single-news">
                    <h2>02/07/2017 - {{ $singlenews->title }}</h2>
                    <div>
                        <span class="minimize">{{ $singlenews->body }}</span>
                        <a href="{{ route('actualitePhotos', $singlenews->id ) }}"><img class="news-img" src="{{ asset('images/tournament/Tournament-pictures.jpg') }}" alt="Image désignant la gallerie de photos"></a>
                        <a href="{{ route('actualiteVideos', $singlenews->id ) }}"><img class="news-img" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image désignant la gallerie de vidéos"></a>
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
    <script>
        jQuery(function(){

            var minimized_elements = $('span.minimize');
            var minimize_character_count = 150;    

            minimized_elements.each(function(){    
                var t = $(this).text();        
                if(t.length < minimize_character_count ) return;

                $(this).html(
                    t.slice(0,minimize_character_count )+'<span>... </span><a href="#" class="more">Lire la suite</a>'+
                    '<span style="display:none;">'+ t.slice(minimize_character_count ,t.length)+' <a href="#" class="less">Réduire</a></span>'
                );

            }); 

            $('a.more', minimized_elements).click(function(event){
                event.preventDefault();
                $(this).slideUp().prev().slideUp();
                $(this).next().slideDown();        
            });

            $('a.less', minimized_elements).click(function(event){
                event.preventDefault();
                $(this).parent().slideUp().prev().show().prev().show();    
            });

        })
    </script>
@endsection