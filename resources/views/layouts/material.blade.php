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

<md-toolbar>
    <div class="md-toolbar-tools">
        <md-button class="md-icon-button" aria-label="Back" href="{{ URL::previous() }}">
            <md-icon md-svg-icon="navigation:arrow_back"></md-icon>
        </md-button>
        <h2>
            <span></span>
        </h2>
        <span flex></span>
        <md-button class="md-icon-button" aria-label="Favorite">
            <md-icon md-svg-icon="img/icons/favorite.svg" style="color: greenyellow;"></md-icon>
        </md-button>
        <md-button class="md-icon-button" aria-label="More">
            <md-icon md-svg-icon="img/icons/more_vert.svg"></md-icon>
        </md-button>
    </div>
</md-toolbar>
@include('admin.partials.errors')
@include('admin.partials.success')

@yield('content')
@yield('modal')

<script src="/js/classroom.js"></script>
@yield('scripts')
</body>
</html>
