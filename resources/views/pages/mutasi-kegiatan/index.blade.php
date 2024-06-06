@include('admin.partials.header')
<div class="col mb-4" align="center">
    @if (session('koordPelayananTol') != null)
        <a href="#">
            <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
                <img src="{{ asset('assets/images/ashiap.png') }}" height="100px" width="100px" alt="" />
            </div>
            <h5 style="margin-top: 15px">
                Mutasi Kegiatan Harian
            </h5>
        </a>
    @else
        <a href="{{ route('mutasi-kegiatan.create') }}">
            <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
                <img src="{{ asset('assets/images/ashiap.png') }}" height="100px" width="100px" alt="" />
            </div>
            <h5 style="margin-top: 15px">
                Mutasi Kegiatan Harian
            </h5>
            <a href="/mutasi-kegiatan"></a>
        </a>
    @endif
</div>
<div style=" overflow-x: auto; overflow-y: scroll;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                {{-- <th scope="col">No Mutasi</th> --}}
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        @php
            $no = 0;
        @endphp
        <tbody>
            @foreach ($datas as $data)
                @php
                    $no += 1;
                    $hari = $data->created_at->translatedFormat('l');
                    $bulan = $data->created_at->translatedFormat('F');
                    $namaHari = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                    ];
                    $namaBulan = [
                        'January' => 'Januari',
                        'February' => 'Februari',
                        'March' => 'Maret', // Perbaikan disini
                        'April' => 'April',
                        'May' => 'Mei', // Perbaikan disini
                        'June' => 'Juni',
                        'July' => 'Juli',
                        'August' => 'Agustus',
                        'September' => 'September',
                        'October' => 'Oktober',
                        'November' => 'November', // Perbaikan disini
                        'December' => 'Desember',
                    ];
                    $hariIndonesia = $namaHari[$hari];
                    $bulanIndonesia = $namaBulan[$bulan];
                    $tanggal = $data->created_at->translatedFormat('d');
                    $tahun = $data->created_at->translatedFormat('Y');
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    {{-- <td>{{ $data->no_mutation }}</td> --}}
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        {{-- <a href="{{ route('mutasi-kegiatan.export', $data->id) }}" type="button" class="btn btn-info">
                            Print Preview</a> --}}
                        <a href="{{ route('mutasi.detail', $data->no_mutation) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('aktivitas-harian.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
