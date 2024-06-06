@include('admin.partials.header')
<div class="col mb-4" align="center">
    @if (Auth::user()->operasional_id == 10 ||
            Auth::user()->operasional_id == 9 ||
            Auth::user()->operasional_id == 8 ||
            Auth::user()->operasional_id == 7)
        <a href="#"></a>
    @else
        <a href="{{ route('pelayanan-pengendalian-operasional.create') }}">
    @endif


    <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
        <img src="{{ asset('assets/images/pengendalian-operasional.png') }}" alt="" />
    </div>
    <h5 style="margin-top: 15px">Laporan Pelayanan dan Pengendalian Operasional</h5>
    </a>
</div>
@if (Auth::user()->operasional_id == 10 ||
        Auth::user()->operasional_id == 9 ||
        Auth::user()->operasional_id == 8 ||
        Auth::user()->operasional_id == 7)
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
    <form action="{{ route('admin.pelayanan-pengendalian-operasional.export') }}" enctype="multipart/form-data"
        method="POST">

        @csrf
        <button class="btn btn-primary m-2" type="submit">Print Preview</button>
@endif
<div style=" overflow-x: auto; overflow-y: auto;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                @if (Auth::user()->operasional_id == 10 ||
                        Auth::user()->operasional_id == 9 ||
                        Auth::user()->operasional_id == 8 ||
                        Auth::user()->operasional_id == 7)
                    <th scope="col">#</th>
                @endif
                <th scope="col">No</th>
                @if (Auth::user()->operasional_id == 10 ||
                        Auth::user()->operasional_id == 9 ||
                        Auth::user()->operasional_id == 8 ||
                        Auth::user()->operasional_id == 7)
                    <th scope="col">Unit</th>
                @endif
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
            @if (Auth::user()->operasional_id == 10 ||
                    Auth::user()->operasional_id == 9 ||
                    Auth::user()->operasional_id == 8 ||
                    Auth::user()->operasional_id == 7)
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
                        @if (Auth::user()->operasional_id == 10 ||
                                Auth::user()->operasional_id == 9 ||
                                Auth::user()->operasional_id == 8 ||
                                Auth::user()->operasional_id == 7)
                            <th><input type="checkbox" name="id[]" value="{{ $data->id }}"></th>
                        @endif

                        </form>
                        <th scope="row">{{ $no }}</th>
                        <td>{{ $data->unit }}</td>
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
                            @if (Auth::user()->operasional_id == 10)
                                <form method="delete"
                                    action="{{ route('admin.pelayanan-pengendalian-operasional.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('Delete')
                                    {{-- <a href="{{ route('admin.pelayanan-pengendalian-operasional.export', $data->id) }}"
                                    type="button" class="btn btn-info"> Print Preview</a> --}}
                                    <a href="{{ route('pelayanan-pengendalian-operasional.edit', $data->id) }}"
                                        type="button" class="btn btn-primary"> Edit</a>
                                    <a href="{{ route('pelayanan-pengendalian-operasional.edit', $data->id) }}"
                                        type="button" class="btn btn-warning"> Approval</a>    
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            @else
                                <a href="{{ route('pelayanan-pengendalian-operasional.edit', $data->id) }}"
                                    type="button" class="btn btn-primary"> Edit</a>
                            @endif

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
                        @if (Auth::user()->operasional_id == 10 ||
                                Auth::user()->operasional_id == 9 ||
                                Auth::user()->operasional_id == 8 ||
                                Auth::user()->operasional_id == 7)
                            <th><input type="checkbox" name="id[]" value="{{ $data->id }}"></th>
                        @endif

                        </form>
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
                            @if (Auth::user()->operasional_id == 10)
                                <form method="delete"
                                    action="{{ route('admin.pelayanan-pengendalian-operasional.delete', $data->id) }}">
                                    @csrf
                                    @method('Delete')
                                    {{-- <a href="{{ route('admin.pelayanan-pengendalian-operasional.export', $data->id) }}"
                                    type="button" class="btn btn-info"> Print Preview</a> --}}
                                    <a href="{{ route('pelayanan-pengendalian-operasional.edit', $data->id) }}"
                                        type="button" class="btn btn-primary"> Edit</a>
                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                </form>
                            @else
                                <a href="{{ route('pelayanan-pengendalian-operasional.edit', $data->id) }}"
                                    type="button" class="btn btn-primary"> Edit</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@if (Auth::user()->operasional_id == 10)
    <a href="{{ route('admin.aktivitas.harian') }}" class="btn btn-primary" style="color: white">Back</a>                    
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
          
    
@elseif (Auth::user()->operasional_id == 7 || Auth::user()->operasional_id == 8 || Auth::user()->operasional_id == 9)
    <a href="{{ route('koordinator.aktivitas.harian') }}" class="btn btn-primary" style="color: white">Back</a>
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
@endif
<script>
    function getSelectedIds() {
        const dataTable = document.getElementById('datatable');
        const checkboxes = dataTable.querySelectorAll('input[type="checkbox"]:checked');
        const selectedIds = [];

        checkboxes.forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });

        // Lakukan apa yang Anda inginkan dengan selectedIds, seperti tampilkan atau proses lebih lanjut.
        console.log("Selected IDs: ", selectedIds);
    }
</script>
@include('admin.partials.footer')
{{-- @include('superadmin.partials.footer') --}}
