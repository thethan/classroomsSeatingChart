@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => array('TablesController@update', $id),'method'=>'PUT', 'class' => 'form-horizontal')) !!}
        @include('admin.tables._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    @endsection


@section("scripts")
    @endsection