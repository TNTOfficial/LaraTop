<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .login_bg {
            background: url("../../assets/images/login1.jpg") no-repeat center/cover;
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .login_bg::before{
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            background-color: #0000003b;
            z-index: -1;
        }
        .login_bg1 {
            background: url("../../assets/images/login.jpg") no-repeat center/cover;
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .login_bg1::before{
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            background-color: #0000003b;
            z-index: -1;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="">
        <!-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> -->

        <div class="">
            {{ $slot }}
        </div>
    </div>
</body>

</html>