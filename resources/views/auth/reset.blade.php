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


                        <form class="form-horizonral" action="{{ url('/password/reset') }}" role="form" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Email">Email Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Password">Password</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="password_confirmation">Confirm Password</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection