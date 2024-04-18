@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('Registrar una nueva membresia'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="{{ __('Nombre completo') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                value="@inversionespijao.com" placeholder="usuario" aria-label="Correo electrónico">
            <div class="input-group-append">
                <span class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </span>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('Contraseña') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <span id="passwordError" class="text-danger"></span>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('Confirmar contraseña') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('Registrar') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('Ya tengo una membresia') }}
        </a>
    </p>
@stop

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');
        const registrationButton = document.querySelector('button[type="submit"]');

        passwordInput.addEventListener('keyup', function () {
            const password = passwordInput.value;
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

            if (password.length < 8) {
                passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres.';
                registrationButton.disabled = true;
            } else if (!password.match(passwordPattern)) {
                passwordError.textContent = 'La contraseña debe contener al menos una letra minúscula, una letra mayúscula y un dígito.';
                registrationButton.disabled = true;
            } else {
                passwordError.textContent = ''; // Limpia el mensaje de error
                registrationButton.disabled = false;
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailInput = document.getElementById('email');
        const domain = '@inversionespijao.com';

        emailInput.addEventListener('focus', function () {
            // Cuando el campo recibe el enfoque, asegúrate de que el usuario pueda editar el campo completo
            emailInput.value = emailInput.value.replace(domain, '');
        });

        emailInput.addEventListener('blur', function () {
            // Al salir del campo, vuelve a agregar el dominio si es necesario
            if (!emailInput.value.endsWith(domain)) {
                emailInput.value += domain;
            }
        });
    });
</script>