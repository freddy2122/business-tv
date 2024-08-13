@extends('layouts.index')

@section('content')
<style>
    .page-banner {
        position: relative;
    }

    .video-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        /* height: 100%; */
        overflow: hidden;
    }

    #background-video {
        width: 100%;
        height: auto;
    }


    .wrapper20 {
        max-width: 1100px;
        width: 100%;
        position: relative;
    }

    .wrapper20 .ii {
        top: 50%;
        height: 50px;
        width: 50px;
        cursor: pointer;
        font-size: 1.25rem;
        position: absolute;
        text-align: center;
        line-height: 50px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.23);
        transform: translateY(-50%);
        transition: transform 0.1s linear;
        z-index: 1;
    }

    .wrapper20 .ii:active {
        transform: translateY(-50%) scale(0.85);
    }

    .wrapper20 .ii:first-child {
        left: -22px;
    }

    .wrapper20 .ii:last-child {
        right: -22px;
    }

    .wrapper20 .carousel20 {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: calc((100% / 3) - 12px);
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        gap: 16px;
        border-radius: 8px;
        scroll-behavior: smooth;
        scrollbar-width: none;
    }

    .carousel20::-webkit-scrollbar {
        display: none;
    }

    .carousel20.no-transition {
        scroll-behavior: auto;
    }

    .carousel20.dragging {
        scroll-snap-type: none;
        scroll-behavior: auto;
    }

    .carousel20.dragging .card {
        cursor: grab;
        user-select: none;
    }

    .carousel20 :where(.card, .img) {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel20 .card20 {
        scroll-snap-align: start;
       /*  height: 342px; */
        list-style: none;
        background: #fff;
        cursor: pointer;
        padding-bottom: 15px;
        flex-direction: column;
        border-radius: 8px;
    }

    .carousel20 .card20 .img {
        background: #8b53ff;
        height: 148px;
        width: 148px;
        border-radius: 50%;
    }

    .card20 .img img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
    }

    .carousel20 .card20 h2 {
        font-weight: 500;
        font-size: 1.56rem;
        margin: 30px 0 5px;
    }

    .carousel20 .card20 span {
        color: #6a6d78;
        font-size: 1.31rem;
    }

    @media screen and (max-width: 900px) {
        .wrapper20 .carousel20 {
            grid-auto-columns: calc((100% / 2) - 9px);
        }

    }

    @media screen and (max-width: 600px) {
        .wrapper20 .carousel20 {
            grid-auto-columns: 100%;
        }
   
    }





</style>
<!-- <div class="container">
    <div class="page-banner home-banner">
        <div class="row align-items-center flex-wrap-reverse h-100">
            <div class="col-md-6 py-5 wow fadeInLeft">
                <h1 class="mb-4">Business TV</h1>
                <p class="text-lg text-grey mb-5">inspirer, informer et soutenir les entrepreneurs et les aspirants entrepreneurs du Bénin et d'Afrique</p>
                <a href="#" class="btn btn-primary btn-split" data-toggle="modal" data-target="#videoModal">Watch Video <div class="fab"><span class="mai-play"></span></div></a>
                <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
                    <div class="modal-dialog  " role="document">
                        <div class="modal-content">
                            <div class="modal-body" style="border: none;">
                               
                                <video controls width="100%">
                                    <source src="/assets/video/PUB.mp4" type="video/mp4">
                                    Votre navigateur ne prend pas en charge la lecture de la vidéo.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 py-5 wow zoomIn">
                <div class="img-fluid text-center">
                    <img src="/assets/img/12.png" width="370px" height="300px" alt="">
                </div>
            </div>
        </div>


    </div>
</div> -->
<div class="">
    <div class="page-banner">

        <div class="video-container">
            <video autoplay muted loop id="background-video">
                <source src="/assets/video/PUB.mp4" type="video/mp4">
                Votre navigateur ne supporte pas la balise vidéo.
            </video>
        </div>
    </div>

</div>


