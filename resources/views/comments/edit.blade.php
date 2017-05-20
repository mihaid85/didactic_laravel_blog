@extends('layouts.main')

@section('title', "| Edit Comment")

@section('content')
	<div class="row">
		<div id="post_wrapper" class="wrapper col-xs-12 col-md-8 col-lg-8">
			<div class='well comment-wrapper'>
				@if (Auth::check())

					<h4>Edit comment:</h4>


					<div class='media'>
						<div>
							<a class='pull-left' href='#'>
								<img class='media-object comment_pic' src='\{{ $comment->user->profile_picture }}' alt='{{ $comment->user->first_name }} {{ $comment->user->last_name }}'>
							</a>
						</div>
						<div class='media-body'>
							<h4 class='media-heading'>
								<span class='commenter'>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</span>
								<small class='time'>
									<span class='glyphicon glyphicon-time'></span>
									<abbr class='published updated'>{{ $comment->created_at }}</abbr>
								</small>
								
							</h4>
						</div>
							<div class='comment_text'>
								{{ Form::model($comment, array('route' => array('comments.update', $comment->id), 'method' => 'put')) }}
									{{ Form::textarea('content', null, array('class' => 'form-control')) }}

									{{ Form::submit('Update', array('class' => 'btn btn-success form-spacing')) }}
								{{ Form::close() }}
							</div>
						</div>
						
					



					
					
				@endif
			</div>
		</div>	
	
	@include('partials.sidebar')
	</div>
@endsection