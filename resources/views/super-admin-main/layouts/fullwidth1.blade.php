@php
    $controller = DzHelper::controller();
    $page = $action = DzHelper::action();
    $action = $controller.'_'.$action;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Title -->
    <title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title>

	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@yield('page_description', $page_description ?? '')">
	<meta property="og:title" content="W3crm:Customer Relationship Management Admin Bootstrap 5 & Laravel Template">
	<meta property="og:description" content="{{ config('dz.name') }} | @yield('title', $page_title ?? '')">
	<meta property="og:image" content="https://w3crm.dexignzone.com/laravel/social-image.png">
	<meta name="format-detection" content="telephone=no">
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons Icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/images/favicon.png')}}">

    <link href="{{ asset('public/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container ">
			<div class="row justify-content-center h-100 align-items-center">
                @yield('content')
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    @if(!empty(config('dz.public.global.js.top')))
    @foreach(config('dz.public.global.js.top') as $script)
        <script src="{{ asset('public/'.$script) }}" type="text/javascript"></script>
    @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
    @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
        <script src="{{ asset('public/'.$script) }}" type="text/javascript"></script>
    @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
    @foreach(config('dz.public.global.js.bottom') as $script)
        <script src="{{ asset('public/'.$script) }}" type="text/javascript"></script>
    @endforeach
    @endif

    @stack('scripts')
</body>
</html>
