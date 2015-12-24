@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
        </div>
    </div>
    <section ng-app="classroom" ng-controller="ClassroomsController">
        <md-content>
            <form name="userForm" action="" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="start" value="@{{ start }}">
                <input type="hidden" name="end" value="@{{ end }}">

                <div layout-gt-sm="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Start</label>

                    </md-input-container>
                    <md-datepicker ng-model="start" md-placeholder="Enter Start date"></md-datepicker>

                    <md-input-container class="md-block" flex-gt-sm>
                        <label>End</label>

                    </md-input-container>
                    <md-datepicker ng-model="end" md-placeholder="Enter End date"></md-datepicker>
                    {{--<md-input-container class="md-block" flex-gt-sm>
                        <label>Concat By</label>
                        <md-select ng-model="concat">
                            <md-option ng-repeat="type in types" value="@{{ type }}">
                                @{{ type }}
                            </md-option>
                        </md-select>
                    </md-input-container>--}}
                </div>
                <div layout-gt-sm="row">
                    <button type="submit" class="md-raised md-primary">
                        Submit
                    </button>
                </div>
            </form>
        </md-content>
    </section>
@endsection


@section('styles')
    <link rel="stylesheet"
          href="https://ajax.googleapis.com/ajax/libs/angular_material/0.11.2/angular-material.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        .md-datepicker-calendar-pane {
            background: #fff;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{'/js/query.js' }}"></script>
    <script>


        angular.module('classroom', ['ngMaterial']);

        angular.module('classroom')
                .controller('ClassroomsController', ClassroomsController);

        angular.module('classroom')
                .config(config);

        function config($mdIconProvider) {
            // Configure URLs for icons specified by [set:]id.
            $mdIconProvider
                    .iconSet('action', '/assets/img/icons/svg-sprite-action.svg')   // Register a named icon set of SVGs
                    .iconSet('av', '/assets/img/icons/svg-sprite-av.svg')   // Register a named icon set of SVGs
                    .iconSet('alert', '/assets/img/icons/svg-sprite-alert.svg')   // Register a named icon set of SVGs
                    .iconSet('communication', '/assets/img/icons/svg-sprite-communication.svg')   // Register a named icon set of SVGs
                    .iconSet('content', '/assets/img/icons/svg-sprite-content.svg')   // Register a named icon set of SVGs
                    .iconSet('device', '/assets/img/icons/svg-sprite-device.svg')   // Register a named icon set of SVGs
                    .iconSet('editor', '/assets/img/icons/svg-sprite-editor.svg')   // Register a named icon set of SVGs
                    .iconSet('file', '/assets/img/icons/svg-sprite-file.svg')   // Register a named icon set of SVGs
                    .iconSet('hardware', '/assets/img/icons/svg-sprite-hardware.svg')   // Register a named icon set of SVGs
                    .iconSet('image', '/assets/img/icons/svg-sprite-image.svg')   // Register a named icon set of SVGs
                    .iconSet('maps', '/assets/img/icons/svg-sprite-maps.svg')   // Register a named icon set of SVGs
                    .iconSet('navigation', '/assets/img/icons/svg-sprite-navigation.svg')   // Register a named icon set of SVGs
                    .iconSet('notification', '/assets/img/icons/svg-sprite-notification.svg')   // Register a named icon set of SVGs
                    .iconSet('social', '/assets/img/icons/svg-sprite-social.svg')   // Register a named icon set of SVGs
                    .iconSet('toggle', '/assets/img/icons/svg-sprite-togge.svg'); // Register a named icon set of SVGs

        }


        ClassroomsController.$inject = ['$scope', '$http', '$mdDialog', '$mdToast'];

        function ClassroomsController($scope, $http, $mdDialog, $mdToast) {

            $scope.types = [
                'day', 'week', 'month'
            ];

            $scope.submit = function () {
                data = {"concat":$scope.concat,"start": $scope.start, "end":$scope.end };
                $http.post('', data)
                        .success(function (data, status) {
                            var blob = new Blob([ data ], { type : 'text/plain' });
                            $scope.url = (window.URL || window.webkitURL).createObjectURL( blob );
                        })
                        .error(function (e, status) {

                        })
            }


        }

    </script>
@endsection