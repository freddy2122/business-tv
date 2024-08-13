    @extends('layouts.admin')

    @section('content')
        <style>
            .blog_card {
                -webkit-box-shadow: 0px 3px 5px -1px rgba(204, 174, 204, 1);
                -moz-box-shadow: 0px 3px 5px -1px rgba(204, 174, 204, 1);
                box-shadow: 0px 3px 5px -1px rgba(204, 174, 204, 1);
                border-radius: 0px !important;
            }

            .blog_card video {
                width: 100%;
                
                height: 123px;
               
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                @foreach ($news as $newsItem)
                    <div class="col-md-3">
                        <div class="card border-0 blog_card ">

                            @if ($newsItem->videos_url)
                                <video class="w-100" controls preload="metadata">
                                    <source src="{{ $newsItem->videos_url }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la balise vidéo.
                                </video>
                            @else
                                <p>Pas de vidéo disponible</p>
                            @endif



                            <div class="card-body">
                                <h6 class="">{{ $newsItem->title }}</h6>
                                <p>{{ $newsItem->content }}</p>
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <a href="{{ route('news.edit', $newsItem->id) }}" class="text-primary"><i
                                                class="fa-solid fa-pen-nib"></i></a>
                                    </div>
                                    <div>
                                        <a href="" class="text-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                            class="fa-solid fa-circle-exclamation text-danger"></i> Confirmer la suppression
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">Êtes-vous sûr de vouloir supprimer cette actualité ?</h6>
                                    <form method="POST" action="{{ route('news.destroy', $newsItem->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex justify-content-around">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                    class="fa-solid fa-x"></i></button>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fa-solid fa-check"></i></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
