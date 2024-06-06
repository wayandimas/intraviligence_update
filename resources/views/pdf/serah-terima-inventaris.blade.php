<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Serah Terima Inventaris Security</title>
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
            font-size: 9px;
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

        .isiBorder {
            border: 1px solid black;
            border-collapse: collapse
        }

        .isiNoBorder3 {
            font-size: 10px;
            border: none;
            border-collapse: collapse;
            padding-left: 110px;
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

    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="87px" height="10px">
                <img width="100%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="150px" height="10px" style="padding-left: 5px; padding-right: 5px;"
                align="center">
                <h2 style="font-size: 24px">Formulir</h2>
            </th>
            <th class="isi" width="40px" height="10px" style="font-weight: normal; font-size:12px">
                <table>
                    <tr>
                        <td width="80px">No. Dok</td>
                        <td width="20%">: FO-MMN-OJT-03-21 </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="80px">Tanggal Terbit</td>
                        <td width="20%">: 1/17/2023</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="80px">No. Revisi</td>
                        <td width="20%">: 02 </td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>

    </table>
    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="27%" height="40px" style="padding:0px;">
                Tanggal
                <br>Laporan:
            </th>
            @php
                $date = DB::table('handover_tol_inventory_log')
                    ->select()
                    ->where('id', $data[0]['id'])
                    ->first();
            @endphp
            <th class="isi" width="29%" height="40px">
                {{ \Carbon\Carbon::parse($date->created_at)->format('Y-m-d') }}
            </th>

            <th class="isi" width="100%" height="40px" style="padding-left: 5px; padding-right: 5px;"
                align="center">
                <h2 style="font-size: 16px">Serah Terima Inventaris Security</h2>
            </th>
            <th class="isi" width="82%" height="40px" style="font-weight: normal; font-size:12px">
                {{ $data[0]['lokasi_aset'] }}
            </th>
        </tr>
    </table>
    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="80px" height="30px" style="padding:0px;">
                Shift I (satu)
            </th>
            <th class="isi" width="80px" height="30px" style="padding:0px;">
                Shift II (dua)
            </th>
            <th class="isi" width="80px" height="30px" style="padding:0px;">
                Shift III (tiga)
            </th>
        </tr>
    </table>
    @php
        $p = DB::table('officers')
            ->select()
            ->where('id', $data[0]['personil'])
            ->first();
        if (count($data) == 2) {
            $pp = DB::table('officers')
                ->select()
                ->where('id', $data[1]['personil'])
                ->first();
        }
        if (count($data) == 3) {
            $pp = DB::table('officers')
                ->select()
                ->where('id', $data[1]['personil'])
                ->first();
            $ppp = DB::table('officers')
                ->select()
                ->where('id', $data[2]['personil'])
                ->first();
        }
    @endphp
    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="50%" height="20px" style="padding:0px;" align="right">
                Personil:
            </th>
            <th class="isi"width="95%" height="20px">{{ $p->nama }}
            </th>
            <th class="isi" width="50%" height="20px" style="padding:0px;" align="right">
                Personil:

            </th>
            <th class="isi" width="95%" height="20px">{{ $pp->nama ?? '' }}
            </th>
            <th class="isi" width="50%" height="20px" style="padding:0px;" align="right">
                Personil:
            </th>
            <th class="isi" width="95%" height="20px">{{ $ppp->nama ?? '' }}
            </th>

        </tr>
    </table>
    {{-- @php
        dd($data);
    @endphp --}}
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 1; $i <= 3; $i++)
                <th class="isi" rowspan="2" width="12px" height="20px" style="padding:0px;" align="center">
                    No
                </th>
                <th class="isi" rowspan="2" width="69px" height="20px">
                    Nama <br> Barang
                </th>
                <th class="isi" rowspan="2" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    Jumlah
                </th>
                <th class="isi" rowspan="1" colspan="2" width="48px" height="20px">
                    Kondisi
                </th>

                <th class="isi" rowspan="2" width="60px" height="20px" style="padding:0px;"
                    align="center">
                    Keterangan

                </th>
            @endfor
        </tr>
        <tr class="judul">
            <th class="isi" colspan="1">B</th>
            <th class="isi" colspan="1">R</th>
            <th class="isi" colspan="1">B</th>
            <th class="isi" colspan="1">R</th>
            <th class="isi" colspan="1">B</th>
            <th class="isi" colspan="1">R</th>
        </tr>

    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    1
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Handy <br> Talkie
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_handy_talkie'] }}
                </th>
                @if ($data[$i]['handy_talkie'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                    </th>
                @elseif($data[$i]['handy_talkie'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif


                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        1
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Handy <br> Talkie
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">

                    </th>

                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">

                    </th>
                @endfor
            @endif
        </tr>

    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    2
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Batok <br> Charger
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_batok_charger'] }}
                </th>
                @if ($data[$i]['batok_charger'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                    </th>
                @elseif($data[$i]['batok_charger'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif


                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">

                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        2
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Batok <br> Charger
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">

                    </th>

                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>

    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    3
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Adapter <br> Charger
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_adapter_charger'] }}
                </th>
                @if ($data[$i]['adapter_charger'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                    </th>
                @elseif($data[$i]['adapter_charger'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        3
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Adapter <br> Charger
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    4
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Tongkat.T
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_tongkat_t'] }}
                </th>
                @if ($data[$i]['tongkat_t'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['tongkat_t'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        4
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Tongkat.T
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    5
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Tali Sling
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_tali_sling'] }}
                </th>
                @if ($data[$i]['tali_sling'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['tali_sling'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        5
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Tali Sling
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    6
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Amplifier
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_amplifier'] }}
                </th>
                @if ($data[$i]['amplifier'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['amplifier'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        6
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Amplifier
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    7
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Wireless
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_wireless'] }}
                </th>
                @if ($data[$i]['wireless'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['wireless'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        7
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Wireless
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    8
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Alarm
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_alarm'] }}
                </th>
                @if ($data[$i]['alarm'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['alarm'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        8
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Alarm
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    9
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Senter <br> Lalin
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_senter_lalin'] }}
                </th>
                @if ($data[$i]['senter_lalin'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['senter_lalin'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        9
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Senter <br> Lalin
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    10
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    APAR
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_apar'] }}
                </th>
                @if ($data[$i]['apar'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['apar'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        10
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        APAR
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    11
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Box<br>APAR
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_box_apar'] }}
                </th>
                @if ($data[$i]['box_apar'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['box_apar'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        11
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Box<br>APAR
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    12
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    AC
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_ac'] }}
                </th>
                @if ($data[$i]['ac'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['ac'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        12
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        AC
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    13
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Jas Hujan
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_jas_hujan'] }}
                </th>
                @if ($data[$i]['jas_hujan'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['jas_hujan'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        13
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Jas Hujan
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    14
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Layar Monitor
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_layar_monitor'] }}
                </th>
                @if ($data[$i]['layar_monitor'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['layar_monitor'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        14
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Layar Monitor
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    15
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    CCTV
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_cctv'] }}
                </th>
                @if ($data[$i]['cctv'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['cctv'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        15
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        CCTV
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    16
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    LLA
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_lla'] }}
                </th>
                @if ($data[$i]['lla'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['lla'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        16
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        LLA
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    17
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    R.Max <br> (4,1m )
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_r_max'] }}
                </th>
                @if ($data[$i]['r_max'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['r_max'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        17
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        R.Max <br> (4,1m )
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    18
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    R. 2,1m
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_r_21'] }}
                </th>
                @if ($data[$i]['r_21'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['r_21'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        18
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        R. 2,1m
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    19
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Mesin Genset
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_mesin_genset'] }}
                </th>
                @if ($data[$i]['mesin_genset'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['mesin_genset'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        19
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Mesin Genset
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    20
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Accu
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_accu'] }}
                </th>
                @if ($data[$i]['accu'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['accu'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        20
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Accu
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    21
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    R.Stop
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_r_stop'] }}
                </th>
                @if ($data[$i]['r_stop'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['r_stop'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        21
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        R.Stop
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    22
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    R.Palang
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_r_palang'] }}
                </th>
                @if ($data[$i]['r_palang'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['r_palang'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        22
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        R.Palang
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    23
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Sepatu Boat
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_sepatu_boat'] }}
                </th>
                @if ($data[$i]['sepatu_boat'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['sepatu_boat'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        23
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Sepatu Boat
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    24
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Payung
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_payung'] }}
                </th>
                @if ($data[$i]['payung'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['payung'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        24
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Payung
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    25
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Dispenser
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_dispenser'] }}
                </th>
                @if ($data[$i]['dispenser'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['dispenser'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        25
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Dispenser
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    26
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Galon
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_galon'] }}
                </th>
                @if ($data[$i]['galon'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['galon'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        26
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Galon
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    27
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Speaker <br> Active
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_speaker_active'] }}
                </th>
                @if ($data[$i]['speaker_active'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['speaker_active'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        27
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Speaker <br> Active
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table class="data" align="center" width="100%" style="border-collapse: collapse">
        <tr class="judul">
            @for ($i = 0; $i <= count($data) - 1; $i++)
                <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                    align="center">
                    28
                </th>
                <th class="isi" rowspan="1" width="69px" height="20px">
                    Rubber <br> Cone
                </th>
                <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                    align="center">
                    {{ $data[$i]['jumlah_rubber_cone'] }}
                </th>
                @if ($data[$i]['rubber_cone'] == 1)
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                    <th class="isi" rowspan="1" width="21px" heiTongkat.Tght="30px">
                    </th>
                @elseif($data[$i]['rubber_cone'] == 2)
                    <th class="isi" rowspan="1" width="21px" height="20px">

                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px">
                        <img src="{{ public_path('assets/admin/check.png') }}" height="15px" alt="">
                    </th>
                @endif
                <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                    align="center">
                </th>
            @endfor
            @php
                //    dd(count($data)!=3);
            @endphp
            @if (count($data) != 3)
                @for ($i = count($data); $i < 3; $i++)
                    <th class="isi" rowspan="1" width="12px" height="20px" style="padding:0px;"
                        align="center">
                        28
                    </th>
                    <th class="isi" rowspan="1" width="69px" height="20px">
                        Rubber <br> Cone
                    </th>
                    <th class="isi" rowspan="1" width="50px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="21px" height="20px"></th>
                    <th class="isi" rowspan="1" width="60px" height="20px" style="padding:0px;"
                        align="center">
                    </th>
                @endfor
            @endif
        </tr>
    </table>
    <table>
        <th>
            <table class="data" style="margin-top: 20px" align="left">
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">Diketahui,</th>
                    <th class="isi" width="100px" height="15px">Diperiksa,</th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="50px"><img src="" height="100px"></th>
                    <th class="isi" width="100px" height="50px"><img src="" height="100px"></th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px"></th>
                    <th class="isi" width="100px" height="15px"></th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px"> Supervisor Operasional dan Pelayanan Lalu
                        Lintas</th>
                    <th class="isi" width="100px" height="15px">Koordinator Security Tol</th>
                </tr>
            </table>
        </th>
        <th>
            <table class="data" style="margin-top: 20px;margin-left:50px" align="left">
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">Dibuat,</th>

                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="50px"><img src="{{ $p->ttd }}"
                            height="40px"></th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">{{ $p->nama }}</th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px" style="padding: 6px;" align="center">
                        Petugas <br> Shift I (satu)</th>
                </tr>
            </table>
        </th>
        <th>
            <table class="data" style="margin-top: 20px;margin-left:50px" align="left">
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">Dibuat,</th>

                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="50px"><img src="{{ $pp->ttd ?? '' }}"
                            height="40px"></th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">{{ $pp->nama ?? '' }}</th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px" style="padding: 6px;" align="center">
                        Petugas <br> Shift II (dua)</th>
                </tr>
            </table>
        </th>
        <th>
            <table class="data" style="margin-top: 20px;margin-left:50px" align="left">
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">Dibuat,</th>

                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="50px"><img src="{{ $ppp->ttd ?? '' }}"
                            height="40px"></th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px">{{ $ppp->nama ?? '' }}</th>
                </tr>
                <tr class="judul">
                    <th class="isi" width="100px" height="15px" style="padding: 6px;" align="center">
                        Petugas <br> Shift III (tiga)</th>
                </tr>
            </table>
        </th>
    </table>


</body>

</html>
