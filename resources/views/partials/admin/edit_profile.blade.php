@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Modifier les informations de l'utilisateur</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    
                    <!-- Photo de profil -->
                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Photo de profil</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo" onchange="previewImage(event)">
                        <!-- Zone d'aperçu de l'image -->
                        <div id="photo_preview" class="mt-3">
                            @if ($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Current profile photo" class="img-fluid" style="max-width: 200px;">
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bouton de mise à jour -->
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('photo_preview');
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Image preview" class="img-fluid" style="max-width: 200px;">';
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
