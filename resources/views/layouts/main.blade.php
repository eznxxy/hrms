<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HRMS | {{ $title }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-social.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/izitoast.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    {{-- Custom per page css --}}
    @stack('css')

    <!-- Global Styles -->
    <style>
        /* 1.18 Select2 */
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            outline: none;
            box-shadow: none;
        }

        .select2-container .select2-selection--multiple,
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 42px;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-user-select: none;
            outline: none;
            background-color: #fdfdff;
            border-color: #e4e6fc;
        }

        .select2-dropdown {
            border-color: #e4e6fc !important;
        }

        .select2-container.select2-container--open .select2-selection--multiple {
            background-color: #fefeff;
            border-color: #95a0f4;
        }

        .select2-container.select2-container--focus .select2-selection--multiple,
        .select2-container.select2-container--focus .select2-selection--single {
            background-color: #fefeff;
            border-color: #95a0f4;
        }

        .select2-container.select2-container--open .select2-selection--single {
            background-color: #fefeff;
            border-color: #95a0f4;
        }

        .select2-results__option {
            padding: 10px;
        }

        .select2-search--dropdown .select2-search__field {
            padding: 7px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            min-height: 42px;
            line-height: 42px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__arrow,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            position: absolute;
            top: 1px;
            right: 1px;
            width: 40px;
            min-height: 42px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
            color: #fff;
            padding-left: 10px;
            padding-right: 10px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding-left: 10px;
            padding-right: 10px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            margin-right: 5px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-results__option[aria-selected=true],
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #6777ef;
            color: #fff;
        }

        .select2-results__option {
            padding-right: 10px 15px;
        }

        /* 1.8 DataTables */
        table.dataTable {
            border-collapse: collapse !important;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            border-bottom: 1px solid #ddd !important;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #ddd !important;
        }

        .dataTables_wrapper {
            padding: 0 !important;
            font-size: 13px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
            margin: 0 !important;
            float: left;
        }

        div.dataTables_wrapper div.dataTables_processing {
            font-size: 0 !important;
            background-image: "{{ asset('assets/img/spinner.svg') }}" !important;
            background-color: #fff;
            background-size: 100%;
            width: 50px !important;
            height: 50px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
            top: 50% !important;
            left: 50% !important;
            -webkit-transform: translate(-50%, -50%) !important;
            transform: translate(-50%, -50%) !important;
            margin: 0 !important;
            opacity: 1 !important;
        }

        table {
            width: 100% !important;
        }

        .disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>

<body>
    @csrf
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            {{-- Navbar Header --}}
            @include('layouts._header')

            {{-- Sidebar --}}
            @include('layouts._sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            @stack('modals')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://github.com/nauvalazhar">Muhamad
                        Nauval Azhar</a>
                    <div class="bullet"></div> Created by <a href="https://www.linkedin.com/in/arifdwi/">Arif Dwi Laksana</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquerynicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment/moment.min.js') }}"></script>

    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/izitoast/iziToast.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/response-helper.js') }}"></script>

    <!-- Main JS -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Page Specific JS File -->
    @stack('js')
</body>

</html>