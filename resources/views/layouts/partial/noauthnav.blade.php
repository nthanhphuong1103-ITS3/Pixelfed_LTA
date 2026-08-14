<nav class="navbar navbar-expand navbar-light navbar-laravel shadow-none border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ config('app.logo') }}" style="max-height: 34px; max-width: 150px; width: auto; height: auto; object-fit: contain;" class="mr-2" alt="Logo">
            <span class="font-weight-bold mb-0" style="font-size:20px;">{{ config_cache('app.name', 'Pixelfed') }}</span>
        </a>
    </div>
</nav>
