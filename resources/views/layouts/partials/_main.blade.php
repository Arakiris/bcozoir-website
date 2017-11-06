<main class="main">

    @include('layouts/partials/_leftsidebar')

    <section class="content">
        @if(isset($warnings) && $warnings->count()>0)
            <div class="warning-carousel warning">
                @foreach($warnings as $warning)
                    <span>{{ $warning->body }}</span>
                @endforeach
            </div>
            <div class="main-section">
        @else
            <div class="main-section padding-top-05">
        @endif

            @yield('content')
        </div>
    </section>

    @include('layouts/partials/_rightsidebar')

</main>