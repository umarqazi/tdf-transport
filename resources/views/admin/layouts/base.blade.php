<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    {!! HTML::style('assets/css/main.css') !!}
    {!! HTML::style('assets/styles/bootstrap.min.css') !!}
    {!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css')!!}
    {!! HTML::style('assets/css/bootstrap-datetimepicker.css')!!}
    {!! HTML::style('assets/styles/metisMenu.min.css') !!}
    {!! HTML::style('assets/styles/font-awesome.min.css') !!}
    {!! HTML::style('assets/styles/sb-admin-2.min.css') !!}
    {!! HTML::style('assets/styles/custom.css') !!}
    {!! HTML::style('assets/styles/responsive.css') !!}
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') !!}
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css') !!}
    {!! HTML::style('//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css')!!}
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    @yield('head_css')
    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body>
        <div id="wrapper">
            @yield('content')
        </div>
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') !!}
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js')!!}
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js')!!}
        {!! HTML::script('assets/scripts/bootstrap.min.js') !!}
        {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js')!!}
        {!! HTML::script('http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js') !!}
        {!! HTML::script('assets/scripts/metisMenu.min.js') !!}
        {!! HTML::script('assets/scripts/sb-admin-2.min.js') !!}
        {!! HTML::script('assets/scripts/custom.js') !!}
        {!! HTML::script('//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js') !!}
        {!! HTML::script('assets/js/admin.js') !!}

    </body>
</html>
