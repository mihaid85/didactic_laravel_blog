<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Blog @yield('title')</title> <!-- different for every page -->
<link rel="icon" href="img/icon.ico">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/style.css') !!}
{!! Html::style('font-awesome/css/font-awesome.min.css') !!}
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

@yield('stylesheets')
<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>