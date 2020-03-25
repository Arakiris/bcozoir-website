@include('layouts/partials/_leftsidebar')
<section class="content">
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
