<!-- Tabs Content -->
<div class="tab-content">

	<!-- General tab -->
	<div class="tab-pane active" id="tab-general">

		<!-- username -->
		{{ Former::text('username') }}
		<!-- ./ username -->

		<!-- Email -->
		{{ Former::text('email') }}
		<!-- ./ email -->

		<!-- Password -->
		{{ Former::password('password') }}
		<!-- ./ password -->

		<!-- Password Confirm -->
		{{ Former::password('password_confirmation') }}
		<!-- ./ password confirm -->

	</div>
	<!-- ./ general tab -->

</div>
<!-- ./ tabs content -->

<!-- Form Actions -->
{{ Former::actions()
    ->large_primary_submit('Submit')
    ->large_inverse_reset('Reset') }}
<!-- ./ form actions -->