@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div id="search-input" class="search-input search-container">

            </div>
        </div>
        <div class="row algolia-link-container">
            <a class="algolia-link" href="https://www.algolia.com"><img class="algolia-logo" src="https://www.algolia.com/static_assets/images/press/downloads/search-by-algolia.svg" alt="Powered by Algolia"></a>
        </div>
        <div class="row">
            <div id="searchResults">
            </div>
        </div>
    </div>


    <script type="text/html" id="hit-template">
        <div class="hit">
            <div class="hit-image">
                <img src="@{{ screenshoturl }}" alt="Capture d'écran du CV interactif de @{{ firstname }} @{{ surname }}">
            </div>
            <div class="hit-content">
                <img src="@{{ portraiturl }}" alt="Photo de @{{ firstname }} @{{ surname }}">
                <h2 class="hit-name">@{{{_highlightResult.firstname.value}}} @{{{_highlightResult.surname.value}}}</h2>
                <p class="hit-description">@{{{_highlightResult.description.value}}}</p>
            </div>
        </div>
    </script>
@endsection