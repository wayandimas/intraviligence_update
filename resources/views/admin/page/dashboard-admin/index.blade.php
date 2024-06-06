@include('admin.partials.header')
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
        /* Tambahkan gaya CSS khusus untuk footer */
        .footer {
            margin-top: 20px;
             /* Media query untuk menampilkan tombol Logout hanya di perangkat dengan lebar minimal 768px (ukuran layar md dan lebih besar) */
        @media (min-width: 768px) {
            .logout-button {
                display: block;
            }
        }

        /* Sembunyikan tombol Logout pada perangkat seluler (kurang dari 768px) */
        @media (max-width: 767px) {
            .logout-button {
                display: none;
            }
        }
        }
    </style>
<div class="row" style="margin-bottom: 30px">
    <div id="map" style="width: 100%; height: 400px"></div>
    {{-- <img src="assets/images/img_mutasi_patroli.png" alt="Image Lalin"
                            style="max-width: 100%; height: auto" /> --}}
</div>
<div class="row">
    <h4 class="title col" style="margin-bottom: 0px; max-width: 1300px">
        Halaman {{ Auth::user()->nama }}
    </h4>
</div>

<div class="title-2 row">
    <div class="col" align="center">
        @if (session('koordPelayananTol') != null)
            <a href="{{ route('koordinator.aktivitas.harian') }}">
                <div class="card-content" style="padding: 3px">
                    <img src="assets/images/ashiap.png" height="120px" width="120px" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    ASHIAP (Aktivitas Harian Petugas)
                </h5>
            </a>
        @else
            <a href="{{ route('admin.aktivitas.harian') }}">
                <div class="card-content" style="padding: 3px">
                    <img src="assets/images/ashiap.png" height="120px" width="120px" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    ASHIAP (Aktivitas Harian Petugas)
                </h5>
            </a>
        @endif
    </div>
    <div class="col" align="center">
        @if (session('koordPelayananTol') != null)
            <a href="{{ route('koordinator.lapenam.index') }}">
                <div class="card-content">
                    <img src="{{ asset('assets/images/lapenam.png') }}" height="120px" width="120px" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    LAPANENAM (Laporan Pemeriksaan Kendaraan dan
                    Monitoring)
                </h5>
            </a>
        @else
            <a href="{{ route('admin.lapenam.index') }}">
                <div class="card-content">
                    <img src="{{ asset('assets/images/lapenam.png') }}" height="120px" width="120px" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    LAPANENAM (Laporan Pemeriksaan Kendaraan dan
                    Monitoring)
                </h5>
            </a>
        @endif
    </div>

    <div class="col" align="center">
        <div class="card-content" style="padding: 15px">
            @if (session('koordPelayananTol') != null)
                <a href="{{ route('koordinator.siap.index') }}"><img src="assets/images/siap.png" height="100px"
                        width="100px" alt="" />
        </div>
        <h5 style="margin-top: 15px">
            SIAP (Surat Ijin Aktivitas Pekerjaan)
        </h5>
        </a>
    @else
        <a href="{{ route('admin.siap.index') }}"><img src="assets/images/siap.png" height="100px" width="100px"
                alt="" />
    </div>
    <h5 style="margin-top: 15px">
        SIAP (Surat Ijin Aktivitas Pekerjaan)
    </h5>
    </a>
    @endif
</div>
 <div class="container mt-3 text-left logout-button">
        <a class="btn btn-primary" href="{{ route('logout.index') }}">Logout</a>
    </div>

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


@include('admin.partials.footer')
