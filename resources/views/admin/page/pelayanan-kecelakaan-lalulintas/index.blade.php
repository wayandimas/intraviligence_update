@include('admin.partials.header')
<div class="col mb-4" align="center">
    <a href="">
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/kecelakaan-lalu-lintas.png') }}" alt="" />
        </div>
        <h5 style="margin-top: 15px">Laporan Pelayanan Penanganan Kecelakaan Lalu Lintas</h5>
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
                    $namaHari = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                    ];
                    
                    // Ubah format hari ke bahasa Indonesia
                    $hariInggris = $data->created_at->format('l'); // Mendapatkan nama hari dalam bahasa Inggris
                    $hariIndonesia = $namaHari[$hariInggris];
                    
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
                    <td>{{ $hariIndonesia }}, {{ $data->created_at->format('d F Y') }}</td>
                    <td>
                        @if (Auth::user()->operasional_id == 10)
                            <form method="post"
                                action="{{ route('admin.pelayanan-kendaraan-kecelakaan.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                <a href="{{ route('pelayanan-kecelakaan-lalu-lintas.export', $data->id) }}"
                                    type="button" class="btn btn-info"> Print Preview</a>
                                <a href="{{ route('admin.pelayanan-kendaraan-kecelakaan.edit', $data->id) }}"
                                    type="button" class="btn btn-primary">Edit</a>
                                <a href="{{ route('admin.pelayanan-kendaraan-kecelakaan.edit', $data->id) }}"
                                    type="button" class="btn btn-warning">Approval</a>   
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-danger"> Delete</button>
                            </form>
                        @else
                            <form method="post"
                                action="{{ route('admin.pelayanan-kendaraan-kecelakaan.delete', $data->id) }}">
                                <a href="{{ route('pelayanan-kecelakaan-lalu-lintas.export', $data->id) }}"
                                    type="button" class="btn btn-info"> Print Preview</a>

                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if (Auth::user()->operasional_id == 7 || Auth::user()->operasional_id == 8 || Auth::user()->operasional_id == 9)
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
@endif
@include('admin.partials.footer')
