<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.partials.bootstrap-script')
    <title>Gadwalls-System</title>
</head>

<body>
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #000000;
        }

        ::-webkit-scrollbar-thumb {
            background-image: linear-gradient(180deg, #ffc107 0%, #1B3764 99%);

            border-radius: 10px;
            transition: 0.5s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;

        }
    </style>


    @include('layouts.partials.nav')

    {{-- @include('layouts.dashboard.dashboard') --}}
    @yield('content')
    @include('layouts.dashboard.dashboard-left')

    @include('layouts.partials.footer')

</body>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
