<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk - {{ config('app.name', 'Jalur Langit') }}</title>
    <link rel="icon" href="https://i.imgur.com/wuuewS5.png" type="image/x-icon" >
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f5f0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="%23e2d8c9" fill-opacity="0.1" d="M50 0L0 50L50 100L100 50L50 0Z"/></svg>');
            background-size: 80px 80px;
        }
        .arabic-font {
            font-family: 'Amiri', serif;
        }
        .islamic-card {
            border: 1px solid #d1e7dd;
            box-shadow: 0 4px 12px rgba(0, 75, 50, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="text-center mb-8">
        <span class="arabic-font text-4xl text-emerald-800">ﷲ</span>
        <h1 class="text-2xl font-bold text-emerald-800 mt-2">Jalur Langit</h1>
        <p class="text-sm text-gray-600">Silakan masuk untuk melanjutkan</p>
    </div>

    <div class="w-full sm:max-w-md px-6 py-8 islamic-card bg-white rounded-xl">
        {{ $slot }}
    </div>

    <div class="text-center mt-6 text-sm text-gray-600">
        <p class="mt-2 text-xs opacity-75">"Ya Allah, aku berlindung kepada-Mu dari ilmu yang tidak bermanfaat" (HR. Muslim)</p>
    </div>
</body>
</html>