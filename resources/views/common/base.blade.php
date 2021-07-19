<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{--https://stackoverflow.com/questions/18251128/why-am-i-suddenly-getting-a-blocked-loading-mixed-active-content-issue-in-fire--}}
    {{--<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">--}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Hossam Magdy Balaha"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/compiled/layout.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>
<div id="loader"><i class="fa fa-spin fa-spinner fa-4x d-none"></i></div>
<div id="loaded" class="pb-2">
    <div id="bg"></div>
    @include('common.success')
    @include('common.errors')
    @yield('body')
</div>

<script type="text/javascript" src="{{asset('assets/compiled/app.js')}}"></script>

<script>
    jQuery(document).ready(function () {
        @if(Session::has('ref-modal'))
        jQuery("#{{Session::get('ref-modal')}}").modal('show');
        @endif
    });
</script>
@yield('scripts')
</body>
</html>
