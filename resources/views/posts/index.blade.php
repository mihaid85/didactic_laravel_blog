@extends('layouts.admin')

@section('title', '| Index')

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h2>All Posts</h2>
		</div>
		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h2-spacing">Create new post</a>
		</div>
		<hr>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created at</th>
					<th>Updated at</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($posts as $post)
						<tr>
							<td>{{ $post->id }}</td>
							<td>{{ $post->title }}</td>
							<td>{{ substr(strip_tags($post->post_content), 0, 100) }}{{ strlen(strip_tags($post->post_content)) > 50 ? "..." : "" }}</td>
							<td>{{ date('d/m/y', strtotime($post->created_at)) }}</td>
							<td>{{ date('d/m/y', strtotime($post->updated_at)) }}</td>
							<td>
								{!! Html::linkRoute('posts.show', 'View', array($post->id), array('class' => 'btn btn-default')) !!}
								{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-default')) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="text-left ">
		{{ $posts->links() }}
	</div>


@endsection