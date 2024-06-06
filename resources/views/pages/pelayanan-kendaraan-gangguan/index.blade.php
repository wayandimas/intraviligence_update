@include('admin.partials.header')
<div class="col mb-4" align="center">
    <a href="{{ route('pelayanan-kendaraan-gangguan.create') }}">
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/kendaraan-gangguan.png') }}" alt="" />
        </div>
        <h5 style="margin-top: 15px">Laporan Pelayanan Kendaraan Gangguan</h5>
    </a>
</div>
<div style=" overflow-x: auto; overflow-y: auto;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>

                <th scope="col">No</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Seksi</th>
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
                    @php
                        $lokasi =
                            DB::table('stationing')
                                ->select()
                                ->where('id', $data->stationing)
                                ->first() ?? '';
                    @endphp
                    <td>{{ $lokasi->nama }}</td>
                    @php
                        $seksi =
                            DB::table('sections')
                                ->select()
                                ->where('id', $data->seksi)
                                ->first() ?? '';
                    @endphp
                    <td>{{ $seksi->nama }}</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        {{-- <form method="post" action="{{ route('pelayanan-kendaraan-gangguan.delete', $data->id) }}">
                        @csrf
                        @method('Delete') --}}
                        {{-- <a href="" type="button" class="btn btn-info"> Print Preview</a> --}}
                        <a href="{{ route('pelayanan-kendaraan-gangguan.edit', $data->id) }}" type="button"
                            class="btn btn-primary"> Edit</a>
                        {{-- <button type="submit" class="btn btn-danger"> Delete</button> --}}
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('admin.partials.footerDashboard')
