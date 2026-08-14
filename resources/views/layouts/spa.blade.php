<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="mobile-web-app-capable" content="yes">
	<title>{{ $title ?? config_cache('app.name') }}</title>
	<link rel="manifest" href="{{url('/manifest.json')}}">
	<meta property="og:site_name" content="{{ config_cache('app.name') }}">
	<meta property="og:title" content="{{ $title ?? config_cache('app.name') }}">
	<meta property="og:type" content="article">
	<meta property="og:url" content="{{url(request()->url())}}">
	@stack('meta')

	<meta name="medium" content="image">
	<meta name="theme-color" content="#10c5f8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" type="image/png" href="{{url('/img/favicon.png?v=2')}}">
	<link rel="apple-touch-icon" type="image/png" href="{{url('/img/favicon.png?v=2')}}">
	<link rel="canonical" href="{{url(request()->url())}}">
	<link href="{{ mix('css/app.css') }}" rel="stylesheet" data-stylesheet="light">
	<link href="{{ mix('css/spa.css') }}" rel="stylesheet" data-stylesheet="light">
	@if(config_cache('uikit.show_custom.css'))
	<style type="text/css">{!!config_cache('uikit.custom.css')!!}</style>
	@endif
	@auth
	<script type="text/javascript">
		window._sharedData = {
			curUser: {},
			user: {!! json_encode(\App\Services\ProfileService::get(request()->user()->profile_id)) !!},
			version: 0
		};
		window.App = {
			config: {!!App\Util\Site\Config::json()!!}
		};
	</script>
	@endauth
</head>
	<body class="loggedIn">
		<main id="content">
			<noscript>
				<div class="container">
					<p class="pt-5 text-center lead">Please enable javascript to view this content.</p>
				</div>
			</noscript>
			<navbar></navbar>
			<router-view></router-view>
		</main>
		<script type="text/javascript" src="{{ mix('js/manifest.js') }}"></script>
		<script type="text/javascript" src="{{ mix('js/vendor.js') }}"></script>
		<script type="text/javascript" src="{{ mix('js/spa.js') }}"></script>

		<script type="text/javascript">
		(function() {
		    function initReactions() {
		        var heartSelector = '.like-btn, .status-heart, .fa-heart, button:has(.fa-heart), button:has(.fa-thumbs-up), .reactions button';
		        document.querySelectorAll(heartSelector).forEach(function(el) {
		            var btn = el.tagName === 'BUTTON' || el.tagName === 'H3' || el.tagName === 'I' || el.tagName === 'SPAN' ? el : el.closest('button, h3, a');
		            if (!btn || btn.dataset.hasReactionPicker === 'true') return;
		            btn.dataset.hasReactionPicker = 'true';

		            var container = btn.closest('.reaction-bar-container') || btn.parentElement;
		            if (!container) return;
		            if (getComputedStyle(container).position === 'static') {
		                container.style.position = 'relative';
		            }
		            container.style.overflow = 'visible';

		            var picker = document.createElement('div');
		            picker.className = 'reaction-popover-bar shadow-lg rounded-pill';
		            picker.style.cssText = 'position: absolute; bottom: 125%; left: 0; z-index: 99999; background: #ffffff !important; border: 1px solid #cbd5e1 !important; box-shadow: 0 10px 30px rgba(0,0,0,0.25) !important; border-radius: 50px !important; display: none; align-items: center; padding: 6px 10px; white-space: nowrap; animation: popIn 0.2s ease;';

		            var reactions = [
		                { icon: '❤️', title: 'Tim', type: 'heart', html: '<i class="fas fa-heart text-danger mr-1"></i> Tim' },
		                { icon: '👍', title: 'Thích', type: 'like', html: '<i class="fas fa-thumbs-up text-primary mr-1"></i> Thích' },
		                { icon: '😆', title: 'Haha', type: 'haha', html: '<span class="mr-1">😆</span> Haha' },
		                { icon: '😢', title: 'Buồn', type: 'sad', html: '<span class="mr-1">😢</span> Buồn' },
		                { icon: '😡', title: 'Giận', type: 'angry', html: '<span class="mr-1">😡</span> Giận' },
		                { icon: '🚫', title: 'Bỏ cảm xúc', type: 'unlike', html: '<i class="far fa-heart mr-1"></i> Thích' }
		            ];

		            reactions.forEach(function(r) {
		                var rBtn = document.createElement('button');
		                rBtn.type = 'button';
		                rBtn.className = 'btn btn-reaction';
		                rBtn.title = r.title;
		                rBtn.innerHTML = r.icon;
		                rBtn.style.cssText = 'border: none; background: transparent; font-size: 24px; cursor: pointer; padding: 2px 6px; transition: transform 0.15s; margin: 0 2px; outline: none;';
		                
		                rBtn.addEventListener('mouseenter', function() { rBtn.style.transform = 'scale(1.4) translateY(-4px)'; });
		                rBtn.addEventListener('mouseleave', function() { rBtn.style.transform = 'scale(1) translateY(0)'; });

		                rBtn.addEventListener('click', function(e) {
		                    e.stopPropagation();
		                    e.preventDefault();
		                    picker.style.display = 'none';

		                    if (btn.tagName === 'BUTTON' || btn.tagName === 'H3' || btn.tagName === 'A') {
		                        btn.innerHTML = r.html;
		                    }

		                    var form = container.querySelector('.like-form') || btn.closest('form');
		                    if (form) {
		                        var submitBtn = form.querySelector('button[type="submit"]');
		                        if (submitBtn) submitBtn.click();
		                    } else {
		                        btn.click();
		                    }
		                });
		                picker.appendChild(rBtn);
		            });

		            container.appendChild(picker);

		            function showPicker() { picker.style.display = 'flex'; }
		            function hidePicker() { picker.style.display = 'none'; }

		            btn.addEventListener('mouseenter', showPicker);
		            container.addEventListener('mouseleave', hidePicker);
		            btn.addEventListener('click', function(e) {
		                if (picker.style.display === 'none') {
		                    e.preventDefault();
		                    e.stopPropagation();
		                    showPicker();
		                }
		            });
		        });
		    }

		    if (document.readyState === 'loading') {
		        document.addEventListener('DOMContentLoaded', initReactions);
		    } else {
		        initReactions();
		    }
		    setInterval(initReactions, 1000);
		})();
		</script>
	</body>
</html>
