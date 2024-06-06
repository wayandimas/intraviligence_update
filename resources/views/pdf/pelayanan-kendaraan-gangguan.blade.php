<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Pelayanan Kendaraan Gangguan</title>
    <style>
        @page {
            margin: 10 20 10 20;
            size: A4;
            /*or width x height 150mm 50mm*/
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 0;
        }

        .delivery-box {
            max-width: 800px;
            margin: auto;
            font-size: 16px;
            line-height: 24px;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial,
                sans-serif;
            color: #555;
        }

        .underline {
            text-decoration: underline;
        }

        .section-one,
        .section-two,
        .section-three,
        .section-seven {
            border: 1px #000 solid;
            margin: 0px;
            padding: 0px;
            border-collapse: collapse;
        }

        .section-three.end {
            border-bottom: 1px #000 solid;
        }

        span {
            margin-right: 60px;
            border: none;
            borde
        }

        .section-four table,
        .section-four table tr,
        .section-four table tr td,
        .section-five table,
        .section-five table tr,
        .section-five table tr td,
        .section-eight table,
        .section-eight table tr,
        .section-eight table tr td {
            border-collapse: collapse;
            border: 1px #000 solid;
        }

        .section-four table tr td,
        .section-five table tr td,
        .section-eight table tr td {
            padding: 0 5px 2px 5px;
        }

        .text-center {
            text-align: center;
        }

        .section-five {
            margin-top: 10px;
            width: 800px;
        }

        .section-five table {
            margin-right: 60px;
        }

        .section-seven {
            font-style: italic;
            margin-top: 50px;
        }

        .data,
        .judul,
        .isi {
            font-size: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .subJudul {
            font-size: 12px;
            border: 1px solid black;
            border-collapse: collapse;
        }


        .isiNoBorder {
            font-size: 10px;
            border: none;
            border-collapse: collapse;
        }

        .isiNoBorder2 {
            font-size: 10px;
            border: none;
            border-collapse: collapse;
            padding-top: 20px
        }
    </style>

</head>

<body>
    {{-- <h5 style="margin-bottom: 5px">Output Mutasi Kegiatan Harian</h5> --}}

    {{-- @for ($i = 1; $i <= $pages; $i++) --}}
    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="100px" height="25px">
                <img width="80%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="100px" height="25px" style="padding-left: 20px; padding-right: 20px;">
                <h2>Data Kejadian Pelayanan Kendaraan Gangguan Jalan Tol</h2>
            </th>
            <th class="isi" width="100px" height="25px">
                <table>
                    <tr>
                        <td width="100%">No. Dok</td>
                        <td width="5%">: FO-MMN-OJT-03-46</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">Tgl Terbit</td>
                        <td width="5%">: 08/21/2023</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">No. Revisi</td>
                        <td width="5%">: 00</td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>

    </table>
    @php
        $page = count($data);
    @endphp
    @foreach ($data as $key => $data)
        @if ($key > 0 && $key % 2 === 0)
            <div style="page-break-after: always;"></div>
            <table class="data" align="center" width="100%">
                <tr class="judul">
                    <th class="isi" width="100px" height="25px">
                        <img width="80%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
                    </th>
                    <th class="isi" width="100px" height="25px" style="padding-left: 20px; padding-right: 20px;">
                        <h2>Data Kejadian Pelayanan Kendaraan Gangguan Jalan Tol</h2>
                    </th>
                    <th class="isi" width="100px" height="25px">
                        <table>
                            <tr>
                                <td width="100%">No. Dok</td>
                                <td width="5%">:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="100%">Tgl Terbit</td>
                                <td width="5%">:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="100%">No. Revisi</td>
                                <td width="5%">:</td>
                                <td style="overflow: hidden"></td>
                            </tr>
                        </table>
                    </th>
                </tr>
            </table>
        @endif
        @php
            $key = intval($key);
            
        @endphp

        <table class="data" align="center" width="100%">
            <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px">
                Informasi Kejadian {{ $key + 1 }}
            </th>
        </table>
        <table class="data" width="100%">
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Tanggal Kejadian
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    : {{ $data['tanggal_kejadian'] }}
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px" style="padding-left:0px">
                    Stationing (STA)
                </td>
                @php
                    $stasioning = DB::table('stationing')
                        ->select()
                        ->where('id', $data['stationing'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    : {{ $stasioning->nama }}
                </td>


            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Waktu Informasi Diterima
                </td>
                <td class="isiNoBorder">
                    : {{ $data['waktu_kejadian'] }}
                </td>
                <td class="isiNoBorder">
                    Seksi
                </td>
                @php
                    $seksi = DB::table('sections')
                        ->select()
                        ->where('id', $data['seksi'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    : {{ $seksi->nama }}
                </td>
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Waktu Petugas Sampai Lokasi
                </td>
                <td class="isiNoBorder">
                    : {{ $data['waktu_sampai'] }}
                </td>
                @php
                    $jalur = DB::table('tracks')
                        ->select()
                        ->where('id', $data['jalur'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    Jalur
                </td>
                <td class="isiNoBorder">
                    : {{ $jalur->nama }}
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px" style="font-style: italic">
                    Respon Time
                </td>
                <td class="isiNoBorder">
                    : {{ $data['respon_time'] }}
                </td>
                @php
                    $lajur = DB::table('lanes')
                        ->select()
                        ->where('id', $data['lajur'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    Lajur
                </td>
                <td class="isiNoBorder">
                    : {{ $lajur->nama }}
                </td>
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Penyelesaian Tugas
                </td>
                <td class="isiNoBorder">
                    : {{ $data['waktu_selesai'] }}
                </td>
                @php
                    $cuaca = DB::table('weathers')
                        ->select()
                        ->where('id', $data['cuaca'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    Cuaca
                </td>
                <td class="isiNoBorder">
                    : {{ $cuaca->nama }}
                </td>
            </tr>
            <tr>
                @php
                    $jg = DB::table('interferences')
                        ->select()
                        ->where('id', $data['jenis_gangguan'])
                        ->first();
                @endphp
                <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                    Jenis Gangguan
                </td>
                <td class="isiNoBorder2">
                    : {{ $jg->nama }}
                </td>
                <td class="isiNoBorder2">
                    Petugas 1
                </td>
                @php
                    $p1 = DB::table('officers')
                        ->select()
                        ->where('id', $data['personil1'])
                        ->first();
                @endphp
                <td class="isiNoBorder2">
                    : {{ $p1->nama }}
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Golongan Kendaraan
                </td>
                @php
                    $gk = DB::table('vehicle_class')
                        ->select()
                        ->where('id', $data['golongan_kendaraan'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    : {{ $gk->nama }}
                </td>
                @php
                    $p2 = DB::table('officers')
                        ->select()
                        ->where('id', $data['personil2'])
                        ->first();
                @endphp
                <td class="isiNoBorder">
                    Petugas 2
                </td>
                <td class="isiNoBorder">
                    : {{ $p2->nama }}
            </tr>
            <tr>
                @php
                    $jk = DB::table('vehicle_type')
                        ->select()
                        ->where('id', $data['jenis_kendaraan'])
                        ->first();
                @endphp
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Jenis Kendaraan
                </td>
                <td class="isiNoBorder">
                    : {{ $jk->nama }}
                </td>
                <td class="isiNoBorder">
                    Penderekan
                </td>
                <td class="isiNoBorder">
                    : {{ $data['penderekan'] }}
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Nomor Plat Kendaraan
                </td>
                <td class="isiNoBorder">
                    : {{ $data['plat_nomor'] }}
                </td>
                <td class="isiNoBorder">
                    Waktu Informasi Derek Dibutuhkan
                </td>
                <td class="isiNoBorder">
                    : {{ $data['waktu_dibutuhkan'] }}
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Asal
                </td>
                <td class="isiNoBorder">
                    : {{ $data['asal_perjalanan'] }}
                </td>
                <td class="isiNoBorder">
                    Waktu Derek Sampai Lokasi
                </td>
                <td class="isiNoBorder">
                    : {{ $data['waktu_sampai_tkp'] }}
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Tujuan
                </td>
                <td class="isiNoBorder">
                    : {{ $data['tujuan_perjalanan'] }}
                </td>
                <td class="isiNoBorder">
                    Respon Time Penderekan
                </td>
                <td class="isiNoBorder">
                    : {{ $data['respon_time_derek'] }}
            </tr>
        </table>
        <table class="data" width="100%">
            <th class="isiNoBorder" rowspan="1" colspan="1" align="center" width="90px"
                style="font-weight: normal;">
                Keterangan
            </th>
        </table>
        <table class="data" width="100%">
            <th class="isiNoBorder" rowspan="1" colspan="1" width="90px"
                style="height: 15px; padding-top:5px;">
                {{ $data['keterangan'] }}
            </th>
        </table>
        <table class="data" align="center" width="100%">
            <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px">
                Dokumentasi Kejadian {{ $key + 1 }}
            </th>
        </table>
        <table class="data" align="center" width="100%">
            <tr>
                @if (isset($data['image'][0]['nama']))
                    <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="200px"
                        style="height: 110px;">
                        <img src="{{ public_path('LPKG/' . $data['image'][0]['nama']) }}" height="100px">
                    </td>
                @endif
                @if (isset($data['image'][1]['nama']))
                    <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="200px"
                        style="height: 110px;">
                        <img src="{{ public_path('LPKG/' . $data['image'][1]['nama']) }}" height="100px">
                    </td>
                @endif


            </tr>
        </table>
        <table class="data" align="center" width="100%">
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 5px">
                    Dibuat,
                </td>

                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 5px">
                    Diperiksa,
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
                    Disetujui,
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
                    Tembusan:
                </td>
            </tr>
            <tr>
                <td>
                    <table class="data">
                        <tr>
                            <th class="isi" width="175px" height="80px"><img src="{{ public_path($p1->ttd) }}"
                                    height="50px"></th>

                        </tr>
                        <tr>
                            <th class="isi" width="175px" height="10px">{{ $p1->nama }}</th>

                        </tr>
                        <tr>
                            <td class="isiNoBorder" width="175px" height="10px" align="center"
                                style="font-size: 8px"> Petugas</td>

                        </tr>
                    </table>
                </td>
                <td>
                    <table class="data">
                        <tr>
                            <th class="isi" width="175px" height="80px"><img
                                    src="{{ public_path('assets/images/TTD/Staf-Desrianto.png') }}" height="80px">
                            </th>

                        </tr>
                        <tr>
                            <th class="isi" width="175px" height="10px">Desrianto</th>

                        </tr>
                        <tr>
                            <td class="isiNoBorder" width="175px" height="10px" align="center"
                                style="font-size: 8px"> Staff Pelayanan Lalu
                                Lintas
                            </td>

                        </tr>
                    </table>
                </td>
                <td>
                    <table class="data" align="right">
                        <tr>
                            <th class="isi" width="175px" height="80px"> <img
                                    src="{{ public_path('assets/images/TTD/Bambang Haryanto.jpg') }}"
                                    height="80px"></th>

                        </tr>
                        <tr>
                            <th class="isi" width="175px" height="10px">Bambang Haryanto</th>

                        </tr>
                        <tr>
                            <td class="isiNoBorder" width="175px" height="10px" align="center"
                                style="font-size: 8px"> Supervisor Operasional dan Pelayanan Lalu Lintas
                            </td>

                        </tr>
                    </table>
                </td>
                <td>
                    <table class="data" align="right">
                        <tr>
                            <th class="isi" width="175px" height="97px"
                                style="font-weight: normal; font-size:8px;padding-top:10px; vertical-align: top; "
                                align="left">

                                1. Direktur Utama
                                <br>
                                2. Direktur Komersil
                                <br>
                                3. Manajer Operasional
                            </th>

                        </tr>


                    </table>
                </td>
            </tr>
        </table>
    @endforeach
    {{-- @php
       dd($page); 
    @endphp --}}
    @if ($page > 0 && $page % 2 != 0)
        <table class="data" align="center" width="100%">
            <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px">
                Informasi Kejadian
            </th>
        </table>
        <table class="data" width="100%">
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Tanggal Kejadian
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    :
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px" style="padding-left:0px">
                    Stationing (STA)
                </td>

                <td class="isiNoBorder">
                    :
                </td>


            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Waktu Informasi Diterima
                </td>
                <td class="isiNoBorder">
                    :
                </td>
                <td class="isiNoBorder">
                    Seksi
                </td>

                <td class="isiNoBorder">
                    :
                </td>
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Waktu Petugas Sampai Lokasi
                </td>
                <td class="isiNoBorder">
                    :
                </td>

                <td class="isiNoBorder">
                    Jalur
                </td>
                <td class="isiNoBorder">
                    :
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px" style="font-style: italic">
                    Respon Time
                </td>
                <td class="isiNoBorder">
                    :
                </td>

                <td class="isiNoBorder">
                    Lajur
                </td>
                <td class="isiNoBorder">
                    :
                </td>
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Penyelesaian Tugas
                </td>
                <td class="isiNoBorder">
                    :
                </td>

                <td class="isiNoBorder">
                    Cuaca
                </td>
                <td class="isiNoBorder">
                    :
                </td>
            </tr>
            <tr>

                <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                    Jenis Gangguan
                </td>
                <td class="isiNoBorder2">
                    :
                </td>
                <td class="isiNoBorder2">
                    Petugas 1
                </td>

                <td class="isiNoBorder2">
                    :
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Golongan Kendaraan
                </td>

                <td class="isiNoBorder">
                    :
                </td>

                <td class="isiNoBorder">
                    Petugas 2
                </td>
                <td class="isiNoBorder">
                    :
            </tr>
            <tr>

                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Jenis Kendaraan
                </td>
                <td class="isiNoBorder">
                    :
                </td>
                <td class="isiNoBorder">
                    Penderekan
                </td>
                <td class="isiNoBorder">
                    :
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Nomor Plat Kendaraan
                </td>
                <td class="isiNoBorder">
                    :
                </td>
                <td class="isiNoBorder">
                    Waktu Informasi Derek Dibutuhkan
                </td>
                <td class="isiNoBorder">
                    :
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Asal
                </td>
                <td class="isiNoBorder">
                    :
                </td>
                <td class="isiNoBorder">
                    Waktu Derek Sampai Lokasi
                </td>
                <td class="isiNoBorder">
                    :
            </tr>
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Tujuan
                </td>
                <td class="isiNoBorder">
                    :
                </td>
                <td class="isiNoBorder">
                    Respon Time Penderekan
                </td>
                <td class="isiNoBorder">
                    :
            </tr>
        </table>
        <table class="data" width="100%">
            <th class="isiNoBorder" rowspan="1" colspan="1" align="center" width="90px"
                style="font-weight: normal;">
                Keterangan
            </th>
        </table>
        <table class="data" width="100%">
            <th class="isiNoBorder" rowspan="1" colspan="1" width="90px"
                style="height: 15px; padding-top:5px;">

            </th>
        </table>
        <table class="data" align="center" width="100%">
            <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px">
                Dokumentasi Kejadian
            </th>
        </table>
        <table class="data" align="center" width="100%">
            <tr>
                {{-- @if (isset($data['image'][0]['nama'])) --}}
                <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="200px"
                    style="height: 110px;">
                    {{-- <img src="{{ public_path('LPKG/'.$data['image'][0]['nama']) }}" height="100px" > --}}
                </td>
                {{-- @endif --}}
                {{-- @if (isset($data['image'][1]['nama'])) --}}
                <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="200px"
                    style="height: 110px;">
                    {{-- <img src="{{ public_path('LPKG/'.$data['image'][1]['nama']) }}" height="100px" > --}}
                </td>
                {{-- @endif --}}


            </tr>
        </table>
        <table class="data" align="center" width="100%">
            <tr>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 5px">
                    Dibuat,
                </td>

                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 5px">
                    Diperiksa,
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
                    Disetujui,
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
                    Tembusan:
                </td>
            </tr>
            <tr>
                <td>
                    <table class="data">
                        <tr>
                            <th class="isi" width="175px" height="80px"></th>

                        </tr>
                        <tr>
                            <th class="isi" width="175px" height="10px"></th>

                        </tr>
                        <tr>
                            <td class="isiNoBorder" width="175px" height="10px" align="center"
                                style="font-size: 8px"> Petugas</td>

                        </tr>
                    </table>
                </td>
                <td>
                    <table class="data">
                        <tr>
                            <th class="isi" width="175px" height="80px"></th>

                        </tr>
                        <tr>
                            <th class="isi" width="175px" height="10px">Desrianto</th>

                        </tr>
                        <tr>
                            <td class="isiNoBorder" width="175px" height="10px" align="center"
                                style="font-size: 8px"> Staff Pelayanan Lalu
                                Lintas
                            </td>

                        </tr>
                    </table>
                </td>
                <td>
                    <table class="data" align="right">
                        <tr>
                            <th class="isi" width="175px" height="80px"></th>

                        </tr>
                        <tr>
                            <th class="isi" width="175px" height="10px">Bambang Haryanto</th>

                        </tr>
                        <tr>
                            <td class="isiNoBorder" width="175px" height="10px" align="center"
                                style="font-size: 8px"> Supervisor Operasional dan Pelayanan Lalu Lintas
                            </td>

                        </tr>
                    </table>
                </td>
                <td>
                    <table class="data" align="right">
                        <tr>
                            <th class="isi" width="175px" height="97px"
                                style="font-weight: normal; font-size:8px;padding-top:10px; vertical-align: top; "
                                align="left">

                                1. Direktur Utama
                                <br>
                                2. Direktur Komersil
                                <br>
                                3. Manajer Operasional
                            </th>

                        </tr>


                    </table>
                </td>
            </tr>
        </table>
    @endif
</body>

</html>
