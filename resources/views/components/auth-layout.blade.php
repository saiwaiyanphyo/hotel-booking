<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    @vite(['resources/scss/layouts/loader.scss'])

    @vite(['resources/layouts/loader.js'])

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">

    @vite(['resources/scss/assets/main.scss'])


    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/waves/waves.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/highlight/styles/monokai-sublime.css') }}">
    @vite(['resources/scss/plugins/perfect-scrollbar/perfect-scrollbar.scss'])

    @vite(['resources/scss/layouts/structure.scss'])

    {{ $headerFiles }}
</head>

<body>

<x-layout-loader/>


{{ $slot }}



{{ $footerFiles }}

</body>

</html>
