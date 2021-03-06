@extends('layouts.app')
@section('content')
    <div class="banner">

    </div>
    <div class="flex-responsive main-home">
        <div class="home-text">
            <h1>Une liste de talents, rien que pour vous !</h1>
            <h2>Choisissez parmi plus de 50 étudiants prêts à travailler<br>à coups de café !</h2>
            <p>Grâce à notre moteur de recherche innovant, la moindre particularité peut faire la différence. Que ce soit le métier, les logiciels maîtrisés, les qualités requises...
                Vous n’avez plus qu’à trouver VOTRE étudiant parfait !
            </p>
            <hr>
            <div class="flex-responsive comparison">
                <div class="boss">
                    <h1>Boss...</h1>
                    <img src="/img/boss.svg" alt="">
                    <p>Pourquoi chercher parmi des millions de profils ? Ne regardez que ceux qui vous corrspondent.
                        Choississez selon différents critères tels que les années d'expérience, les compétences,...
                    </p>
                    <div class="button-to-search">
                        <a href="{{ route("search") }}" title="Accéder au moteur de recherche">Étudiants  <i class="fas fa-arrow-right"></i>

                        </a>
                    </div>
                </div>
                <hr class="vertical-line">
                <div class="student">
                    <h1>...et étudiants</h1>
                    <img src="/img/student.svg" alt="">
                    <p>Des offres adaptées et intéressantes qui sont parfaites pour vous ! N'arpentez plus les nombreux
                        sites d'offres, tels qu'<i>AlsaCréation</i>, <i>Linkedin</i>, <i>MonkeyTie</i>... Un job est à votre portée,
                        maintenant !
                    </p>
                    <div class="button-to-search">
                        <a href="{{ route("offers") }}" title="Accéder au moteur de recherche">Offres  <i class="fas fa-arrow-right"></i>

                        </a>
                    </div>
                </div>
            </div>
            <h1>La créativité ne se mesure pas à un bout de papier</h1>
            <h2>Et c'est bien pour ça qu'on est là</h2>
            <p>Avoir le diplôme n’est pas toujours synonyme d’avoir les compétences. Vous pouvez donc rechercher ce dont vous avez besoin, avec  des mots-clés et un système de filtres.
                Mais surtout, vous pouvez déposer vos offres pour attirer encore plus de génies !
            </p>

        </div>
        <div class="register-bloc">
            <div class="register-bloc-container">
                <h2>Rejoignez la plateforme de découverte de talents</h2>
                <p>Accéder à nos talents prends deux secon... C'est déjà fini ?
                </p>
                <form action="{{ route('register') }}" class="col-md-auto">
                    <div class="form-element">
                        <input type="text" id="name" name="name" placeholder="Pseudo" class="form-control button-shadow" value="{{ old('name') }}">
                    </div>
                    <div class="form-element">
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control button-shadow" value="{{ old('mail') }}">
                    </div>
                    <button type="submit" class="btn w-100">Trouver mon bonheur</button>
                </form>
            </div>
        </div>
    </div>
@endsection