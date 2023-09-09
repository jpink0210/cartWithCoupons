<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Script -->
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

        <!-- Styles -->
        
    </head>
    <body class="antialiased">
        <h2>Cart</h2>
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ route('page.dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">會員中心</a>
                        <br>
                        <br>
                        <a href="{{ route('mart') }}" class="text-sm text-gray-700 underline">前往商城</a>

                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">登入 </a>
                        <br>
                        <br>
                        @if (Route::has('signup'))
                            <a href="{{ route('signup') }}" class="text-sm text-gray-700 underline">註冊新帳號 </a>

                        @endif


                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">

                
            </div>
        </div>
    </body>
</html>
