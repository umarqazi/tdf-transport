<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    {!! HTML::style('assets/css/bootstrap.css') !!}
    {!! HTML::style('assets/css/main.css') !!}
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') !!}
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    @yield('head_css')
    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body>
        <div class="login-container">
            @yield('content')
            <footer class="login-footer">
                <a href="" class="footer-logo"><img src="{{asset('assets/images')}}/logoTDF.png"></a>
                <ul class="footer-links">
                    <li><i class="fa fa-map-marker"></i> 20 rue de Moreau - 75012 PARIS</li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto: contact@tdf-transport.com">contact@tdf-transport.com</a> </li>
                </ul>
            </footer>
        </div>
        {!! HTML::script('assets/js/bootstrap.js') !!}
        {!! HTML::script('assets/js/jquery.js') !!}
    </body>
</html>