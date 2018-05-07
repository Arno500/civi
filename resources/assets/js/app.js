/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import $ from 'jquery';

import instantsearch from 'instantsearch.js';
import {hits, searchBox} from 'instantsearch.js/es/widgets';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    if ($("#search-input").length){
        var search = instantsearch({
            // Replace with your own values
            appId: 'LHQG8G2ATM',
            apiKey: '894c34833fec8963ff6606620240d0c5',
            indexName: 'civi',
            routing: true,
            searchParameters: {
                hitsPerPage: 10
            }
        });

        search.addWidget(
            searchBox({
                container: '#search-input',
                magnifier: false,
                reset: {
                    cssClasses: {root: "ais-search-box-reset"}},
                poweredBy: false,
                cssClasses: {root: "search-container",
                    input: "search-box"},
                placeholder: "Essayez de taper \"Valentin photoshop\""
            })
        );

        search.addWidget(
            hits({
                container: '#searchResults',
                templates: {
                    item: document.getElementById('hit-template').innerHTML,
                    empty: "We didn't find any results for the search <em>\"{{query}}\"</em>"
                }
            })
        );

        search.start();
    }



});