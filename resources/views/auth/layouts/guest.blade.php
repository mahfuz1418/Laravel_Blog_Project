<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('backend') }}/assets/vendors/core/core.css">
	<!-- endinject -->
  <!-- plugin css for this page -->
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('backend') }}/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	{{-- <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/demo_1/style.css"> --}}
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.png" />
  @vite(['public/backend/assets/css/demo_1/style.css', 'public/backend/assets/vendors/core/core.js'])
</head>
<body>
@yield('content')

	<!-- core:js -->
	{{-- <script src="{{ asset('backend') }}/assets/vendors/core/core.js"></script> --}}
	<!-- endinject -->
  <!-- plugin js for this page -->
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{ asset('backend') }}/assets/vendors/feather-icons/feather.min.js"></script>
	<script src="{{ asset('backend') }}/assets/js/template.js"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
	<!-- end custom js for this page -->
</body>
</html>
