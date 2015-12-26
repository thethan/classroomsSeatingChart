<!DOCTYPE html>
<html>
<head>
    <title>Ursenbach's Classes</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    @yield('styles')
    <style>
        table.dataTable thead .sorting, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc {
            background-image: none ;

        }
    </style>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    {{--<script src="{{ elixir('js/app.js') }}"></script>--}}
</head>
<body ng-app="classroom">
@include('admin.partials.navbar')
<div class="container-fluid">
    @include('admin.partials.errors')
    @include('admin.partials.success')

    @yield('content')
    @yield('modal')
</div>
<script src="/js/app.js"></script>
@yield('scripts')
</body>
</html>
