@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => 'Classrooms@store','method'=>'POST', 'class' => 'form-horizontal')) !!}
        @include('admin.classrooms._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    <link rel="stylesheet" href="asfd">
    @endsection


@section("scripts")
    @endsection