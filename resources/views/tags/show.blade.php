@extends('layouts.admin')

@section('title', "| $tag->name Tag")

@section('content')
<div class="row">
	<div class="col-md-8">
		<h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>
	</div>
	<div class="col-md-2">
		<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary pull-right btn-block">Edit</a>
	</div>
	<div class="col-md-2">
		{{ Form::open(array('route' => array('tags.destroy', $tag->id), 'method'=>'delete')) }}

			{{ Form::submit('Delete', array('class'=>'btn btn-danger btn-block')) }}

		{{ Form::close() }}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Tags</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tag->posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>{{ $post->title }}</td>
						<td>
							@foreach ($post->tags as $tag)
								<div class='tags'>
						 			<a class='tag_block' href='#' rel='tag'>{{ $tag->name }}</a>
								</div>
							@endforeach
							<td>
								<a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a>
							</td>
						</td>
					</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
</div>

@endsection