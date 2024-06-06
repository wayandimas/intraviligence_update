<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Log Kelengkapan Kendaraan Rescue</title>

    <style>
        @page {
            margin: 10 20 10 20;
            size: 210mm 450mm;
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
            <th class="isi" width="40px" height="23.5px" rowspan="2">
                <img width="60%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="100px" height="23.5px"
                style="padding-left: 20px; padding-right: 20px;"rowspan="1">
                <h2>FORM</h2>
            </th>
            <th class="isi" width="100px" height="23.5px" rowspan="2">
                <table>
                    <tr>
                        <td width="100%">No. Dok</td>
                        <td width="5%">: FO/OJT/03/40</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">Tgl Terbit</td>
                        <td width="5%">: 03/03/2019</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">No. Rev</td>
                        <td width="5%">: 00</td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>
        <tr align="center">
            <th rowspan="1" class="isi">
                <h2> LOG KELENGKAPAN RESCUE</h2>
            </th>

        </tr>
    </table>
    @php
        // dd();
        use Carbon\Carbon;
        setlocale(LC_TIME, 'id_ID');
        $datas = DB::table('rescue_vehicle_log')
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
            <th class="isi" width="150px" height="23.5px" rowspan="3" align="left">
                <h3>Hari : {{ $hariIndonesia }}</h3>
                <h3>Tgl : {{ $tanggal }} </h3>
                <h3>KM :{{ $data[0]['km_awal'] }} </h3>
            </th>
            @for ($i = 1; $i <= 3; $i++)
                <th class="isi" width="100px" height="23.5px"
                    style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="4">
                    <h3>Shift {{ $i }}</h3>
                </th>
                <th class="isi" width="80px" height="23.5px"rowspan="3">
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
        <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1">
            <h3>A. BAGIAN RODA DAN BAN</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 22.0px">
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
            ->where('categori_id', 13)
            ->get();
        $id = 1;
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 253)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 248)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kanan_depan'] == 1)
                        <td class="isi" style="width: 22.0px" align="center">
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
                        <td colspan="1" class="isi" style="width: 22.0px" align="center">
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 249)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kanan_belakang'] == 1)
                        <td class="isi" style="width: 22.0px" align="center">
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
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                    @elseif ($data[$i]['ban_kanan_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 22.0px" align="center">
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 250)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kiri_depan'] == 1)
                        <td class="isi" style="width: 22.0px" align="center">
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
                        <td colspan="1" class="isi" style="width: 22.0px" align="center">
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 251)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kiri_belakang'] == 1)
                        <td class="isi" style="width: 22.0px" align="center">
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
                        <td colspan="1" class="isi" style="width: 22.0px" align="center">
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 252)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach

    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1">
            <h3>B. BAGIAN DALAM</h3>
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
            ->where('categori_id', 14)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 263)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 254)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 255)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 256)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 257)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 258)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 259)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_ruangan'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_ruangan'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 260)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 261)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 262)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1">
            <h3>C. PERALATAN</h3>
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
            ->where('categori_id', 15)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 284)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">

            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 264)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['mobile_power_unit'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['mobile_power_unit'] == 2)
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
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_peralatan'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 265)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['spreaders'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['spreaders'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 266)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['cutters'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['cutters'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 267)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['rescue_rams'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                    @elseif ($data[$i]['rescue_rams'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 268)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lrc_ram'] == 1)
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
                    @elseif ($data[$i]['lrc_ram'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 269)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['hose_extention'] == 1)
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
                    @elseif ($data[$i]['hose_extention'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 270)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['vetter_air_liftingbag'] == 1)
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
                    @elseif ($data[$i]['vetter_air_liftingbag'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 271)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['vetter_air_attack'] == 1)
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
                    @elseif ($data[$i]['vetter_air_attack'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 272)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_cylinder'] == 1)
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
                    @elseif ($data[$i]['air_cylinder'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 273)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['spring_loaded'] == 1)
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
                    @elseif ($data[$i]['spring_loaded'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 274)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['pressure_regulator'] == 1)
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
                    @elseif ($data[$i]['pressure_regulator'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 275)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['controller'] == 1)
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
                    @elseif ($data[$i]['controller'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 276)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['hydrant_portable'] == 1)
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
                    @elseif ($data[$i]['hydrant_portable'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 277)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['gasoline_cans'] == 1)
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
                    @elseif ($data[$i]['gasoline_cans'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 278)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['chainset'] == 1)
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
                    @elseif ($data[$i]['chainset'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 279)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['fire_hose'] == 1)
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
                    @elseif ($data[$i]['fire_hose'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 280)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['nossel'] == 1)
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
                    @elseif ($data[$i]['nossel'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 281)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['water_hose'] == 1)
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
                    @elseif ($data[$i]['water_hose'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 282)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['generator_krisbow'] == 1)
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
                    @elseif ($data[$i]['generator_krisbow'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 283)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_sorot_krisbow'] == 1)
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
                    @elseif ($data[$i]['lampu_sorot_krisbow'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif

        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1">
            <h3>D. PERALATAN TAMBAHAN</h3>
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
            ->where('categori_id', 16)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 301)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 285)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_strobo'] == 1)
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
                    @elseif ($data[$i]['lampu_strobo'] == 2)
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
                        {{ $data[$i]['ket_peralatan_tambahan'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 286)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['public_adress'] == 1)
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
                    @elseif ($data[$i]['public_adress'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 287)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['raincoat'] == 1)
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
                    @elseif ($data[$i]['raincoat'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 288)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['bottle_jack'] == 1)
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
                    @elseif ($data[$i]['bottle_jack'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 289)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['cable_cutter'] == 1)
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
                    @elseif ($data[$i]['cable_cutter'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 290)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['apar_6kg'] == 1)
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
                    @elseif ($data[$i]['apar_6kg'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 291)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['apar_9kg'] == 1)
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
                    @elseif ($data[$i]['apar_9kg'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 292)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['safety_line'] == 1)
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
                    @elseif ($data[$i]['safety_line'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 293)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['first_aid'] == 1)
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
                    @elseif ($data[$i]['first_aid'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 294)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['thermal_blanket'] == 1)
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
                    @elseif ($data[$i]['thermal_blanket'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 295)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kunci_roda'] == 1)
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
                    @elseif ($data[$i]['kunci_roda'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 296)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['cribing'] == 1)
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
                    @elseif ($data[$i]['cribing'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 297)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['jerry_water'] == 1)
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
                    @elseif ($data[$i]['jerry_water'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 298)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['parking_chock'] == 1)
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
                    @elseif ($data[$i]['parking_chock'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 299)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['webing_sling'] == 1)
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
                    @elseif ($data[$i]['webing_sling'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 300)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oil_absorbent'] == 1)
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
                    @elseif ($data[$i]['oil_absorbent'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1">
            <h3>E. PERSOLAN PROTECTION EQUIPMENT</h3>
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
            ->where('categori_id', 17)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 314)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 302)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['safety_glove'] == 1)
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
                    @elseif ($data[$i]['safety_glove'] == 2)
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
                        {{ $data[$i]['ket_personal_protection'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 303)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['safety_boots'] == 1)
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
                    @elseif ($data[$i]['safety_boots'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 304)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['safety_glasses'] == 1)
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
                    @elseif ($data[$i]['safety_glasses'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 305)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['headlamp'] == 1)
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
                    @elseif ($data[$i]['headlamp'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 306)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['helm_safety'] == 1)
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
                    @elseif ($data[$i]['helm_safety'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 307)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['apron'] == 1)
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
                    @elseif ($data[$i]['apron'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 308)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['knee'] == 1)
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
                    @elseif ($data[$i]['knee'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 309)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['faceshild'] == 1)
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
                    @elseif ($data[$i]['faceshild'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 310)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['goggles'] == 1)
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
                    @elseif ($data[$i]['goggles'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 311)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['single_mask'] == 1)
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
                    @elseif ($data[$i]['single_mask'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 312)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['flip_cover'] == 1)
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
                    @elseif ($data[$i]['flip_cover'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 313)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['fire_boots'] == 1)
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
                    @elseif ($data[$i]['fire_boots'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif

        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1">
            <h3>F. ENGINE</h3>
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
            ->where('categori_id', 18)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 320)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 315)
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
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_engine'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 316)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 317)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oil'] == 1)
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
                    @elseif ($data[$i]['oil'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 318)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 319)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 22px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 27.5px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                    </th>
                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
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
