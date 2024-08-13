@extends('layouts.admin')

@section('content')
<style>
    #success-popup {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #28a745; /* Couleur verte pour le succès */
    color: white;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: none;
    z-index: 9999;
}
</style>
    <div class="container-fluid">
        <div id="success-popup" class="alert">
            {{ session('success') }}
        </div>
        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ $news->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="video_url">URL de la vidéo (optionnel)</label>
                <input type="file" name="videos_url[]" id="video_url" class="form-control" accept="video/*" multiple>
                <div id="video-preview" class="mt-3">
                    @if ($news->videos_url)
                        @php
                            $videoUrls = json_decode($news->videos_url);
                        @endphp
                        @foreach ($videoUrls as $videoUrl)
                            <video class="card-img-top mt-2" controls>
                                <source src="{{ $videoUrl }}" type="video/mp4">
                                Votre navigateur ne supporte pas la balise vidéo.
                            </video>
                        @endforeach
                    @endif
                </div>
            </div>
            <button type="submit" class="btn" style="background:#007bff;color:white">Modifier</button>
        </form>
    </div>

    <script>
        document.getElementById('video_url').addEventListener('change', function(event) {
            let files = event.target.files;
            let videoPreview = document.getElementById('video-preview');
            videoPreview.innerHTML = ''; // Clear any previous videos

            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let videoType = /video.*/;

                if (file.type.match(videoType)) {
                    let video = document.createElement('video');
                    video.classList.add('card-img-top');
                    video.controls = true;
                    video.src = URL.createObjectURL(file);
                    videoPreview.appendChild(video);
                }
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = "{{ session('success') }}";
            if (successMessage) {
                var popup = document.getElementById('success-popup');
                popup.style.display = 'block';
                setTimeout(function() {
                    popup.style.display = 'none';
                }, 4000); // Afficher pendant 4 secondes
            }
        });
    </script>
@endsection
