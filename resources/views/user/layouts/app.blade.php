<!DOCTYPE html>
<html>
    @include('user.layouts.head')
	@stack('css')
<body>
	

	@include('user.layouts.header')
	@include('user.layouts.right-sidebar')


	

	@include('user.layouts.left-side-bar')
	{{-- @include('user.layouts.loader') --}}


	<div class="main-container">
		<div class="pd-ltr-20">
			@yield('content')
		</div>
	</div>
	<!-- js -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pannellum@2.6.0/build/pannellum.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.6.0/build/pannellum.js"></script>

	@include('user.layouts.model')
	@include('user.layouts.script')

	@stack('js')
</body>
</html>