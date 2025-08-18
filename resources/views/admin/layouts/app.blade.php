<!DOCTYPE html>
<html>
    @include('admin.layouts.head')
	@stack('css')
<body>
	

	@include('admin.layouts.header')
	@include('admin.layouts.right-sidebar')


	

	@include('admin.layouts.left-side-bar')
	{{-- @include('admin.layouts.loader') --}}


	<div class="main-container">
		<div class="pd-ltr-20">
			@yield('content')
		</div>
	</div>
	<!-- js -->
	
	@include('admin.layouts.model')
	@include('admin.layouts.script')
	@stack('js')
</body>
</html>