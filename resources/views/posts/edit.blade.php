@extends('layouts.admin')

@section('title | Edit post')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wn7in04nlpiqw1f1rxyu71bh9d526fvry9r7akeoj6pum8r3"></script>
  	<script>
  		tinymce.init({ 
  			selector: 'textarea',
  			plugins: 'link code lists',
  			menubar: 'false'
  		});
  	</script>
@endsection

@section('content')
	<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method'=> 'PUT', 'data-parsley-validate' => '', 'files' => true]) !!}
			{{ csrf_field() }}
			<div class="col-xs-12 col-md-8 col-lg-8">
				<div class="post_entry">
					{{ Form::label('title', 'Title:') }}
					{{ Form::text('title', null, array('class'=>'form-control input-lg', 'required' => '', 'maxlength' => '200')) }}

					{{ Form::label('slug', 'Page URL:', array('class'=>'form-spacing')) }}
	    			{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '200')) }}

	    			{{ Form::label('tags', 'Tags:', array('class'=>'form-spacing')) }}
	    			{{ Form::select('tags[]', $tags, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple')) }}
		    		
		    		{{ Form::label('imageUpload', 'Upload Image:', array('class'=>'form-spacing')) }}
	    			{{ Form::file('imageUpload') }}

					{{ Form::label('post_content', 'Content:', array('class'=>'form-spacing')) }}
					{{ Form::textarea('post_content', null, array('class'=>'form-control full')) }}
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="well">
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
							{!! Form::submit('Save Changes', array('class' => 'btn btn-success btn-block')) !!}
						</div>
						<div class="col-sm-6">
							{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
						</div>
					</div>
				</div>
				<div class="col-md-2 imagePreview">
					<img id="preview" src="/img/noimage.png" />
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({{ json_encode($post->tags()->allRelatedIds()) }} ).trigger('change');
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