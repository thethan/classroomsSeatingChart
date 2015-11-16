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

                        <form class="form-horizonral" action="{{ url('/auth/login') }}" role="form" method="POST">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Email">Email Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Password">Password</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"/> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <a href={{ url('password/email') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection