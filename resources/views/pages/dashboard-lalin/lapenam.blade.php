<!DOCTYPE html>
<html lang="en">

<head>
    <title>LAPENAM</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    @include('partials.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-60 p-b-100 font-poppins">
        <div class="wrapper wrapper--w1300">
            <div class="card card-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="dropdown">
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ Auth::user()->nama }}</a>
                                {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('logout.index') }}">Logout</a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col" style="text-align: end">
                            <p id="tanggalwaktu" name="tanggalwaktu">
                                Date
                            </p>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 30px">
                        <div id="map" style="width: 100%; height: 400px"></div>
                    </div>
                    <div class="row">
                        <h4 class="title col" style="margin-bottom: 0px; max-width: 1300px">
                            LAPENAM (Laporan Pemeriksaan Kendaraan dan Monitoring)
                        </h4>
                    </div>
                    <div class="title row" style="margin-top: 0px">
                        <div class="col">
                            <img src=" assets/images/icon1.png" alt="" />
                            <h5 style="margin-top: 15px">{{ ($total / 16) * 100 }}%</h5>
                        </div>
                        <div class="col">
                            <img src=" assets/images/icon2.png" alt="" />
                            <h5 style="margin-top: 15px">0.00%</h5>
                        </div>
                        <div class="col">
                            <img src=" assets/images/icon3.png" alt="" />
                            <h5 style="margin-top: 15px">0.00%</h5>
                        </div>
                    </div>
                    <div class="title-2 row">
                        <div class="col">
                            <a href="{{ route('lapenam.ceklis') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/checklist-kendaraan.png" height="100px" width="100px"
                                        alt="" />
                                </div>
                                @if (Auth::user()->operasional_id == 5)
                                    <h5 style="margin-top: 15px">
                                        Laporan Serah Terima Inventaris
                                    </h5>
                                @else
                                    <h5 style="margin-top: 15px">
                                        Checklist Performa Kendaraan
                                    </h5>
                            </a>
                            @endif
                        </div>
                        <div class="col">
                            <a href="{{ route('lapenam.pengisian-bbm.index') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/bahan-bakar-kendaraan.png" height="100px" width="100px"
                                        alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    Laporan Pengisian Bahan Bakar Kendaraan
                                </h5>
                        </div>
                        <div class="col">
                            <a href="https://mun-integritysystem.com/skrol/#login">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/perawatan-kendaraan.png" height="100px" width="100px"
                                        alt="" />
                                </div>
                                <h5 style="margin-top: 15px">Laporan Kerusakan dan Perawatan Kendaraan</h5>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('lapenam.perawatan-kendaraan.index') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/perbaikan-kendaraan.png" height="100px" width="100px"
                                        alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    Laporan Perbaikan Kerusakan dan Perawatan Kendaraan
                                </h5>
                        </div>
                    </div>
                    <a href="{{ route('dashboard-lalin.index') }}" class="btn btn-primary">Back </a>
                </div>
                     <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Isi footer, misalnya informasi tambahan, tautan, dll. -->
                <p>&copy; 2023 Developed By TKJ PNUP</p>
            </div>
        </div>
    </div>
</footer>
            </div>
        </div>
    </div>
    @include('partials.js')
</body>

</html>
