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
			{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
		</div>
		<div class="col-sm-6">
			{!! Html::linkRoute('posts.destroy', 'Delete', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
		</div>
	</div>
</div>