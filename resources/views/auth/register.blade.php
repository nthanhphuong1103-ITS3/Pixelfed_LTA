@extends('layouts.app')

@push('styles')
<style>
  .auth-wrapper {
    min-height: calc(100vh - 120px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem 1rem;
    background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), url('/img/login-bg.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }
  .auth-card {
    width: 100%;
    max-width: 400px;
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
    margin-bottom: 1.5rem;
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
  .auth-subtitle {
    text-align: center;
    color: #8e8e8e;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 1.5rem;
    line-height: 1.4;
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
    margin-top: 1rem;
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
  .auth-subcard {
    width: 100%;
    max-width: 400px;
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
            
            <div class="auth-subtitle">
                Sign up to see photos and videos from your friends.
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger p-2 mb-3 rounded-lg border-0 small">
                    <i class="far fa-exclamation-circle mr-1"></i> {{ $error }}
                </div>
                @endforeach
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="rt" value="{{ (new \App\Http\Controllers\Auth\RegisterController())->getRegisterToken() }}">

                <div class="form-group mb-3">
                    <input id="name" type="text" class="form-control form-control-ig {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('auth.name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback d-block small mt-1">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <input id="username" type="text" class="form-control form-control-ig {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="{{ __('auth.username') }}" required>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback d-block small mt-1">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <div class="input-password-group">
                        <input id="password" type="password" class="form-control form-control-ig {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="{{ __('auth.password') }}" required>
                        <i class="far fa-eye toggle-password-icon" id="togglePasswordReg" title="Toggle password visibility"></i>
                    </div>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback d-block small mt-1">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <div class="input-password-group">
                        <input id="password-confirm" type="password" class="form-control form-control-ig" name="password_confirmation" placeholder="{{ __('auth.confirm-password') }}" required>
                        <i class="far fa-eye toggle-password-icon" id="togglePasswordConfirmReg" title="Toggle password visibility"></i>
                    </div>
                </div>

                @if((bool) config_cache('captcha.enabled') && (bool) config_cache('captcha.active.register'))
                <div class="d-flex justify-content-center my-3">
                    {!! Captcha::display() !!}
                </div>
                @endif

                <p class="small text-muted text-center" style="font-size: 11px; line-height: 1.4;">
                    {!! __('auth.terms') !!}
                </p>

                <button type="submit" class="btn btn-ig">
                    {{ __('auth.register') }}
                </button>
            </form>
        </div>

        <div class="auth-subcard">
            <span class="text-muted">Đã có tài khoản?</span>
            <a href="/login" class="ml-1">{{ __("auth.login") }}</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    function setupTogglePassword(iconId, inputId) {
        const icon = document.getElementById(iconId);
        const input = document.getElementById(inputId);
        if (icon && input) {
            icon.addEventListener('click', function() {
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    }

    setupTogglePassword('togglePasswordReg', 'password');
    setupTogglePassword('togglePasswordConfirmReg', 'password-confirm');
});
</script>
@endpush
