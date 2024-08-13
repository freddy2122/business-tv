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
           
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nom & prénoms') }}</label>
                    <input id="name" class="form-control" type="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Adresse e-mail') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    <div class="input-group">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                        <button type="button" class="btn btn-primary" id="togglePassword">
                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirmer mot de passe') }}</label>
                    <div class="input-group">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                        <button type="button" class="btn btn-primary" id="togglePasswordConfirmation">
                            <i class="fa fa-eye" id="togglePasswordConfirmationIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary py-3 font-bold rounded">{{ __("S'inscrire") }}</button>
                </div>
                <div class=" mb-3 text-center">
                    <a href="{{ route('login') }}" class="text-primary">{{ __('Aviez-vous déjà un compte?') }}</a>
                </div>
               
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

        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmationField = document.getElementById('password_confirmation');
        const togglePasswordConfirmationIcon = document.getElementById('togglePasswordConfirmationIcon');

        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationField.setAttribute('type', type);
            togglePasswordConfirmationIcon.classList.toggle('fa-eye');
            togglePasswordConfirmationIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>

@endsection
