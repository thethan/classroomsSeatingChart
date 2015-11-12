@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => 'MarksController@store','method'=>'POST', 'class' => 'form-horizontal')) !!}
        @include('admin.marks._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    @endsection


@section("scripts")
    @endsection