@extends('layouts.app')
@section('content')

    <header>
        <div class="search-intro">
            <h1>Votre talent parmi
                <br>{{ App\Student::all()->count() }} profils</h1>
        </div>

        <div class="row">
            <div id="search-input" class="search-input">

            </div>
        </div>
        <div class="row algolia-link-container">
            <a class="algolia-link" href="https://www.algolia.com"><img class="algolia-logo"
                                                                        src="https://www.algolia.com/static_assets/images/press/downloads/search-by-algolia.svg"
                                                                        alt="Powered by Algolia"></a>
        </div>
    </header>
    <section class="resultscontainer">
        <div id="searchResults" class="entries">
        </div>
        <div class="facets">
            <div id="internship" class="internship"></div>
            <div id="softwares" class="softwares"></div>
            <div id="qualities" class="softwares"></div>
        </div>
    </section>

    <div id="pagination" class="search-pagination"></div>

    <div class="embed">
        <div class="flex-embed">
            <div class="left-panel expanded">
                <div class="infos-wrapper">
                    <h4 class="student-name"></h4>
                    <h5 class="internship-preference">
                        <span class="name-category ">Type de stage souhaité :</span>
                        <br>
                        <span class="fill-span"></span>
                    </h5>
                    <h5 class="internship-duration">
                        <span class="name-category ">Durée de stage souhaité :</span>
                        <br>
                        <span class="fill-span"></span>
                    </h5>
                    <h5 class="softwares">
                        <span class="name-category ">Qualités :</span>
                        <br>
                        <span class="fill-span"></span>
                    </h5>
                    <h5 class="qualities">
                        <span class="name-category ">Logiciels :</span>
                        <br>
                        <span class="fill-span"></span>
                    </h5>
                    <p class="description"></p>
                    <a class="resume-static" href="#"></a>
                </div>
                <div class="retract retract__active"></div>
            </div>
            <iframe class="frame-panel" security="restricted"
                    sandbox="allow-same-origin allow-scripts allow-top-navigation"></iframe>
        </div>
        <div class="close-embed"></div>
    </div>

    <script type="text/html" id="hit-template">
        <img class="screenshot" src="@{{ screenshoturl }}"
             alt="Capture d'écran du CV interactif de @{{ firstname }} @{{ surname }}">
        <div class="informations" data-internshippreference="@{{ internship_preference }}"
             data-internshipduration="@{{ internship_duration }}" data-name="@{{ firstname }} @{{ surname }}"
             data-url="@{{ resumeurl_interactive }}" data-urlstatic="@{{ resumeurl_static }}"
             data-description="@{{ description }}" data-qualities="@{{ qualities }}" data-softwares="@{{ softwares }}">
            <img class="portrait" src="@{{ portraiturl }}" alt="Photo de @{{ firstname }} @{{ surname }}">
            <div class="card-text">
                <h3>@{{{ _highlightResult.firstname.value }}} @{{{ _highlightResult.surname.value }}}</h3>
                <small>@{{{ _highlightResult.internship_preference.value }}}</small>
            </div>
        </div>
    </script>
    <script>
                @if(Auth::check())
        var authStatus = true;
                @else
        var authStatus = false;
        @endif
    </script>
@endsection