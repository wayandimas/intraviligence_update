<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Output Pengendalian dan Pelayanan Operasional Jalan Tol</title>
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

</head>

<body>

    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="50px" height="10px">
                <img width="100%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="90px" height="10px" style="padding-left: 5px; padding-right: 5px;"
                align="center">
                <h2>Data Kejadian Pengendalian dan Pelayanan Operasional Jalan Tol</h2>
            </th>
            <th class="isi" width="60px" height="10px" style="font-weight: normal; font-size:12px">
                <table>
                    <tr>
                        <td width="100%">No. Dok</td>
                        <td width="5%">: FO-MMN-OJT-03-45 </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">Tanggal Terbit</td>
                        <td width="5%">: 08/21/2023</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">No. Revisi</td>
                        <td width="5%">: 00 </td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>

    </table>
    @php
        $page = count($data);
    @endphp
    @foreach ($data as $key=>$data)
    @if($key > 0 && $key % 2 === 0)
    <div style="page-break-after: always;"></div>
    <table class="data" align="center" width="100%">
        <tr class="judul">
            <th class="isi" width="50px" height="10px">
                <img width="100%" src="assets/images/Logo_MMN_JTSE.png" alt="" />
            </th>
            <th class="isi" width="90px" height="10px" style="padding-left: 5px; padding-right: 5px;"
                align="center">
                <h2>Data Kejadian Pengendalian dan Pelayanan Operasional Jalan Tol</h2>
            </th>
            <th class="isi" width="60px" height="10px" style="font-weight: normal; font-size:12px">
                <table>
                    <tr>
                        <td width="100%">No. Dok</td>
                        <td width="5%">: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">Tanggal Terbit</td>
                        <td width="5%">: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100%">No. Revisi</td>
                        <td width="5%">: </td>
                        <td style="overflow: hidden"></td>
                    </tr>
                </table>
            </th>
        </tr>

    </table>
    
    @endif

    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px"
            style="font-weight:bold;font-size:16px">
            Informasi Kejadian {{ $key+1 }}
        </th>
    </table>
    <table class="data" align="center" width="100%" style="border-top:none";>
        <tr>
            <td>
                @php
                    // dd($data);
                @endphp
                <table class="data" width="100%" style="border-top: none;border-bottom:none;border-left:none;">
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Tanggal Kejadian
                    </td>
                    <td class="isiNoBorder">
                        : {{ $data['tanggal_kejadian'] }}
                    </td>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Waktu Informasi Diterima
                        </td>
                        <td class="isiNoBorder">
                            : {{ $data['waktu_kejadian'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Waktu Petugas Sampai Lokasi
                        </td>
                        <td class="isiNoBorder">
                            : {{ $data['waktu_sampai'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px" style="font-style: italic">
                            Respon Time
                        </td>
                        <td class="isiNoBorder">
                            : {{ $data['respon_time'] }}
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Penyelesaian Tugas
                        </td>
                        <td class="isiNoBorder">
                            : {{ $data['respon_time'] }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        $jk = DB::table('type_activity')->select()->where('id', $data['jenis_kegiatan'])->first();
                        @endphp
                        <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                            Jenis Kejadian
                        </td>
                        <td class="isiNoBorder2">
                            : {{ $jk->nama }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        $p1 = DB::table('officers')->select()->where('id', $data['personil1'])->first();
                        @endphp
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 1
                        </td>
                        <td class="isiNoBorder">
                            : {{ $p1->nama }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        $p2 = DB::table('officers')->select()->where('id', $data['personil2'])->first();
                        @endphp
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 2
                        </td>
                        <td class="isiNoBorder">
                            : {{ $p2->nama }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        $p3 = DB::table('officers')->select()->where('id', $data['personil3'])->first();
                        @endphp
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 3
                        </td>
                        <td class="isiNoBorder">
                            : {{ $p3->nama??'' }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        $p4= DB::table('officers')->select()->where('id', $data['personil4'])->first();
                        @endphp
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 4
                        </td>
                        <td class="isiNoBorder">
                            :  {{ $p4->nama??'' }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        $p5= DB::table('officers')->select()->where('id', $data['personil5'])->first();
                        @endphp
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 5
                        </td>
                        <td class="isiNoBorder">
                            : {{ $p5->nama??'' }}
                        </td>
                    </tr>
                </table>
            </td>

            <table class="data" width="100%"
                style=" border-left:none;margin-left:10px;border-right:none;border-top:none;border-bottom:none">
                @php
                $stationing= DB::table('stationing')->select()->where('id', $data['stationing'])->first();
                @endphp
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Stationing (STA)
                </td>
                <td class="isiNoBorder">
                    : {{ $stationing->nama }}
                </td>
                <tr>
                    @php
                    $seksi= DB::table('sections')->select()->where('id', $data['seksi'])->first();
                    @endphp
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Seksi
                    </td>
                    <td class="isiNoBorder">
                        : {{ $seksi->nama }}
                    </td>
                </tr>
                <tr>
                    @php
                    $jalur = DB::table('tracks')->select()->where('id', $data['jalur'])->first();
                    @endphp
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Jalur
                    </td>
                    <td class="isiNoBorder">
                        : {{ $jalur->nama }}
                    </td>
                </tr>
                <tr>
                    @php
                    $lajur = DB::table('lanes')->select()->where('id', $data['lajur'])->first();
                    @endphp
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Lajur
                    </td>
                    <td class="isiNoBorder">
                        : {{ $lajur->nama }}
                    </td>
                </tr>
                <tr>
                    @php
                    $cuaca = DB::table('weathers')->select()->where('id', $data['cuaca'])->first();
                    @endphp
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Cuaca
                    </td>
                    <td class="isiNoBorder">
                        : {{ $cuaca->nama }}
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                        Keterangan Kejadian
                    </td>
                    <td class="isiNoBorder2">
                        : {{ $data['deskripsi_kegiatan'] }}
                    </td>
                </tr>
            </table>
            </td>
    </table>
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
                    <img src="{{ public_path('LPPO/' . $data['image'][0]['nama']) }}" height="100px">
                </td>
            @endif
            @if (isset($data['image'][1]['nama']))
                <td class="isiNoBorder" align="center" rowspan="1" colspan="1" width="200px"
                    style="height: 110px;">
                    <img src="{{ public_path('LPPO/' . $data['image'][1]['nama']) }}" height="100px">
                </td>
            @endif


        </tr>
    </table>
    <table class="data" align="center" width="100%" style="margin-top: 10px;border:none">
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
                        <th class="isi" width="175px" height="80px">
                            <img src="{{ public_path($p1->ttd) }}" height="80px" >
                        </th>

                    </tr>
                    <tr>
                        <th class="isi" width="175px" height="10px" style="font-size: 8px;font-weight:normal">
                           {{$p1->nama}}
                        </th>

                    </tr>
                    <tr>
                        <td class="isiNoBorder" width="175px" height="10px" align="center"
                            style="font-size: 8px"> Petugas
                        </td>

                    </tr>
                </table>

            <td>
                <table class="data">
                    <tr>
                        <th class="isi" width="175px" height="80px">
                            <img src="{{ public_path('assets/images/TTD/Staf-Desrianto.png') }}" height="80px" >
                        </th>

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
                        <th class="isi" width="175px" height="80px">
                            <img src="{{ public_path('assets/images/TTD/Bambang Haryanto.jpg') }}" height="80px" >
                        </th>

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
                        <th class="isi" width="175px" height="80px"
                            style="font-weight: normal; font-size:8px;padding-top:10px; vertical-align: top; "
                            align="left">

                            1. Direktur Utama
                            <br>
                            2. Direktur Operasional
                            <br>
                            3. Manajer Operasional
                        </th>

                    </tr>


                </table>
            </td>
        </tr>
    </table>
    @endforeach
    
    @if ($page>0 && $page%2 !=0 )
    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px"
            style="font-weight:bold;font-size:16px">
            Informasi Kejadian 
        </th>
    </table>
    <table class="data" align="center" width="100%" style="border-top:none";>
        <tr>
            <td>
                @php
                    // dd($data);
                @endphp
                <table class="data" width="100%" style="border-top: none;border-bottom:none;border-left:none;">
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Tanggal Kejadian
                    </td>
                    <td class="isiNoBorder">
                        :
                    </td>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Waktu Informasi Diterima
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
                    </tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px" style="font-style: italic">
                            Respon Time
                        </td>
                        <td class="isiNoBorder">
                            : 
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Penyelesaian Tugas
                        </td>
                        <td class="isiNoBorder">
                            : 
                        </td>
                    </tr>
                    <tr>
                        
                        <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                            Jenis Kejadian
                        </td>
                        <td class="isiNoBorder2">
                            : 
                        </td>
                    </tr>
                    <tr>
                        
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 1
                        </td>
                        <td class="isiNoBorder">
                            : 
                        </td>
                    </tr>
                    <tr>
                       
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 2
                        </td>
                        <td class="isiNoBorder">
                            : 
                        </td>
                    </tr>
                    <tr>
                       
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 3
                        </td>
                        <td class="isiNoBorder">
                            : 
                        </td>
                    </tr>
                    <tr>
                        
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 4
                        </td>
                        <td class="isiNoBorder">
                            :  
                        </td>
                    </tr>
                    <tr>
                        
                        <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                            Petugas 5
                        </td>
                        <td class="isiNoBorder">
                            : 
                        </td>
                    </tr>
                </table>
            </td>

            <table class="data" width="100%"
                style=" border-left:none;margin-left:10px;border-right:none;border-top:none;border-bottom:none">
                
                <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                    Stationing (STA)
                </td>
                <td class="isiNoBorder">
                    : 
                </td>
                <tr>
                    
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Seksi
                    </td>
                    <td class="isiNoBorder">
                        : 
                    </td>
                </tr>
                <tr>
                    
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Jalur
                    </td>
                    <td class="isiNoBorder">
                        : 
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Lajur
                    </td>
                    <td class="isiNoBorder">
                        :
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder" rowspan="1" colspan="1" width="200px">
                        Cuaca
                    </td>
                    <td class="isiNoBorder">
                        : 
                    </td>
                </tr>
                <tr>
                    <td class="isiNoBorder2" rowspan="1" colspan="1" width="200px">
                        Keterangan Kejadian
                    </td>
                    <td class="isiNoBorder2">
                        : 
                    </td>
                </tr>
            </table>
            </td>
    </table>
    </table>
    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="100px"
            style="font-weight:bold;font-size:16px">
            Foto Kejadian 
        </th>
    </table>
    <table class="data" align="center" width="100%">
        <th class="subJudul" rowspan="1" colspan="1" align="center" width="90px" height="120px">
            {{-- <img src="{{ public_path('LPPO/'.$data['dokumentasi']) }}" height="100px" style="padding-top: 5px"> --}}
        </th>
    </table>

    <table class="data" align="center" width="100%" style="margin-top: 10px;border:none">
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
                        <th class="isi" width="175px" height="80px">
                           
                        </th>

                    </tr>
                    <tr>
                        <th class="isi" width="175px" height="10px" style="font-size: 8px;font-weight:normal">
                           
                        </th>

                    </tr>
                    <tr>
                        <td class="isiNoBorder" width="175px" height="10px" align="center"
                            style="font-size: 8px"> Petugas
                        </td>

                    </tr>
                </table>

            <td>
                <table class="data">
                    <tr>
                        <th class="isi" width="175px" height="80px">
                            
                        </th>

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
                        <th class="isi" width="175px" height="80px">
                            
                        </th>

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
                        <th class="isi" width="175px" height="80px"
                            style="font-weight: normal; font-size:8px;padding-top:10px; vertical-align: top; "
                            align="left">

                            1. Direktur Utama
                            <br>
                            2. Direktur Operasional
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
