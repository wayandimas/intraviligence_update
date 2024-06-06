@include('admin.partials.header')
<div class="row" style="margin-bottom: 30px">
    <div id="map" style="width: 100%; height: 400px"></div>
</div>
<div class="row">
    <h4 class="title col" style="margin-bottom: 0px; max-width: 1300px">
        Halaman {{ Auth::user()->nama }}
    </h4>
</div>


<div class="title-2 row">
    <div class="col" align="center">
        @if (session('koordPelayananTol') != null)
            <a href="{{ route('koordinator.mutasi.kegiatan') }}">
                <div class="card-content" style="padding: 20px">
                    <img src="{{ asset('assets/images/ashiap.png') }}" height="100px" width="100px" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    Mutasi Kegiatan Harian
                </h5>
            </a>
        @else
            <a href="{{ route('admin.mutasi.kegiatan') }}">
                <div class="card-content" style="padding: 20px">
                    <img src="{{ asset('assets/images/ashiap.png') }}" height="100px" width="100px" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    Mutasi Kegiatan Harian
                </h5>
            </a>
        @endif
    </div>
    <div class="col" align="center">
        @if (session('koordPelayananTol') != null)
            <a href="{{ route('koordinator.pelayanan-kendaraan-kecelakaan') }}">
                <div class="card-content" style="padding: 20px">
                    <img src="{{ asset('assets/images/kecelakaan-lalu-lintas.png') }}" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    Laporan Pelayanan Penanganan Kecelakaan Lalu Lintas
                </h5>
            </a>
        @else
            <a href="{{ route('admin.pelayanan-kendaraan-kecelakaan') }}">
                <div class="card-content" style="padding: 20px">
                    <img src="{{ asset('assets/images/kecelakaan-lalu-lintas.png') }}" alt="" />
                </div>
                <h5 style="margin-top: 15px">
                    Laporan Pelayanan Penanganan Kecelakaan Lalu Lintas
                </h5>
            </a>
        @endif
    </div>
    <div class="col" align="center">
        @if (session('koordPelayananTol') != null)
            <a href="{{ route('koordinator.pelayanan-kendaraan-gangguan') }}">
                <div class="card-content" style="padding: 20px">
                    <img src="{{ asset('assets/images/kendaraan-gangguan.png') }}" alt="" />
                </div>
                <h5 style="margin-top: 15px">Laporan Pelayanan Kendaraan Gangguan</h5>
            </a>
        @else
            <a href="{{ route('admin.pelayanan-kendaraan-gangguan') }}">
                <div class="card-content" style="padding: 20px">
                    <img src="{{ asset('assets/images/kendaraan-gangguan.png') }}" alt="" />
                </div>
                <h5 style="margin-top: 15px">Laporan Pelayanan Kendaraan Gangguan</h5>
            </a>
        @endif
    </div>
    <div class="col" align="center">
        <div class="card-content" style="padding: 20px">
            @if (session('koordPelayananTol') != null)
                <a href="{{ route('koordinator.pelayanan-pengendalian-operasional.index') }}">
                    <img src="{{ asset('assets/images/pengendalian-operasional.png') }}" alt="" />
        </div>
        <h5 style="margin-top: 15px">
            Laporan Pelayanan dan Pengendalian Operasional
        </h5></a>
    @else
        <a href="{{ route('admin.pelayanan-pengendalian-operasional.index') }}">
            <img src="{{ asset('assets/images/pengendalian-operasional.png') }}" alt="" />
    </div>
    <h5 style="margin-top: 15px">
        Laporan Pelayanan dan Pengendalian Operasional
    </h5></a>
    @endif

</div>
</div>
@if (session('koordPelayananTol') != null)
    <a href="{{ route('koordinator.dashboard.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary" style="color: white">Back</a>
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

@include('admin.partials.footer')
