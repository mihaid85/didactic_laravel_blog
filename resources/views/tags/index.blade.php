@extends('layouts.admin')

@section('title | All Tags')

@section('content')
	
	<div class="row">
		<div class="col-md-8">
			<h2>Tags</h2>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tags as $tag)
						<tr>
							<td>{{ $tag->id }}</td>
							<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
							<td>{{ $tag->posts()->count() }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<div class="well">
				{{ Form::open(array('route' => 'tags.store', 'method' => 'POST')) }}
					<h2>New Tag</h2>
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, array('class' => 'form-control')) }}

					{{ Form::submit('Create New Tag', array('class' => 'btn btn-primary btn-block btn-h2-spacing')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection