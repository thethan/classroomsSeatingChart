@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => array('SeatsController@update', $id),'method'=>'PUT', 'class' => 'form-horizontal')) !!}
        @include('admin.seats._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    @endsection


@section("scripts")
    @endsection