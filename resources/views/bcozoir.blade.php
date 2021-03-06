﻿@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="presentation" />
@endsection


@section('content')
    <div class="content__title">
        <h1 class="heading-1">ABC I.D.F.</h1>
    </div>
    <div class="introduction">

        @if (isset($content->description))
            {!! $content->description !!}
        @else
            <p>
                Après l’inauguration du City Bowling d’Ozoir-la-Ferrière en décembre 2006, le club du BC OZOIR a été créé le 02 Août 2007 
                avec Michel COLLIN comme Président. Le club comptait alors une trentaine de joueurs. Après une succession de six présidents, 
                le club a trouvé sa vitesse de croisière avec un bureau stable présidé par Alain ROUSSEAU depuis 5 ans.    
            </p>

            <p>
                Le club s’est développé tout au long de ces années allant même jusqu’aux 61 adhérents pour la saison 2016-2017. La volonté du bureau 
                n’est pas d’avoir un nombre d’adhérents toujours plus grand, mais d’avoir des joueurs qui contribuent à la dynamique du club par leurs 
                participations aux divers tournois privés et à des compétitions fédérales. La cohésion et le sens du partage sont les mots-clés qui représentent 
                la raison d’être de ce club.
            </p>
            
            <p>
                Pour pouvoir continuer à exister dans un contexte économique défavorable, l’idée est de faire exister le club par l’originalité des tournois que nous 
                organisons. Tous les membres du bureau sont en phase pour amener toujours plus de nouveautés afin de préserver le caractère attractif de nos tournois. Il nous 
                faut sans cesse innover pour ne pas faire du sur place.
            </p>
            
            <p>
                Le BC OZOIR a maintenant plus de 10 ans. Nous serons 50 durant la saison 2019. Il a trouvé sa place dans le monde du bowling. Il est reconnu pour son caractère novateur et tout sera mis en 
                œuvre pour que son épanouissement continue. Une bonne maîtrise dans la gestion doit permettre que chacun de ses membres y trouve son compte. 
                Le défi de demain sera de faire face à la réduction des subventions. Notre réflexion est de trouver les solutions pour assurer la stabilité du club.
            </p>
            
            <p>
                Longue vie au BC OZOIR et bienvenue à celles et ceux qui voudraient nous rejoindre. <br><br><br>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                .｡.✿*ﾟ‘ﾟ･✿.｡.:* *.:｡✿*ﾟ’ﾟ･✿.｡.* *.:｡✿*ﾟ’ﾟ･✿.｡.<br><br><br>
            </p>

            <p>
                <b> VALEURS DU BC OZOIR ET DE SES MEMBRES  </b> <br><br>
                
                ◆ Avoir un esprit ouvert et positif <br>
                ◆ Ne pas être polémique <br>
                ◆ Avoir une bonne communication et le sens de l'humour <br>
                ◆ Avoir un bon relationnel et le sens du partage <br>
                ◆ Participer aux activités et tournois du club <br>
                ◆ Participer aux ligues <br>
                ◆ Jouer régulièrement en tournois <br>
                ◆ Respecter ses adversaires <br>
                ◆ Être solidaire de ses partenaires <br>
                ◆ Représenter et promouvoir le club dans toutes les manifestations. <br>
            </p>
        @endif
        
    </div>
@endsection