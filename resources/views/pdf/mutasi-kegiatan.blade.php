<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Output Mutasi Kegiatan Harian</title>
        <style>
            @page {
                margin: 10 20 10 20;
                size: A4; /*or width x height 150mm 50mm*/
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
                font-size: 12px;
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
            span{
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
            .role {
                font-size: 9px;
               font-weight: normal;
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
        @php $activity =
        DB::table('activity_mutation_service_tol')->select()->where('no_mutasi',$no_mutation)->get();
        // dd($activity); 
        @endphp
    </head>

    <body>
        <h5 style="margin-bottom: 5px">Output Mutasi Kegiatan Harian</h5>

        <table class="data" align="center" width="100%">
            <tr class="judul">
                <th class="isi" width="100px" height="25px">
                    <img
                        width="80%"
                        src="assets/images/Logo_MMN_JTSE.png"
                        alt=""
                    />
                </th>
                <th class="isi" width="100px" height="25px">
                    <h2>Formulir</h2>
                </th>
                <th class="isi" width="100px" height="25px">
                    <table>
                        <tr>
                            <td width="100%">No. Dok</td>
                            <td width="5%">: FO-MMN-OJT-03-44</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td width="100%">Tgl Terbit</td>
                            <td width="5%">: 01/17/2023</td>
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
        @php $nodata=0; $no =0; $p1 = ''; $p2 = ''; @endphp @foreach ($activity
        as $activity) @if ($activity->personil1==$p1 &&
        $activity->personil2==$p2 ) @php continue; @endphp @endif @php
        $nodata++; $p1 = $activity->personil1; $p2 = $activity->personil2;
        @endphp

        <table class="data">
            =
            <tr class="judul" align="center">
                <th class="isi" rowspan="4" width="25px">NO</th>
                <th
                    class="isi"
                    rowspan="1"
                    colspan="1"
                    align="center"
                    width="90px"
                >
                    Tanggal Laporan
                </th>
                <th class="isi" rowspan="1" align="center" width="122px">
                    {{now()->toDateString()}}
                </th>
                <th class="isi" rowspan="1" align="center" width="245px">
                    Laporan Kegiatan Unit Pelayanan Lalu Lintas
                </th>
                @php 
                if($activity->unit==11){
                    $user =
                DB::table('operasionals')->select()->where('id',$activity->unit)->first();
                   }
                 elseif($activity->unit==5){
                   $user =substr($activity->no_mutasi, 0, -3);
                }else{
                     $user =substr($activity->no_mutasi, 0, 3);
                
                }
                @endphp
                <th class="isi" rowspan="1" align="center" width="242px">
                    @if($activity->unit==11)
                    Sentral Komunikasi
                    @elseif($activity->unit ==4)
                    Ambulans
                    @elseif($activity->unit ==2)
                    Derek
                    @elseif($activity->unit ==3)
                    Rescue
                    @elseif($activity->unit ==5)
                    {{ $user}}
                    @else
                    {{ $user}}
                    @endif
                    
                </th>
            </tr>
             @php $personil1 =
            DB::table('officers')->select()->where('id',$activity->personil1)->first();
            $personil2 =
            DB::table('officers')->select()->where('id',$activity->personil2)->first();
            $shift =
            DB::table('monitoring_time')->select()->where('id',$activity->waktu_pemantauan)->first();
            $lokasi =
            DB::table('monitoring_locations')->select()->where('id',$activity->lokasi_pemantauan)->first();
            @endphp
            <tr align="center">
                <th rowspan="2" class="isi">Personil</th>
                <th rowspan="1" class="isi">{{ $personil1->nama }}</th>
                <th rowspan="2" class="isi" align="right">Shift :</th>
                <?php
                $shiftValue = $shift->shift;
                if ($shiftValue == 1) {
                   
                    $shiftText = 'I (Satu)';
                } else if($shiftValue == 2)  {
                    $shiftText = 'II (Dua)';     
                }
                else{
                    $shiftText = 'III (Tiga)';
                }
                ?>
                <th rowspan="2" class="isi">{{ $shiftText }}</th>
            </tr>

            <tr align="center">
                <th rowspan="1" class="isi">{{ $personil2->nama }}</th>
            </tr>
            <tr align="center">
                <th rowspan="1" class="isi">Jam</th>
                <th rowspan="1" class="isi">Lokasi</th>
                <th rowspan="1" colspan="2" class="isi">Uraian</th>
            </tr>
            @php $data =
            DB::table('activity_mutation_service_tol')->select()->where('no_mutasi',$no_mutation)
            ->where('personil1',$p1)->where('personil2',$p2)->orderBy('waktu_pemantauan',
            'ASC')->get(); @endphp 
            @foreach ($data as $data )
        </table>
        @php $no++; $shiftdata =
        DB::table('monitoring_time')->select()->where('id',$data->waktu_pemantauan)->first();
        $lokasidata =
        DB::table('monitoring_locations')->select()->where('id',$data->lokasi_pemantauan)->first();
        @endphp

        <table class="data">
            <tr class="judul" align="center">
                <th class="isi" rowspan="1" width="25px">{{ $no }}</th>
                <th class="isi" rowspan="1" align="center" width="90px">
                    {{ $shiftdata->start_time }}-{{ $shiftdata->end_time }}
                </th>
                <th class="isi" rowspan="1" align="center" width="122px">
                    {{ $lokasidata->nama }}
                </th>
                <th class="isi" rowspan="1" align="center" width="490px">
                    {{ $data->keterangan }}
                </th>
            </tr>
        </table>
        
                  @endforeach @endforeach
                  @php 
                  $amst = DB::table('activity_mutation_service_tol')->select()->where('no_mutasi',$no_mutation)->get();
                //   dd(count($amst));
                  if(count($amst)>32){
                    $p11 = DB::table('officers')->select()->where('id', $amst[0]->personil1)->first();
                    $p12 = DB::table('officers')->select()->where('id', $amst[0]->personil2)->first();
                    $shift1 = DB::table('monitoring_time')->select()->where('id', $amst[0]->waktu_pemantauan)->first();

                    $p21 = DB::table('officers')->select()->where('id', $amst[16]->personil1)->first() ?? null;
                    $p22 = DB::table('officers')->select()->where('id', $amst[16]->personil2)->first() ?? null;
                    $shift2 = DB::table('monitoring_time')->select()->where('id', $amst[16]->waktu_pemantauan)->first() ?? null;

                    $p31 = DB::table('officers')->select()->where('id', $amst[32]->personil1)->first() ?? null;
                    $p32 = DB::table('officers')->select()->where('id', $amst[32]->personil2)->first() ?? null;
                    $shift3 = DB::table('monitoring_time')->select()->where('id', $amst[32]->waktu_pemantauan)->first() ?? null;
                  }
                  elseif (count($amst)<=32 && count($amst)>16 ) {
                    $p11 = DB::table('officers')->select()->where('id', $amst[0]->personil1)->first();
                    $p12 = DB::table('officers')->select()->where('id', $amst[0]->personil2)->first();
                    $shift1 = DB::table('monitoring_time')->select()->where('id', $amst[0]->waktu_pemantauan)->first();

                    $p21 = DB::table('officers')->select()->where('id', $amst[16]->personil1)->first() ?? null;
                    $p22 = DB::table('officers')->select()->where('id', $amst[16]->personil2)->first() ?? null;
                    $shift2 = DB::table('monitoring_time')->select()->where('id', $amst[16]->waktu_pemantauan)->first() ?? null;

                    // dd($shift2);
                  }
                  elseif(count($amst)<=16 ) {
                    $p11 = DB::table('officers')->select()->where('id', $amst[0]->personil1)->first();
                    $p12 = DB::table('officers')->select()->where('id', $amst[0]->personil2)->first();
                    $shift1 = DB::table('monitoring_time')->select()->where('id', $amst[0]->waktu_pemantauan)->first();
                  }
                  

                  @endphp
 
                @if (count($amst)>32)
                <table>
                    <th>
                     <table class="data" style="margin-top: 50px" align="left">
                        <tr class="judul">
                            <th class="isi" width="100px" height="20px">Diketahui ,</th>
                            <th class="isi" width="100px" height="20px">Diperiksa,</th>
                        </tr>
                        @php
                        $unit = explode("-", $data->no_mutasi);
                    @endphp
                        @if ($shift1!=null && $shift2!=null && $shift3!=null)
                        <tr class="judul">
                             @if(count($amst)==48)
                              <th class="isi" width="100px" height="70px"><img src="{{ public_path('assets/images/TTD/Bambang Haryanto.jpg') }}" height="70px" width="100px"></th>
                               <th class="isi" width="100px" height="70px">
                                @if ($unit[0]  =='Rescue' || $unit[0] =='Ambulans' ) <img src="{{ public_path('assets/images/TTD/Staf-Januar Faisal.jpeg')}}"
                               height="70px" width="100px">
                                  @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek' ) <img src="{{ public_path('assets/images/TTD/Staf-Aryansyah Mahudar.jpeg')}}"
                               height="70px" width="100px">
                               @elseif($data->unit[0]==5)
                               <img src="{{public_path('assets/images/TTD/Kord-Security-Ismail.jpeg')}}"
                               height="70px" width="100px">
                                  @elseif ($unit[0]  =='Senkom' ) <img src="{{ public_path('assets/images/TTD/Bambang Haryanto.jpg')}}"
                               height="70px" width="100px">
                                @endif 
                            </th>
                            @else
                              <th class="isi" width="100px" height="70px"></th>
                              <th class="isi" width="100px" height="70px"></th>
                            @endif
                           
                        </tr>
                        @else
                        <tr class="judul">
                            <th class="isi" width="100px" height="70px"></th>
                            
                            <th class="isi" width="100px" height="70px">
                                
                            </th>
                        </tr>
                        @endif
                       
                       
                        <tr class="judul">
                            <th class="isi" width="100px" height="20px">Bambang Haryanto</th>
                              @if ($unit[0] =='Rescue' || $unit[0] =='Ambulans' )
                            <th class="isi" width="100px" height="20px">Januar Faisal</th>
                             @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek')
                            <th class="isi" width="100px" height="20px">Aryansyah Mahudar</th>
                             @elseif($data->unit[0]==5)
                             <th class="isi" width="100px" height="20px">Ismail</th>
                            @elseif ($unit[0]  =='Senkom' )  <th class="isi" width="100px" height="20px">Bambang Haryanto</th>
                            @endif
                        </tr>
                        <tr class="judul">
                            <th class="role" width="100px" height="20px">Supervisor Operasional dan Pelayanan Lalu Lintas</th>
                                @if ($unit[0]  =='Rescue' || $unit[0] =='Ambulans' )
                            <th class="role" width="100px" height="20px">Koordinator Emergency Response Team</th>
                              @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek')
                            <th class="role" width="100px" height="20px">Koordinator Pelayanan Jalan Tol</th>
                            @elseif($data->unit[0]==5)
                            <th class="role" width="100px" height="20px">Koordinator Security</th>
                             @elseif ($unit[0]  =='Senkom' )  
                             <th class="role" width="100px" height="20px">Supervisor Operasional dan Pelayanan Lalu Lintas</th>
                             @endif
                        </tr>
                    </table>
                </th>
                <th width="20px"></th>
                
                <th>
                    <table class="data" style="margin-top: 50px" align="right">
                        <tr class="judul">
                            
                            <th class="isi" width="80px" height="20px"colspan="2">Shift:1 (satu)</th>
                            <th class="isi" width="80px" height="20px" colspan="2">Shift:2 (dua)</th>
                            <th class="isi" width="80px" height="20px" colspan="2">Shift:3 (tiga)</th>
        
                        </tr>
                       
                         <tr class="judul">
                        @if ($shift1->shift == 1)
                       
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p11->ttd) ??''}}" height="70px" width="80px">
                        </th>
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p12->ttd??'') }}" height="70px" width="80px">
                        </th>
                        @else
                        <th class="isi" width="80px" height="70px">
                 
                        </th>
                        <th class="isi" width="80px" height="70px">
                            {{-- <img src="{{ public_path($personil2->ttd) }}" height="70px" width="80px"> --}}
                        </th>
                        @endif
                        @if ($shift2->shift == 2)
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p21->ttd??'') }}" height="70px" width="80px">
                        </th>
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p22->ttd??'') }}" height="70px" width="80px">
                        </th>
                        @else
                        <th class="isi" width="80px" height="70px">
                        
                        </th>
                        <th class="isi" width="80px" height="70px">
                          
                        </th>
                        @endif
                        @if ($shift3->shift == 3)
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p31->ttd??'') }}" height="70px" width="80px">
                        </th>
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p32->ttd??'') }}" height="70px" width="80px">
                        </th>
                        @else
                        <th class="isi" width="80px" height="70px">
                        
                        </th>
                        <th class="isi" width="80px" height="70px">
                            
                        </th>
                        @endif
                    </tr>
                    <tr class="judul">
                        <th class="isi" width="80px" height="20px">{{ $p11->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p12->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p21->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p22->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p31->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p32->nama?? '' }}</th>
                    </tr>
                                              
                @endif
                @if (count($amst)<=32 && count($amst)>16)
                @php
                    $shift3=null;
                    // $shift3->shift=0;
                @endphp
                <table>
                    <th>
                     <table class="data" style="margin-top: 50px" align="left">
                        <tr class="judul">
                            <th class="isi" width="100px" height="20px">Diketahui ,</th>
                            <th class="isi" width="100px" height="20px">Diperiksa,</th>
                        </tr>
                        @php
                        $unit = explode("-", $data->no_mutasi);
                    @endphp
                        @if ($shift1!=null && $shift2!=null && $shift3!=null)
                                <tr class="judul">
                            <th class="isi" width="100px" height="70px"></th>
                            <th class="isi" width="100px" height="70px"></th>
                            
                            
                        </tr>
                        @else
                        <tr class="judul">
                            <th class="isi" width="100px" height="70px"></th>
                            
                            <th class="isi" width="100px" height="70px">
                                
                            </th>
                        </tr>
                        @endif
                       
                       
                        <tr class="judul">
                            <th class="isi" width="100px" height="20px">Bambang Haryanto</th>
                              @if ($unit[0] =='Rescue' || $unit[0] =='Ambulans' )
                            <th class="isi" width="100px" height="20px">Januar Faisal</th>
                             @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek')
                            <th class="isi" width="100px" height="20px">Aryansyah Mahudar</th>
                              @elseif($data->unit[0]==5)
                             <th class="isi" width="100px" height="20px">Ismail</th>
                            @elseif ($unit[0]  =='Senkom' )  <th class="isi" width="100px" height="20px">Bambang Haryanto</th>
                            @endif
                        </tr>
                        <tr class="judul">
                            <th class="role" width="100px" height="20px">Supervisor Operasional dan Pelayanan Lalu Lintas</th>
                                @if ($unit[0]  =='Rescue' || $unit[0] =='Ambulans' )
                            <th class="role" width="100px" height="20px">Koordinator Emergency Response Team</th>
                              @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek')
                            <th class="role" width="100px" height="20px">Koordinator Pelayanan Jalan Tol</th>
                               @elseif($data->unit[0]==5)
                            <th class="role" width="100px" height="20px">Koordinator Security</th>
                             @elseif ($unit[0]  =='Senkom' )  
                             <th class="role" width="100px" height="20px">Supervisor Operasional dan Pelayanan Lalu Lintas</th>
                             @endif
                        </tr>
                    </table>
                </th>
                <th width="20px"></th>
                <th>
                    <table class="data" style="margin-top: 50px" align="right">
                        <tr class="judul">
                            
                            <th class="isi" width="80px" height="20px"colspan="2">Shift:1 (satu)</th>
                            <th class="isi" width="80px" height="20px" colspan="2">Shift:2 (dua)</th>
                            <th class="isi" width="80px" height="20px" colspan="2">Shift:3 (tiga)</th>
        
                        </tr>
                       
                         <tr class="judul">
                        @if ($shift1->shift == 1)
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p11->ttd??'')}}" height="70px" width="80px">
                        </th>
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p12->ttd??'') }}" height="70px" width="80px">
                        </th>
                        @else
                        <th class="isi" width="80px" height="70px">
                           
                        </th>
                        <th class="isi" width="80px" height="70px">
                      
                        </th>
                        @endif
                        @if ($shift2->shift == 2)
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p21->ttd) }}" height="70px" width="80px">
                        </th>
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p22->ttd) }}" height="70px" width="80px">
                        </th>
                        @else
                        <th class="isi" width="80px" height="70px">
                       
                        </th>
                        <th class="isi" width="80px" height="70px">
                          
                        </th>
                        @endif
                       
                        <th class="isi" width="80px" height="70px">
                           
                        </th>
                        <th class="isi" width="80px" height="70px">
                       
                        </th>
                    </tr>
                    <tr class="judul">
                        <th class="isi" width="80px" height="20px">{{ $p11->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p12->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p21->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p22->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px"></th>
                        <th class="isi" width="80px" height="20px"></th>
                    </tr>
                @endif
                @if (count($amst)<=16)
                @php
                    $shift3=null;
                    $shift2=null;
                    // $shift3->shift=0;
                @endphp
                <table>
                    <th>
                     <table class="data" style="margin-top: 50px" align="left">
                        <tr class="judul">
                            <th class="isi" width="100px" height="20px">Diketahui ,</th>
                            <th class="isi" width="100px" height="20px">Diperiksa,</th>
                        </tr>
                        @php
                        $unit = explode("-", $data->no_mutasi);
                    @endphp
                        @if ($shift1!=null && $shift2!=null && $shift3!=null)
                                <tr class="judul">
                            <th class="isi" width="100px" height="70px"></th>
                            <th class="isi" width="100px" height="70px"></th>
                            
                           
                        </tr>
                        @else
                        <tr class="judul">
                            <th class="isi" width="100px" height="70px"></th>
                            
                            <th class="isi" width="100px" height="70px">
                                
                            </th>
                        </tr>
                        @endif
                       
                       
                        <tr class="judul">
                            <th class="isi" width="100px" height="20px">Bambang Haryanto</th>
                              @if ($unit[0] =='Rescue' || $unit[0] =='Ambulans' )
                            <th class="isi" width="100px" height="20px">Januar Faisal</th>
                             @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek')
                            <th class="isi" width="100px" height="20px">Aryansyah Mahudar</th>
                            @elseif(is_array($data->unit) && $data->unit[0] == 5)
                             <th class="isi" width="100px" height="20px">Ismail</th>
                            @elseif ($unit[0]  =='Senkom' )  <th class="isi" width="100px" height="20px">Bambang Haryanto</th>
                            @endif
                        </tr>
                        <tr class="judul">
                            <th class="role" width="100px" height="20px">Supervisor Operasional dan Pelayanan Lalu Lintas</th>
                                @if ($unit[0]  =='Rescue' || $unit[0] =='Ambulans' )
                            <th class="role" width="100px" height="20px">Koordinator Emergency Response Team</th>
                              @elseif ($unit[0]  =='801' || $unit[0] =='802' || $unit[0] =='803' || $unit[0] =='Derek')
                            <th class="role" width="100px" height="20px">Koordinator Pelayanan Jalan Tol</th>
                            @elseif(is_array($data->unit) && $data->unit[0] == 5)
                            <th class="role" width="100px" height="20px">Koordinator Security</th>
                             @elseif ($unit[0]  =='Senkom' )  
                             <th class="role" width="100px" height="20px">Supervisor Operasional dan Pelayanan Lalu Lintas</th>
                             @endif
                        </tr>
                    </table>
                </th>
                <th width="20px"></th>
                <th>
                    <table class="data" style="margin-top: 50px" align="right">
                        <tr class="judul">
                            
                            <th class="isi" width="80px" height="20px"colspan="2">Shift:1 (satu)</th>
                            <th class="isi" width="80px" height="20px" colspan="2">Shift:2 (dua)</th>
                            <th class="isi" width="80px" height="20px" colspan="2">Shift:3 (tiga)</th>
        
                        </tr>
                       
                         <tr class="judul">
                        @if ($shift1->shift == 1)
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p11->ttd) ??''}}" height="70px" width="80px">
                        </th>
                        <th class="isi" width="80px" height="70px">
                            <img src="{{ public_path($p12->ttd) ??'' }}" height="70px" width="80px">
                        </th>
                        @else
                        <th class="isi" width="80px" height="70px">
                            
                        </th>
                        <th class="isi" width="80px" height="70px">
                         
                        </th>
                        @endif
                    
                        <th class="isi" width="80px" height="70px">
                          
                        </th>
                        <th class="isi" width="80px" height="70px">
                     
                        </th>
                        {{-- @endif --}}
                       
                        <th class="isi" width="80px" height="70px">
                         
                        </th>
                        <th class="isi" width="80px" height="70px">
                            {{-- <img src="{{ public_path($personil2->ttd) }}" height="70px" width="80px"> --}}
                        </th>
                    </tr>
                    <tr class="judul">
                        <th class="isi" width="80px" height="20px">{{ $p11->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px">{{ $p12->nama?? '' }}</th>
                        <th class="isi" width="80px" height="20px"></th>
                        <th class="isi" width="80px" height="20px"></th>
                        <th class="isi" width="80px" height="20px"></th>
                        <th class="isi" width="80px" height="20px"></th>
                    </tr>
                @endif    
                                 
                            

                  
                
                </table>
            </th>
           

        </table>
    </body>
</html>
