<!-- Tabs Content -->
<div class="tab-content">

	<!-- General tab -->
	<div class="tab-pane active" id="tab-general">

		<!-- username -->
		<div class="control-group">
			{{ Form::label('username', 'Username', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('username') }}
			</div>
		</div>
		<!-- ./ username -->

		<!-- Email -->
		<div class="control-group">
			{{ Form::label('email', 'Email', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('email') }}
			</div>
		</div>
		<!-- ./ email -->

		<!-- Password -->
		<div class="control-group">
			{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::password('password') }}
			</div>
		</div>
		<!-- ./ password -->

		<!-- Password Confirm -->
		<div class="control-group">
			{{ Form::label('password_confirmation', 'Password Confirm', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::password('password_confirmation') }}
			</div>
		</div>
		<!-- ./ password confirm -->

	</div>
	<!-- ./ general tab -->

</div>
<!-- ./ tabs content -->

<!-- Form Actions -->
<div class="control-group">
	<div class="controls">
		{{ Form::submit('Create New Account', array('class' => 'btn btn-success')) }}
	</div>
</div>
<!-- ./ form actions -->