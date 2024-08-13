@extends('layouts.index')

@section('content')
    <style>
        .comment-content {
            margin-bottom: 0;
        }

        .comment-time {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .comment-header {
            margin-bottom: 0;
        }

        .comment-item {
            margin-bottom: 0;
        }

        .custom-input {
            border: none;
            border-bottom: 2px solid rgb(193, 190, 190);
            border-radius: 0;
        }

        @media (max-width: 767.98px) {
            .sidebar-sticky {
                position: static;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 768px) {
            .sidebar-sticky {
                position: sticky;
                top: 2rem;
            }
        }

        .xxx video {
            width: 30%;
            height: 80px;
        }

        .comment-scroll {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>

    <main class="container-fluid">
        <div class="row g-5">
            <div class="col-md-4">
                @include('partials.archives_post', ['news' => $news])
            </div>

            <div class="col-md-8">
                <div class="pb-3">
                    <div class="row">
                        @if ($newsItem->videos_url)
                            <video controls width="100%" height="400px">
                                <source src="{{ $newsItem->videos_url }}" type="video/mp4">
                                Votre navigateur ne supporte pas la balise vidéo.
                            </video>
                        @else
                            <p>Pas de vidéo disponible</p>
                        @endif
                        <p class="blog-post-meta pt-2" style="font-size: 13px"><i class="bi bi-calendar-event"></i>
                            {{ $newsItem->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
                <article class="blog-post d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <p class=" mb-1"><strong>{{ $newsItem->title }}</strong></p>
                    </div>
                    <div class="">
                        <i class="fa-solid fa-comment text-primary"></i> {{$commentCount}}
                        <i class="fa-solid fa-eye text-primary"></i> {{ $viewCount}}
                    </div>
                </article>
                <p>{{ $newsItem->content }}</p>
                <div class="pb-5">
                    <h5>Commentaires</h5>

                    @auth
                        <div class="d-flex align-items-center mb-4">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                    class="img-fluid rounded-circle" height="40" width="40" alt="Profile Photo">
                            @else
                                <img src="https://ui-avatars.com/api?name={{ auth()->user()->name }}" alt="Profile"
                                    class="rounded-circle" width="50" height="50" style="margin-right: 1rem;">
                            @endif
                            <form id="commentForm" class="flex-grow-1">
                                @csrf
                                <input type="hidden" name="news_id" value="{{ $newsItem->id }}">
                                <div class="d-flex">
                                    <input type="text" class="form-control custom-input" placeholder="Laisser un commentaire"
                                        name="comment">
                                    <button type="submit" class="btn btn-primary ms-2"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    @else
                        <p>Veuillez <a href="{{ route('login') }}">vous connecter</a> pour laisser un commentaire.</p>
                    @endauth

                    <div class="mt-4 comment-scroll" id="commentsContainer">
                        <h6>Commentaires précédents</h6>
                        <p id="noCommentsMessage" style="display: none;">Aucun commentaire disponible</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentForm = document.getElementById('commentForm');
            const commentsContainer = document.getElementById('commentsContainer');
            const noCommentsMessage = document.getElementById('noCommentsMessage');

            commentForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(commentForm);

                fetch('/post-comment', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.comment) {
                        addCommentToDOM(data.comment);
                        commentForm.reset();
                    } else {
                        console.error('Error: Invalid response', data);
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            const newsId = commentForm.querySelector('input[name="news_id"]')?.value;

            if (!newsId) {
                console.error('News ID not found');
                return;
            }

            fetch(`/comments/${newsId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.comments.length === 0) {
                        noCommentsMessage.style.display = 'block';
                    } else {
                        noCommentsMessage.style.display = 'none';
                        data.comments.slice(0, 5).forEach(comment => addCommentToDOM(comment));
                    }
                })
                .catch(error => console.error('Error:', error));

            function timeAgo(date) {
                const now = new Date();
                const diffInSeconds = Math.floor((now - new Date(date)) / 1000);
                const diffInMinutes = Math.floor(diffInSeconds / 60);
                const diffInHours = Math.floor(diffInMinutes / 60);
                const diffInDays = Math.floor(diffInHours / 24);

                if (diffInDays > 0) {
                    return `il y a ${diffInDays} jours`;
                } else if (diffInHours > 0) {
                    return `il y a ${diffInHours}h`;
                } else if (diffInMinutes > 0) {
                    return `il y a ${diffInMinutes}mn`;
                } else {
                    return `à l'instant`;
                }
            }

            function addCommentToDOM(comment) {
                const commentElement = document.createElement('div');
                commentElement.classList.add('comment-item', 'd-flex', 'align-items-start', 'p-2', 'mb-2');

                commentElement.innerHTML = `
                    <img src="${comment.user.profile_photo ? '{{ asset('storage/') }}/' + comment.user.profile_photo : 'https://ui-avatars.com/api?name=' + comment.user.name}" alt="Profile" class="rounded-circle me-2" width="40" height="40">
                    <div class="flex-grow-1">
                        <p class="comment-header"><strong>${comment.user.name}</strong></p>
                        <p class="comment-content">${comment.content}</p>
                        <small class="comment-time">${timeAgo(comment.created_at)}</small>
                    </div>
                `;

                commentsContainer.insertBefore(commentElement, commentsContainer.firstChild);
            }
        });
    </script>
@endsection
