<!DOCTYPE html>
<html lang="en">

<head>
    <title>LAPENAM</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    @include('partials.css')
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
                    <div class="row" style="margin-bottom: 30px">
                        <div id="map" style="width: 100%; height: 400px"></div>
                    </div>
                    <div class="row">
                        <h4 class="title col" style="margin-bottom: 0px; max-width: 1300px">
                            LAPENAM (Laporan Pemeriksaan Kendaraan dan Monitoring)
                        </h4>
                    </div>

                    <div class="title-2 row">
                        <div class="col">
                            @if (session('koordPelayananTol') != null)
                                <a href="{{ route('koordinator.lapenam.ceklis') }}">
                                @else
                                    <a href="{{ route('admin.lapenam.ceklis') }}">
                            @endif
                            <div class="card-content" style="padding: 20px">
                                <img src="{{ asset('assets/images/checklist-kendaraan.png') }}" height="100px"
                                    width="100px" alt="" />
                            </div>

                            @if (Auth::user()->operasional_id == 9)
                                <h5 style="margin-top: 15px">
                                    Laporan Serah Terima Inventaris
                                </h5>
                            @else
                                <h5 style="margin-top: 15px">
                                    Checklist Performa Kendaraan
                                </h5>
                            @endif
                            </a>
                        </div>
                        <div class="col">
                            @if (session('koordPelayananTol') != null)
                                <a href="{{ route('koordinator.lapenam.pengisian-bbm.index') }}">
                                @else
                                    <a href="{{ route('admin.lapenam.pengisian-bbm.index') }}">
                            @endif
                            <div class="card-content" style="padding: 20px">
                                <img src="{{ asset('assets/images/bahan-bakar-kendaraan.png') }}" height="100px"
                                    width="100px" alt="" />
                            </div>
                            <h5 style="margin-top: 15px">
                                Laporan Pengisian Bahan Bakar Kendaraan
                            </h5>
                        </div>
                        <div class="col">
                            <a href="https://mun-integritysystem.com/skrol/">
                                <div class="card-content" style="padding: 20px">
                                    <img src="{{ asset('assets/images/perawatan-kendaraan.png') }}" height="100px"
                                        width="100px" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">Laporan Kerusakan dan Perawatan Kendaraan</h5>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.lapenam.perawatan-kendaraan.index') }}">
                                <div class="card-content" style="padding: 20px">
                                    <img src="{{ asset('assets/images/perbaikan-kendaraan.png') }}" height="100px"
                                        width="100px" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    Laporan Perbaikan Kerusakan dan Perawatan Kendaraan
                                </h5>
                        </div>
                    </div>
                    @if (session('koordPelayananTol') != null)
                        <a href="{{ route('koordinator.dashboard.index') }}" class="btn btn-primary"
                            style="color: white">Back</a>
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
                    @else
                        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary"
                            style="color: white">Back</a>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('partials.js')
</body>

</html>
