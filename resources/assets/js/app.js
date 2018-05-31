/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import $ from 'jquery';

import instantsearch from 'instantsearch.js';
import {hits, searchBox} from 'instantsearch.js/es/widgets';

const ColorThief = require("exports-loader?ColorThief!./color-thief.min.js");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    $(".dropdown-toggle").click(function () {
        var menu = $(".dropdown-menu");
        if (menu.css("display") === 'none') {
            menu.show();
        } else {
            menu.hide();
        }
    });

    if ($("#search-input").length){
        function getBase64Image(img) {
            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);
            var dataURL = canvas.toDataURL("image/png");
            return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
        }
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
                placeholder: "Essayez de taper \"Valentin photoshop\"",
                queryHook: function() {
                    $(".hit-image>img").each(function(){
                        var colorThief = new ColorThief();
                        //console.log($(this).get(0));
                        console.log(colorThief.getColor($(this).get(0)));
                    });
                }
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

    if ($("#register").length) {
        var temp;
        $("body").click(function() {
            if ($('input[name="account"]')[0].checked === true) {
                $(".active").removeClass('active focus');
                $("#studentcheck").parent().addClass('active');
                $(".enterprise-group").hide('fast');
                temp = $(".enterprise-group").find("input").val();
                $(".enterprise-group").find("input").val("");
            } else {
                $(".active").removeClass('active focus');
                $("#enterprisecheck").parent().addClass('active');
                $(".enterprise-group").show('fast');
            }
        })

    }



});