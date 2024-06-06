<table>
    <thead>
        <tr>
            <th>Unit</th>
            <th>Unit Perawatan</th>
            <th>Tanggal Perawatan</th>
            <th>Odometer Perawatan</th>
            <th>Jenis Perawatan</th>
            <th>Tempat Bengkel Perbaikan</th>
            <th>Keterangan</th>
            <th>Nama Petugas 1</th>
            <th>Nama Petugas 2</th>
            <th>Foto Odometer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perawatan as $key => $data)
            <tr>
                <td>{{ $data->unit }}</td>
                @php
                    $unit_perawatan = DB::table('maintenance_unit')
                        ->select()
                        ->where('id', $data->unit_perawatan)
                        ->first();
                @endphp
                @php
                    $jenis_perawatan = DB::table('maintenance_type')
                        ->select()
                        ->where('id', $data->jenis_perawatan)
                        ->first();
                @endphp
                @php
                    $bengkel = DB::table('repair_workshop')
                        ->select()
                        ->where('id', $data->bengkel)
                        ->first();
                @endphp
                @php
                    $personil1 = DB::table('officers')
                        ->select()
                        ->where('id', $data->personil1)
                        ->first();
                @endphp
                @php
                    $personil2 = DB::table('officers')
                        ->select()
                        ->where('id', $data->personil2)
                        ->first();
                @endphp
                <td>{{ $unit_perawatan->nama }}</td>
                <td>{{ $data->tanggal_perawatan }}</td>
                <td>{{ $data->odo_meter }}</td>
                <td>{{ $jenis_perawatan->nama }}</td>
                <td>{{ $bengkel->nama }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>{{ $personil1->nama }}</td>
                <td>{{ $personil2->nama }}</td>
                <td><a
                        href="http://127.0.0.1:8000/LPBBM/{{ $data->foto_odo_meter }}">http://127.0.0.1:8000/LPBBM/{{ $data->foto_odo_meter }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
