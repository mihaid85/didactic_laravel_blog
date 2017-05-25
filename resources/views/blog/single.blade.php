@extends('layouts.main')

@section('title', "| $post->title")

@section('content')
	<div class="row">
		<div id="post_wrapper" class="wrapper col-xs-12 col-md-8 col-lg-8">
			<div class="post_entry">
				<h1 class='post_title'>{{ $post->title }}</h1>
				<div class='post_header'>
					<div class='post_info_page'>
						<div class='author_info'>
								<img class='avatar_pic' src='\{{ $post->user->profile_picture }}' alt='{{ $post->user->first_name }} {{ $post->user->last_name }}' title='author name' height='32' width='32'>
								Author: 
								<a class='author_name' rel='author' title='author profile' href='#'>{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
						</div>
						<div class="post_time_stamp">
							Published on:
							<a class="time_stamp_link" href="#">
								<abbr class="published updated" title="2016-05-26T20:08:00+07:00">{{ date('d/m/y', strtotime($post->created_at)) }}</abbr>
							</a>
						</div>
					</div>
					<div class='tags_wrapper'>
						<span class='tag_info'>
							<i class='fa fa-hashtag' aria-hidden='true'></i>
							tags
						</span>
						@foreach ($post->tags as $tag)
							<div class='tags'>
					 			<a class='tag_block' href='#' rel='tag'>{{ $tag->name }}</a>
							</div>
						@endforeach
					</div>	
				</div>
				<div class='post_content'>
					<div>
						<img alt="Smooth Sweet Tea with Cookies" src="\img\{{ $post->picture->directory }}" title="Smooth Sweet Tea with Cookies">
					</div>
					<div>
						{!! $post->post_content !!}
					</div>
				</div>
			</div>
			<div class='well comment-wrapper'>
				@if (Auth::check())
					<h4>Leave a comment:</h4>
					{{ Form::open(array('route' => array('comments.store', $post->id), 'method' => 'post')) }}
						{{ Form::textarea('content', null, array('class' => '	form-control')) }}
						{{ Form::hidden('user_id', Auth::user()->id) }}
						{{ Form::hidden('parent', '0') }}

						{{ Form::submit('Submit', array('class' => 'btn btn-primary form-spacing')) }}
					{{ Form::close() }}

				@endif

				<h3 class='comm_title'><span class='glyphicon glyphicon-comment'></span> {{ $post->comments()->count() }} Comments:</h3>

				@foreach ($post->comments as $comment)
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
								
								<div class="pull-right top">
									<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
									
									{{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
										{{ Form::button('<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger']) }}
									{{ Form::close() }}
								</div>
							</h4>
							<div class='comment_text'>
								{{ $comment->content }}
							</div>
						</div>
						
					</div>
				@endforeach
				

			</div>
		</div>	
	
	@include('partials.sidebar')
	</div>
@endsection