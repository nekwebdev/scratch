@include('layouts.head')

<body>

	<!-- Navbar -->
	@include('layouts.nav')
	<!-- ./ navbar -->

  <!-- Container -->
  <div class="container">

		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		@include('layouts.footer')
		<!-- ./ Footer -->

	</div>
	<!-- ./ container -->

  <!-- Javascripts -->
  {{ Basset::show('public.js') }}

  <script type="text/javascript">

  </script>

  @yield('scripts')
  <!-- ./ javascripts -->

</body>

</html>