<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Log Kelengkapan Medis Ambulance</title>

    <style>
        @page {
            margin: 10 20 10 20;
            size: 210mm 330mm;
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
            margin-top: 15px;
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
            font-size: 15px;
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
                        <td width="5%">: FO-MMN-OJT-03-41</td>
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
                <h2> LOG KELENGKAPAN MEDIS</h2>
            </th>

        </tr>
    </table>
    @php
        // dd();
        use Carbon\Carbon;
        setlocale(LC_TIME, 'id_ID');
        $datas = DB::table('medical_equipment_log')
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
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>AMBULANCE</h3>
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
            ->where('categori_id', 25)
            ->get();
        $id = 1;
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 177)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 156)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['cairan_nacl'] == 1)
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
                            {{ $data[$i]['ket_peralatan_medis'] }}
                        </th>
                    @elseif ($data[$i]['cairan_nacl'] == 2)
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
                            {{ $data[$i]['ket_peralatan_medis'] }}
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
                            {{ $data[$i]['ket_peralatan_medis'] }}
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 157)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['nirbekken'] == 1)
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
                    @elseif ($data[$i]['nirbekken'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 158)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['pinset_anatomi'] == 1)
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
                    @elseif ($data[$i]['pinset_anatomi'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 159)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sunction_manual'] == 1)
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
                    @elseif ($data[$i]['sunction_manual'] == 2)
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
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 160)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['tabung_o2'] == 1)
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
                    @elseif ($data[$i]['tabung_o2'] == 2)
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
            @if ($component->id == 161)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['tandu_skop'] == 1)
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
                    @elseif ($data[$i]['tandu_skop'] == 2)
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
            @if ($component->id == 162)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['brangkar'] == 1)
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
                    @elseif ($data[$i]['brangkar'] == 2)
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
            @if ($component->id == 163)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kantong_mayat'] == 1)
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
                    @elseif ($data[$i]['kantong_mayat'] == 2)
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
            @if ($component->id == 164)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['betadine'] == 1)
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
                    @elseif ($data[$i]['betadine'] == 2)
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
            @if ($component->id == 165)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['alcohol'] == 1)
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
                    @elseif ($data[$i]['alcohol'] == 2)
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
            @if ($component->id == 166)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kasa_steril'] == 1)
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
                    @elseif ($data[$i]['kasa_steril'] == 2)
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
            @if ($component->id == 167)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['perban_elastis'] == 1)
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
                    @elseif ($data[$i]['perban_elastis'] == 2)
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
            @if ($component->id == 168)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kapas'] == 1)
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
                    @elseif ($data[$i]['kapas'] == 2)
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
            @if ($component->id == 169)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['handskun'] == 1)
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
                    @elseif ($data[$i]['handskun'] == 2)
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
            @if ($component->id == 170)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['selang_o2'] == 1)
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
                    @elseif ($data[$i]['selang_o2'] == 2)
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
            @if ($component->id == 171)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['extrication_collar'] == 1)
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
                    @elseif ($data[$i]['extrication_collar'] == 2)
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
            @if ($component->id == 172)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['bidai_tiup'] == 1)
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
                    @elseif ($data[$i]['bidai_tiup'] == 2)
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
            @if ($component->id == 173)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['masker'] == 1)
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
                    @elseif ($data[$i]['masker'] == 2)
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
            @if ($component->id == 174)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['gunting'] == 1)
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
                    @elseif ($data[$i]['gunting'] == 2)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
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
            @if ($component->id == 175)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['plester'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['plester'] == 2)
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
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
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
            @if ($component->id == 176)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ambu_bag_masker'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['ambu_bag_masker'] == 2)
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
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
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
            <h3>RUANG MEDIS</h3>
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
            ->where('categori_id', 26)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 193)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 178)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['alat_sterilisator'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_ruang_medis'] }}
                        </th>
                    @elseif ($data[$i]['alat_sterilisator'] == 2)
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
                            colspan="3">
                            {{ $data[$i]['ket_ruang_medis'] }}
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 22px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_ruang_medis'] }}
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 179)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['tempat_tidur_pasien'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['tempat_tidur_pasien'] == 2)
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
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 180)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kantong_mayat_medis'] == 1)
                        <td colspan="1" class="isi" style="width: 22px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 23.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['kantong_mayat_medis'] == 2)
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
                        <td colspan="1" class="isi" style="width: 27.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
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
            @if ($component->id == 181)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['tensi_meter'] == 1)
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
                    @elseif ($data[$i]['tensi_meter'] == 2)
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
            @if ($component->id == 182)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['stetescop'] == 1)
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
                    @elseif ($data[$i]['stetescop'] == 2)
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
            @if ($component->id == 183)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kotak_p3k'] == 1)
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
                    @elseif ($data[$i]['kotak_p3k'] == 2)
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
            @if ($component->id == 184)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['gunting_plester'] == 1)
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
                    @elseif ($data[$i]['gunting_plester'] == 2)
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
            @if ($component->id == 185)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['clem'] == 1)
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
                    @elseif ($data[$i]['clem'] == 2)
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
            @if ($component->id == 186)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kasa_steril_medis'] == 1)
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
                    @elseif ($data[$i]['kasa_steril_medis'] == 2)
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
            @if ($component->id == 187)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kasa_gulung'] == 1)
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
                    @elseif ($data[$i]['kasa_gulung'] == 2)
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
            @if ($component->id == 188)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['cairan_nacl_medis'] == 1)
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
                    @elseif ($data[$i]['cairan_nacl_medis'] == 2)
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

            @if ($component->id == 189)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kapas_medis'] == 1)
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
                    @elseif ($data[$i]['kapas_medis'] == 2)
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
            @if ($component->id == 190)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['hipafix'] == 1)
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
                    @elseif ($data[$i]['hipafix'] == 2)
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
            @if ($component->id == 191)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['tabung_o2_medis'] == 1)
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
                    @elseif ($data[$i]['tabung_o2_medis'] == 2)
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
            @if ($component->id == 192)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['betadine_medis'] == 1)
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
                    @elseif ($data[$i]['betadine_medis'] == 2)
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
