@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Laissez votre message</h1>
    </div>
    <div class="main-content-contact">
        <div>
            <p><span class="contact-special">Par e-mail</span> en remplissant le formulaire ci-dessous, nous vous répondrons le plus tôt possible :</p>
            
                <form action="/contact" method="post">
                    {{ csrf_field() }}
                    <div class="message-contact information">
                        <select>
                            <option value="">* Civilité</option>
                            <option value="Monsieur">Mr.</option>
                            <option value="Madame">Mme.</option>
                        </select>
                        <input type="text" name="last_name" placeholder="*Votre nom">
                        <input type="text" name="first_name" placeholder="*Votre prénom">
                        <input type="text" name="email" placeholder="*Votre e-mail">
                        <input type="tel" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" name="tel" placeholder="*Votre téléphone">
                    </div>
                    <div class="message-contact">
                        <textarea class="textarea-contact" rows="14" placeholder="*Votre message..."></textarea>
                        <button class="envoyer right">ENVOYER</button>
                    </div>
                </form>
            <div class="clear"></div>
            <p class="smaller-text"><i>Conformément à la loi informatique et Libertés en date du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification, de modification et de suppression des données qui vous concernent. Vous pouvez exercer ce droit en nous envoyant un courrier électronique ou postal.</i></p>
        </div>
        <div class="margin-top-20">
            <p><span class="contact-special">Par téléphone</span> au ...</p>
        </div>
        <div class="margin-top-20">
            <p><span class="contact-special">Par courrier</span> en écrivant à: ...</p>
        </div> 
    </div>
@endsection