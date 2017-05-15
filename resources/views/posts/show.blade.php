@extends('layouts.admin')

@section('title | View post')

@section('content')
	<div class="row">
		<div id="post_wrapper" class="wrapper col-xs-12 col-md-8 col-lg-8">
			<div class="post_entry">

				<h1 class='post_title'>{{ $post->title }}</h1>
				<div class='post_header'>
					<div class='post_info_page'>
						<div class='author_info'>
								<img class='avatar_pic' src='\{{ $post->user->profile_picture }}' alt='{{ $post->user->first_name }} {{ $post->user->last_name }}' title='{{ $post->user->first_name }} {{ $post->user->last_name }}' height='32' width='32'>
								Author: 
								<a class='author_name' rel='author' title='author profile' href='#''>{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
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
						<img alt="Smooth Sweet Tea with Cookies" src="\{{ $post->image->directory }}" title="Smooth Sweet Tea with Cookies"  height="400" width="640">
					</div>
					<p>
						{{ $post->post_content }}
					</p>
				</div>
			</div>
		</div>
		<div class="well col-xs-12 col-md-4">
			<ul class="list-unstyled list-inline">
				<li>Url:</li>
				<li><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></li>
			</ul>
			<ul class="list-unstyled list-inline">
				<li>Created at:</li>
				<li>{{ date('d/m/y', strtotime($post->created_at)) }}</li>
			</ul>
			<ul class="list-unstyled list-inline">
				<li>Last updated:</li>
				<li>{{ date('d/m/y', strtotime($post->updated_at)) }}</li>
			</ul>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
				</div>
				<div class="col-sm-6">
					{!! Form::open(array('route'=> array('posts.destroy', $post->id), 'method'=>'delete')) !!}

					{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-block')) !!}

					{!! Form::close() !!}
				</div>
			
				<div class="col-sm-12">
					{!! Html::linkRoute('posts.index', '<< See all posts', array(), array('class' => 'btn btn-default btn-block btn-h2-spacing')) !!}
				</div>
			</div>
		</div>
	</div>
@endsection