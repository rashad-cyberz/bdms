<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif


        @php

            $users = \App\Models\User::all();
        @endphp


        <div class="grid grid-cols-4 gap-4">






            @for ($i = 1; $i <= 10; $i++)
                <div class="text-sm leading-4 bg-slate-50 rounded-lg dark:bg-slate-800 dark:highlight-white/5 p-6">
                    <div class="relative flex flex-col-reverse   ">

                        <div class="flex items-center space-x-4"><img
                                src="https://ui-avatars.com/api/?name=John+Doe" alt=""
                                class="flex-none w-14 h-14 rounded-full object-cover" loading="lazy" decoding="async">
                            <div class="flex-auto">
                                <div class="text-base text-slate-900 font-semibold dark:text-slate-300"><a
                                        href="https://twitter.com/ryanflorence/status/1187951799442886656"
                                        tabindex="0"><span class="absolute inset-0"></span>Ryan Florence</a></div>
                                <div class="mt-0.5">AB+ve</div>
                            </div>



                        </div>



                    </div>

                    <div class="flex p-4">
                        <a href="#"
                            class="text-slate-50 hover:text-slate-50 mr-2 bg-blue-500 p-2 rounded font-bold">Add
                            Friend</a>
                        <a href="#" class="text-red-500 hover:text-red-700 p-2 rounded font-bold border">Contact
                        </a>
                    </div>
                </div>
            @endfor
        </div>






    </div>



</body>

</html>
