@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
	@parent :: {{{ $title }}}
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

	<!-- Form -->
	{{ Former::horizontal_open()
		->id('create')
		->rules($rules)
		->method('POST')
		->action('user') }}

	{{ Former::token() }}

		@include('user.form')

	{{ Former::close() }}
	<!-- ./ form -->
@stop

{{-- Scripts --}}
@section('scripts')

@stop

