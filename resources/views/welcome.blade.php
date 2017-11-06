@extends('layouts.master')

@section('content')
    @if(isset($ads) && $ads->count() > 0)
        <div class="ads-carousel">
            @foreach($ads as $ad)
                <div class="carousel-img">
                    <img src="{{ ($ad->picture->first()->path) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="Image de bienvenue">
                </div> 
            @endforeach
        </div>
    @endif
@endsection