<!-- Banner info -->
<div class="page-section banner-info mb-5 ">
    <div class="wrap bg-image" style="background-image: url(/assets/img/bg_pattern.svg);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 py-3 pr-lg-5 wow fadeInUp">
                    <h2 class="title-section">Pensez-vous devenir entrepreneur?</h2>
                    <div class="divider"></div>
                    Envisager de devenir entrepreneur nécessite une combinaison de passion, de clarté dans le projet, et d'une approche bien planifiée. Faire un bilan personnel, confronter son idée au marché, suivre des étapes structurées, et s'entourer judicieusement sont des éléments cruciaux pour réussir dans l'entrepreneuriat. Accéder à des conseils, des informations, et suivre des conseils pratiques peut également jouer un rôle essentiel dans ce parcours.

                </div>
                <div class="col-lg-6 py-3 wow fadeInRight">
                    <div class="img-fluid text-center">
                        <img src="/assets/img/10.png" alt="" width="350px">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .wrap -->
</div> <!-- .page-section -->


<div class="page-section" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-3 wow fadeInUp">
                <span class="subhead"></span>
                <h2 class="title-section">Notre projet(Web TV)</h2>
                <div class="divider"></div>
                <p>L'idée de créer des creusets de promotion des entrepreneurs béninois vise à établir des environnements favorables à l'essor de l'entrepreneuriat au Bénin. Voici une explication détaillée de ce concept :</p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Création de Creusets de Promotion :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Ces "creusets" peuvent être des centres d'innovation, des incubateurs, des programmes de mentorat, ou des initiatives similaires. Ils sont spécialement conçus pour soutenir et promouvoir les entrepreneurs béninois. Ces structures offrent des ressources, des conseils, et des opportunités qui favorisent la croissance des entreprises.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Participation au Développement Économique :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">L'objectif ultime est de contribuer au développement économique du pays. En encourageant la création et la croissance d'entreprises locales, ces creusets stimulent l'activité économique, génèrent des emplois, et contribuent à la prospérité générale du Bénin.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Partage d'Informations sur l'Entrepreneuriat :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body"> Les creusets servent également de plateformes pour partager des informations cruciales sur l'entrepreneuriat. Cela inclut des formations, des ateliers, des conférences, et des ressources éducatives visant à renforcer les compétences entrepreneuriales des individus.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree2" aria-expanded="false" aria-controls="flush-collapseThree2">
                                            Encouragement du Développement Entrepreneurial :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body"> Les creusets encouragent activement le développement entrepreneurial en créant un écosystème qui célèbre l'innovation, la créativité, et l'initiative. Ils fournissent également un réseau solide où les entrepreneurs peuvent interagir, collaborer, et bénéficier de l'expérience les uns des autres.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree3" aria-expanded="false" aria-controls="flush-collapseThree3">
                                            Inviter des Entrepreneurs aux Émissions :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">- Organiser des émissions dédiées à l'entrepreneuriat. <br>
                                            - Inviter des entrepreneurs à présenter leurs produits, partager leurs expériences, et discuter des défis qu'ils ont surmontés. <br>
                                            - Favoriser la visibilité des entrepreneurs et de leurs produits à travers différents médias.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree4" aria-expanded="false" aria-controls="flush-collapseThree4">
                                            Micros-Trottoirs sur l'Entrepreneuriat :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree4" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">- Réaliser des micros-trottoirs dans des zones fréquentées par la cible (jeunes, étudiants, élèves). <br>
                                            - Poser des questions sur divers aspects de l'entrepreneuriat pour recueillir les opinions et perceptions du public.<br>
                                            - Diffuser ces micros-trottoirs sur les réseaux sociaux et autres plateformes pour sensibiliser et inspirer.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree5" aria-expanded="false" aria-controls="flush-collapseThree5">
                                            Débats et Partages de Connaissances :
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree5" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">- Organiser des débats entre experts, entrepreneurs, et acteurs du secteur économique. <br>
                                            - Aborder des sujets pertinents tels que les tendances du marché, l'innovation, et les opportunités entrepreneuriales.<br>
                                            - Faciliter le partage de connaissances entre les participants pour favoriser l'apprentissage et l'émulation.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 py-3 wow fadeInRight">
                <div class="img-fluid py-3 text-center">
                    <img src="/assets/img/11.png" alt="" width="350px">
                </div>
            </div>
        </div>
    </div> <!-- .container -->
</div>


<!-- .page-section -->






@endsection