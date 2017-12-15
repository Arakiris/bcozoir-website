<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
			page. However, you can choose any other skin. Make sure you
			apply the skin class to the body tag so the changes take effect.
		-->
		<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/skin-blue.min.css') }}">
		<!-- Dropzone -->
		<link rel="stylesheet" href="{{ asset('css/basic.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

		@yield('styles')

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
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

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
		Both of these plugins are recommended to enhance the
		user experience. Slimscroll is required when using the
		fixed layout. -->
	<script>
		$(function () {
			$('.sortingTable').DataTable({
				"language": {
					url : '{{ asset('bower_components/AdminLTE/plugins/datatables/i18n/French.json') }}'
				}
			});
			$('.sortingTable2').DataTable({
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
			CKEDITOR.replace('editor', {
                language: 'fr',
                customConfig: "{{ asset('bower_components/AdminLTE/plugins/ckeditor/config.js') }}"
            });
		});
	</script>
	@yield('scripts')
	</body>
</html>
