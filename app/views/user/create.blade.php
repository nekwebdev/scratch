@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Meta Information --}}
@section('keywords')User creation @stop
@section('author')Author @stop
@section('description')User creation page @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>Create your profile</h3>
	</div>

	<!-- Tabs -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	</ul>
	<!-- ./ tabs -->

	{{-- Create User Form --}}
	{{ Form::open(array('action' => 'UserController@postIndex', 'class' => 'form-horizontal', 'id' => 'create')) }}

		@include('user.form')

	{{ Form::close() }}

@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('form#create').submit(function()
			{
				$.ajax({
					url: "{{ URL::action('UserController@postIndex') }}",
					type: "post",
					data: $('form#create').serialize(),
					datatype: "json",
					beforeSend: function()
					{
						$('#ajax-loading').show();
						$(".validation-error-inline").hide();
					}
					})
					.done(function(data)
					{
						if (data.validation_failed == 1)
						{
							var arr = data.errors;
							$.each(arr, function(index, value)
							{
								if (value.length != 0)
								{
									$("#" + index).after('<span class="text-error validation-error-inline">' + value + '</span>');
								}
							});
							$('#ajax-loading').hide();
						}
					})
					.fail(function(jqXHR, ajaxOptions, thrownError)
					{
						  alert('No response from server');
					});
					return false;
			});
		});
	</script>
@stop

