@extends('layouts.index')

@section('content')
    <style>
        .bg-image {
            position: relative;
            background: url("https://www2.telenet.be/business/fr/sme-le/offre/accueillir/business-tv-plus.thumb.800.480.png?imgId=0");
            background-size: cover;
            background-position: center;
            padding: 2rem;
            border-radius: 0.5rem;
            height: 300px;
        }

        .blog_card {
            -webkit-box-shadow: 0px 3px 5px -1px rgba(204, 174, 204, 1);
            -moz-box-shadow: 0px 3px 5px -1px rgba(204, 174, 204, 1);
            box-shadow: 0px 3px 5px -1px rgba(204, 174, 204, 1);
        }

        .blog_card video {
            width: 100%;
            height: 200px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-image">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 text-center">
                        <form class="d-flex justify-content-center" action="" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Tapez votre recherche..."
                                aria-label="Search" name="query" required>
                            <button class="btn btn-primary" type="submit">Chercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h3>NOS POSTS</h3>
        <div class="row">
            @foreach ($news as $newsItem)
                <div class="col-md-3">
                    <div class="card border-0 blog_card">
                        <a href="{{ route('news.details', ['slug' => $newsItem->slug]) }}"
                            class="text-decoration-none text-dark">
                            @if ($newsItem->videos_url)
                                <video class="w-100" controls preload="metadata">
                                    <source src="{{ $newsItem->videos_url }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la balise vidéo.
                                </video>
                            @else
                                <p>Pas de vidéo disponible</p>
                            @endif

                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        @if ($newsItem->user->profile_photo)
                                            <img src="{{ asset('storage/' . $newsItem->user->profile_photo) }}"
                                                class="img-fluid rounded-circle" height="40" width="40"
                                                alt="Profile Photo">
                                        @else
                                            <img src="https://ui-avatars.com/api?name={{ $newsItem->user->name }}"
                                                class="img-fluid rounded-circle" height="40" width="40"
                                                alt="Default Avatar">
                                        @endif
                                    </div>
                                    <div class="pt-4">
                                        <h6 class="">{{ $newsItem->title }}</h6>
                                        <p>{{ $newsItem->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
