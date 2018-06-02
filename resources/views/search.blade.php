@extends('layouts.app')
@section('content')

    <div class="row">
        <div id="search-input" class="search-input search-container">

        </div>
    </div>
    <div class="row algolia-link-container">
        <a class="algolia-link" href="https://www.algolia.com"><img class="algolia-logo"
                                                                    src="https://www.algolia.com/static_assets/images/press/downloads/search-by-algolia.svg"
                                                                    alt="Powered by Algolia"></a>
    </div>
    <div class="resultscontainer">
        <div id="searchResults" class="entries">
        </div>
        <div class="facets">
            <div id="internship"></div>
            <div id="softwares"></div>
            <div id="qualities"></div>
        </div>
    </div>

    <div id="pagination"></div>

    <script type="text/html" id="hit-template">
        <img class="screenshot" src="@{{ screenshoturl }}"
             alt="Capture d'écran du CV interactif de @{{ firstname }} @{{ surname }}">
        <div class="informations">
            <img class="portrait" src="@{{ portraiturl }}" alt="Photo de @{{ firstname }} @{{ surname }}">
            <div class="card-text">
                <h3>@{{{ _highlightResult.firstname.value }}} @{{{ _highlightResult.surname.value }}}</h3>
                <small>@{{{ _highlightResult.internship_preference }}}</small>
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