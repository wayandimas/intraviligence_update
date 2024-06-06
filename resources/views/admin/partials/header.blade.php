<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $judul ?? 'ASHIAP' }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all" />
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all" />
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Vendor CSS-->
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('assets/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    
        <link href="{{ asset('assets/superadmin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('assets/superadmin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/superadmin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <style>
            /* Ganti ukuran checkbox sesuai keinginan Anda */
            /* Misalnya, untuk memperbesar ukuran checkbox menjadi 20px x 20px */
            input[type="checkbox"] {
                width: 20px;
                height: 20px;
            }
        </style>
        <link href="{{ asset('assets/superadmin/plugins/morris/morris.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/superadmin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/superadmin/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/superadmin/css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-60 p-b-100 font-poppins">
        <div class="wrapper wrapper--w1300">
            <div class="card card-4">
                <div class="card-body">
                    @if ($errors->first('message'))
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('message') }}
                            </div>
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-info" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="dropdown">
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ Auth::user()->nama }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('logout.index') }}">Logout</a>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="text-align: end">
                            <p id="tanggalwaktu" name="tanggalwaktu">
                                Date
                            </p>
                        </div>
                    </div>
