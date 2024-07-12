<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Task App</title>
	
	<!-- Global stylesheets -->
	<link href="{{ asset('assets/base/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/base/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/layout_1/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/style.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('assets/base/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('assets/base/js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/base/js/vendor/notifications/noty.min.js') }}"></script>
	<script src="{{ asset('assets/layout_1/js/app.js') }}"></script>
	<script src="{{ asset('assets/main.js') }}"></script>
	<!-- /theme JS files -->
    @stack('js_pre_content')
</head>