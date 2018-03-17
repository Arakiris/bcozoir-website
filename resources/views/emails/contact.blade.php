

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>BC Ozoir</title>
    </head>
    <body>
        <header>
            <h1>Site Internet BC Ozoir - <small>{{ $subject }}</small> </h1>
        </header>
        <section>
            <div>
                <p>Bonjour,</p> <br>

                <p> {{ $civility }} <b>{{ $last_name }} {{ $first_name }}</b>, vous a laissé(e) un message sur le site internet BC Ozoir : </p>

                <p>{!! $messages !!}</p> <br>


                <p> 
                    Cordialement, <br>
                    {{ $last_name }} {{ $first_name }},<br>
                    {{ $email }} <br>
                    {{ $phone }}
                </p>
            </div>
        </section>
    </body>
</html>