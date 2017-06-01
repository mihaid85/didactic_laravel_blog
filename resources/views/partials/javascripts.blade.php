<script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/modal.js"></script>
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
	$('.select2-multi').select2();
	$('.select2-multi').select2().val({{ json_encode($post->tags()->allRelatedIds()) }} ).trigger('change');
</script>
