<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('layouts.header')
<body>
  @include('layouts.navbar')
	<!-- Page content -->
	<div class="page-content">
  @include('layouts.sidebar')
  @yield('content')
	</div>
	<!-- /page content -->
  @stack('js_post_content')
</body>
</html>