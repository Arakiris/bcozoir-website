<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--  <meta name="viewport" content="initial-scale=1, maximum-scale=1">  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Site internet du club de bowling d'Ozoir" />
    <meta name="keywords" content="bowling, Ozoir" />
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

    <title>Bowling Club - Ozoir</title>
</head>
<body>
    @include('layouts.partials._header')

    @include('layouts.partials._main')

    @include('layouts/partials/_footer')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    {{--  <script>
        var now = moment()
    </script>  --}}
    <script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            moment().format();

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
            // aspectRatio: 3,
            header: {
                    left:   'prev',
                    center: 'title',
                    right:  'next'
                },
                height: 'auto',
                events: "{{ route('eventcalendar') }}",
                color: 'blue',   // an option!
                textColor: 'black', // an option!
            });

            $('.warning-carousel').slick({
                dots: false,
                prevArrow: false,
                nextArrow: false,
                infinite: true,
                speed: 300,
                autoplay: true,
                autoplaySpeed: 2000
            });

            $('.ads-carousel').slick({
                dots: true,
                prevArrow: false,
                nextArrow: false,
                infinite: true,
                speed: 300,
                autoplay: true,
                autoplaySpeed: 2000
            });

            $('.pictures-carousel').slick({
                dots: false,
                prevArrow: false,
                nextArrow: false,
                infinite: true,
                speed: 300,
                autoplay: true,
                autoplaySpeed: 3000
            });
        });
    </script>
    @yield('scripts')

</body>
</html>