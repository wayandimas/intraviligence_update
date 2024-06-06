<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Log Kelengkapan Kendaraan Derek Besar</title>

    <style>
        @page {
            margin: 10 20 10 20;
            size: 210mm 360mm;
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
            line-height: 22px;
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
            font-size: 8px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .subJudul {
            font-size: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }


        .isiNoBorder {
            font-size: 8px;
            border: none;
            border-collapse: collapse;
        }

        .isiNoBorder2 {
            font-size: 8px;
            border: none;
            border-collapse: collapse;
            padding-top: 20px
        }
    </style>
    {{-- @php
        // dd(count($data));
    @endphp --}}
</head>

<body>
    {{-- <h5 style="margin-bottom: 5px">Output Mutasi Kegiatan Harian</h5> --}}

    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="40px" height="25px" rowspan="2">
                <img width="60%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="100px" height="25px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1">
                <h2>FORM</h2>
            </th>
            <th class="isi" width="100px" height="25px" rowspan="2">
                <table>
                    <tr>
                        <td width="100%">No. Dok</td>
                        <td width="5%">: FO-MMN-OJT-03-28</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">Tgl Terbit</td>
                        <td width="5%">:01/07/2019</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">No. Rev</td>
                        <td width="5%">: 01</td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>
        <tr align="center">
            <th rowspan="1" class="isi">
                <h2> LOG KELENGKAPAN DEREK BESAR</h2>
            </th>

        </tr>
    </table>
    @php
        // dd();
        use Carbon\Carbon;
        setlocale(LC_TIME, 'id_ID');
        $datas = DB::table('derek_kecil_vehicle_log')
            ->select()
            ->where('id', $data[0]['id'])
            ->first();
        // dd($datas);
        $createdAt = Carbon::parse($datas->created_at);
        $hari = $createdAt->translatedFormat('l');
        // $bulan = $createdAt->translatedFormat('F');
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
        // $bulanIndonesia = $namaBulan[$bulan];
        $tanggal = $createdAt->format('d/m/Y');
    @endphp
    <table class="data" width="100%">
        <tr class="judul">
            <th class="isi" width="150px" height="25px" rowspan="3" align="left">
                <h3>Hari : {{ $hariIndonesia }}</h3>
                <h3>Tgl : {{ $tanggal }} </h3>
                <h3>KM :{{ $data[0]['km_awal'] }} </h3>
            </th>
            @for ($i = 1; $i <= 3; $i++)
                <th class="isi" width="100px" height="25px"
                    style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="4">
                    <h3>Shift {{ $i }}</h3>
                </th>
                <th class="isi" width="80px" height="25px"rowspan="3">
                    <h3>KET</h3>
                </th>
            @endfor


        <tr align="center">
            @for ($i = 0; $i < 3; $i++)
                <td colspan="2" class="isi">
                    <h3>Status</h3>
                </td>
                <td colspan="2" class="isi">
                    <h3>Kondisi</h3>
                </td>
            @endfor
        </tr>
        <tr align="center">
            @for ($i = 0; $i < 3; $i++)
                <td colspan="1" class="isi">
                    <h3>Ada</h3>
                </td>
                <td colspan="1" class="isi">
                    <h3>T.Ada</h3>
                </td>
                <td colspan="1" class="isi">
                    <h3>Baik</h3>
                </td>
                <td colspan="1" class="isi">
                    <h3>Rusak</h3>
                </td>
            @endfor
        </tr>

    </table>
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>BAGIAN RODA DAN BAN</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 22px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px;">
            </td>
            <td colspan="1" class="isi" style="width: 23.5px;">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px;">
            </td>
            </th>

            <th class="isi" width="100px" height="15px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
            </th>
        @endfor

    </table>
    @php
        $component = DB::table('components')
            ->select()
            ->where('categori_id', 27)
            ->get();
        $id = 1;
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 199)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 194)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kanan_depan'] == 1)
                        <td class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <td class="isi" style="width: 23.5px;"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_roda_ban'] }}
                        </th>
                    @elseif ($data[$i]['ban_kanan_depan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_roda_ban'] }}
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_roda_ban'] }}
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 195)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kanan_belakang'] == 1)
                        <td class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <td class="isi" style="width: 23.5px;"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @elseif ($data[$i]['ban_kanan_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 196)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kiri_depan'] == 1)
                        <td class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <td class="isi" style="width: 23.5px;"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @elseif ($data[$i]['ban_kiri_depan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="10px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="10px" alt="">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 197)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kiri_belakang'] == 1)
                        <td class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <td class="isi" style="width: 23.5px;"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td class="isi" style="width: 27.5px;"align="center">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @elseif ($data[$i]['ban_kiri_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">

                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 198)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_serep'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['ban_serep'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width:23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach

    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>BAGIAN DALAM</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 22px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            <td colspan="1" class="isi" style="width: 23.5px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            </th>

            <th class="isi" width="100px" height="15px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
            </th>
        @endfor

    </table>
    @php
        $component = DB::table('components')
            ->select()
            ->where('categori_id', 28)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 215)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 200)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['stnk'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_bagian_dalam'] }}
                        </th>
                    @elseif ($data[$i]['stnk'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_bagian_dalam'] }}
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_bagian_dalam'] }}
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 201)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_dashboard'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['lampu_dashboard'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 202)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_depan'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['lampu_depan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 203)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_belakang'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 204)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_rem'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_rem'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 205)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_sein'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_sein'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 206)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_mundur'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_mundur'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 207)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_kabut'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_kabut'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 208)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_strobo'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_strobo'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 209)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_sorot'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_sorot'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 210)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_conditioner'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['air_conditioner'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif

            @if ($component->id == 211)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['klakson'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['klakson'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 212)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['wiper'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['wiper'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 213)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['seat_belt'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['seat_belt'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 214)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['apar'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['apar'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>PERALATAN</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 22px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            <td colspan="1" class="isi" style="width: 23.5px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            </th>

            <th class="isi" width="100px" height="15px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
            </th>
        @endfor

    </table>
    @php
        $component = DB::table('components')
            ->select()
            ->where('categori_id', 29)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 233)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">

            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>

            @if ($component->id == 216)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['balok'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['balok'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_peralatan'] }}</th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 217)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['p3k'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['p3k'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 218)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['katrol'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['katrol'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 219)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['dongkrak_hidrolik_20_ton'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['dongkrak_hidrolik_20_ton'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 220)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kunci_shock'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['kunci_shock'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 221)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kunci_moment'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['kunci_moment'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 222)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kunci_pipa'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['kunci_pipa'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 223)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['rantai_m'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['rantai_m'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 224)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['tali_sling'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['tali_sling'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 225)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['rantai_besi'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['rantai_besi'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 226)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['segel'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['segel'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 227)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['selang_kompresor'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['selang_kompresor'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 228)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['helm'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['helm'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 229)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['jas_hujan'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['jas_hujan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 230)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sarung_tangan'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['sarung_tangan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 231)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sepatu_boat'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['sepatu_boat'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 232)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['senter_charge'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['senter_charge'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach

    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>MESIN</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 22px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            <td colspan="1" class="isi" style="width: 23.5px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            </th>

            <th class="isi" width="100px" height="15px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
            </th>
        @endfor

    </table>
    @php
        $component = DB::table('components')
            ->select()
            ->where('categori_id', 30)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 241)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 234)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['engine_condition'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['engine_condition'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_engine'] }}</th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 235)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['running_test'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['running_test'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 237)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_radiator'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['air_radiator'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 236)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_accu'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['air_accu'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 238)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oli_mesin'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['oli_mesin'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 239)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['minyak_rem'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['minyak_rem'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 240)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oil_power_steering'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['oil_power_steering'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>BODY & CAT</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 22px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            <td colspan="1" class="isi" style="width: 23.5px">
            </td>
            <td colspan="1" class="isi" style="width: 27.5px">
            </td>
            </th>

            <th class="isi" width="100px" height="15px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
            </th>
        @endfor

    </table>
    @php
        $component = DB::table('components')
            ->select()
            ->where('categori_id', 31)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 247)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 242)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['samping_kiri'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['samping_kiri'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_body_cat'] }}</th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 243)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['samping_kanan'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['samping_kanan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 244)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['depan'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['depan'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 245)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['belakang'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 246)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['atas'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['atas'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i < 3; $i++)
                    <td colspan="1" class="isi" style="width: 22px">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px;">
                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px;">
                    </td>
                    </th>

                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach

    <table class="data" align="center" width="100%">
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                style="padding-top: 22px; padding-left:80px;margin-left:80px;">
                <h3>Mengetahui,</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px" style="padding-top: 22px">
                <h3>Petugas Shift I</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"style="padding-top: 22px">
                <h3>Petugas Shift II</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"style="padding-top: 22px">
                <h3>Petugas Shift III</h3>
            </td>
        </tr>
        <tr>
            @if (count($data) == 3)
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 5px; padding-left:80px;">
                    <img src="{{ public_path('assets/images/TTD/Staf-Desrianto.png') }}" height="50px"
                        width="50px" alt="">
                </td>
            @else
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 5px; padding-left:80px;">
                    <img src="" height="50px" width="50px" alt="">
                </td>
            @endif


            @php
                // dd($data[0]['personil']);
                $p = DB::table('officers')
                    ->select()
                    ->where('id', $data[0]['personil'])
                    ->first();
                if (count($data) == 2) {
                    $p2 = DB::table('officers')
                        ->select()
                        ->where('id', $data[1]['personil'])
                        ->first();
                }
                if (count($data) == 3) {
                    $p2 = DB::table('officers')
                        ->select()
                        ->where('id', $data[1]['personil'])
                        ->first();
                    $p3 = DB::table('officers')
                        ->select()
                        ->where('id', $data[2]['personil'])
                        ->first();
                }
            @endphp
            @if (count($data) == 1)
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    <img src="{{ public_path($p->ttd) }}" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    {{-- <img src="{{ public_path($p->ttd) }}" height="50px" width="50px" alt=""> --}}
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    {{-- <img src="{{ public_path($p->ttd) }}" height="50px" width="50px" alt=""> --}}
                </td>
            @endif
            @if (count($data) == 2)
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    <img src="{{ public_path($p->ttd) }}" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    <img src="{{ public_path($p2->ttd) }}" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    {{-- <img src="{{ public_path($p3->ttd ?? '') }}" height="50px" width="50px" alt=""> --}}
                </td>
            @endif
            @if (count($data) == 3)
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    <img src="{{ public_path($p->ttd) }}" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    <img src="{{ public_path($p2->ttd) }}" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                    style="padding-top: 22px">
                    <img src="{{ public_path($p3->ttd) }}" height="50px" width="50px" alt="">
                </td>
            @endif
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"
                style="padding-top: 5px; padding-left:80px;">
                <h3>Desrianto</h3>
            </td>

            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px" style="padding-top: 5px">
                <h3>{{ $p->nama }}</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px" style="padding-top: 5px">
                <h3>{{ $p2->nama ?? '' }}</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px" style="padding-top: 5px">
                <h3>{{ $p3->nama ?? '' }}</h3>
            </td>

        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px" style="padding-left:80px;">
                <h3>Staf Pengendalian Lalin</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 5px">
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"style="padding-top: 5px">
            </td>



        </tr>

    </table>
</body>

</html>
