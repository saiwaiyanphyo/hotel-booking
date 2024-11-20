<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>

    @vite(['resources/scss/layouts/loader.scss'])

    @vite(['resources/layouts/loader.js'])

    <link href="https://fonts.googleapis.com/css?family=Inter:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    @vite(['resources/scss/assets/main.scss'])
    @vite(['resources/scss/dashboard.scss'])

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/waves/waves.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/highlight/styles/monokai-sublime.css') }}">
    @vite(['resources/scss/plugins/perfect-scrollbar/perfect-scrollbar.scss'])
    @vite(['resources/scss/layouts/structure.scss'])

    {{ $headerFiles }}
</head>

<body>

<x-layout-loader/>

<x-navbar.employee-menu/>


<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container " id="container">

    <!--  BEGIN LOADER  -->
    <x-layout-overlay/>
    <!--  END LOADER  -->


    <x-menu.employee-menu/>

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content {{ Request::routeIs('blank') ? 'ms-0 mt-0' : '' }}">

        @if ($scrollspy == 1)
            <div class="container">
                <div class="container">
                    {{ $slot }}
                </div>
            </div>
        @else
            <div class="layout-px-spacing">
                <div class="middle-content p-0">
                    {{ $slot }}
                </div>
            </div>
        @endif

        <!--  BEGIN FOOTER  -->
        <x-layout-footer/>
        <!--  END FOOTER  -->

    </div>
    <!--  END CONTENT AREA  -->

</div>
<!--  END MAIN CONTAINER  -->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('plugins/mousetrap/mousetrap.min.js') }}"></script>
<script src="{{ asset('plugins/waves/waves.min.js') }}"></script>
<script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
@if ($scrollspy == 1)
    @vite(['resources/assets/js/scrollspyNav.js'])
@endif


@vite(['resources/layouts/app.js'])


{{ $footerFiles }}
</body>

</html>
