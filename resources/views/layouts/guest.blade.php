<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}

    <style>
        /* CSS Dasar untuk Guest Layout */
        body {
            font-family: sans-serif;
            background-color: var(--cream-bg, #f6f5f2); /* Menggunakan warna latar belakang Anda */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .guest-container {
            width: 100%;
            max-width: 400px; /* Ukuran kotak login/register */
            padding: 24px;
            background-color: var(--white, #FFFFFF);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 24px;
        }

        /* Tambahkan CSS yang relevan dari tema Anda di sini */
        :root {
            --sage-dark: #6E7C6F;
            --cream-bg: #F6F5F2;
            --white: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="guest-container">
        <div class="logo-area">
            <a href="/" style="color: var(--sage-dark); text-decoration: none; font-size: 1.5rem; font-weight: bold;">
                {{ config('app.name', 'App Logo') }}
            </a>
        </div>

        {{ $slot }} 
    </div>
</body>
</html>