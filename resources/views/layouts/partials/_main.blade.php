@include('layouts/partials/_leftsidebar')
<section class="content">
    <audio class="content__audio" id="audio" autoplay loop >
        <source src="{{ isset($music_link->path) ? asset('storage' . $music_link->path) : asset('music/music.mp3') }}" type="audio/mpeg">
            <p>Votre navigateur ne prend pas en charge l'audio HTML.</p>
    </audio>
    @if(isset($warnings) && $warnings->count()>0)
        <div class="content__warning warning-carousel warning">
            @foreach($warnings as $warning)
                <span>{!! $warning->body !!}</span>
            @endforeach
        </div>
        <div class="content__main content__with-warning main-section">
    @else
        <div class="content__main main-section">
    @endif

        @yield('content')
    </div>
</section>
@include('layouts/partials/_rightsidebar')
