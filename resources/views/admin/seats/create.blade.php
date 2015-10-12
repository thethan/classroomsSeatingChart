@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => 'SeatsController@store','method'=>'POST', 'class' => 'form-horizontal')) !!}
        @include('admin.seats._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    @endsection


@section("scripts")
    @endsection