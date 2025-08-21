<!DOCTYPE html>
<html>
    @include('agent.layouts.head')
	@stack('css')
<body>
	

	@include('agent.layouts.header')
	@include('agent.layouts.right-sidebar')


	

	@include('agent.layouts.left-side-bar')
	{{-- @include('agent.layouts.loader') --}}


	<div class="main-container">
		<div class="pd-ltr-20">
			@yield('content')
		</div>
	</div>
	<!-- js -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pannellum@2.6.0/build/pannellum.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.6.0/build/pannellum.js"></script>

	@include('agent.layouts.model')
	@include('agent.layouts.script')

	@stack('js')
</body>
</html>