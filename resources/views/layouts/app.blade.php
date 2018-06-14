<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400|Lato|Source+Sans+Pro:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md bg-light">


        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#app-navbar-collapse"
                aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Branding Image -->
        @guest
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/img/logo.svg" alt="{{ config('app.name', 'Laravel') }}" height="50">
                CiVi
            </a>
        @else
            @if(Auth::user()->enterprise == null)
                <a class="navbar-brand" href="{{ route('offers') }}">
                    <img src="/img/logo.svg" alt="{{ config('app.name', 'Laravel') }}" height="50">
                    CiVi
                </a>
            @else
                <a class="navbar-brand" href="{{ route('search') }}">
                    <img src="/img/logo.svg" alt="{{ config('app.name', 'Laravel') }}" height="50">
                    CiVi
                </a>
            @endif
        @endguest


        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">
                <li class="nav-item"><a href="{{ route('mmi') }}" class="nav-link">La formation MMI</a></li>
                <li class="nav-item"><a href="{{ route('search') }}" class="nav-link">Nos étudiants</a></li>
                <li class="nav-item"><a href="{{ route('offers') }}" class="nav-link">Les offres</a></li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Se connecter</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link button-register">S'inscrire</a></li>
                @else
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu">
                            <li class="dropdown-item">
                                <a href="{{ route('profile') }}">
                                    Profil
                                </a>
                            </li>
                            <div class="dropdown-divider">
                            </div>
                            <li class="dropdown-item">
                                <a href="{{ route('logout') }}" aria-labelledby="dropdownMenu"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
<main>
    @yield('content')
</main>
    <footer>
        <div class="about">
            <h2>À propos :</h2>
            <p>Nous sommes une petite équipe de 3 personnes (Valentin Trinty, Romain Laze, Arno Dubois) basée à Champs-sur-Marne. Ceci est notre projet-tutoré, une plateforme de CV interactifs qui regroupe les Curricculum Vitae web des étudiants de la promotion MMI 2017-2018.</p>
        </div>
        <div class="location">
                <h2>IUT de Champs-sur-Marne</h2>
            <p>
                Contact : Martine Thireau
                <br>
                <a href="tel:+33160958590s"><i class="fas fa-phone"></i> +33 1 60 95 85 90</a>
                <br>
                <a href=""><i class="fas fa-envelope"></i> <span class="mail"></span></a>
            </p>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('script')
</body>
</html>
