@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{url('/admin/marks/create') }}" class="btn btn-primary pull-right">Create Mark</a>
        </div>
    </div>
    <table id="marks">
        <thead>
        <tr>
            <th>Id</th>
            <th>Mark</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        </tr>
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">

                    <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
                    {!! Form::open(array('class' => 'form-inline', 'id' => 'deleteMark', 'method' => 'DELETE', 'route' => array('admin.marks.destroy'))) !!}

                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}+

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">
@endsection


@section("scripts")
    <script>
        var table = $('#marks').DataTable({
            ajax: {
                "url": "/api/marks",

            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "created_at"},

            ],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false,
                    "searchable": false,
                },
                {
                    "targets": [3],

                    "defaultContent":
                    "<button type='button' class='btn btn-primary col-xs-4 edit' >Edit</button>"+
                    "<button type='button' class='btn btn-danger col-sm-offset-2 delete'  data-whatever='Title'>Delete</button>",
                }
            ]
        });

        $('#marks tbody').on('click', 'button.edit', function () {
            var data = table.row($(this).parents('tr')).data();
            console.log(data);
            window.location.href = '/admin/marks/' + data.id + '/edit';
        });


        $('#marks tbody').on('click', '.delete', function () {
            var data = table.row($(this).parents('tr')).data();
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $('#deleteModal');
            console.log(data);
            modal.find('.modal-title').text('Do you want to delete mark: ' + data.name +'?')
            modal.find('#deleteMark').attr('action', '/admin/marks/'+data.id)
            $('#deleteModal').modal('show');
        })

    </script>
@endsection