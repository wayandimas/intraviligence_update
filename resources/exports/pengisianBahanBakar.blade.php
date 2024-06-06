<table>
    <thead>
        <tr>
            <th>Unit</th>
            <th>Unit Pengisian</th>
            <th>Tanggal Pengisian</th>
            <th>Waktu Pengisian</th>
            <th>Odometer Pengisian</th>
            <th>Jumlah Pengisian</th>
            <th>Nama Petugas 1</th>
            <th>Nama Petugas 2</th>
            <th>Kembalian Pengisian</th>
            <th>Foto Struk</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengisian as $key => $data)
            <tr>
                <td>{{ $data->unit }}</td>
                @php
                    $unit_pengisian = DB::table('maintenance_unit')
                        ->select()
                        ->where('id', $data->unit_pengisian)
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
                <td>{{ $unit_pengisian->nama }}</td>
                <td>{{ $data->tanggal_pengisian }}</td>
                <td>{{ $data->waktu_pengisian }}</td>
                <td>{{ $data->odo_meter }}</td>
                <td>{{ $data->jumlah_pengisian }}</td>
                <td>{{ $personil1->nama }}</td>
                <td>{{ $personil2->nama }}</td>
                <td>{{ $data->kembalian }}</td>
                <td><a
                        href="http://127.0.0.1:8000/LPBBM/{{ $data->foto_struk }}">http://127.0.0.1:8000/LPBBM/{{ $data->foto_struk }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
