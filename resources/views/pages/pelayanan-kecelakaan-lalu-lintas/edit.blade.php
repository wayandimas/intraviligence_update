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
                    <form action="{{ route('pelayanan-kendaraan-kecelakaan.update', $datas->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="stasioning" class="label">Stasioning (STA)</label>
                            <select class="form-control" aria-label="Default select example" name=stasioning>

                                <option selected disabled>
                                    Stasioning
                                </option>

                                @foreach ($stationing as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->stationing == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->seksi == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->jalur == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->lajur == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jalur') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="cuaca" class="label">Cuaca</label>
                            <select class="form-control" aria-label="Default select example" name=cuaca>
                                <option selected disabled>
                                    Cuaca
                                </option>
                                @foreach ($weather as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->cuaca == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->sumber_informasi == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('sumber_informasi') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_kejadian" class="label">Tanggal Kejadian</label>
                            <input type="date" class="form-control" placeholder="" required
                                value="{{ $datas->tanggal_kejadian ? \Carbon\Carbon::parse($datas->tanggal_kejadian)->format('Y-m-d') : '' }}"
                                name=tgl_kejadian /><small
                                class="form-text text-danger">{{ $errors->first('tgl_kejadian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wk" class="label">Waktu Kejadian</label>
                            <input type="time" class="form-control" required id="wkm"
                                value="{{ $datas->waktu_kejadian }}" name=wkm onchange="validateTimeMedis()" /><small
                                class="form-text text-danger">{{ $errors->first('wkm') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ws" class="label">Waktu Sampai</label>
                            <input type="time" class="form-control" required value="{{ $datas->waktu_sampai }}"
                                id="wsm" name=wsm onchange="validateTimeMedis()" /><small
                                class="form-text text-danger"id="wsm-error"></small>
                        </div>

                        <div class="form-group">
                            <label for="rt" class="label">Respon Time</label>
                            <input class="form-control" readonly name=rtp value="{{ $datas->respon_time }}"
                                id="rtp" />
                        </div>

                        <div class="form-group">
                            <label for="wsim" class="label">Waktu Selesai</label>
                            <input type="time" class="form-control" required name=wsim
                                value="{{ $datas->waktu_selesai }}" id="wsim"
                                onchange="validateTimeSelesai()" /><small class="form-text text-danger"
                                id="wsim-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dp" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dp value="{{ $datas->durasi_penanganan }}"
                                id="dp" />
                        </div>
                        <div class="form-group">
                            <label for="jk" class="label">Jenis Kecelakaan</label>
                            <select class="form-control" aria-label="Default select example" name=jk>
                                <option selected disabled>
                                    Jenis Kecelakaan
                                </option>
                                @foreach ($typeAccident as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->jenis_kecelakaan == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->penyebab_kecelakaan == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->kategori_kecelakaan == $data->id ? 'selected' : '' }}>
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
                                        {{ $datas->kerugian_kecelakaan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('kek') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="kat" class="label">Kerugian Aset Tol</label>
                            <input type="text" class="form-control" placeholder="" name=kat
                                value="{{ $datas->kerugian_tol }}" /><small
                                class="form-text text-danger">{{ $errors->first('pnk') }}</small>
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
                            <input type="text" class="form-control" placeholder="" required name=asal
                                value="{{ $datas->asal_perjalanan }}" /><small
                                class="form-text text-danger">{{ $errors->first('asal') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="label">Tujuan Perjalanan</label>
                            <input type="text" class="form-control" placeholder="" required name=tujuan
                                value="{{ $datas->tujuan_perjalanan }}" /><small
                                class="form-text text-danger">{{ $errors->first('tujuan') }}</small>
                        </div>
                        <div id="kendaraan-container">
                            @foreach ($datas->detail as $index => $vc)
                                <div class="form-group korban-entry" id="kendaraan-wrapper-{{ $index }}">
                                    <div class="mb-1">
                                        <label for="gk" class="label">Golongan Kendaraan
                                            {{ $index + 1 }}</label>

                                        <select class="form-control" aria-label="Default select example" name=gk[]>
                                            <option>Select Golongan</option>
                                            @foreach ($classVehicle as $key => $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $vc->vehicle_class_id == $data->id ? 'selected' : '' }}>
                                                    {{ $data->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">{{ $errors->first('gk[]') }}</small>
                                    </div>
                                    <div class="mb-1">
                                        <label for="gk" class="label">Nomor Kendaraan
                                            {{ $index + 1 }}</label>
                                        <input type="text" class="form-control" placeholder="" required
                                            value="{{ $vc->nopol }}"
                                            onkeyup="this.value = this.value.toUpperCase()" name=nnk[] />
                                        <small class="form-text text-danger">{{ $errors->first('nnk[]') }}</small>
                                        <small class="form-text text-info">Catatan: Input Tanpa Spasi</small>
                                    </div>

                                    @if ($index >= 0)
                                        <button class="btn btn-danger hapus-kendaraan"
                                            data-id="{{ $index }}">Hapus</button>
                                    @endif
                                    <hr class="thick-hr">
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <a class="btn btn-primary" style="width: 100%; color:white;" id="add-kendaraan"
                                data-id={{ count($datas->detail) }}>Tambah</a>
                        </div>
                        <div class="form-group">
                            <label for="personil1" class="label">Petugas Patroli 1</label>
                            <select class="form-control" name=personil1>
                                @foreach ($patroli as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->personil1 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil2" class="label">Petugas Patroli 2</label>
                            <select class="form-control" name=personil2>
                                @foreach ($patroli as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->personil2 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil2') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugasAmbulan" class="label">Petugas Ambulan</label>
                            <select class="form-control" name=petugasAmbulan>
                                <option selected name=petugasAmbulan>
                                    Petugas Ambulan
                                </option>
                                @foreach ($pAmbulan as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->personil_ambulan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('petugasAmbulan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugasRescue" class="label">Petugas Rescue</label>
                            <select class="form-control" name=petugasRescue>
                                <option selected name=petugasRescue>
                                    Petugas Rescue
                                </option>
                                @foreach ($pRescue as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->personil_rescue == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('petugasRescue') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugasLain" class="label">Petugas Lainnya</label>
                            <select class="form-control" name=petugasLain>
                                <option selected name=petugasLain>
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
                                    <option value="{{ $data->id }}"
                                        {{ $datas->petugas_lainnya == $data->id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
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
                                    {{ $datas->penderekan === 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="transform: scale(1.5)" type="radio"
                                    name="inlineRadioOptions" id="no" onchange="showForm()" value="Tidak"
                                    {{ $datas->penderekan === 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('penderekan') }}</small>
                        </div>

                        <div id="myForm" style="display: none;">
                            <div class="form-group">
                                <label for="derek" class="label">Unit Derek</label>
                                <select class="form-control" aria-label="Default select example" name=derek>
                                    <option selected disabled>
                                        Unit Derek
                                    </option>
                                    <option value="kecil" {{ $datas->unit_derek == 'kecil' ? 'selected' : '' }}>
                                        Kecil
                                    </option>
                                    <option value="besar" {{ $datas->unit_derek == 'besar' ? 'selected' : '' }}>
                                        Besar
                                    </option>

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('derek') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="pd" class="label">Petugas Derek</label>
                                <select class="form-control" aria-label="Default select example" name=pd>
                                    <option selected disabled>
                                        Petugas Derek
                                    </option>
                                    @foreach ($pDerek as $key => $data)
                                        <option value="{{ $data->id }}"
                                            {{ $datas->petugas_derek == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('pd') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="widdkc" class="label">Waktu Informasi Derek Dibutuhkan</label>
                                <input type="time" class="form-control" name=widdkc id="widdkc"
                                    value="{{ $datas->waktu_dibutuhkan }}" /><small
                                    class="form-text text-danger">{{ $errors->first('widdkc-error') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="wdslkc" class="label">Waktu Derek Sampai Lokasi</label>
                                <input type="time" class="form-control" name=wdslkc id="wdslkc"
                                    value="{{ $datas->waktu_sampai_tkp }}" /><small
                                    class="form-text text-danger">{{ $errors->first('wdslkc-error') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="rtdkc" class="label">Respon Time Derek</label>
                                <input class="form-control" readonly name=rtdkc id="rtdkc"
                                    value="{{ $datas->respon_time_derek }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="doc" class="label">Dokumentasi</label>
                            <input type="file" class="form-control-input" name="dokumentasi[]" multiple
                                id="dokumentasi-input" onchange="displayImage()" />
                            <img id="selected-image" width="200" src="#" alt="Selected Image"
                                style="display: none;">
                            <p id="image-title" style="display: none;"></p>
                            <small class="form-text text-danger">{{ $errors->first('dokumentasi') }}</small>
                        </div>
                        <div>
                            @foreach ($datas->image as $image)
                                @if ($image->nama)
                                    <img width="200" src="{{ asset('LKLL/' . $image->nama) }}" alt="">
                                    <p>Current Image: {{ $image->nama }}</p>
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="ket" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" required name=keterangan
                                value="{{ $datas->keterangan }}" /><small
                                class="form-text text-danger">{{ $errors->first('keterangan') }}</small>
                        </div>
                        <div class="form-group" style="display: flex; justify-content: center ">

                            {{-- <div class="p-t-15" style="margin-right: 10px;">
                            <a class="btn btn-primary btn-block" href="{{ route('pelayanan-kendaraan-kecelakaan.editNext',$datas->id) }}">
                                Next
                            </a>
                        </div> --}}
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
            // Click event handler for "Tambah" button
            $("#add-kendaraan").click(function() {
                // Get the current data-id and increment it by 1
                let id = parseInt($(this).attr("data-id")) + 1;
                $(this).attr("data-id", id);

                // New input for Korban
                let input = `
            <div class="form-group korban-entry" id="kendaraan-wrapper-${id}">
                <div class="mb-1">
                    <label for="gk" class="label">Golongan Kendaraan ${id}</label>
        
                    <select
                    class="form-control"
                    aria-label="Default select example"
                    name = gk[]>
                    <option>Select Golongan</option>
                    @foreach ($classVehicle as $key => $data)
                        <option value="{{ $data->id }}">
                            {{ $data->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-danger">{{ $errors->first('gk[]') }}</small>
                </div>
                <div class="mb-1">
                    <label for="gk" class="label">Nomor Kendaraan ${id}</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder=""
                    required
                    onkeyup="this.value = this.value.toUpperCase()"
                    name = nnk[]
                />
                <small class="form-text text-danger">{{ $errors->first('nnk[]') }}</small>
                <small class="form-text text-info">Catatan: Input Tanpa Spasi</small>
                </div>
                <button class="btn btn-danger hapus-korban" data-id="${id}">Hapus</button>
            <hr class="thick-hr"> 
            </div>
            `;

                // Append new inputs to the korban container
                $("#kendaraan-container").append(input);
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

</html>
