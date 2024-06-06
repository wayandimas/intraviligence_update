@include('admin.partials.header')
<div class="col mb-4" align="center">
    <a href="">
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/kendaraan-gangguan.png') }}" alt="" />
        </div>
        <h5 style="margin-top: 15px">Laporan Pelayanan Kendaraan Gangguan</h5>
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
    <form action="{{ route('admin.pelayanan-kendaraan-gangguan.export') }}" enctype="multipart/form-data"
        method="POST">
        @csrf
        <button class="btn btn-primary m-2" type="submit">Print Preview</button>
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
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

            @csrf
            <tbody>
                @foreach ($datas as $data)
                    @php
                        $no += 1;
                        $format = "Y-m-d";
                        $date = Date::createFromFormat($format,$data->tanggal_kejadian);
                        
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
                        <th><input type="checkbox" name="id[]" value="{{ $data->id }}"></th>

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
        <form method="post" action="{{ route('admin.pelayanan-kendaraan-gangguan.delete', $data->id) }}"onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
            @csrf
            @method('Delete')
            {{-- <a href="" type="button" class="btn btn-info"> Print Preview</a> --}}
            <a href="{{ route('admin.pelayanan-kendaraan-gangguan.edit', $data->id) }}" type="button"
                class="btn btn-primary"> Edit</a>
            <a href="{{ route('admin.pelayanan-kendaraan-gangguan.edit', $data->id) }}" type="button"
                class="btn btn-warning"> Approval</a>    
            <button type="submit" class="btn btn-danger"> Delete</button>
        </form>
    </td>
    </tr>
    @endforeach
    </tbody>

    </table>


</div>
@if (session('koordPelayananTol') != null)
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
