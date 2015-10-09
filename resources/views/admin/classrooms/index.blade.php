@extends('layouts.master')

@section('content')

        <table id="classrooms">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                <th>Grade</th>
                <th>Created</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Acy</td>
                </tr>
            </tbody>
        </table>
    @endsection


@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">
    @endsection


@section("scripts")
    <script>
        var table = $('#classrooms').DataTable( {
            ajax: {
                "url": "/api/classrooms",

            },
            "columns": [
                { "data": "id" },
                { "data": "teachername" },
                { "data": "grade" },
                { "data": "created_at" },
            ],
            "columnDefs": [
                {"targets": [ 0 ],
                    "visible": false,
                    "searchable": false,
                    "searchable": false,
                },{
                    "targets": [4],

                    "defaultContent": "<button>Click!</button>",
                }
            ]
        });

        $('#classrooms tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            console.log(data);
            alert( data.teachername +"'s salary is: "+ data.id );
        } );
    </script>
    @endsection