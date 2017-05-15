@extends('layouts.admin')

@section('title', "| Edit Tag")

@section('content')
	
	{{ Form::model($tag, array('route' => array('tags.update', $tag->id), 'method' => 'PUT')) }}

		{{ Form::label('name', 'Title:') }}
		{{ Form::text('name', null, array('class' => 'form-control')) }}
		
		{{ Form::submit('Save changes', array('class' => 'btn btn-success form-spacing')) }}

	{{ Form::close() }}
@endsection