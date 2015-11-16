@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => array('StudentsController@store', $classroomId),'method'=>'POST', 'class' => 'form-horizontal')) !!}
        @include('admin.students._form')
    {!! Form::close() !!}
    @endsection


@section('styles')
    <link rel="stylesheet" href="asfd">
    @endsection


@section("scripts")
    @endsection