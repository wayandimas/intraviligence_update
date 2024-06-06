<!doctype html>
<html lang="en">

<head>
    <title>Laporan Pelayanan Kecelakaan Lalu Lintas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <script>
        function showForm() {
            var form = document.getElementById("myForm");
            if (document.getElementById("yes").checked) {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
    <script>
        function saveFormData() {
            var formData = {
                stasioning: document.getElementsByName('stasioning')[0].value,
                seksi: document.getElementsByName('seksi')[0].value
                lajur: document.getElementsByName('lajur')[0].value
                jalur: document.getElementsByName('jalur')[0].value
                cuaca: document.getElementsByName('cuaca')[0].value
                sumber_informasi: document.getElementsByName('sumber_informasi')[0].value
                tgl_kejadian: document.getElementsByName('tgl_kejadian')[0].value
                wk: document.getElementsByName('wk')[0].value
                ws: document.getElementsByName('ws')[0].value
                wsi: document.getElementsByName('wsi')[0].value
                jk: document.getElementsByName('jk')[0].value
                pk: document.getElementsByName('pk')[0].value
                kk: document.getElementsByName('kk')[0].value
                kek: document.getElementsByName('kek')[0].value
                pnk: document.getElementsByName('pnk')[0].value
                asal: document.getElementsByName('asal')[0].value
                gk[]: document.getElementsByName('gk[]')[0].value
                nnk[]: document.getElementsByName('nnk[]')[0].value
                personil1: document.getElementsByName('personil1')[0].value
                personil2: document.getElementsByName('personil2')[0].value
                petugasAmbulan: document.getElementsByName('petugasAmbulan')[0].value
                petugasRescue: document.getElementsByName('petugasRescue')[0].value
                petugasLain: document.getElementsByName('petugasLain')[0].value
                penderekan: document.getElementsByName('penderekan')[0].value
                derek: document.getElementsByName('derek')[0].value
                petugasDerek: document.getElementsByName('petugasDerek')[0].value
                widd: document.getElementsByName('widd')[0].value
                wdsl: document.getElementsByName('wdsl')[0].value
                dokumentasi[]: document.getElementsByName('dokumentasi[]')[0].value
                keterangan: document.getElementsByName('keterangan')[0].value
                rt: document.getElementsByName('rt')[0].value
                dp: document.getElementsByName('dp')[0].value
            };
            console.log(formData)
            localStorage.setItem('formData', JSON.stringify(formData));
        }


        function restoreFormData() {
            var formData = JSON.parse(localStorage.getItem('formData'));
            if (formData) {
                document.getElementsByName('stasioning')[0].value = formData.stasioning;
                document.getElementsByName('seksi')[0].value = formData.seksi;
                document.getElementsByName('lajur')[0].value = formData.lajur;
                document.getElementsByName('jalur')[0].value = formData.jalur;
                document.getElementsByName('cuaca')[0].value = formData.cuaca;
                document.getElementsByName('sumber_informasi')[0].value = formData.sumber_informasi;
                document.getElementsByName('tgl_kejadian')[0].value = formData.tgl_kejadian;
                document.getElementsByName('wk')[0].value = formData.wk;
                document.getElementsByName('ws')[0].value = formData.ws;
                document.getElementsByName('wsi')[0].value = formData.wsi;
                document.getElementsByName('jk')[0].value = formData.jk;
                document.getElementsByName('pk')[0].value = formData.pk;
                document.getElementsByName('kk')[0].value = formData.kk;
                document.getElementsByName('kek')[0].value = formData.kek;
                document.getElementsByName('pnk')[0].value = formData.pnk;
                document.getElementsByName('asal')[0].value = formData.asal;
                document.getElementsByName('gk[]')[0].value = formData.gk[];
                document.getElementsByName('nnk[]')[0].value = formData.nnk[];
                document.getElementsByName('personil1')[0].value = formData.personil1;
                document.getElementsByName('personil2')[0].value = formData.personil2;
                document.getElementsByName('petugasAmbulan')[0].value = formData.petugasAmbulan;
                document.getElementsByName('petugasRescue')[0].value = formData.petugasRescue;
                document.getElementsByName('petugasLain')[0].value = formData.petugasLain;
                document.getElementsByName('penderekan')[0].value = formData.penderekan;
                document.getElementsByName('derek')[0].value = formData.derek;
                document.getElementsByName('petugasDerek')[0].value = formData.petugasDerek;
                document.getElementsByName('widd')[0].value = formData.widd;
                document.getElementsByName('wdsl')[0].value = formData.wdsl;
                document.getElementsByName('dokumentasi[]')[0].value = formData.dokumentasi[];
                document.getElementsByName('keterangan')[0].value = formData.keterangan;
                document.getElementsByName('dp')[0].value = formData.dp;
                document.getElementsByName('rt')[0].value = formData.rt;

            }


        }
    </script>
    @include('partials.css')
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body" style="padding:0px">
                    <a href="{{ route('pelayanan-kecelakaan-lalu-lintas.index') }}" type="button"
                        class="btn btn-primary" style=" margin-bottom:10px">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->first('message'))
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('message') }}
                            </div>
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-info" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="dropdown">
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ Auth::user()->nama }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('logout.index') }}">Logout</a>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="text-align: end">
                            <p id="tanggalwaktu" name=tanggalwaktu>Date</p>
                        </div>
                    </div>

                    <h2 class="title">Form Pelayanan Penanganan Kecelakaan Lalu Lintas</h2>
                    <form action="{{ route('pelayanan-kecelakaan-lalu-lintas.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="stasioning" class="label">Stasioning (STA)</label>
                            <select class="form-control" aria-label="Default select example" name=stasioning>

                                <option selected disabled>
                                    Stasioning
                                </option>

                                @foreach ($stationing as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('stasioning') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('stasioning') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="seksi" class="label">Seksi</label>
                            <select class="form-control" aria-label="Default select example" name=seksi>
                                <option selected disabled>
                                    Seksi
                                </option>
                                @foreach ($section as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('seksi') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('seksi') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="jalur" class="label">Jalur</label>
                            <select class="form-control" aria-label="Default select example" name=jalur>
                                <option selected disabled>
                                    Jalur
                                </option>
                                @foreach ($track as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('jalur') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jalur') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="lajur" class="label">Lajur</label>
                            <select class="form-control" aria-label="Default select example" name=lajur>
                                <option selected disabled>
                                    Lajur
                                </option>
                                @foreach ($lane as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('lajur') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('lajur') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="cuaca" class="label">Cuaca</label>
                            <select class="form-control" aria-label="Default select example" name=cuaca>
                                <option selected disabled>
                                    Cuaca
                                </option>
                                @foreach ($weather as $key => $data)
                                    <option value="{{ $data->id }} "
                                        {{ old('cuaca') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('cuaca') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sumber_informasi" class="label">Sumber Informasi</label>
                            <select class="form-control" aria-label="Default select example" name=sumber_informasi>
                                <option selected disabled>
                                    Sumber Informasi
                                </option>
                                @foreach ($information as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('sumber_informasi') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('sumber_informasi') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_kejadian" class="label">Tanggal Kejadian</label>
                            <input type="date" class="form-control" placeholder=""
                                id="tgl_kejadian"{{ date('Y-m-d') }} name=tgl_kejadian
                                value="{{ old('tgl_kejadian') }}" /> <small
                                class="form-text text-danger">{{ $errors->first('tgl_kejadian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wkm" class="label">Waktu Kejadian</label>
                            <input type="time" class="form-control" id="wkm" name=wkm
                                value="{{ old('wkm') }}" onchange="validateTimeMedis()" /><small
                                class="form-text text-danger">{{ $errors->first('wkm') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wsm" class="label">Waktu Sampai</label>
                            <input type="time" class="form-control" id="wsm" name=wsm
                                value="{{ old('wsm') }}" onchange="validateTimeMedis()" /><small
                                class="form-text text-danger"id="wsm-error"></small>
                        </div>

                        <div class="form-group">
                            <label for="rtp" class="label">Respon Time</label>
                            <input class="form-control" readonly name=rtp id="rtp"
                                value="{{ old('rtp') }}" />
                            <small class="form-text text-danger">{{ $errors->first('rtp') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="wsim" class="label">Waktu Selesai</label>
                            <input type="time" class="form-control" name=wsim
                                id="wsim"value="{{ old('wsim') }}"
                                onchange="validateTimePenanganan()" /><small
                                class="form-text text-danger"id="wsim-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dp" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dp id="dp"
                                value="{{ old('dp') }}" />
                        </div>
                        <div class="form-group">
                            <label for="jk" class="label">Jenis Kecelakaan</label>
                            <select class="form-control" aria-label="Default select example" name=jk>
                                <option selected disabled>
                                    Jenis Kecelakaan
                                </option>
                                @foreach ($typeAccident as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('jk') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="pk" class="label">Penyebab Kecelakaan</label>
                            <select class="form-control" aria-label="Default select example" name=pk>
                                <option selected disabled>
                                    Penyebab Kecelakaan
                                </option>
                                @foreach ($causeAccident as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('pk') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('pk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="kk" class="label">Kategori Kecelakaan</label>
                            <select class="form-control" aria-label="Default select example" name=kk>
                                <option selected disabled>
                                    Kategori Kecelakaan
                                </option>
                                @foreach ($categoryAccident as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('kk') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('kk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="kek" class="label">Kerugian Kecelakaan</label>
                            <select class="form-control" aria-label="Default select example" name=kek>
                                <option selected disabled>
                                    Kerugian Kecelakaan
                                </option>
                                @foreach ($lossAccident as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('kek') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('kek') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="kat" class="label">Kerugian Aset Tol</label>
                            <input type="text" class="form-control" placeholder="" name=kat
                                value="{{ old('kat') }}" /><small
                                class="form-text text-danger">{{ $errors->first('kat') }}</small>
                            <small class="form-text text-info">Catatan: Isi Jika Ada Kerugian Aset Tol</small>
                        </div>
                        {{-- <div class="form-group">
                        <label for="jk" class="label"
                        >Jenis Kendaraan</label
                        >
                        <select
                            class="form-control"
                            aria-label="Default select example"
                            name = jk
                        >
                            <option selected disabled>
                                Jenis Kendaraan
                            </option>
                            @foreach ($typeVehicle as $key => $data)
                                <option value="{{$data->id}}">
                                    {{$data->nama}}
                                </option>
                            @endforeach

                        </select>
                        <small class="form-text text-danger">{{ $errors->first('jk') }}</small>
                    </div> --}}
                        <div class="form-group">
                            <label for="asal" class="label">Asal Perjalanan</label>
                            <input type="text" class="form-control" placeholder="" name=asal
                                value="{{ old('asal') }}" /><small
                                class="form-text text-danger">{{ $errors->first('asal') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="label">Tujuan Perjalanan</label>
                            <input type="text" class="form-control" placeholder="" name=tujuan
                                value="{{ old('tujuan') }}" /><small
                                class="form-text text-danger">{{ $errors->first('tujuan') }}</small>
                        </div>
                        <div id="kendaraan-container">

                            <div class="form-group korban-entry" id="kendaraan-wrapper-0">
                                <div class="mb-1">
                                    <label for="gk" class="label">Golongan Kendaraan 1</label>

                                    <select class="form-control" aria-label="Default select example" name="gk[]">
                                        <option>Select Golongan </option>
                                        @foreach ($classVehicle as $key => $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-danger"></small>
                                </div>
                                <div class="mb-1">
                                    <label for="gk" class="label">Nomor Kendaraan 1</label>
                                    <input type="text" class="form-control" placeholder="" required
                                        onkeyup="this.value = this.value.toUpperCase()" name="nnk[]" />
                                    <small class="form-text text-danger"></small>
                                    <small class="form-text text-info">Catatan: Input Tanpa Spasi</small>
                                </div>
                                <hr class="thick-hr">
                            </div>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-primary" style="width: 100%; color:white;" id="add-kendaraan"
                                data-id=0>Tambah</a>
                        </div>
                        <div class="form-group">
                            <label for="personil1" class="label">Petugas Patroli 1</label>
                            <select class="form-control" aria-label="Default select example" name=personil1>
                                <option selected disabled name=personil1>
                                    Petugas Patroli 1
                                </option>
                                @foreach ($patroli as $key => $data)
                                    <option
                                        value="{{ $data->id }}"{{ old('personil1') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil2" class="label">Petugas Patroli 2</label>
                            <select class="form-control" aria-label="Default select example" name=personil2>
                                <option selected disabled name=personil2>
                                    Petugas Patroli 2
                                </option>
                                @foreach ($patroli as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('personil2') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil2') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugasAmbulan" class="label">Petugas Ambulan</label>
                            <select class="form-control" name=petugasAmbulan>
                                <option selected disabled name=petugasAmbulan>
                                    Petugas Ambulan
                                </option>
                                @foreach ($pAmbulan as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('petugasAmbulan') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('petugasAmbulan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugasRescue" class="label">Petugas Rescue</label>
                            <select class="form-control" name=petugasRescue>
                                <option selected disabled name=petugasRescue>
                                    Petugas Rescue
                                </option>
                                @foreach ($pRescue as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('petugasRescue') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('petugasRescue') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugasLain" class="label">Petugas Lainnya</label>
                            <select class="form-control" name=petugasLain>
                                <option selected disabled name=petugasLain>
                                    Petugas Lainnya
                                </option>
                                @foreach ($pAnother as $key => $data)
                                    @php
                                        $id = $data->operasional_id;
                                        $nama = $data->nama;
                                        if ($id == 5) {
                                            $nama = 'Security Tol-' . $nama;
                                        } elseif ($id == 11) {
                                            $nama = 'Senkom-' . $nama;
                                        }
                                        $nama = $nama;
                                        
                                    @endphp
                                    <option
                                        value="{{ $data->id }}"{{ old('petugasLalin') == $data->id ? 'selected' : '' }}>
                                        {{ $nama }}</option>
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('petugasLain') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="penderekan" class="label">Penderekan</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="transform: scale(1.5)" type="radio"
                                    name="inlineRadioOptions" id="yes" onchange="showForm()" value="Ya"
                                    {{ old('inlineRadioOptions') === 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="transform: scale(1.5)" type="radio"
                                    name="inlineRadioOptions" id="no" onchange="showForm()" value="Tidak"
                                    {{ old('inlineRadioOptions') === 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('inlineRadioOptions') }}</small>
                        </div>

                        <div id="myForm" style="display: none;">
                            <div class="form-group">
                                <label for="derek" class="label">Unit Derek</label>
                                <select class="form-control" aria-label="Default select example" name=derek>
                                    <option selected disabled>
                                        Unit Derek
                                    </option>
                                    <option value="kecil">
                                        Kecil
                                    </option>
                                    <option value="besar">
                                        Besar
                                    </option>

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('derek') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="pd" class="label">Petugas Derek</label>
                                <select class="form-control" aria-label="Default select example" name=petugasDerek>
                                    <option selected disabled>
                                        Petugas Derek
                                    </option>
                                    @foreach ($pDerek as $key => $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('petugasDerek') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="widd" class="label">Waktu Informasi Derek Dibutuhkan</label>
                                <input type="time" class="form-control" name=widdkc id="widdkc" /><small
                                    class="form-text text-danger">{{ $errors->first('widdkc') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="wdsl" class="label">Waktu Derek Sampai Lokasi</label>
                                <input type="time" class="form-control" name=wdslkc id="wdslkc"
                                    onchange="validateTimeDerek()" /><small
                                    class="form-text text-danger"id="wdsl-error"></small>
                            </div>

                            <div class="form-group">
                                <label for="rtd" class="label">Respon Time Derek</label>
                                <input class="form-control" readonly name=rtdkc id="rtdkc" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="doc" class="label">Dokumentasi (Masukkan 4 Gambar)</label>
                            <input type="file" class="form-control-input" name="dokumentasi[]"
                                value="{{ old('dokumentasi') }}" multiple /><small
                                class="form-text text-danger">{{ $errors->first('dokumentasi') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" name=keterangan
                                value="{{ old('keterangan') }}" /><small
                                class="form-text text-danger">{{ $errors->first('keterangan') }}</small>
                        </div>
                        <div class="form-group" style="display: flex; justify-content: center ">

                            <div class="p-t-15" style="margin-right: 10px;">
                                <button class="btn btn-primary btn-block" name="action" value="next">
                                    Next
                                </button>
                            </div>

                            <div class="p-t-15">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                             <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Isi footer, misalnya informasi tambahan, tautan, dll. -->
                <p>&copy; 2023 Developed By Teknik Komputer dan Jaringan PNUP</p>
            </div>
        </div>
    </div>
</footer>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Jquery JS-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"
        integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(document).ready(function() {
            let entryCount = 1; // Initialize the entry count

            // Click event handler for "Tambah Kendaraan" button
            $("#add-kendaraan").click(function() {
                let id = entryCount;

                // New input for Kendaraan
                let input = `
                <div class="form-group korban-entry" id="kendaraan-wrapper-${id}">
                    <div class="mb-1">
                        <label for="gk" class="label">Golongan Kendaraan ${id}</label>
                        <select class="form-control" aria-label="Default select example" name="gk[]">
                            <option>Select Golongan</option>
                            @foreach ($classVehicle as $key => $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-danger"></small>
                    </div>
                    <div class="mb-1">
                        <label for="gk" class="label">Nomor Kendaraan ${id}</label>
                        <input type="text" class="form-control" placeholder="" required
                            onkeyup="this.value = this.value.toUpperCase()" name="nnk[]" />
                        <small class="form-text text-danger"></small>
                        <small class="form-text text-info">Catatan: Input Tanpa Spasi</small>
                    </div>
                    <button class="btn btn-danger hapus-kendaraan" data-id="${id}">Hapus</button>
                    <hr class="thick-hr">
                </div>
            `;

                // Append new inputs to the kendaraan container
                $("#kendaraan-container").append(input);
                entryCount++; // Increment the entry count
            });

            // Click event handler for "Hapus" button
            $(document).on('click', '.hapus-kendaraan', function() {
                var id = parseInt($(this).data("id"));
                $('#kendaraan-wrapper-' + id).remove();
            });
        });
    </script>


    @include('partials.js')

</body>
<script>
    document.addEventListener('DOMContentLoaded', restoreFormData);
</script>


</html>
