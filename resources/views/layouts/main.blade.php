<!DOCTYPE html>
<html>
	@include('includes.head')
	<body>
		@include('includes.header-footer')
		@yield('content')
		<script>
			const minPrice = {{$min_price}};
			const maxPrice = {{$max_price}};
			const sourcesView1 = <?php echo json_encode($sources1, JSON_PRETTY_PRINT)?>,
			sourcesView2 = <?php echo json_encode($sources2, JSON_PRETTY_PRINT)?>;
		</script>
		@include('includes.scripts')
	</body>
</html>
