    <div class="col-12 col-md-3">
        <ul class="nav flex-column settings-nav py-3">
            <li class="nav-item pl-3 {{request()->is('settings/home')?'active':''}}">
                <a class="nav-link font-weight-light text-muted" href="{{route('settings')}}">{{__('settings.account')}}</a>
            </li>
            <li class="nav-item pl-3 {{request()->is('settings/email')?'active':''}}">
                <a class="nav-link font-weight-light text-muted" href="{{route('settings.email')}}">{{__('settings.email')}}</a>
            </li>
            <li class="nav-item pl-3 {{request()->is('settings/password')?'active':''}}">
                <a class="nav-link font-weight-light text-muted" href="{{route('settings.password')}}">{{__('settings.password')}}</a>
            </li>
            <li class="nav-item pl-3 {{request()->is('settings/accessibility')?'active':''}}">
                <a class="nav-link font-weight-light text-muted" href="{{route('settings.accessibility')}}">{{__('settings.accessibility')}}</a>
            </li>
        </ul>
    </div>

    @push('styles')
    <style type="text/css">
        .settings-nav {
            @media only screen and (min-width: 768px) {
                border-right: 1px solid #dee2e6 !important
            }
            height: 100%;
            flex-grow: 1;
        }
    </style>
    @endpush
