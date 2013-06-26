@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
	@parent :: {{{ $title }}}
@stop

{{-- Meta Information --}}
@section('keywords')User administration @stop
@section('author')Author @stop
@section('description')User administration page @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>Edit your profile</h3>
	</div>

	<!-- Tabs -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	</ul>
	<!-- ./ tabs -->

	{{-- Form::model($user, array('action' => array('UserController@postEdit', $user->id), 'class' => 'form-horizontal')) --}}

	{{ Former::horizontal_open()
		->id('edit')
		->rules($rules)
		->method('POST')
		->action('user/' . $user->id . '/edit') }}

	{{ Former::populate($user) }}

		@include('user.form')

	{{ Form::close() }}

@stop