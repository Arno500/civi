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
                <img src="@{{image}}" alt="@{{name}}">
            </div>
            <div class="hit-content">
                <h3 class="hit-price">$@{{price}}</h3>
                <h2 class="hit-name">@{{{_highlightResult.name.value}}}</h2>
                <p class="hit-description">@{{{_highlightResult.description.value}}}</p>
            </div>
        </div>
    </script>
@endsection