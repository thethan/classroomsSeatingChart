@extends('layouts.master')

@section('content')
    <div id="materials-table">
        <h3>Material Table</h3>
    </div>
    <section id="classroom">
        @foreach($chart as $table => $seats)
            <div class="table {{ $table }}">
                @foreach($seats as $seat)
                    @if(array_key_exists($seat, $students))
                        <div onclick="marks($seat)">
                            {{ $students[$seat] }}
                        </div>
                    @else
                        <div onclick="fillSeat()">

                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </section>
@endsection

@section('styles')
    <style>
        #classroom {
            width: 80%;
            float: left;
            display: block;
            margin: 0 0 0 6%;

        }
        #classroom .table {
            width: 40%;
            float: left;
            margin: 5% 2% 0 0;
            display: block;
            min-width: 400px;
            height: 200px;
        }

        #classroom .table div {
            width: 33%;
            height: 50%;
            border: 1px solid #000000;
            display: block;
            float: left;
        }
        #classroom .table div:nth-child(3n){
            width: 34%;
        }

        .green {
            background: green;
        }

        .blue {
            background: blue;
        }

        .red {
            background: red;
        }

        .yellow {
            background: yellow;
        }

        .orange {
            background: orange;
        }

        .purple {
            background: purple;
        }
        #materials-table {
            height: 60%;
            width: 10%;
            display: block;

            float:left;

        }
        #materials-table h3 {
            transform: rotate(90deg);
            transform-origin: left top 0;
            margin: 0 -3em 0 0;
        }
    </style>
@endsection


@section('modal')
    <div class="modal fade" id="marks">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('scripts')

@endsection