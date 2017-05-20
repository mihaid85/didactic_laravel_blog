@extends('layouts.admin')

@section('title', '| Create new post')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wn7in04nlpiqw1f1rxyu71bh9d526fvry9r7akeoj6pum8r3"></script>
  	<script>
  		tinymce.init({ 
  			selector: 'textarea',
  			plugins: 'link code',
  			menubar: 'false'
  		});
  	</script>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Create new post</h1>

			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
				{!! csrf_field() !!}
	    		{{ Form::label('title', 'Title:') }}
	    		{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '200')) }}

	    		{{ Form::label('slug', 'Page URL:', array('class'=>'form-spacing')) }}
	    		{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '200')) }}

	    		{{ Form::label('tags', 'Tags:', array('class'=>'form-spacing')) }}
	    		<select class="form-control select2-multi" name="tags[]" multiple="multiple">
	    			@foreach ($tags as $tag)
	    				<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
	    			@endforeach
	    		</select>

	    		{{ Form::label('imageUpload', 'Upload Image:', array('class'=>'form-spacing')) }}
	    		{{ Form::file('imageUpload') }}

	    		{{ Form::label('post_content', 'Post body:', array('class'=>'form-spacing')) }}
	    		{{ Form::textarea('post_content', null, array('class' => 'form-control')) }}
	    		<br>
	    		{{ Form::hidden('user_id', Auth::user()->id) }}
	    		{{ Form::submit('Create post', array('class' => 'btn btn-success btn-lg btn-block')) }}
			{!! Form::close() !!}
		</div>
		<div class="col-md-2 imagePreview">
			<img id="preview" src="/img/noimage.png" />
		</div>
	</div>

@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
	<script type="text/javascript">

    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {

                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function(){

        readURL(this);

    });

	</script>
@endsection