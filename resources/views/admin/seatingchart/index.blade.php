
@extends('layouts.material')
@section('content')


    <section ng-controller="ClassroomController as showCase">

        <md-content class="md-padding classroom">

            <div ng-repeat="table in chart" class="@{{ table.name }} table">
                <div class="desk" ng-repeat="seat in table.seats">
                    <div ng-if="seat" ng-click="showCase.marks($event, seat, table.name, $index)" class="student">
                        <p>@{{ getStudentByObject(seat) }}</p>
                    </div>

                    <div ng-if="!seat" ng-click="showCase.fillSeat($event, table.name, $index)" class="student">
                        <p><i>unassigned</i></p>
                    </div>
                </div>
            </div>
        </md-content>

    </section>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/0.11.2/angular-material.min.css">

    <style>
        .break {
            height: 2em;
        }

        .classroom {
            display: -webkit-flex; /* Safari */
            -webkit-flex-flow: row wrap; /* Safari 6.1+ */
            display: flex;
            flex-flow: row wrap;
            padding: 0 2em;
        }

        .table {
            flex: 1 45%;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
            margin: 0 0 2em 2.5%;
            flex-flow: row wrap;
        }

        .table .desk {
            justify-content: center;
            align-items: center;
            flex: 1 30%;
            margin: .5em 1% 0 0;
            color: #3c3c3c;
            font-weight: 600;
            display: flex;

        }

        .table .desk .student {
            flex: 1;
            display: flex;
            height: 200px;
            justify-content: center;
            align-items: center;
        }

        .table .desk .student p {
            flex: 1;
            text-align: center;
        }

        .green .desk .student {
            background: rgba(0, 255, 0, .5);
        }

        .blue .desk .student {
            background: rgba(0, 0, 255, .5);
        }

        .red .desk .student {
            background: rgba(255, 0, 0, .5);
            background: red;
        }

        .yellow .desk .student {
            background: yellow;
        }

        .orange .desk .student {
            background: orange;
        }

        .purple .desk .student {
            background: rgba(147,112,219,1);
        }

    </style>
@endsection


@section('modal')

@endsection


