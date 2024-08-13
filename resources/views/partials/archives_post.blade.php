<div class="sidebar-sticky">
    <div>
        <h4 class="fst-italic">Archive posts</h4>
        <ul class="list-unstyled">
            @foreach ($news as $newsItem)
                <li>
                    <a class="text-decoration-none border-top text-dark"
                        href="{{ route('news.details', ['slug' => $newsItem->slug]) }}">
                        <div class="d-flex align-items-center xxx pb-3">
                            @if ($newsItem->videos_url)
                                <video class="" controls preload="metadata">
                                    <source src="{{ $newsItem->videos_url }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la balise vidéo.
                                </video>
                            @else
                                <p>Pas de vidéo disponible</p>
                            @endif
                            <div class="" style="margin-left:15px">
                                <h6 class="mb-0">{{ $newsItem->title }}</h6>
                                <small class="text-body-secondary">{{ $newsItem->created_at->format('F d, Y') }}</small>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
