@include('admin.partials.header')
<div class="col mb-4" align="center">
    @if (session('admin') != null)
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/siap.png') }}" style="height: 100px" alt="" />
        </div>
        <h5 style="margin-top: 15px">Surat Ijin Aktivitas Pekerjaan</h5>
    @else
        <a href="{{ route('siap.create') }}">
            <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
                <img src="{{ asset('assets/images/siap.png') }}" style="height: 100px" alt="" />
            </div>
            <h5 style="margin-top: 15px">Surat Ijin Aktivitas Pekerjaan</h5>
        </a>
    @endif
</div>
<div style=" overflow-x: auto; overflow-y: auto;">
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Tanggal Mulai Izin Kerja</th>
                <th scope="col">Tanggal Selesai Izin Kerja</th>
                <th scope="col">Jenis Pekerjaan</th>
                <th scope="col">Aksi</th>
                <th scope="col">Status</th>

            </tr>
        </thead>
        @php
            $no = 0;
        @endphp
        <tbody>
            @foreach ($datas as $data)
                @php
                    $no += 1;
                    $today = Carbon\Carbon::now();
                    $tanggal = $today->toDateString();
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $data->tanggal_mulai_pekerjaan }}</td>
                    <td>{{ $data->tanggal_mulai_izin }}</td>
                    <td>{{ $data->tanggal_selesai_izin }}</td>
                    <td>{{ $data->jenis_pekerjaan }}</td>

                    <td>
                        @if (Auth::user()->operasional_id == 10)
                            <form method="post" action="{{ route('admin.siap.delete', $data->id) }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('Delete')
                                <a href="{{ route('siap.edit', $data->id) }}" type="button" class="btn btn-primary">
                                    Edit</a>

                                <button type="submit" class="btn btn-danger"> Delete</button>
                            </form>
                        @else
                            <a href="{{ route('siap.edit', $data->id) }}" type="button" class="btn btn-primary">
                                Edit</a>
                        @endif

                    </td>
                    <td>
                        @if ($data->tanggal_selesai_izin >= $tanggal)
                            <button class="btn btn-success">Aktif</button>
                        @else
                            <button class="btn btn-warning">Expired</button>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if (Auth::user()->operasional_id == 10)
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
@else
    <a href="{{ route('dashboard-lalin.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
