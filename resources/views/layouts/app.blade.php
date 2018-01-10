<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- Bootstrap Core CSS 
    <link href="{{ url('/').'/css/vendor/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet">-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- MetisMenu CSS -->
    <link href="{{ url('/').'/css/vendor/metisMenu/metisMenu.min.css' }}" rel="stylesheet">

    <!-- DataTables CSS 
    <link href="{{ url('/').'/css/vendor/datatables-plugins/dataTables.bootstrap.css' }}" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <!-- DataTables Responsive CSS 
    <link href="{{ url('/').'/css/vendor/datatables-responsive/dataTables.responsive.css' }}" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link href="{{ url('/').'/css/dist/css/sb-admin.css' }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ url('/').'/css/vendor/morrisjs/morris.css' }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('/').'/css/vendor/font-awesome/css/font-awesome.min.css' }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    
    
    

    
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        @include('partials.nav')

        <div id="page-wrapper">
        @yield('content')
        </div>
    </div>
        @yield('modal')

    <!-- Scripts -->
    <!-- jQuery 
    <script src="{{ url('/').'/css/vendor/jquery/jquery.min.js' }}"></script>-->
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    

    <!-- DataTables JavaScript 
    <script src="{{ url('/').'/css/vendor/datatables/js/jquery.dataTables.min.js' }}"></script>
    <script src="{{ url('/').'/css/vendor/datatables-plugins/dataTables.bootstrap.min.js' }}"></script>
    <script src="{{ url('/').'/css/vendor/datatables-responsive/dataTables.responsive.js' }}"></script>-->
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/').'/css/vendor/bootstrap/js/bootstrap.min.js' }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('/').'/css/vendor/metisMenu/metisMenu.min.js' }}"></script>

    

    <!-- Morris Charts JavaScript -->
    <script src="{{ url('/').'/css/vendor/raphael/raphael.min.js' }}"></script>
    <script src="{{ url('/').'/css/vendor/morrisjs/morris.min.js' }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('/').'/css/dist/js/sb-admin.js' }}"></script>

     <!-- Latest compiled JavaScript -->
     @yield('actionscripts')
</body>
</html>
