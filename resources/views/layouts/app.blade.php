<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('assets/jquery-2.2.1.js') }}"></script>
</head>
<body>
<div class="wrapper">
    <main>
        <header class="header">
            <div class="container"><a class="header__logo" href="/"><img src="{{ asset('img/logo.png') }}"></a>
                <div class="header__name">Scholarly Reputation <br /> and Metrics</div>
                <nav>
                    <ul id="menu">
                        <li class="{{ Request::is('index') ? 'class="active"' : '' }}"><a href="{{ route('index') }}">Home</a></li>
                        <li class="{{ Request::is('metrics') ? 'class="active"' : '' }}"><a href="{{ route('metrics') }}">Metrics</a></li>
                        <li class="{{ Request::is('about') ? 'class="active"' : '' }}"><a href="{{ route('about') }}">About</a></li>
                        <li class="{{ Request::is('contact') ? 'class="active"' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
        </header>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <div class="page-buffer"></div>
</div>
<footer class="footer">
    <div class="container">
        <a class="footer__leterImgContainer" href="mailto:scholarmetric@gmail.com"><img src="{{ asset('img/icon_email.png') }}"></a><a class="footer__leterImgContainer" href="https://twitter.com/ScholarMetrics" target="_blank"><img src="{{ asset('img/icon_twitter.png') }}"></a>
    </div>
</footer>

<script>
    var getPersonByShortlinkUrl = '{{ route('ajax-shortlink') }}';
    var getListUrl = '{{ route('ajax-getList') }}';
    var contentYear = '{{ \App\Models\Content::year() ? \App\Models\Content::year() : '2018' }}';
    var sendEmailUrl = '{{ route('sendEmail') }}';
</script>
<script src="{{ asset('js/tooltip.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@stack('scripts')

@if( request()->getHttpHost() == 'scholarmetrics.com' )
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-77262756-1', 'auto');
        ga('send', 'pageview');
    </script>
@endif
</body>
</html>