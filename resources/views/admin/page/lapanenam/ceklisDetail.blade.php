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
<div style=" overflow-x: auto; overflow-y: auto;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Shift</th>
                <th scope="col">Unit</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        @php
            $no = 0;
        @endphp
        <tbody>
            @if (Auth::user()->operasional_id == 7)
                @if (!empty($datas))
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
                            <td>{{ $data->shift }}</td>
                            <td>{{ substr($data->unit, 0, 3) }}</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post" action="{{ route('admin.lapenam.ceklis.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('Delete')
                                    <a href="{{ route('koordinator.lapenam.ceklis-patroli.edit', $data->id) }}"
                                        type="button" class="btn btn-info"> Edit</a>
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasDerekKecil))
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
                            <td>{{ $data->shift }}</td>
                            <td>Derek Kecil</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-derek-kecil.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="" type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasDerekBesar))
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
                            <td>{{ $data->shift }}</td>
                            <td>Derek Besar</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-derek-besar.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="" type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @elseif(Auth::user()->operasional_id == 8)
                @if (!empty($datasRescue))
                    @foreach ($datasRescue as $data)
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
                            <td>{{ $data->shift }}</td>
                            <td>Rescue</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post" action="{{ route('admin.lapenam.ceklis.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="" type="button" class="btn btn-info">
                                        Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasAmbulan))
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
                            <td>{{ $data->shift }}</td>
                            <td>Ambulans</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-ambulan.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('admin.lapenam.ceklis-ambulan.edit', $data->id) }}"
                                        type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasMedical))
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
                            <td>{{ $data->shift }}</td>
                            <td>Ambulans</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-medical.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('admin.lapenam.ceklis-ambulan.edit', $data->id) }}"
                                        type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @else
                @if (!empty($datas))
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
                            <td>{{ $data->shift }}</td>
                            <td>{{ substr($data->unit, 0, 3) }}</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post" action="{{ route('admin.lapenam.ceklis.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('Delete')
                                    <a href="{{ route('lapenam.ceklis.patroli.edit', $data->id) }}" type="button"
                                        class="btn btn-info"> Edit</a>
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasRescue))
                    @foreach ($datasRescue as $data)
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
                            <td>{{ $data->shift }}</td>
                            <td>Rescue</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-rescue.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('admin.lapenam.ceklis-rescue.edit', $data->id) }}" type="button"
                                        class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if (!empty($datasDerekKecil))
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
                            <td>{{ $data->shift }}</td>
                            <td>Derek Kecil</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-derek-kecil.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('lapenam.ceklis-derek.edit', $data->id) }}" type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasDerekBesar))
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
                            <td>{{ $data->shift }}</td>
                            <td>Derek Besar</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-derek-besar.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('lapenam.ceklis-derek.edit', $data->id) }}" type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasSecurity))
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
                            <td>{{ $data->shift }}</td>
                            <td>{{ $data->unit }}</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.serah-terima.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('admin.lapenam.serah-terima.edit', $data->id) }}"
                                        type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasAmbulan))
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
                            <td>{{ $data->shift }}</td>
                            <td>Ambulans</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-ambulan.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('admin.lapenam.ceklis-ambulan.edit', $data->id) }}"
                                        type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (!empty($datasMedical))
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
                            <td>{{ $data->shift }}</td>
                            <td>Ambulans</td>
                            <td>{{ $hariIndonesia . ' , ' . $tanggal . ' ' . $bulanIndonesia . ' ' . $tahun }}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('admin.lapenam.ceklis-medical.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    <a href="{{ route('admin.lapenam.ceklis-ambulan.edit', $data->id) }}"
                                        type="button" class="btn btn-info"> Edit</a>
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endif

        </tbody>
    </table>
</div>
@if (session('koordPelayananTol') != null)
    <a href="{{ route('koordinator.lapenam.ceklis') }}" class="btn btn-primary" style="color: white">Back</a>
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
    <a href="{{ route('admin.lapenam.ceklis') }}" class="btn btn-primary" style="color: white">Back</a>
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
