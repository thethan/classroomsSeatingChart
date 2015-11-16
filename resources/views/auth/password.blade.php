@extends('admin.layout')

@section('styles')
    <link rel="stylesheet" href="/admin/admin.css"/>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-body">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">

                        @include('admin.partials.errors')
                        <!-- resources/views/auth/register.blade.php -->


                        <form class="form-horizonral" action="{{ url('/password/email') }}" role="form" method="POST">

                            {!! csrf_field() !!}


                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Email">Email Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Send Reset Password Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection