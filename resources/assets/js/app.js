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

/**
 * Converts an RGB color value to HSL. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes r, g, and b are contained in the set [0, 255] and
 * returns h, s, and l in the set [0, 1].
 *
 * @param   Number  r       The red color value
 * @param   Number  g       The green color value
 * @param   Number  b       The blue color value
 * @return  Array           The HSL representation
 */
function rgbToHsl(r, g, b) {
    r /= 255, g /= 255, b /= 255;

    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if (max == min) {
        h = s = 0; // achromatic
    } else {
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

        switch (max) {
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }

        h /= 6;
    }

    return [ h, s, l ];
}

$(document).ready(function() {
    const mail1 = "martine.th";
    const mail2 = "ireau@u-";
    const mail3 = "pem.fr";
    $(".mail").prop("href", "mailto:"+mail1+mail2+mail3).text(mail1+mail2+mail3);

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
            $(elm).on('load', function(event) {
                var colorThief = new ColorThief();
                var tempArray = colorThief.getColor(event.currentTarget);
                let colorArray = rgbToHsl(tempArray[0],tempArray[1],tempArray[2]);
                let colorArrayReduced = [Math.floor(colorArray[0]*360),Math.floor((colorArray[1]/1.3)*100),Math.floor((colorArray[2])*100)];
                let hsl = "hsl("+colorArrayReduced[0]+","+colorArrayReduced[1]+"%,"+colorArrayReduced[2]+"%)";
                $(event.currentTarget).siblings(".informations").css({
                    'background-color': hsl
                });
                if (contrast(tempArray, [0,0,0]) <= 5.14) {
                    $(event.currentTarget).siblings(".informations").children(".card-text").css("color", "white");
                    $(event.currentTarget).siblings(".informations").find("small").css("color", "#d8d8d8");
                }
            });
                /*try {
                    var tempArray = colorThief.getColor(elm.get(0));
                } catch(event) {
                    var tempArray = [255,255,255];
                    setTimeout(function() {setBackgroundColor(elm)}, 100);
                }*/

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
                    empty: "Nous n'avons pas trouvé de résultats pour la requête <em>\"{{query}}\"</em>"
                }
            })
        );

        search.addWidget(
            refinementList({
                container: '#internship',
                attributeName: 'internship_preference',
                templates: {
                    header: "<h3 class='facet-title'>Métier souhaité</h3>"
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
            $(".studentcard").unbind("click");
            $(".screenshot").each(function(elm) {
                setBackgroundColor($(this));
            });
            if (!authStatus) {
                $(".informations").each(function() {
                    $(this).removeAttr("data-url");
                    $(this).removeAttr("data-urlstatic");
                    $(this).removeAttr("data-description");
                    $(this).removeAttr("data-qualities");
                    $(this).removeAttr("data-softwares");
                    $(this).removeAttr("data-internship-duration");
                    $(this).removeAttr("data-internship-preference");
                });
            }
            $(".studentcard").click(function(event){
                if ($(event.currentTarget).is("div.studentcard")) {
                    if (!authStatus) {
                        alert("Rejoignez CiVi pour accéder au profil détaillé des étudiants !");
                    } else {
                        $("body").css("overflow", "hidden");
                        $(".embed").fadeIn();
                        $('html,body').animate({scrollTop: 0}, 500);
                        $(".retract").unbind("click");
                        $(".retract").click(function(){
                            const leftPanel = $(".left-panel");
                            const button = $(".retract");
                            const flexContainer = $(".flex-embed");
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
                        });
                        var studentData = $(event.currentTarget).children(".informations").data();
                        var leftPanel = $(".left-panel");
                        var iframe = $(".frame-panel");
                        leftPanel.find(".student-name").text(studentData.name);
                        leftPanel.find(".resume-static").attr("href", studentData.urlstatic).text("Lien vers le CV statique (PDF)");
                        leftPanel.find(".internship-preference>.fill-span").text(studentData.internshippreference);
                        leftPanel.find(".internship-duration>.fill-span").text(studentData.internshipduration);
                        leftPanel.find(".softwares>.fill-span").text(studentData.softwares.replace(/,/g, ', '));
                        leftPanel.find(".qualities>.fill-span").text(studentData.qualities.replace(/,/g, ', '));
                        leftPanel.children(".description").text(studentData.description);
                        if (studentData.url !== "#") {
                            iframe.prop("src", studentData.url);
                        } else {
                            iframe.prop("src", "");
                        }

                    }
                }
            });


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