<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Log Kelengkapan Kendaraan Patroli</title>

    <style>
        @page {
            margin: 10 20 10 20;
            size: 215mm 400mm;
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
                        <td width="5%">: FO-MMN-OJT-03-43</td>
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
                <h2> LOG KELENGKAPAN PATROLI</h2>
            </th>

        </tr>
    </table>
    @php
        // dd();
        use Carbon\Carbon;
        setlocale(LC_TIME, 'id_ID');
        $datas = DB::table('patroli_vehicle_log')
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
        $tanggal = $createdAt->format('d-m-Y');
    @endphp
    <table class="data" width="100%">
        <tr class="judul">
            <th class="isi" width="150px" height="25px" rowspan="3" align="left">
                <h3>Unit : {{ $data[0]['unit'] }}</h3>
                <h3>Hari/Tgl : {{ $hariIndonesia }}/{{ $tanggal }}</h3>
                <h3>KM : {{ $data[0]['km_awal'] }}</h3>
            </th>
            @for ($i = 1; $i <= 3; $i++)
                <th class="isi" width="100px" height="25px"
                    style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="4">
                    <h3>Shift {{ $i }}</h3>
                </th>
                <th class="isi" width="40px" height="25px"rowspan="3">
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
            <h3>BAGIAN BAN</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 37px">

            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 37.5px">
            </td>
            <td colspan="1" class="isi" style="width: 35.5px">
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
            ->where('categori_id', 1)
            ->get();
        $id = 1;
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 7)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 1)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kanan_depan'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_roda_ban'] }}
                        </th>
                    @elseif ($data[$i]['ban_kanan_depan'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_roda_ban'] }}
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_roda_ban'] }}
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 2)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kanan_belakang'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @elseif ($data[$i]['ban_kanan_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 3)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kiri_depan'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @elseif ($data[$i]['ban_kiri_depan'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">

                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 4)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_kiri_belakang'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['ban_kiri_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 5)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['ban_serep'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['ban_serep'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 6)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['velg_roda_drop'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['velg_roda_drop'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px" height="15px"
                            style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
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
            <td colspan="1" class="isi" style="width: 37px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 37.5px">
            </td>
            <td colspan="1" class="isi" style="width: 35.5px">
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
            ->where('categori_id', 2)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 32)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 15)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['stnk'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_bagian_dalam'] }}
                        </th>
                    @elseif ($data[$i]['stnk'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_bagian_dalam'] }}
                        </th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3">
                            {{ $data[$i]['ket_bagian_dalam'] }}
                        </th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 16)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_dashboard'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['lampu_dashboard'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1" colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 17)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_depan'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px"align="center">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @elseif ($data[$i]['lampu_depan'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>
                        </th>
                        <th class="isi" width="100px"
                            height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                            colspan="3"></th>
                    @endif
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 18)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_belakang'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 19)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_rem'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_rem'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 20)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_sein'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_sein'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 21)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_mundur'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['lampu_mundur'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 22)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['radio_tape'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['radio_tape'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 23)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_conditioner'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['air_conditioner'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 24)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sandaran_kepala'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['sandaran_kepala'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 25)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['karpet'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['karpet'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 26)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sarung_jok'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['sarung_jok'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 27)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['klakson'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['klakson'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 28)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['wiper'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['wiper'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 29)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['speaker'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['speaker'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 30)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['power_window'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['power_window'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 31)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['seat_belt'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['seat_belt'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
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
            <td colspan="1" class="isi" style="width: 37px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 37.5px">
            </td>
            <td colspan="1" class="isi" style="width: 35.5px">
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
            ->where('categori_id', 3)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 50)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">

            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 47)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['kunci_roda'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 37.5px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 35.5px" align="center"></td>
                    @elseif ($data[$i]['kunci_roda'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_peralatan'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 48)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['dongkrak'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['dongkrak'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 49)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['p3k'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['p3k'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif

        </table>
    @endforeach
    <table class="data" width="100%">
        <th class="isiNoBorder" width="150px" height="15px" align="center" rowspan="1">
            <h3>PERALATAN TAMBAHAN</h3>
        </th>
        @for ($i = 0; $i < 3; $i++)
            <td colspan="1" class="isi" style="width: 37px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
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
            ->where('categori_id', 4)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 80)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 62)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['public_adress'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['public_adress'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_peralatan_tambahan'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 63)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_strobo'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['lampu_strobo'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 64)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['lampu_sorot'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['lampu_sorot'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 65)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['apar'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['apar'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 66)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['rubber_cone'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['rubber_cone'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 67)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['rambu_tanda_seru'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['rambu_tanda_seru'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 68)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['rambu_petunjuk_arah'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['rambu_petunjuk_arah'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 69)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['bendera'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['bendera'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 70)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oil_absorbent'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['oil_absorbent'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 71)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['senter_charger'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['senter_charger'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 72)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sepatu_boat'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['sepatu_boat'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 73)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['jas_hujan'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['jas_hujan'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 74)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['senter_lalin'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['senter_lalin'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 75)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['safety_glasess'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['safety_glasess'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 76)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['helm'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['helm'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 77)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['safety_gloves'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['safety_gloves'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 78)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sekop'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['sekop'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 79)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['sapu_lidi'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['sapu_lidi'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
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
            <td colspan="1" class="isi" style="width: 37px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
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
            ->where('categori_id', 5)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 93)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 87)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['engine_condition'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['engine_condition'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_engine'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 88)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_accu'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['air_accu'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 89)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['air_radiator'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['air_radiator'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 90)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oli_mesin'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['oli_mesin'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 91)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['minyak_rem'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['minyak_rem'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 92)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['oil_power_steering'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['oil_power_steering'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
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
            <td colspan="1" class="isi" style="width: 37px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
            </td>
            <td colspan="1" class="isi" style="width: 36px">
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
            ->where('categori_id', 6)
            ->get();
    @endphp
    @foreach ($component as $component)
        @if ($component->id == 108)
            @php
                continue;
            @endphp
        @endif
        <table class="data" width="100%">
            <th class="isiNoBorder" width="150px" height="15px" align="left" rowspan="1"
                style="font-weight: normal">
                {{ $component->nama }}
            </th>
            @if ($component->id == 103)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['samping_kiri'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['samping_kiri'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3">
                        {{ $data[$i]['ket_body_cat'] }}</th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 104)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['samping_kanan'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['samping_kanan'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 105)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['depan'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['depan'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 106)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['belakang'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['belakang'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

                    <th class="isi" width="100px"
                        height="15px"style="padding-left: 20px; padding-right: 20px;"rowspan="1"
                        colspan="3">
                    </th>
                @endfor
            @endif
            @if ($component->id == 107)
                @for ($i = 0; $i <= count($data) - 1; $i++)
                    @if ($data[$i]['atas'] == 1)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @elseif ($data[$i]['atas'] == 2)
                        <td colspan="1" class="isi" style="width: 37px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                    @else
                        <td colspan="1" class="isi" style="width: 37px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center">
                            <img src="{{ public_path('assets/admin/check.png') }}" height="15px"
                                alt="">
                        </td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                        <td colspan="1" class="isi" style="width: 36px" align="center"></td>
                    @endif
                    <th class="isi" width="100px" height="15px"
                        style="padding-left: 20px; padding-right: 20px;" rowspan="1" colspan="3"></th>
                @endfor
                @for ($i = count($data); $i <= 3 - 1; $i++)
                    <td colspan="1" class="isi" style="width: 37px" align="center">

                    </td>
                    <td colspan="1" class="isi" style="width: 36px" align="center">
                    </td>
                    <td colspan="1" class="isi" style="width: 37.5px" align="center"></td>
                    <td colspan="1" class="isi" style="width: 35.5px"align="center"></td>

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
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                style="padding-top: 30px; padding-left:20px;">
                <h3>Mengetahui,</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px" style="padding-top: 30px">
                <h3>Petugas Shift I</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"style="padding-top: 30px">
                <h3>Petugas Shift II</h3>
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="2" width="100px"style="padding-top: 30px">
                <h3>Petugas Shift III</h3>
            </td>
        </tr>
        <tr>
            @if (count($data) == 3)
                <td class="isiNoBorder" colspan="1" width="100px"
                    style="padding-top: 5px; padding-left:20px;">
                    <img src="{{ public_path('assets/images/TTD/Staf-Desrianto.png') }}" height="50px"
                        width="50px" alt="">
                </td>
            @else
                <td class="isiNoBorder" colspan="1" width="100px"
                    style="padding-top: 5px; padding-left:20px;">
                    <img src="" height="50px" width="50px" alt="">
                </td>
            @endif

            @for ($i = 0; $i <= count($data) - 1; $i++)
                @php
                    // dd(count($data)-1)
                    $p = DB::table('officers')
                        ->select()
                        ->where('id', $data[$i]['personil1'])
                        ->first();
                    $pp = DB::table('officers')
                        ->select()
                        ->where('id', $data[$i]['personil2'])
                        ->first();
                @endphp
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                    style="padding-top: 30px">
                    <img src="{{ public_path($p->ttd) }}" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                    style="padding-top: 30px">
                    <img src="{{ public_path($pp->ttd) }}" height="50px" width="50px" alt="">
                </td>
            @endfor
            @for ($i = count($data); $i < 3; $i++)
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                    style="padding-top: 30px">
                    <img src="" height="50px" width="50px" alt="">
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                    style="padding-top: 30px">
                    <img src="" height="50px" width="50px" alt="">
                </td>
            @endfor
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                style="padding-top: 5px; padding-left:20px;">
                <h3>Desrianto</h3>
            </td>
            @for ($i = 0; $i <= count($data) - 1; $i++)
                @php
                    $p = DB::table('officers')
                        ->select()
                        ->where('id', $data[$i]['personil1'])
                        ->first();
                    $pp = DB::table('officers')
                        ->select()
                        ->where('id', $data[$i]['personil2'])
                        ->first();
                    
                @endphp
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 5px">
                    <h3>{{ $p->nama }}</h3>
                </td>
                <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                    style="padding-top: 5px; margin-left:0px;">
                    <h3>{{ $pp->nama }}</h3>
                </td>
            @endfor
            @if (count($data) < 3)


                @for ($i = count($data); $i < 3; $i++)
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                        style="padding-top: 5px">
                        <h3></h3>
                    </td>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"
                        style="padding-top: 5px; margin-left:0px;">
                        <h3></h3>
                    </td>
                @endfor'
            @endif
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-left:20px;">
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
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 5px">
            </td>
        </tr>

    </table>
</body>

</html>
