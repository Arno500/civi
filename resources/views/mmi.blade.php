@extends('layouts.app')
@section('content')

    <div class="container-presentation">


        <div class="content">

            <h1>Présentation</h1>

            <h2>Ce que vous devez savoir :</h2>

            <p>Le Diplôme Universitaire de Technologie (DUT) Métiers du Multimédia et de l'Internet (MMI) est un diplôme reconnu par l'Etat qui s'effectue en 2 ans en formation initiale.
            </p>

            <p>Ce DUT est très polyvalent, les matières enseignées sont diverses et variées. 24 matières en tout, d'Anglais aux Services sur réseau ou esthétique et l'expression artistique. Les élèves y sont formés par des enseignants qualifiés dans leur domaine. Les intervenants apportent un côté professionnel pour une formation initiale.

            </p>

            <div class="video">
                <div class="youtube-embed">
                    <iframe allowFullScreen="allowFullScreen"
                            src="https://www.youtube.com/embed/M4pEPkGbemo?ecver=1&amp;iv_load_policy=3&amp;rel=0&amp;yt:stretch=16:9&amp;autohide=1&amp;color=red&amp;width=560&amp;width=560"
                            width="560" height="315" allowtransparency="true" frameborder="0">
                        <div style="text-align: center; margin: auto"></div>
                        <script type="text/javascript">function execute_YTvideo() {
                                return youtube.query({
                                    ids: "channel==MINE",
                                    startDate: "2018-01-01",
                                    endDate: "2018-12-31",
                                    metrics: "views,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained",
                                    dimensions: "day",
                                    sort: "day"
                                }).then(function (e) {
                                }, function (e) {
                                    console.error("Execute error", e)
                                })
                            }</script>
                    </iframe>
                </div>
            </div>

            <h2>Ce que vous ne savez pas encore :</h2>

            <p>Cette formation, très complète, forme les nouveaux intégrateurs de demain, les nouveaux graphistes qui exposeront leur talents sur des affiches publicitaires, les nouveaux développeurs d'applications mobiles, ou bien peut-être le prochain Spielberg. De nouveaux talents, de nouvelles passions grandissent chaque jour.
            </p>

            <h2>Ils sont parmi nous :</h2>

            <p>Vous recherchez un étudiant ? Un profil ? Un talent ? Vous recherchez la perle rare ?
                <b>Bienvenue sur notre site de CV en ligne, <i>CiVi</i>.</b>Nous avons créé un site de recrutement de talents. Chacun des étudiants issus de la formation MMI a un baggage très large en matière de polyvalence. Vous souhaitez rechercher un profil particulier ? Alors n'hésitez plus, rendez vous sur la page d'acceuil et nous vous guiderons pour que votre expérience se passe au mieux. </p>

            <div class="button-to-search">
                <a href="{{ route("search") }}" title="Accéder au moteur de recherche">Je veux les découvrir ! <i class="fas fa-arrow-right"></i>

                </a>

            </div>
        </div>



    </div>

@endsection