@section('scripts')

    <script>


        angular.module('classroom', ['ngMaterial']);

        angular.module('classroom')
                .controller('ClassroomController', ClassroomController);

        angular.module('classroom')
                .config(config);

        function config($mdIconProvider) {
            // Configure URLs for icons specified by [set:]id.
            $mdIconProvider
                    .iconSet('action', '/assets/img/icons/actions/defs/svg/sprite.defs.svg')   // Register a named icon set of SVGs
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
                    .iconSet('navigation', '/assets/img/icons/navigation/defs/svg/sprite.defs.svg')   // Register a named icon set of SVGs
                    .iconSet('notification', '/assets/img/icons/svg-sprite-notification.svg')   // Register a named icon set of SVGs
                    .iconSet('social', '/assets/img/icons/svg-sprite-social.svg')   // Register a named icon set of SVGs
                    .iconSet('toggle', '/assets/img/icons/svg-sprite-togge.svg'); // Register a named icon set of SVGs

        }
        ;

        ClassroomController.$inject = ['$scope', '$http', '$mdDialog', '$mdToast'];

        function ClassroomController($scope, $http, $mdDialog, $mdToast) {

            var self = this;
            self.fillSeat = function ($event, tableName, seatIndex) {
                $mdDialog.show({
                    controller: FillSeatController,
                    controllerAs: 'ctrl',
                    templateUrl: '/assets/html/dialog/fillseat.template.html',
                    parent: angular.element(document.body),
                    targetEvent: $event,
                    clickOutsideToClose: true
                })
                        .then(function (studentId) {
                            var seatId = getAddStudentToSeat(tableName, seatIndex, studentId);
                            studentName = $scope.students[studentId];
                            $http.post('/api/seats/' + seatId + '/students', {"student_id": studentId})
                                    .success(function () {
                                        var toast = $mdToast.simple()
                                                .content( studentName + ' found their seat.')
                                                .highlightAction(false);
                                        $mdToast.show(toast);
                                    }).error(function () {

                                    });
                        }, function () {
                            $scope.status = 'You cancelled the dialog.';
                        });
            }

            self.marks = function ($event, studentId, tableName, seatIndex) {
                var seatId = getSeatId(tableName, seatIndex);
                $mdDialog.show({
                    controller: MarksController,
                    controllerAs: 'ctrl',
                    templateUrl: '/assets/html/dialog/marks.template.html',
                    parent: angular.element(document.body),
                    targetEvent: $event,
                    locals: {
                        tableName: tableName,
                        student_id: studentId,
                        seatId : seatId,


                    },
                    clickOutsideToClose: true
                })
            }

            $http.get('/api/assign/{{ $classroomId }}')
                    .success(function (data) {
                        $scope.chart = data;
                    }).error(function (data) {
                        alert(data);
                    })


            $scope.isOpen = false;

            $scope.demo = {
                isOpen: false,
                count: 0,
                selectedDirection: 'left'
            };

            getStudentsWithoutASeat();

            function MarksController($timeout, $q, $scope, $mdDialog, tableName, student_id, seatId) {
                var self = this;
                $scope.studentId = student_id;
                $http.get('/api/marks')
                        .success(function (data, status) {
                            $scope.marks  = data.data;
                        });
                $http.get('/api/students/'+student_id+'/marks/today')
                        .success(function (data, status) {
                            $scope.historicalMarks  = data;
                            console.log($scope.historicalMarks);
                        });
                $scope.confirm = function () {
                    $mdDialog.hide();
                }

                self.removeFromSeat = function ($event, studentId) {

                    $http.put('/api/seats/' + seatId + '/students', {"student_id": student_id})
                            .success(function (data, status) {
                                getRemoveStudentToSeat(tableName, seatId);
                                $mdDialog.hide();
                            })
                }

                $scope.addMark = function(markId, $event){
                    $http.post('/api/students/'+student_id+'/marks/'+markId+'/add')
                            .success(function(data, status){
                                $scope.historicalMarks[markId].mark_count++;
                            });
                }
                $scope.removeMark = function(markId, $event){
                    $http.put('/api/students/'+student_id+'/marks/'+markId+'/remove')
                            .success(function(data, status){
                                $scope.historicalMarks[markId].mark_count--;
                            });
                }

                self.cancel = function ($event) {
                    $mdDialog.cancel();
                };
                self.confirm = function ($event) {
                    $mdDialog.hide();
                };
                self.finished = function ($event) {
                    $mdDialog.cancel();
                };

            }

            function FillSeatController($timeout, $q, $scope, $mdDialog) {
                var self = this;
                // list of `state` value/display objects
                self.students = loadAll();
                self.querySearch = querySearch;
                // ******************************
                // Template methods
                // ******************************
                self.cancel = function ($event) {
                    $mdDialog.cancel();
                };
                self.finish = function ($event, selectedItem) {
                    $mdDialog.hide(selectedItem.id);
                };
                // ******************************
                // Internal methods
                // ******************************
                /**
                 * Search for states... use $timeout to simulate
                 * remote dataservice call.
                 */
                function querySearch(query) {
                    return query ? self.students.filter(createFilterFor(query)) : self.students;
                }

                /**
                 * Build `states` list of key/value pairs
                 */
                function loadAll() {


                    $http.get('/api/classrooms/{{$classroomId}}/unassigned')
                            .success(function (data, status) {
                                self.students = [];
                                data.map(function (student) {
                                    self.students.push({
                                        value: student.name.toLowerCase(),
                                        display: student.name,
                                        id: student.id
                                    });
                                });
                            });

                }

                /**
                 * Create filter function for a query string
                 */
                function createFilterFor(query) {
                    var lowercaseQuery = angular.lowercase(query);
                    return function filterFn(state) {
                        return (state.value.indexOf(lowercaseQuery) === 0);
                    };
                }


            }

            $scope.isOpen = false;
            $scope.demo = {
                isOpen: false,
                count: 0,
                selectedDirection: 'left'
            };

            function getStudentsWithoutASeat() {
                $http.get('{{route('unassignedStudents', ['classroomId' => $classroomId])}}')
                        .success(function (res) {
                            $scope.unassignedStudents = res;
                        })
                        .error(function (e) {
                        })
            }

            function getAddStudentToSeat(tableName, seatIndex, studentId) {
                var key = 0;
                for (var key in $scope.chart) {
                    if ($scope.chart.hasOwnProperty(key)) {
                        table = $scope.chart[key];
                        if (table.name == tableName) {
                            var i = 0;
                            for (var prop in table.seats) {
                                if (table.seats.hasOwnProperty(prop)) {
                                    console.log(prop);
                                    if (seatIndex === i) {
                                        $scope.chart[key].seats[prop] = studentId;
                                        return prop;
                                    }
                                    i++;
                                }

                            }
                        }
                    }
                    key++;
                }
            }

            function getRemoveStudentToSeat(tableName, seatId, studentId) {
                var key = 0;
                for (var key in $scope.chart) {
                    if ($scope.chart.hasOwnProperty(key)) {
                        table = $scope.chart[key];
                        if (table.name == tableName) {
                            var i = 0;
                            for (var prop in table.seats) {
                                if(prop === seatId){
                                    $scope.chart[key].seats[prop] = null;
                                    return;
                                }
                            }
                        }
                    }
                    key++;
                }
            }

            function getSeatId(tableName, seatIndex) {
                for (var key in $scope.chart) {
                    if ($scope.chart.hasOwnProperty(key)) {
                        table = $scope.chart[key];
                        if (table.name == tableName) {
                            var i = 0;
                            for (var prop in table.seats) {
                                if (table.seats.hasOwnProperty(prop)) {
                                    if (seatIndex === i) {
                                        return prop;
                                    }
                                    i++;
                                }

                            }
                        }
                    }
                    key++;
                }
            }

            $scope.students = <?php echo  json_encode($students); ?>;


            $scope.getStudentByObject = function (id) {

                return $scope.students[id];
            }

        }


    </script>
@endsection