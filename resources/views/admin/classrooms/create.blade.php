@extends('layouts.master')

@section('content')
    {!! Form::open(array('action' => 'Classrooms@store','method'=>'POST')) !!}
    <?php echo Form::token(); ?>
    {!! Form::label('teachername', 'Teacher Name', array('class' => 'control-label')) !!}
    {!! Form::text('teachername','',['class' => 'control-input']) !!}
    {!! Form::label('grade','Grade', array('class' => 'control-label')) !!}
    {!! Form::select('grade',$grades) !!}
    {!! Form::submit("Save") !!}
    {!! Form::close() !!}
    @endsection


@section('styles')
    <link rel="stylesheet" href="asfd">
    @endsection


@section("scripts")
    @endsection