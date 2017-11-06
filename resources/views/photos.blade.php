@extends('layouts.master')

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightgallery.min.css') }}" /> 
@endsection

@section('content')
    <div class="main-content-title">
        <h1>{{ $title }}</h1>
        @if(isset($tournament))   
            <div class="photos-information">
                <div class="photos-title"> <b>{{ $tournament->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $tournament->title }} </div>
                <div class="photos-place"> {{ $tournament->place }}</div>
            </div>
        @elseif(isset($event))
            <div class="photos-information">
                <div class="photos-title"> <b>{{ $event->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $event->name }} </div>
                <div class="photos-place"> {{ $event->place }}</div>
            </div>
        @elseif(isset($news))
            <div class="photos-information">
                <div class="photos-title"> <b>{{ $news->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $news->title }} </div>
            </div>
        @endif

    </div>
    <div class="main-content-photos">
        <div class="photos-wrapper">
            <div class="photos">
                @foreach($pictures as $picture)
                    <img class="tournament-picture" src="{{ ($picture->path) ? asset('storage' . $picture->path) : null }}" alt="Photos du tournoi" align="middle">
                @endforeach
            </div>
        </div>
        <div class="bottom-div">
            <div>
                {{ $pictures->links() }}
            </div>
            <a id="diaporama" href="#"><img class="diaporama-img" src="{{ asset('images/tournament/Diaporama.png') }}" alt="Image représentant un diaporama"></a>
        </div>
        
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{ asset('js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('js/lg-autoplay.min.js') }}"></script>
    <script>
        $(function(){ 
            $('#diaporama').on('click', function(event) {
                event.preventDefault();
                $(this).lightGallery({
                    autoplay: true,
                    pause: 2000,
                    progressBar: true,
                    dynamic: true,
                    dynamicEl: [
                        <?php $numItems = $allpictures->count(); $i=0 ?>
                        @foreach($allpictures as $picture)
                            {
                                "src": "{{ asset('storage' . $picture->path) }}"
                            @if($i == $numItems)
                                }
                            @else
                                },
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    ]
                });
            });
        });
    </script>
@endsection