@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
	@parent :: Home Page
@stop

{{-- Meta Information --}}
@section('keywords')home page @stop
@section('author')Author @stop
@section('description')Home page @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>Welcome to the home page.</h3>
	</div>
@stop

{{-- Scripts --}}
@section('scripts')

@stop