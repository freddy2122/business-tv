@extends('layouts.index')

@section('content')
<style>
    .form-check-input:focus {
        box-shadow: 0 0 0 0.02rem rgba(0, 123, 255, 0.25);
    }
    
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
           
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Adresse e-mail') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    <div class="input-group">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                        <button type="button" class="btn btn-primary" id="togglePassword">
                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-check mb-3 d-flex justify-content-between">
                    <input type="checkbox" class="form-check-input" id="remember_me_checkbox" name="remember">
                    <label for="remember_me_checkbox" class="form-check-label">{{ __('Se souvenir de moi') }}</label>
                    <a href="{{ route('register') }}" class="text-primary">{{ __('s\'inscrire') }}</a>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary py-3 font-bold rounded">{{ __('Connexion') }}</button>
                </div>
                @if (Route::has('password.request'))
                    <div class="mb-3 text-center">
                        <a class="text-decoration-underline" href="{{ route('password.request') }}">{{ __('Mot de passe oublié?') }}</a>
                    </div>
                @endif
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            togglePasswordIcon.classList.toggle('fa-eye');
            togglePasswordIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>


@endsection
