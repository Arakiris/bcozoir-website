@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="presentation" />
@endsection


@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>BC Ozoir</h1>
    </div>
    <div class="content-bcozoir">
        <p>
                Après l’inauguration du City Bowling d’Ozoir-la-Ferrière en décembre 2006, le club du BC OZOIR a été créé le 02 Août 2007 
                avec Michel COLLIN comme Président. Le club comptait alors une trentaine de joueurs. Après une succession de six présidents, 
                le club a trouvé sa vitesse de croisière avec un bureau stable présidé par Alain ROUSSEAU depuis 4 ans.    
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
                Le BC OZOIR a maintenant 10 ans. Il a trouvé sa place dans le monde du bowling. Il est reconnu pour son caractère novateur et tout sera mis en 
                œuvre pour que son épanouissement continue. Une bonne maîtrise dans la gestion doit permettre que chacun de ses membres y trouve son compte. 
                Le défi de demain sera de faire face à la réduction des subventions. Notre réflexion est de trouver les solutions pour assurer la stabilité du club.
        </p>
        
        <p>
                Longue vie au BC OZOIR et bienvenue à celles et ceux qui voudraient nous rejoindre.
        </p>
    </div>
@endsection