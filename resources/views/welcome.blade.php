<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Site internet du club de bowling d'Ozoir" />
    <meta name="keywords" content="bowling, Ozoir" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.print.css"> -->
    <link rel="stylesheet" href="styles.css">
    <title>Bowling Club - Ozoir</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#">
                <img src="images/logo.jpg" alt="" class="logo-img" >
            </a>
        </div>
        <div class="header-img">

        </div>
    </header>

    <nav class="header-nav">
        <div class="updatedAt">
            <span>MAJ le 30/08/2017</span>
        </div>
        <ul class="nagivation">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">BC Ozoir</a></li>
            <li><a href="#">Bureau</a></li>
            <li><a href="#">Membres</a></li>
            <li><a href="#">Partenaires</a></li>
            <li><a href="#">Liens</a></li>
            <li><a href="#">Adresses</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <main class="main">
        <aside class="aside-left">
            <nav class="aside-bar">
                <ul class="side-bar">
                    <li><a href="#">Actualités</a></li>
                    <li><a href="#">Tournois BC Ozoir</a></li>
                    <li><a href="#">Tournois privés</a></li>
                    <li><a href="#">Championnats fédéraux</a></li>
                    <li><a href="#">Ligues</a></li>
                    <li><a href="#">Moyennes listing</a></li>
                    <li><a href="#">Podium</a></li>
                    <li><a href="#">Évènements</a></li>
                    <li><a href="#">Archives Tournois</a></li>
                    <li><a href="#">Archies ligues</a></li>
                </ul>
            </nav>
            
            <div class="container-calendar">
                <div class="agendaTitle"><span>Agenda</span></div>
                <div id="calendar" class="calendar">
                </div>
            </div>
        </aside>

        <section class="content">
            <div class="warning">
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at justo et enim scelerisque mollis. Nam efficitur auctor mi, a.</span>
            </div>
        </section>

        <aside class="aside-right">
            <div class="nextTournament">
                <div class="nextTournamentTitle"><h2>Prochain tournois BC Ozoir</h2></div>
                <div class="nextTournamentContent">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                </div>
                <div class="nextTournamentContent">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="nextTournamentContent">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="nextTournament">
                <div class="nextTournamentTitle"><h2>Prochain autres tournois</h2></div>
                <div class="nextTournamentContent">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                </div>
                <div class="nextTournamentContent">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="nextTournamentContent">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="frameRandomPicture">
                <div class="frameRandomPictureTitle">Photos</div>
                <div class="frameRandomPictureContent">
                    <img src="images/randomPicture.jpg" alt="Photo au hasard" class="randomPicture">
                </div>
                <div class="pictureText">
                    <p>18 avril 2016 <br> 1hdp Ozoir-la-Ferrière</p>
                </div>
            </div>
        </aside>
    </main>

    <footer class="footer">
        <ul class="footer-nav">
            <li>&copy; BC Ozoir</li>
            <li><a href="#">Version</a></li>
            <li><a href="#">Mentions Légales</a></li>
            <li><a href="#">Suggestions</a></li>
            <li><a href="#">Plans</a></li>
        </ul>
    </footer>

    <script
    src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
    <script>
        var now = moment()
        console.log(typeof moment.defineLocale)
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
    <script src="scripts.js"></script>

</body>
</html>