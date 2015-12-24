@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{url('/admin/classrooms/create') }}" class="btn btn-primary pull-right">Create Classroom</a>
    </div>
</div>
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
    var table = $('#classrooms').DataTable({
        ajax: {
            "url": "/api/classrooms",

        },
        "columns": [
            {"data": "id"},
            {"data": "teachername"},
            {"data": "grade"},
            {"data": "created_at"},

        ],
        "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false,
                "searchable": false,
            }, {
                "targets": [4],

                "defaultContent":
                "<button type='button' class='btn btn-primary edit' >Reports</button>"
            }
        ]
    });

    $('#classrooms tbody').on('click', 'button.edit', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
        window.location.href = '/admin/reports/' + data.id ;
    });

    $('#classrooms tbody').on('click', 'button.success', function () {
        var data = table.row($(this).parents('tr')).data();
        window.location.href = '/admin/assign/' + data.id ;
    });

    $('#classrooms tbody').on('click', 'button.students', function () {
        var data = table.row($(this).parents('tr')).data();
        window.location.href = '/admin/classrooms/' + data.id +'/students';
    });

    $('#classrooms tbody').on('click', 'button.marks', function () {
        var data = table.row($(this).parents('tr')).data();
        window.location.href = '/admin/classrooms/' + data.id +'/marks';
    });

    $('#classrooms tbody').on('click', '.delete', function () {
        var data = table.row($(this).parents('tr')).data();
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $('#deleteModal');
        console.log(data);
        modal.find('.modal-title').text('Do you want to delete classroom: ' + data.teachername +' '+ data.grade+ '?')
        modal.find('#deleteClassroom').attr('action', '/admin/classrooms/'+data.id)
        $('#deleteModal').modal('show');
    })

</script>
@endsection