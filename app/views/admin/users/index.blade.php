@extends('admin.users.template')

{{-- Extra CSS styles --}}
@section('syles')
	<style type="text/css"></style>
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/users/create') }}}" class="btn-create iframe"><i class="icon-plus-sign icon-white"></i> Create</a>
			</div>
		</h3>
	</div>

	<table id="users" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="span2">{{{ Lang::get('admin/users/table.username') }}}</th>
				<th class="span3">{{{ Lang::get('admin/users/table.email') }}}</th>
				<th class="span3">{{{ Lang::get('admin/users/table.roles') }}}</th>
				<th class="span2">{{{ Lang::get('admin/users/table.activated') }}}</th>
				<th class="span2">{{{ Lang::get('admin/users/table.created_at') }}}</th>
				<th class="span2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	@include('admin.layouts.modals.delete')

@stop

{{-- Extra JavaScripts --}}
@section('scripts')
	<script type="text/javascript"></script>
@stop