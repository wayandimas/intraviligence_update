<!doctype html>
<html lang="en">

<head>
    <title>Laporan Pelayanan Kendaraan Gangguan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all" />
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all" />
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

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
                    <a href="{{ route('admin.pelayanan-kendaraan-gangguan') }}" type="button" class="btn btn-primary"
                        style=" margin-bottom:10px">Back</a>
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

                    <h2 class="title">Form Pelayanan Kendaraan Gangguan</h2>
                    <form action="{{ route('admin.pelayanan-kendaraan-gangguan.update', $datas->id) }}" method="POST"
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
                            <input type="time" class="form-control" required id="wk" name=wk
                                value="{{ $datas->waktu_kejadian }}" /><small
                                class="form-text text-danger">{{ $errors->first('wk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ws" class="label">Waktu Sampai</label>
                            <input type="time" class="form-control" required id="ws" name=ws
                                value="{{ $datas->waktu_sampai }}" onchange="validateTime()" /><small
                                class="form-text text-danger"id="ws-error"></small>
                        </div>

                        <div class="form-group">
                            <label for="rt" class="label">Respon Time</label>
                            <input class="form-control" readonly name=rt id="rt"
                                value="{{ $datas->respon_time }}" />
                        </div>

                        <div class="form-group">
                            <label for="wsi" class="label">Waktu Selesai</label>
                            <input type="time" class="form-control" required name=wsi id="wsi"
                                value="{{ $datas->waktu_selesai }}" onchange="validateTimeSelesai()" /><small
                                class="form-text text-danger" id="wsi-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dp" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dp id="dp"
                                value="{{ $datas->durasi_penanganan }}" />
                        </div>
                        <div class="form-group">
                            <label for="jg" class="label">Jenis Gangguan</label>
                            <select class="form-control" aria-label="Default select example" name=jg>
                                <option selected disabled>
                                    Jenis Gangguan
                                </option>
                                @foreach ($interference as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->jenis_gangguan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="gk" class="label">Golongan Kendaraan</label>
                            <select class="form-control" aria-label="Default select example" name=gk>
                                <option selected disabled>
                                    Golongan Kendaraan
                                </option>
                                @foreach ($classVehicle as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->golongan_kendaraan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('gk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jk" class="label">Jenis Kendaraan</label>
                            <select class="form-control" aria-label="Default select example" name=jk>
                                <option selected disabled>
                                    Jenis Kendaraan
                                </option>
                                @foreach ($typeVehicle as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->jenis_kendaraan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="pnk" class="label">Plat Nomor Kendaraan</label>
                            <input type="text" class="form-control" placeholder="" required
                                onkeyup="this.value = this.value.toUpperCase()" name=pnk
                                value="{{ $datas->plat_nomor }}" /><small
                                class="form-text text-danger">{{ $errors->first('pnk') }}</small>
                            <small class="form-text text-info">Catatan: Input Tanpa Spasi</small>
                        </div>
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
                        <div class="form-group">
                            <label for="personil1" class="label">Personil 1</label>
                            <select class="form-control" aria-label="Default select example" name=personil1 readonly
                                disabled>
                                @if ($p1 != null)
                                    <option readonly value="{{ $p1->id }}">{{ $p1->nama }}</option>
                                @elseif ($pa != null)
                                    <option readonly value="{{ $pa->id }}">{{ $pa->nama }}</option>
                                @endif

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil2" class="label">Personil 2</label>
                            <select class="form-control" aria-label="Default select example" name=personil2 readonly
                                disabled>
                                @if ($p2 != null)
                                    <option readonly value="{{ $p2->id }}">{{ $p2->nama }}</option>
                                @elseif ($pa != null)
                                    <option readonly value="{{ $pa->id }}">{{ $pa->nama }}</option>
                                @endif

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil2') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil3" class="label">Personil 3</label>
                            <select class="form-control" name=personil3>
                                <option selected disabled="disabled">
                                    Personil 3
                                </option>
                                @foreach ($officer as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->personil3 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil3') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="penderekan" class="label">Penderekan</label>


                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="transform: scale(1.5)" type="radio"
                                    name="inlineRadioOptions" id="yes" onclick="showForm()" value="Ya"
                                    {{ $datas->penderekan === 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="transform: scale(1.5)" type="radio"
                                    name="inlineRadioOptions" id="no" onclick="showForm()" value="Tidak"
                                    {{ $datas->penderekan === 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('penderekan') }}</small>
                        </div>

                        <div id="myForm" style="display: none;">
                            <div class="form-group">
                                <label for="derek" class="label">Unit Derek</label>
                                <select class="form-control" aria-label="Default select example" name=derek>

                                    <option selected disabled>Unit Derek</option>
                                    <option value="kecil" {{ $datas->unit_derek == 'kecil' ? 'selected' : '' }}>
                                        Kecil</option>
                                    <option value="besar" {{ $datas->unit_derek == 'besar' ? 'selected' : '' }}>
                                        Besar</option>

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('derek') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="pd" class="label">Petugas Derek</label>
                                <select class="form-control" aria-label="Default select example" name=pd>
                                    <option selected disabled>
                                        Petugas Derek
                                    </option>
                                    @foreach ($derek as $key => $data)
                                        <option value="{{ $data->id }}"
                                            {{ $datas->petugas_derek == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('pd') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="widd" class="label">Waktu Informasi Derek Dibutuhkan</label>
                                <input type="time" class="form-control" name=widd id="widd"
                                    value="{{ $datas->waktu_dibutuhkan }}" /><small
                                    class="form-text text-danger">{{ $errors->first('widd') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="wdsl" class="label">Waktu Derek Sampai Lokasi</label>
                                <input type="time" class="form-control" name=wdsl id="wdsl"
                                    value="{{ $datas->waktu_sampai_tkp }}" /><small
                                    class="form-text text-danger">{{ $errors->first('wdsl') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="rtd" class="label">Respon Time Derek</label>
                                <input class="form-control" readonly name=rtd id="rtd"
                                    value="{{ $datas->respon_time_derek }}" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="ket" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" required name=keterangan
                                value="{{ $datas->keterangan }}" /><small
                                class="form-text text-danger">{{ $errors->first('keterangan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="doc" class="label">Dokumentasi (Masukkan 2 Gambar)</label>
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
                                    <img width="200" src="{{ asset('LPKG/' . $image->nama) }}" alt="">
                                    <p>Current Image: {{ $image->nama }}</p>
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            @endforeach

                        </div>

                        <div class="form-group">
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
                <p>&copy; 2023 Developed By TKJ PNUP</p>
            </div>
        </div>
    </div>
</footer>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.js')
</body>

</html>
