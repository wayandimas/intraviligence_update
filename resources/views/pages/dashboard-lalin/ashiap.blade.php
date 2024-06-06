<!DOCTYPE html>
<html lang="en">

<head>
    <title>ASHIAP</title>
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
                        {{-- <img src="assets/images/img_mutasi_patroli.png" alt="Image Lalin"
                            style="max-width: 100%; height: auto" /> --}}
                    </div>
                    <div class="row">
                        <h4 class="title col" style="margin-bottom: 0px; max-width: 1300px">
                            ASHIAP (Aktivitas Harian Petugas)
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
                            <a href="{{ route('mutasi-kegiatan.index') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/ashiap.png" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    Mutasi Kegiatan Harian
                                </h5>
                            </a>
                        </div>

                        <div class="col">
                            @if (Auth::user()->operasional_id == 11)
                                <a href="{{ route('pelayanan-kecelakaan-lalu-lintas.index') }}">
                            @endif
                            <div class="card-content" style="padding: 20px">
                                <img src="assets/images/kecelakaan-lalu-lintas.png" alt="" />
                            </div>
                            <h5 style="margin-top: 15px">
                                Laporan Pelayanan Penanganan Kecelakaan Lalu Lintas
                            </h5>
                        </div>
                        <div class="col">
                            <a href="{{ route('pelayanan-kendaraan-gangguan.index') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/kendaraan-gangguan.png" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">Laporan Pelayanan Kendaraan Gangguan</h5>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('pelayanan-pengendalian-operasional.index') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="assets/images/pengendalian-operasional.png" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    Laporan Pelayanan dan Pengendalian Operasional
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
