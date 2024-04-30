<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ $title ?? 'Booking Serive & Penjualan Sparepart Mobil' }}</title> --}}
    <title>{{ $title ?? 'Todo Manager' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fugaz+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style>
        .dt-length {
            display: flex;
            width: 300px;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .dt-length select {
            width: 80px;
            border-radius: 100px;
            padding: 5px 10px;
        }

        .dt-search {
            display: flex;
            width: 300px;
            align-items: center;
            justify-content: end;
            gap: 10px;
            margin-bottom: 10px;
        }

        .dt-search input {
            width: 200px;
            border-radius: 100px;
            padding: 5px 10px;
        }

        .dt-empty {
            width: 100%;
            text-align: center;
        }

        .dt-info {
            margin-top: 10px;
        }

        .dt-paging.paging_full_numbers {
            margin-top: 10px;
        }

        .table tbody tr th,
        .table tfoot tr th {
            background-color: #f7f7f7;
        }

        .table tbody tr th,
        .table tbody tr td {
            padding: 14px 10px !important;
        }

        table thead {
            background-color: #435EBE;
        }

        thead tr th {
            color: #fff !important;
        }

        @media (max-width: 767px) {
            .dt-length {
                width: 100%;
                justify-content: center;
                flex-direction: column;
                gap: 0;
                margin-bottom: 10px;
            }

            .dt-search {
                width: 100%;
                justify-content: center;
            }

            .dt-info,
            .dt-paging.paging_full_numbers {
                width: 100%;
                display: flex;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div id="app" style="overflow: hidden;">
        <div id="main" class="layout-horizontal">
            @include('layouts._header')

            <div class="container content-wrapper">

                <div class="page-heading">
                    <h4>{{ $main_title }}</h4>
                </div>
                <div class="page-content">

                    {{ $slot }}
                    {{-- /Content --}}
                </div>

            </div>

            <footer class="">
                <div class="container">
                    <div class="clearfix mb-0 footer text-muted">
                        <div class="float-start">
                            <p>2023 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Template Created by <a href="https://saugi.me">Saugi</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script type="module">
        $(document).ready(function() {
            $('#table1').DataTable();
        });
    </script>
    @isset($script)
        {{ $script }}
    @endisset

</body>

</html>
