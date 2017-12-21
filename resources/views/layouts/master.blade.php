<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--  <meta name="viewport" content="initial-scale=1, maximum-scale=1">  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="language" content="fr-FR" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="geo.region" content="FR" />
    <meta name="geo.placename" content="Ozoir-la-Ferri&egrave;re" />
    <meta name="geo.position" content="48.762292;2.663712" />
    <meta name="ICBM" content="48.762292, 2.663712" />

    <meta name="description" content="Tous concernant le club de bowling d'Ozoir, informations, tournois, ligues, membres, listing, photos, vidéos, tournois future et plus" />
    <meta name="keywords" content="bowling, Ozoir" />
    @yield('keywords')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

    <title>Bowling Club - Ozoir</title>
</head>
<body>
    @include('layouts.partials._header')

    @include('layouts.partials._main')

    @include('layouts/partials/_footer')

    <script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/lang/fr.js') }}"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                lang: 'fr',
                header: {
                        left:   'prev',
                        center: 'title',
                        right:  'next'
                    },
                height: 250,
                events: "{{ route('eventcalendar') }}",
                color: 'blue', 
                textColor: 'black',
            });
        });
    </script>
    @yield('scripts')

</body>
</html>