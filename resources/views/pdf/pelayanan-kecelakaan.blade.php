<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Pelayanan Kecelakaan Lalu Lintas</title>
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
    {{-- @php$activity = DB::table('activity_mutation_service_tol')
            ->select()
            ->where('no_mutasi', $no_mutation)
            ->get();
        // dd($activity->unit);
    @endphp --}}
</head>

<body>

    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="80px" height="25px">
                <img width="100%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="120px" height="25px" style="padding-left: 5px; padding-right: 5px;"
                align="center">
                <h1>Data Kejadian Kecelakaan Lalu Lintas Jalan Tol</h1>
            </th>
            <th class="isi" width="60px" height="25px" style="font-weight: normal; font-size:12px">
                <table>
                    <tr>
                        <td width="100%">No. Dok</td>
                        <td width="5%">: FO-MMN-OJT-03-19</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">Tanggal Terbit</td>
                        <td width="5%">: 07/06/2022</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">No. Revisi</td>
                        <td width="5%">: 01</td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>

    </table>
    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px"
            style="font-weight:normal;font-size:16px">
            Informasi Kecelakaan
        </th>
    </table>
    <table class="data" width="100%">
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Tanggal Kejadian
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="205px">
                : {{ \Carbon\Carbon::parse($data['tanggal_kejadian'])->format('j F Y') }}
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Stationing (STA)
            </td>
            @php
                $stationing = DB::table('stationing')
                    ->select()
                    ->where('id', $data['stationing'])
                    ->first();
            @endphp
            <td class="isiNoBorder">
                : {{ $stationing->nama }}
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
            <td class="isiNoBorder">
                Jalur
            </td>
            @php
                $jalur = DB::table('tracks')
                    ->select()
                    ->where('id', $data['jalur'])
                    ->first();
            @endphp
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
            <td class="isiNoBorder">
                Lajur
            </td>
            @php
                $lajur = DB::table('lanes')
                    ->select()
                    ->where('id', $data['lajur'])
                    ->first();
            @endphp
            <td class="isiNoBorder">
                : {{ $lajur->nama }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Penyelesaian Tugas
            </td>
            <td class="isiNoBorder">
                : {{ $data['waktu_selesai'] }}
            </td>
            <td class="isiNoBorder">
                Cuaca
            </td>
            @php
                $cuaca = DB::table('weathers')
                    ->select()
                    ->where('id', $data['cuaca'])
                    ->first();
            @endphp
            <td class="isiNoBorder">
                : {{ $cuaca->nama }}
        </tr>
        <tr>
            @php
                $jk = DB::table('type_accident')
                    ->select()
                    ->where('id', $data['jenis_kecelakaan'])
                    ->first();
            @endphp
            <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                Jenis Kecelakaan
            </td>
            <td class="isiNoBorder2">
                : {{ $jk->nama }}
            </td>
            <td class="isiNoBorder2">
                Kendaraan 1
            </td>
            <td class="isiNoBorder2">
                : {{ $data['detail'][0]['nopol'] ?? '-' }}
        </tr>
        <tr>
            @php
                $pk = DB::table('cause_accident')
                    ->select()
                    ->where('id', $data['penyebab_kecelakaan'])
                    ->first();
            @endphp
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Penyebab Kecelakaan
            </td>
            <td class="isiNoBorder">
                : {{ $pk->nama }}
            </td>
            <td class="isiNoBorder">
                Kendaraan 2
            </td>
            <td class="isiNoBorder">
                : {{ $data['detail'][1]['nopol'] ?? '-' }}
        </tr>
        <tr>
            @php
                $kk = DB::table('category_accident')
                    ->select()
                    ->where('id', $data['kategori_kecelakaan'])
                    ->first();
            @endphp
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Kategori Kecelakaan
            </td>
            <td class="isiNoBorder">
                : {{ $kk->nama }}
            </td>
            <td class="isiNoBorder">
                Kendaraan 3
            </td>
            <td class="isiNoBorder">
                : {{ $data['detail'][2]['nopol'] ?? '-' }}
        </tr>
        <tr>
            @php
                $keke = DB::table('loss_accident')
                    ->select()
                    ->where('id', $data['kerugian_kecelakaan'])
                    ->first();
            @endphp
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Kerugian Kecelakaan
            </td>
            <td class="isiNoBorder">
                : {{ $keke->nama }}
            </td>
            <td class="isiNoBorder">
                Kendaraan 4
            </td>
            <td class="isiNoBorder">
                : {{ $data['detail'][3]['nopol'] ?? '-' }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Asal
            </td>
            <td class="isiNoBorder">
                : {{ $data['asal_perjalanan'] }}
            </td>
            <td class="isiNoBorder">
                Kendaraan 5
            </td>
            <td class="isiNoBorder">
                : {{ $data['detail'][4]['nopol'] ?? '-' }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Tujuan
            </td>
            <td class="isiNoBorder">
                : {{ $data['tujuan_perjalanan'] }}
            </td>
            <td class="isiNoBorder">
                Kendaraan 6
            </td>
            <td class="isiNoBorder">
                : {{ $data['detail'][5]['nopol'] ?? '-' }}
        </tr>
    </table>
    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px"
            style="font-weight:normal;font-size:16px">
            Informasi Petugas
        </th>
    </table>
    <table class="data" width="100%" style="border-bottom:none;">
        @php
            $p1 = DB::table('officers')
                ->select()
                ->where('id', $data['personil1'])
                ->first();
            $p2 = DB::table('officers')
                ->select()
                ->where('id', $data['personil2'])
                ->first();
            $pa = DB::table('officers')
                ->select()
                ->where('id', $data['personil_ambulan'])
                ->first();
            $pr = DB::table('officers')
                ->select()
                ->where('id', $data['personil_rescue'])
                ->first();
            $pd = DB::table('officers')
                ->select()
                ->where('id', $data['petugas_derek'])
                ->first();
        @endphp
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Nama Petugas Patroli 1
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="90px">
                : {{ $p1->nama }}
            </td>
            <td class="isiNoBorder3" rowspan="1" colspan="1" width="200px">
                Nama Petugas Ambulan
            </td>
            <td class="isiNoBorder">
                : {{ $pa->nama }}
            </td>


        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Nama Petugas Patroli 2
            </td>
            <td class="isiNoBorder" width="95px">
                : {{ $p2->nama }}
            </td>
            <td class="isiNoBorder3">
                Nama Petugas Rescue
            </td>
            <td class="isiNoBorder">
                : {{ $pr->nama }}
            </td>
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Petugas Derek
            </td>
            <td class="isiNoBorder">
                : {{ $pd->nama }}
            </td>
            <td class="isiNoBorder3">
                Waktu Info Dibutuhkan Medis
            </td>
            <td class="isiNoBorder">
                : {{ $data['waktu_info_medis_dibutuhkan'] }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Waktu Info Derek Diperlukan
            </td>
            <td class="isiNoBorder">
                :  {{ $data['waktu_dibutuhkan']??'-' }}
            </td>
            <td class="isiNoBorder3">
                Waktu Medis Sampai TKP
            </td>
            <td class="isiNoBorder">
                :  {{ $data['waktu_tiba_medis']??'-' }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Waktu Derek Sampai Lokasi
            </td>
            <td class="isiNoBorder">
                : {{ $data['waktu_sampai_tkp']??'-' }}
            </td>
            <td class="isiNoBorder3">
                Respon Time Medis
            </td>
            <td class="isiNoBorder">
                : {{ $data['respond_time_medis']??'-' }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Respon Time Penderekan
            </td>
            <td class="isiNoBorder">
                : {{ $data['respon_time_derek']??'-' }}
            </td>
            <td class="isiNoBorder3">
                Waktu Medis Meninggalkan TKP
            </td>
            <td class="isiNoBorder">
                : {{ $data['waktu_medis_meninggalkan_tkp']??'-' }}
        </tr>
        <tr>
            @php
            $pl = DB::table('officers')
           ->select()
           ->where('id', $data['petugas_lainnya'])
           ->first();
            @endphp
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Nama Petugas Lainnya
            </td>
            <td class="isiNoBorder">
                : {{ $pl->nama }}
            </td>
            <td class="isiNoBorder3">
                Waktu Medis Sampai ke Rumah Sakit
            </td>
            <td class="isiNoBorder">
                : {{ $data['waktu_sampai_rs']??'-' }}
        </tr>
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                Sumber Informasi
            </td>
            @php
                 $si = DB::table('source_informations')
                ->select()
                ->where('id', $data['sumber_informasi'])
                ->first();
            @endphp
            <td class="isiNoBorder">
                : {{ $si->nama??'-' }}
            </td>
            <td class="isiNoBorder3">
                Waktu Perjalanan Medis ke Rumah Sakit
            </td>
            <td class="isiNoBorder">
                : {{ $data['durasi_perjalanan']??'-' }}
        </tr>
    </table>

    <table class="data" align="center" width="100%" style="border-top:none">

        <tr>
            <td>
                <table class="data" width="95%" style="border-left: none;border-right:none">
                    <tr>
                        <th class="data" rowspan="1" colspan="1" width="200px" align="center"
                            style="font-weight: normal;">
                            Kerugian Aset Tol (Isi Jika Ada)
                        </th>

                    </tr>
                    <tr>
                        <td class="isiBorder" rowspan="1" colspan="1" width="200px" height="100px">
                            {{ $data['kerugian_tol'] }}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="data" align="right" width="95%">
                    <tr>
                        <th class="isiBorder" rowspan="1" colspan="1" width="200px" align="center"
                            style="font-weight: normal">
                            Keterangan Kejadian
                        </th>

                    </tr>
                    <tr>

                        <td class="isiBorder" rowspan="1" colspan="1" width="200px" height=100px>
                            {{ $data['keterangan'] }}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px"
            style="font-weight:normal;font-size:16px">
            Keterangan Korban
        </th>
    </table>
    <table class="data" align="center" width="100%" style="border-top:none">
        <tr>
            @php
              $ko = DB::table('traffic_accident_victim')
                ->select('traffic_accident_victim.*', 'victim_condition.nama as kondisi_nama')
                ->join('victim_condition', 'traffic_accident_victim.kondisi', '=', 'victim_condition.id')
                ->where('traffic_accident_victim.report_id', $data['id'])
                ->get();
                // dd($ko);
            @endphp
            <td>
                <table class="data" width="100%" style="border-top: none;border-bottom:none;border-left:none">
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Nama Korban
                    </td>
                    <td class="isiNoBorder">
                        : {{ $ko[0]->nama??'-' }}
                    </td>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Umur Korban
                        </td>
                        <td class="isiNoBorder">
                            : {{ $ko[0]->umur ??'-'}} Tahun
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Kondisi Korban
                        </td>
                        <td class="isiNoBorder">
                            : {{ $ko[0]->kondisi_nama??'-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Tindakan Korban
                        </td>
                        <td class="isiNoBorder">
                            : {{ $ko[0]->tindakan??'-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                            Nama Korban
                        </td>
                        <td class="isiNoBorder2">
                            : {{ $ko[1]->nama??'-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Umur Korban
                        </td>
                        <td class="isiNoBorder">
                            : {{ $ko[1]->umur ??'-'}} Tahun
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Kondisi Korban
                        </td>
                        <td class="isiNoBorder">
                            : {{ $ko[1]->kondisi_nama ??'-'}}
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Tindakan Korban
                        </td>
                        <td class="isiNoBorder">
                            : {{ $ko[1]->tindakan??'-' }}
                        </td>
                    </tr>
                </table>
            </td>

            <table class="data" width="100%"
                style="border-right:none;border-bottom:none;border-top:none;border-left:none">
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Nama Korban
                </td>
                <td class="isiNoBorder">
                    : {{ $ko[2]->nama??'-' }}
                </td>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Umur Korban
                    </td>
                    <td class="isiNoBorder">
                        : {{ $ko[2]->umur??'-' }} Tahun
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Kondisi Korban
                    </td>
                    <td class="isiNoBorder">
                        : {{ $ko[2]->kondisi_nama??'-' }}
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Tindakan Korban
                    </td>
                    <td class="isiNoBorder">
                        :{{ $ko[2]->tindakan??'-' }}
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                        Nama Korban
                    </td>
                    <td class="isiNoBorder2">
                        : {{ $ko[3]->nama??'-' }}
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Umur Korban
                    </td>
                    <td class="isiNoBorder">
                        : {{ $ko[3]->umur??'-' }} Tahun
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Kondisi Korban
                    </td>
                    <td class="isiNoBorder">
                        : {{ $ko[3]->kondisi_nama??'-' }}
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Tindakan Korban
                    </td>
                    <td class="isiNoBorder">
                        : {{ $ko[3]->tindakan??'-' }}
                    </td>
                </tr>
            </table>
            </td>
    </table>
    </tr>
    </table>
    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px" height="15px">
            Dokumentasi
        </th>
    </table>
    <table class="data" align="center" width="100%">
       <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="100px"style="height: 110px;"> <img src="{{ public_path('LKLL/' . $data['image'][0]['nama']) }}" height="100px">
                    </td>
     <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="100px"style="height: 110px;"> <img src="{{ public_path('LKLL/' . $data['image'][1]['nama']) }}" height="100px">
    </td>
     <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="100px"style="height: 110px;"> <img src="{{ public_path('LKLL/' . $data['image'][2]['nama']) }}" height="100px">
    </td>
      <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="100px"style="height: 110px;"> <img src="{{ public_path('LKLL/' . $data['image'][3]['nama']) }}" height="100px">
    </td>
       
    </table>

    <table class="data" align="center" width="100%" style="margin-top: 20px;border:none">
        <tr>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 10px">
                Dibuat,
            </td>

            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px" style="padding-top: 10px">
                Diperiksa,
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 10px">
                Disetujui,
            </td>
            <td class="isiNoBorder" rowspan="1" colspan="1" width="100px"style="padding-top: 10px">
                Tembusan:
            </td>
        </tr>
        <tr>
               @php
                    $senkom = DB::table('officers')
                    ->select()
                    ->where('id',$data['senkom'] )
                    ->first();
                // dd($activity->unit);
                    @endphp
            <td>
                <table class="data">
                    <tr>
                        <th class="isi" width="175px" height="100px">
                           <img src="{{ public_path($senkom->ttd) }}" height="70px" width="100px"> 
                        </th>

                    </tr>
                 
                    <tr>
                        <th class="isi" width="175px" height="10px" style="font-size: 8px;font-weight:normal">
                            {{$senkom->nama}}
                        </th>

                    </tr>
                    <tr>
                        <td class="isiNoBorder" width="175px" height="10px" align="center"
                            style="font-size: 8px"> Sentral Komunikas
                        </td>

                    </tr>
                </table>
            </td>
            <td>
                <table class="data">
                    <tr>
                        <th class="isi" width="175px" height="100px"><img src="{{ public_path('assets/images/TTD/Staf-Desrianto.png') }}" height="70px" width="100px"></th>

                    </tr>
                    <tr>
                        <th class="isi" width="175px" height="10px" style="font-size: 8px;font-weight:normal">
                            Desrianto</th>

                    </tr>
                    <tr>
                        <td class="isiNoBorder" width="175px" height="10px" align="center"
                            style="font-size: 8px"> Staff
                            Pelayanan Lalu
                            Lintas
                        </td>
                        
                    </tr>
                </table>
            </td>
            <td>
                <table class="data" align="right">
                    <tr>
                        <th class="isi" width="175px" height="100px"><img src="{{ public_path('assets/images/TTD/Bambang Haryanto.jpg') }}" height="70px" width="100px"></th>

                    </tr>
                    <tr>
                        <th class="isi" width="175px" height="10px" style="font-size: 8px;font-weight:normal">
                            Bambang Haryanto</th>

                    </tr>
                    <tr>
                        <td class="isiNoBorder" width="175px" height="10px" align="center"
                            style="font-size: 8px">
                            Supervisor Operasional dan Pelayanan Lalu Lintas
                        </td>

                    </tr>
                </table>
            </td>
            <td>
                <table class="data" align="right">
                    <tr>
                        <th class="isi" width="175px" height="117px"
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
</body>

</html>
