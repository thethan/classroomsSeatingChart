<!DOCTYPE html>
<html>
<head>
    <title>Ursenbach's Classes</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    @yield('styles')
    <link rel="stylesheet" href="{{ elixir('css/classroom.css') }}">

    {{--<script src="{{ elixir('js/app.js') }}"></script>--}}
</head>
<body ng-app="classroom">


    @include('admin.partials.errors')
    @include('admin.partials.success')

    @yield('content')
    @yield('modal')

    <script src="/js/classroom.js"></script>
    @yield('scripts')
</body>
</html>
