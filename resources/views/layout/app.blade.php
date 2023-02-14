<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inec Portal</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-dark">
        <div class="container-fluid text-white">
            <a class="navbar-brand text-white" href="/">INEC ELECTION PORTAL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars text-white"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarID">
                <div class="navbar-nav text-white">
                    <a class="nav-link text-white" aria-current="page" href="{{ route('unit') }}">Polling Unit
                        Result</a>
                    <a class="nav-link text-white" aria-current="page" href="{{ route('total') }}">Total result</a>
                    <a class="nav-link text-white" aria-current="page" href="{{ route('add') }}">Add Result</a>

                </div>
            </div>
        </div>
    </nav>
    <marquee class="bg-warning" width="100%" direction="left" height="fit-content" scrollamount=15>
        Please note that only few data from some of the polling units in DELTA STATE are available right now. Available LGA:
        <b>Ethiope West, Ika North - East, Sapele, Ughelli North, Ukwuani, Uvwie, Warri South, Warri South West</b>
    </marquee>

    <main class="py-4">
        @yield('content')
    </main>
    @yield('script')
</body>

</html>
