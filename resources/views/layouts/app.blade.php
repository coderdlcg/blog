<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="description" content="@yield('description', env('APP_NAME'))">

{{--    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">--}}
{{--    <link rel="manifest" href="/site.webmanifest">--}}
{{--    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#7843E9">--}}
{{--    <meta name="msapplication-TileColor" content="#7843E9">--}}
{{--    <meta name="theme-color" content="#7843E9">--}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white dark:bg-gray-800">
{{--@include('shared.alert')--}}
{{--@include('shared.header')--}}

<main class="min-h-screen max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-700">
    <div class="container">
        @yield('content')
    </div>
</main>

{{--@include('shared.footer')--}}

</body>
</html>
