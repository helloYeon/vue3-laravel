<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head prefix="og:http://ogp.me/ns#">
		@vite(['resources/sass/app.scss','resources/js/app.ts','resources/css/app.css'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vue Laravel SPA') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

</head>

<body>
    <div id="app" class="mt-0 mx-auto mb-auto">
    </div>
</body>

</html>
