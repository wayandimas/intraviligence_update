@include('admin.partials.header')
<div class="col mb-4" align="center">
    <a href="">
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/checklist-kendaraan.png') }}" height="100px" width="100px" alt="" />
        </div>
        <h5 style="margin-top: 15px">
            Checklist Performa Kendaraan
        </h5>
    </a>
</div>


<form class="form-inline mb-4">
    <div class="form-group row">
        <div class="col-5">
            <label for="example-date-input" class="col-sm-2 col-form-label">Start Date</label>
            <div class="col-sm-10">
                <input class="form-control" type="date" name="start" value="{{ Request::get('start') }}"
                    id="example-date-input">
            </div>
        </div>
        <div class="col-5">
            <label for="example-date-input" class="col-sm-2 col-form-label">End Date</label>
            <div class="col-sm-10" style="margin-left:0px;">
                <input class="form-control" type="date" name="end" value="{{ Request::get('end') }}"
                    id="example-date-input">
            </div>
        </div>
        <div class="col-2" style="margin-top:35px;">
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </div>

</form>
<div style=" overflow-x: auto; overflow-y: auto;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Unit</th>
                <th scope="col">Jenis</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        @php
            $no = 0;
        @endphp
        @if (Auth::user()->operasional_id == 9)
            @foreach ($datasSecurity as $data)
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
                    <td>{{ $data->unit }}</td>
                    <td>Serah Terima Inventaris</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.serah-terima.export', $data->id) }}" type="button"
                            class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        @elseif(Auth::user()->operasional_id == 7)
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
                    <td>{{ substr($data->unit, 0, 3) }}</td>
                    <td>Kelengkapan Kendaraan Patroli</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('koordinator.lapenam.pemeriksaan-kendaraan-patroli.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('koordinator.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasDerekKecil as $data)
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
                    <td>Derek</td>
                    <td>Kelengkapan Kendaraan Derek Kecil</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('koordinator.lapenam.pemeriksaan-derek-kecil.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('koordinator.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasDerekBesar as $data)
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
                    <td>Derek</td>
                    <td>Kelengkapan Kendaraan Derek Besar</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('koordinator.lapenam.pemeriksaan-derek-besar.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('koordinator.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        @elseif(Auth::user()->operasional_id == 8)
            @foreach ($datasRescue as $rescueData)
                @php
                    $no += 1;
                    $hari = $rescueData->created_at->translatedFormat('l');
                    $bulan = $rescueData->created_at->translatedFormat('F');
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
                    $tanggal = $rescueData->created_at->translatedFormat('d');
                    $tahun = $rescueData->created_at->translatedFormat('Y');
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>Rescue</td>
                    <td>Kelengkapan Kendaraan Rescue</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-kendaraan-rescue.export', $rescueData->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $rescueData->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasAmbulan as $data)
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
                    <td>Ambulans</td>
                    <td>Kelengkapan Kendaraan Ambulan</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-kendaraan-ambulans.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasMedical as $data)
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
                    <td>Ambulans</td>
                    <td>Kelengkapan Medis</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-peralatan-medis.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        @else
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
                    <td>{{ substr($data->unit, 0, 3) }}</td>
                    <td>Kelengkapan Kendaraan Patroli</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-kendaraan-patroli.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach


            @foreach ($datasRescue as $rescueData)
                @php
                    $no += 1;
                    $hari = $rescueData->created_at->translatedFormat('l');
                    $bulan = $rescueData->created_at->translatedFormat('F');
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
                    $tanggal = $rescueData->created_at->translatedFormat('d');
                    $tahun = $rescueData->created_at->translatedFormat('Y');
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>Rescue</td>
                    <td>Kelengkapan Kendaraan Rescue</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        @if (Auth::user()->operasional_id == 10 || Auth::user()->operasional_id == 9 || Auth::user()->operasional_id == 10)
                            <a href="{{ route('admin.lapenam.pemeriksaan-kendaraan-rescue.export', $rescueData->id) }}"
                                type="button" class="btn btn-info">Print Preview</a>
                        @endif

                        <a href="{{ route('admin.lapenam.ceklis.detail', $rescueData->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasAmbulan as $data)
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
                    <td>Ambulans</td>
                    <td>Kelengkapan Kendaraan Ambulan</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-kendaraan-ambulans.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasMedical as $data)
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
                    <td>Ambulans</td>
                    <td>Kelengkapan Medis</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-peralatan-medis.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasDerekKecil as $data)
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
                    <td>Derek</td>
                    <td>Kelengkapan Kendaraan Derek Kecil</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-derek-kecil.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($datasDerekBesar as $data)
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
                    <td>Derek</td>
                    <td>Kelengkapan Kendaraan Derek Besar</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.pemeriksaan-derek-besar.export', $data->id) }}"
                            type="button" class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach

            @foreach ($datasSecurity as $data)
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
                    <td>{{ $data->unit }}</td>
                    <td>Serah Terima Inventaris</td>
                    <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                    <td>
                        <a href="{{ route('admin.lapenam.serah-terima.export', $data->id) }}" type="button"
                            class="btn btn-info">Print Preview</a>
                        <a href="{{ route('admin.lapenam.ceklis.detail', $data->unit) }}" type="button"
                            class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
@if (session('koordPelayananTol') != null)
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
@endif
@include('admin.partials.footer')
@include('superadmin.partials.footer')
