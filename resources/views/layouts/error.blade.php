<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR @yield('code') | {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/errors.css') }}">
</head>
<body>
    @yield('content')
    <div class="binary-bg" id="binary"></div>
    <div class="scan-line"></div>
</body>
</html>