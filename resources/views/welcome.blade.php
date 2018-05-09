@extends('layouts.app')
@section('content')
    <main class="main-home">
        <div class="home-text">
            <h1> Parce que les talents ont du mal à rencontrer les gentils employeurs</h1>
            <h2>Mais nous vous mettons en relation, donc pas de soucis à se faire</h2>
            <p>Dans un marché paradoxelement saturé avec un haut taux de chômage, il devient difficile de trouver une
                entreprise/un Créateur/Web-Designer/Dev Full-Stack/CRM/Expert SEO... Et nous sommes là pour vous aider !
                En vous proposant un moteur de recherche complet et innovant, on relie tout le petit monde avec des
                critères tels que le niveau d'expérience mininum, les compétences, les langues parlées... Et chaque
                personne sera présentée à travers son CV interractif, représentant sa personnalité.
            </p>
            <h1>La créativité ne se mesure pas à un bout de papier</h1>
            <h2>Et c'est bien pour ça qu'on est là</h2>
            <p>On en a marre des entreprises qui prennent juste les premiers de promo, on vous montre que TOUT LE MONDE
                a des qualités, et rarement des qualités inutiles.
            </p>
            <div class="boss-student">
                <div class="boss">
                    <h1>Boss...</h1>
                    <img src="" alt="">
                    <p>Pourquoi chercher parmi des millions de profils ? Ne regardez que ceux qui vous corrspondent.
                        Choississez selon différents critères tels que les années d'expérience, les compétences,...
                    </p>
                </div>
                <hr>
                <div class="student">
                    <h1>...et étudiants</h1>
                    <img src="" alt="">
                    <p>Des offres adaptées et intéressantes qui sont parfaites pour vous ! N'arpentez plus les nombreux
                        sites d'offres, tels qu'<i>Alsa création, Linkedin, MonkeyTie..</i> Un job est à votre portée,
                        maintenant, maintenant !
                    </p>
                </div>
            </div>
        </div>
        <div class="register-bloc">
            <h1>
                Rejoignez la plateforme de découverte de talents :
            </h1>
            <p>Dans quelques secondes, vous pourrez naviguer parmi la crème de la crème en matière de créativité et de
                talent !
            </p>
            <form action="" class="col-md-auto">
                <div class="form-group"><input type="text" placeholder="Nom" class="form-control"></div>
                <div class="form-group"><input type="text" placeholder="Prénom" class="form-control"></div>
                <button type="submit" class="btn w-100">Trouver mon bonheur</button>
            </form>
        </div>
    </main>
@endsection