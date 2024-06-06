@include('admin.partials.header')
<div class="col mb-4" align="center">
    @if (Auth::user()->operasional_id == 10 ||
            Auth::user()->operasional_id == 9 ||
            Auth::user()->operasional_id == 8 ||
            Auth::user()->operasional_id == 7)
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/bahan-bakar-kendaraan.png') }}" height="100px" width="100px"
                alt="" />
        </div>
        <h5 style="margin-top: 15px">
            Laporan Pengisian Bahan Bakar Kendaraan
        </h5>
    @else
        <a href="{{ route('lapenam.pengisian-bbm.create') }}">
            <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
                <img src="{{ asset('assets/images/bahan-bakar-kendaraan.png') }}" height="100px" width="100px"
                    alt="" />
            </div>
            <h5 style="margin-top: 15px">
                Laporan Pengisian Bahan Bakar Kendaraan
            </h5>
        </a>
    @endif

</div>

@if (Auth::user()->operasional_id == 10 ||
        Auth::user()->operasional_id == 9 ||
        Auth::user()->operasional_id == 8 ||
        Auth::user()->operasional_id == 7)
    <div class="mb-2">
        <a href="{{ route('lapenam.pengisian-bbm.exportAll') }}" class="btn btn-success btn-loader">Export</a>
    </div>
@endif
<div style=" overflow-x: auto; overflow-y: auto;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Unit</th>
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
                       $format = "Y-m-d";
                        $date = Date::createFromFormat($format,$data->tanggal_pengisian);
                        
                        $hari = $date->translatedFormat('l');
                        $bulan = $date->translatedFormat('F');
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
                        $tanggal = $date->translatedFormat('d');
                        $tahun = $date->translatedFormat('Y');
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $data->unit }}</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    @if (Auth::user()->operasional_id == 10 ||
                            Auth::user()->operasional_id == 9 ||
                            Auth::user()->operasional_id == 8 ||
                            Auth::user()->operasional_id == 7)
                        <td>
                            <form method="post" action="{{ route('lapenam.pengisian-bbm.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('Delete')
                                <a href="{{ route('admin.lapenam.pengisian-bbm.edit', $data->id) }}" type="button"
                                    class="btn btn-info"> Edit</a>
                                <button type="submit" class="btn btn-danger"> Delete</button>
                            </form>
                        </td>
                    @else
                        <td>

                            <a href="{{ route('lapenam.pengisian-bbm.edit', $data->id) }}" type="button"
                                class="btn btn-info"> Edit</a>
                            {{-- <button type="submit" class="btn btn-danger"> Edit</button> --}}
                        </td>
                    @endif
            @endforeach
        </tbody>
    </table>
</div>


@if (Auth::user()->operasional_id == 10)
    <a href="{{ route('admin.lapenam.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
@elseif(session('koordPelayananTol') != null)
    <a href="{{ route('koordinator.lapenam.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
    <a href="{{ route('lapenam.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
@include('superadmin.partials.footer')
