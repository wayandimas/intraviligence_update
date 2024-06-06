@include('admin.partials.header')
<div class="col mb-4" align="center">
    <a href="{{ route('pelayanan-kecelakaan-lalu-lintas.create') }}">
        <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
            <img src="{{ asset('assets/images/kecelakaan-lalu-lintas.png') }}" alt="" />
        </div>
        <h5 style="margin-top: 15px">Laporan Pelayanan Penanganan Kecelakaan Lalu Lintas</h5>
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
                    <td>{{ $data->created_at->format('l, d F Y') ?? '' }}</td>
                    <td>
                        <form method="post" action="{{ route('pelayanan-kendaraan-kecelakaan.delete', $data->id) }}">
                            @csrf
                            @method('Delete')
                            {{-- <a href="" type="button" class="btn btn-info"> Print Preview</a> --}}
                            <a href="{{ route('pelayanan-kendaraan-kecelakaan.edit', $data->id) }}" type="button"
                                class="btn btn-primary"> Edit</a>
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
@elseif (session('admin') != null)
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
@include('admin.partials.footer')
