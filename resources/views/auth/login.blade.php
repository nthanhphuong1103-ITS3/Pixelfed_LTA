@extends('layouts.app')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
        background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), url('/img/BG genuineparnergroup.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .auth-card {
        width: 100%;
        max-width: 380px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        padding: 2.5rem 2rem 2rem 2rem;
        transition: all 0.3s ease;
    }

    [data-stylesheet="dark"] .auth-card {
        background: rgba(18, 18, 18, 0.88);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-color: rgba(255, 255, 255, 0.12);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
    }

    .auth-brand {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-brand img {
        height: 48px;
        margin-bottom: 0.5rem;
        transition: transform 0.3s ease;
    }

    .auth-brand img:hover {
        transform: scale(1.05);
    }

    .auth-brand-title {
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: -0.5px;
        color: #262626;
    }

    [data-stylesheet="dark"] .auth-brand-title {
        color: #f5f5f5;
    }

    .form-control-ig {
        background: #fafafa;
        border: 1px solid #dbdbdb;
        border-radius: 8px;
        font-size: 14px;
        padding: 12px 14px;
        height: auto;
        color: #262626;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control-ig:focus {
        background: #ffffff;
        border-color: #a8a8a8;
        box-shadow: 0 0 0 2px rgba(0, 149, 246, 0.15);
        outline: none;
    }

    [data-stylesheet="dark"] .form-control-ig {
        background: #1a1a1a;
        border-color: #363636;
        color: #f5f5f5;
    }

    [data-stylesheet="dark"] .form-control-ig:focus {
        background: #242424;
        border-color: #0095f6;
    }

    .btn-ig {
        background: linear-gradient(135deg, #0095f6 0%, #0077e6 100%);
        border: none;
        border-radius: 8px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 11px;
        width: 100%;
        margin-top: 0.5rem;
        transition: opacity 0.2s, transform 0.1s;
        box-shadow: 0 4px 12px rgba(0, 149, 246, 0.3);
    }

    .btn-ig:hover {
        opacity: 0.93;
        color: #ffffff;
        text-decoration: none;
    }

    .btn-ig:active {
        transform: scale(0.99);
    }

    .input-password-group {
        position: relative;
    }

    .toggle-password-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #8e8e8e;
        font-size: 16px;
        user-select: none;
    }

    .toggle-password-icon:hover {
        color: #262626;
    }

    [data-stylesheet="dark"] .toggle-password-icon:hover {
        color: #ffffff;
    }

    .divider-or {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: #8e8e8e;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .divider-or::before,
    .divider-or::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #dbdbdb;
    }

    [data-stylesheet="dark"] .divider-or::before,
    [data-stylesheet="dark"] .divider-or::after {
        border-bottom-color: #262626;
    }

    .divider-or span {
        padding: 0 0.75rem;
    }

    .auth-subcard {
        width: 100%;
        max-width: 380px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        padding: 1.25rem;
        text-align: center;
        font-size: 14px;
        margin-top: 0.75rem;
    }

    [data-stylesheet="dark"] .auth-subcard {
        background: rgba(18, 18, 18, 0.88);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-color: rgba(255, 255, 255, 0.12);
        color: #f5f5f5;
    }

    .auth-subcard a {
        color: #0095f6;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-subcard a:hover {
        text-decoration: underline;
    }

    .remember-forgot-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="d-flex flex-column align-items-center w-100">
        <div class="auth-card">
            <div class="auth-brand">
                <a href="{{ url('/') }}">
                    <img src="{{ config('app.logo') }}" alt="{{ config('app.name') }}" style="max-height: 52px; max-width: 180px; width: auto; height: auto; object-fit: contain;">
                </a>
                <div class="auth-brand-title">{{ config('app.name') }}</div>
            </div>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger p-2 mb-3 rounded-lg border-0 small">
                <i class="far fa-exclamation-circle mr-1"></i> {{ $error }}
            </div>
            @endforeach
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-3">
                    <input id="email" type="text" class="form-control form-control-ig {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Tên đăng nhập hoặc Email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback d-block small mt-1">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-2">
                    <div class="input-password-group">
                        <input id="password" type="password" class="form-control form-control-ig {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="{{ __('auth.password') }}" required>
                        <i class="far fa-eye toggle-password-icon" id="togglePasswordIcon" title="Toggle password visibility"></i>
                    </div>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback d-block small mt-1">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="remember-forgot-row">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label text-muted font-weight-normal" for="remember">
                            {{ __('auth.remember') }}
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-muted small">
                        {{ __('auth.forgot') }}
                    </a>
                </div>

                @if(
                (bool) config_cache('captcha.enabled') &&
                (bool) config_cache('captcha.active.login') ||
                (
                (bool) config_cache('captcha.triggers.login.enabled') &&
                request()->session()->has('login_attempts') &&
                request()->session()->get('login_attempts') >= config('captcha.triggers.login.attempts')
                )
                )
                <div class="d-flex justify-content-center mb-3">
                    {!! Captcha::display() !!}
                </div>
                @endif

                <button type="submit" class="btn btn-ig">
                    {{ __('auth.login') }}
                </button>
            </form>

            @if(
            (config_cache('pixelfed.open_registration') && config('remote-auth.mastodon.enabled')) ||
            (config('remote-auth.mastodon.ignore_closed_state') && config('remote-auth.mastodon.enabled'))
            )
            <div class="divider-or"><span>OR</span></div>
            <form method="POST" action="/auth/raw/mastodon/start">
                @csrf
                <button type="submit" class="btn btn-outline-primary btn-block rounded-lg font-weight-bold btn-sm py-2" style="border-color: #6364FF; color: #6364FF;">
                    <i class="fab fa-mastodon mr-1"></i> {{ __("auth.signInMastodon") }}
                </button>
            </form>
            @endif

            @if( config('remote-auth.oidc.enabled') )
            <div class="divider-or"><span>OR</span></div>
            <a href="/auth/oidc/start" class="btn btn-outline-secondary btn-block rounded-lg font-weight-bold btn-sm py-2">
                Sign-in with OIDC
            </a>
            @endif
        </div>

        @if((bool) config_cache('pixelfed.open_registration') || (bool) config_cache('instance.curated_registration.enabled'))
        <div class="auth-subcard">
            <span class="text-muted">Chưa có tài khoản?</span>
            <a href="/register" class="ml-1">{{ __("auth.register") }}</a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Autofill email from query param if available
        function getQueryParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }
        const email = getQueryParam('email');
        if (email) {
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.value = email;
                const passwordInput = document.getElementById('password');
                if (passwordInput) {
                    passwordInput.focus();
                }
            }
        }

        // Toggle Password Visibility
        const toggleIcon = document.getElementById('togglePasswordIcon');
        const passwordInput = document.getElementById('password');
        if (toggleIcon && passwordInput) {
            toggleIcon.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>
@endpush
