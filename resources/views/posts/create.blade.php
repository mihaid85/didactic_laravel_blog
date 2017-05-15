@extends('layouts.admin')

@section('title', '| Create new post')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create new post</h1>

			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '']) !!}
				{!! csrf_field() !!}
	    		{{ Form::label('title', 'Title:') }}
	    		{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '200')) }}

	    		{{ Form::label('slug', 'Page URL:', array('class'=>'form-spacing')) }}
	    		{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '200')) }}

	    		{{ Form::label('tags', 'Tags:') }}
	    		<select class="form-control select2-multi" name="tags[]" multiple="multiple">
	    			@foreach ($tags as $tag)
	    				<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
	    			@endforeach
	    		</select>

	    		{{ Form::label('post_content', 'Post body:', array('class'=>'form-spacing')) }}
	    		{{ Form::textarea('post_content', null, array('class' => 'form-control', 'required' => '')) }}
	    		<br>
	    		{{ Form::hidden('user_id', Auth::user()->id) }}
	    		{{ Form::submit('Create post', array('class' => 'btn btn-success btn-lg btn-block')) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
@endsection