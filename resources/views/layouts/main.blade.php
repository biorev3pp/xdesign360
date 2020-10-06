<!DOCTYPE html>
<html>
	@include('includes.head')
	<body>
		@include('includes.header-footer')
		@yield('content')
		@include('includes.scripts')
		@stack('scripts')	
	</body>
</html>
