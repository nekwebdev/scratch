@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
	@parent
@stop

{{-- Meta Information --}}
@section('keywords')User creation @stop
@section('author')Author @stop
@section('description')User creation page @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>Login</h3>
	</div>

	{{-- Create User Form --}}
	{{-- Form::open(array('action' => 'UserController@postIndex', 'class' => 'form-horizontal', 'id' => 'create')) --}}

	{{ Former::horizontal_open()
		->id('login')
		->method('POST')
		->action('user/login') }}

	{{ Former::token() }}

		<!-- username -->
		{{ Former::text('username')->label('Username or Email')->prependIcon('user') }}
		<!-- ./ username -->

		<!-- Password -->
		{{ Former::password('password')->prependIcon('lock') }}
		<!-- ./ password -->

		<!-- Form Actions -->
		{{ Former::actions()
		    ->primary_submit('Submit')
		    ->inverse_reset('Reset') }}
		<!-- ./ form actions -->

	{{ Former::close() }}
@stop
{{-- Scripts --}}
@section('scripts')

@stop