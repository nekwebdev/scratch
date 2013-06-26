@include('layouts.head')

<body>
	<!-- Container -->
	<div class="container">

		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
		</div>
		<!-- ./ navbar -->

		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
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