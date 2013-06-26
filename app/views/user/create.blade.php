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
	{{-- Form::open(array('action' => 'UserController@postIndex', 'class' => 'form-horizontal', 'id' => 'create')) --}}

	{{ Former::horizontal_open()
		->id('create')
		->secure()
		->rules($rules)
		->method('POST')
		->action('user') }}

		@include('user.form')

	{{ Former::close() }}

@stop

{{-- Scripts --}}
@section('scripts')

@stop

