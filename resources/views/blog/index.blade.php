@extends('layouts.main')

@section('title', '| Homepage')

@section('content')
<div id="post_wrapper" class="wrapper col-xs-12 col-md-8 col-lg-8">
@foreach ($posts as $post)
	<div class="media">
		<div class="media-left">
			<img class="media-object" src="\{{ $post->image->directory }}" alt="Smooth Sweet Tea with Cookies">
		</div>
		<div class="media-body">
			<h2 class="media-heading">
				<a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a>
			</h2>
			<div class="post_info">
				<span class="fn">
					<i class="fa fa-user"></i> 
					<a class="profile" href="#">
						<span>{{ $post->user->first_name }} {{ $post->user->last_name }}</span>
					</a>
				</span>
				<span class="time_stamp">
					<i class="fa fa-calendar-o"></i> 
					<a class="time_stamp_link" href="#">
					<abbr class="published updated" title="2016-05-26T20:08:00+07:00">{{ date('d/m/y', strtotime($post->created_at)) }}</abbr>
					</a>
				</span>
				<span class="comment_info">
					<i class="fa fa-comments-o"></i> 
					$commentNr = "SELECT COUNT(comments.post_id) AS nr FROM comments LEFT JOIN posts ON comments.post_id = posts.post_id WHERE comments.post_id =" .$row['post_id'];
					$result2 = mysqli_query ($conn,$commentNr);
					
					while ($row2 = mysqli_fetch_assoc ($result2)) {
						<a href="#" title="Comments Count">'. $row2['nr'] .'</a>
					}
				</span>
			</div>
			<div class="post_content">{{ substr($post->post_content, 0, 100) }}{{ strlen($post->post_content) > 50 ? "..." : "" }}</div>
		</div>
	</div>
@endforeach
<div class="text-left ">
	{{ $posts->links() }}
</div>
</div>


@include('partials.sidebar')

@endsection