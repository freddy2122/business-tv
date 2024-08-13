@extends('layouts.index')

@section('content')
<style>
    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.02rem #009FE3;
    }

    .accordion-button:focus {
        z-index: 3;
        /* border-color: var(--bs-accordion-btn-focus-border-color); */
        outline: 0;
        /* box-shadow: var(--bs-accordion-btn-focus-box-shadow); */
    }
</style>
<div class="container-fluid" style="background:url('/assets/img/18.jpg');background-size:cover;height:660px">
    <!-- <div class="page-banner">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <nav aria-label="Breadcrumb">
                    <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                        <li class="breadcrumb-item active">A propos de nous</li>
                    </ul>
                </nav>
                <h1 class="text-center">A propos de nous</h1>
            </div>
        </div>
    </div> -->


</div>

<div class="page-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-3">
                <h2 class="title-section">Notre mission</h2>
                <div class="divider"></div>
                <p>
                    Business TV a pour mission d'inspirer, d'informer et de soutenir les entrepreneurs et les aspirants entrepreneurs du Bénin et d'Afrique. Nous nous engageons à fournir des contenus de haute qualité, pertinents et pratiques, qui couvrent les défis, les succès et les innovations dans le monde de l'entrepreneuriat. Notre but est de créer une plateforme dynamique et interactive qui favorise l'échange d'idées, le partage d'expériences et le développement de compétences, contribuant ainsi à l'épanouissement et à la croissance de l'écosystème entrepreneurial.
                </p>

            </div>
            <div class="col-lg-6 py-3">
                <div class="img-fluid py-3 text-center">
                    <img src="/assets/img/14.png" width="390px" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-6 py-3">
                <div class="img-fluid py-3 text-center">
                    <img src="/assets/img/13.png" width="390px" alt="">
                </div>
            </div>
            <div class="col-lg-6 py-3">
                <h2 class="title-section">Notre vision</h2>
                <div class="divider"></div>
                <p>
                La vision de Business TV est de devenir le principal média digital du Bénin et d'Afrique pour tout ce qui concerne l'entrepreneuriat, en étant une source d'inspiration et une référence pour les entrepreneurs à tous les stades de leur parcours. Nous aspirons à créer une communauté engagée et informée, qui contribue activement au développement économique et social du Bénin. En mettant en lumière les histoires de réussite locales et en offrant des insights sur les tendances globales, nous voulons encourager l'innovation, la créativité et l'impact social positif.
                </p>

            </div>
           
        </div>
    </div>
</div>





@endsection
