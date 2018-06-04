/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import $ from 'jquery';

import instantsearch from 'instantsearch.js';
import {hits, searchBox, refinementList, pagination} from 'instantsearch.js/es/widgets';

const ColorThief = require("exports-loader?ColorThief!./color-thief.min.js");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    $(".navbar-toggler").click(function () {
        var menu = $(".collapse");
        if (menu.css("display") === 'none') {
            menu.show();
        } else {
            menu.hide();
        }
    });

    $(".dropdown-toggle").click(function () {
        var menu = $(".dropdown-menu");
        if (menu.css("display") === 'none') {
            menu.show();
        } else {
            menu.hide();
        }
    });

    if ($("#search-input").length){
        var search = instantsearch({
            // Replace with your own values
            appId: 'LHQG8G2ATM',
            apiKey: '894c34833fec8963ff6606620240d0c5',
            indexName: 'civi',
            routing: true,
            searchParameters: {
                hitsPerPage: 8
            }
        });

        function luminanace(r, g, b) {
            var a = [r, g, b].map(function (v) {
                v /= 255;
                return v <= 0.03928
                    ? v / 12.92
                    : Math.pow( (v + 0.055) / 1.055, 2.4 );
            });
            return a[0] * 0.2126 + a[1] * 0.7152 + a[2] * 0.0722;
        }
        function contrast(rgb1, rgb2) {
            return (luminanace(rgb1[0], rgb1[1], rgb1[2]) + 0.05)
                / (luminanace(rgb2[0], rgb2[1], rgb2[2]) + 0.05);
        }


        function setBackgroundColor(elm) {
            var colorThief = new ColorThief();
                try {
                    var tempArray = colorThief.getColor(elm.get(0));
                } catch(event) {
                    var tempArray = [255,255,255];
                    setTimeout(function() {setBackgroundColor(elm)}, 100);
                }
                let colorArray = [(255-tempArray[0])/2,(255-tempArray[1])/2,(255-tempArray[2])/2];
                elm.siblings(".informations").css("background-color", "rgb("+colorArray[0]+","+colorArray[1]+","+colorArray[0]+")");
                console.log(elm.siblings(".informations").css("background-color"));
                if (contrast(colorArray, [0,0,0]) <= 5.14) {
                    elm.siblings(".informations").children(".card-text").css("color", "white");
                    elm.siblings(".informations").find("small").css("color", "#d8d8d8");
                }
        }

        search.addWidget(
            searchBox({
                container: '#search-input',
                magnifier: false,
                reset: {
                    cssClasses: {root: "ais-search-box-reset"}},
                poweredBy: false,
                cssClasses: {root: "search-container",
                    input: "search-box"},
                placeholder: "Essayez de taper \"Valentin créatif\""
            })
        );

        search.addWidget(
            hits({
                container: '#searchResults',
                cssClasses: {
                    root: "searchresults",
                    item: "studentcard"
                },
                templates: {
                    item: document.getElementById('hit-template').innerHTML,
                    empty: "We didn't find any results for the search <em>\"{{query}}\"</em>"
                }
            })
        );

        search.addWidget(
            refinementList({
                container: '#internship',
                attributeName: 'internship_preference',
                templates: {
                    header: "<h3 class='facet-title'>Métiers</h3>"
                },
                showMore: {
                    templates: {
                        inactive: "<a class=\"ais-show-more ais-show-more__inactive\">Plus...</a>",
                        active: "<a class=\"ais-show-more ais-show-more__active\">Réduire</a>"
                    },
                    limit: 15
                },
                limit: 6
            })
        );
        search.addWidget(
            refinementList({
                container: '#softwares',
                attributeName: 'softwares',
                operator: "and",
                templates: {
                    header: "<h3 class='facet-title'>Logiciels maîtrisés</h3>"
                },
                showMore: {
                    templates: {
                        inactive: "<a class=\"ais-show-more ais-show-more__inactive\">Plus...</a>",
                        active: "<a class=\"ais-show-more ais-show-more__active\">Réduire</a>"
                    },
                    limit: 15
                },
                limit: 6
            })
        );
        search.addWidget(
            refinementList({
                container: '#qualities',
                attributeName: 'qualities',
                operator: "and",
                templates: {
                    header: "<h3 class='facet-title'>Qualités</h3>"
                },
                showMore: {
                    templates: {
                        inactive: "<a class=\"ais-show-more ais-show-more__inactive\">Plus...</a>",
                        active: "<a class=\"ais-show-more ais-show-more__active\">Réduire</a>"
                    },
                    limit: 15
                },
                limit: 6
            })
        );

        search.addWidget(
            pagination({
                container: '#pagination',
                maxPages: 20,
                scrollTo: '#searchResults'
            })
        );

        search.start();

        search.on("render", function() {
            $(".screenshot").each(function() {
                setBackgroundColor($(this));
            });
            if (!authStatus) {
                $(".informations").each(function() {
                    $(this).removeAttr("data-url");
                    $(this).removeAttr("data-urlstatic");
                    $(this).removeAttr("data-description");
                    $(this).removeAttr("data-qualities");
                    $(this).removeAttr("data-softwares");
                });
            }
            $(".searchresults>div").click(function(event){
                if ($(event.currentTarget).is("div.studentcard")) {
                    if (!authStatus) {
                        alert("Rejoignez CiVi pour accéder au profil détaillé des étudiants !");
                    } else {
                        $("body").css("overflow", "hidden");
                        $(".embed").fadeIn();
                        $('html,body').animate({scrollTop: 0}, 500);
                        console.log(event);
                        var studentData = $(event.currentTarget).children(".informations").data();
                        var leftPanel = $(".left-panel");
                        leftPanel.children(".student-name").text(studentData.name);
                        leftPanel.children(".resume-static").attr("href", studentData.urlstatic).text("Lien vers le CV statique (PDF)");
                    }
                }
            });

            $(".retract").click(function(){
                var leftPanel = $(".left-panel");
                var button = $(".retract");
                var flexContainer = $(".flex-embed");
                if (leftPanel.hasClass("expanded")) {
                    leftPanel.removeClass("expanded");
                    button.removeClass("retract__active");
                    flexContainer.removeClass("flex-embed-expanded");
                    leftPanel.addClass("retracted");
                    button.addClass("retract__inactive");
                    flexContainer.addClass("flex-embed-retracted");
                } else {
                    flexContainer.removeClass("flex-embed-retracted");
                    leftPanel.removeClass("retracted");
                    button.removeClass("retract__inactive");
                    leftPanel.addClass("expanded");
                    button.addClass("retract__active");
                    flexContainer.addClass("flex-embed-expanded");
                }
            })

            $(".close-embed").click(function() {
                $("body").css("overflow", "initial");
                $(".embed").fadeOut();
            })
        });
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