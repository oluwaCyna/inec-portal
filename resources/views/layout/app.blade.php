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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .result-card {
                width: 30%;
            }
        @media (max-width: 768px) {
            .unit-group {
                flex-direction: column;
            }
            .result-card {
                width: 45%;
            }
        }
    </style>

  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/js/app.js']) --}}
     <!-- BS5 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
     <!-- fontawesome -->
     <script src="https://kit.fontawesome.com/b41ff46bee.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-dark">
        <div class="container-fluid">
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
    <marquee class="bg-warning fs-2" width="100%" direction="left" height="fit-content" scrollamount=15>
        Please select options from the drop down box and wait for the result. Please note that only few data from some of the polling units in DELTA STATE are available right now as provided by the database file given. Available LGA:
        <b>Ethiope West, Ika North - East, Sapele, Ughelli North, Ukwuani, Uvwie, Warri South, Warri South West</b>
    </marquee>

    <main class="py-4">
        @yield('content')
    </main>
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
