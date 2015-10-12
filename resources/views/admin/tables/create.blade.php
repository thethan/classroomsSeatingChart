@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => 'TablesController@store','method'=>'POST', 'class' => 'form-horizontal')) !!}
        @include('admin.tables._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    @endsection


@section("scripts")
    @endsection