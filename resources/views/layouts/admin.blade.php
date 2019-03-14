<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>BC Ozoir Administration</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noodp">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/libs/font-awesome/css/font-awesome.min.css') }}">
		<!-- Ionicons -->
		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/libs/ionicons/css/ionicons.min.css') }}">
		<!-- DataTables -->
  		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">
		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/skin-blue.min.css') }}">
		<!-- Dropzone -->
		<link rel="stylesheet" href="{{ asset('css/basic.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

		@yield('styles')
	</head>

	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">

			@include('layouts.partials.admin._header')

			@include('layouts.partials.admin._sidebar')


			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				@yield('content')
			</div>
			<!-- /.content-wrapper -->

			@include('layouts.partials.admin._footer')

		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->


	<!-- jQuery 2.2.3 -->
	{{--  <script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>  --}}
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/dropzone.js') }}"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- DataTables -->
	<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('bower_components/AdminLTE/dist/js/app.js') }}"></script>
	<!-- Dropzone App -->
	<script src="{{ asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('js/admin.js') }}"></script>

	<script>
		$(function () {
			$('.sortingTable').DataTable({
				"pageLength": 100,
				"language": {
					url : '{{ asset('bower_components/AdminLTE/plugins/datatables/i18n/French.json') }}'
				}
			});
			$('.sortingTable2').DataTable({
				"pageLength": 100,
				"language": {
					url : '{{ asset('bower_components/AdminLTE/plugins/datatables/i18n/French.json') }}'
				},
				"paging": false,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": false,
				"autoWidth": false
			});
			$('.sortingTableAddPlayers').DataTable({
				"pageLength": -1,
				"language": {
					url : '{{ asset('bower_components/AdminLTE/plugins/datatables/i18n/French.json') }}'
				},
				"paging": false,
				"lengthChange": false,
				"searching": false
			});
		});
		$(function () {
			CKEDITOR.replace('editor', {
                language: 'fr',
                customConfig: "{{ asset('bower_components/AdminLTE/plugins/ckeditor/config.js') }}"
			});
		});
	</script>
	@yield('scripts')
	</body>
</html>
