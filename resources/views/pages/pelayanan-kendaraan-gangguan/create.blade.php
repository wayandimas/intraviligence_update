<!doctype html>
<html lang="en">

<head>
    <title>Laporan Pelayanan Kendaraan Gangguan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <script>
        document.addEventListener("DOMContentLoaded", showForm);
    </script>

    @include('partials.css')
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body" style="padding:0px">
                    <a href="{{ route('pelayanan-kendaraan-gangguan.index') }}" type="button" class="btn btn-primary"
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
                    <form action="{{ route('pelayanan-kendaraan-gangguan.store') }}" method="POST"
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
                                value="{{ old('tgl_kejadian') }}" /><small
                                class="form-text text-danger">{{ $errors->first('tgl_kejadian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wk" class="label">Waktu Kejadian</label>
                            <input type="time" class="form-control"id="wk" name=wk
                                value="{{ old('wk') }}" /><small
                                class="form-text text-danger">{{ $errors->first('wk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ws" class="label">Waktu Sampai</label>
                            <input type="time" class="form-control"id="ws" name=ws
                                value="{{ old('ws') }}" onchange="validateTime()" /><small
                                class="form-text text-danger"id="ws-error"></small>
                            <small class="form-text text-danger">{{ $errors->first('ws-error') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="rt" class="label">Respon Time</label>
                            <input class="form-control" readonly name=rt id="rt"
                                value="{{ old('rt') }}" />
                        </div>

                        <div class="form-group">
                            <label for="wsi" class="label">Waktu Selesai</label>
                            <input type="time" class="form-control"name=wsi id="wsi"
                                value="{{ old('wsi') }}" onchange="validateTimeSelesai()" /><small
                                class="form-text text-danger" id="wsi-error"></small><small
                                class="form-text text-danger">{{ $errors->first('wsi-error') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="dp" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dp id="dp"
                                value="{{ old('dp') }}" />
                        </div>
                        <div class="form-group">
                            <label for="jg" class="label">Jenis Gangguan</label>
                            <select class="form-control" aria-label="Default select example" name=jg>
                                <option selected disabled>
                                    Jenis Gangguan
                                </option>
                                @foreach ($interference as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('jg') == $data->id ? 'selected' : '' }}>
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
                                        {{ old('gk') == $data->id ? 'selected' : '' }}>
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
                                        {{ old('jk') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="pnk" class="label">Plat Nomor Kendaraan</label>
                            <input type="text" class="form-control" placeholder="" value="{{ old('pnk') }}"
                                onkeyup="this.value = this.value.toUpperCase()" name=pnk /><small
                                class="form-text text-danger">{{ $errors->first('pnk') }}</small>
                            <small class="form-text text-info">Catatan: Input Tanpa Spasi</small>
                        </div>
                        <div class="form-group">
                            <label for="asal" class="label">Asal Perjalanan</label>
                            <input type="text" class="form-control" placeholder=""name=asal
                                value="{{ old('asal') }}" /><small
                                class="form-text text-danger">{{ $errors->first('asal') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="label">Tujuan Perjalanan</label>
                            <input type="text" class="form-control" placeholder=""name=tujuan
                                value="{{ old('tujuan') }}" /><small
                                class="form-text text-danger">{{ $errors->first('tujuan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil1" class="label">Personil 1</label>
                            <select class="form-control" aria-label="Default select example" name=personil1 readonly
                                disabled>
                                @if ($p1 != null)
                                    <option readonly value={{ $p1->id }}>
                                        {{ $p1->nama }}
                                    </option>
                                @elseif ($pAmbulan != null)
                                    <option readonly value={{ $pAmbulan->id }}>
                                        {{ $pAmbulan->nama }}
                                    </option>
                                @elseif($pSecurity != null)
                                    <option readonly value={{ $pSecurity->id }}>
                                        {{ $pSecurity->nama }}
                                    </option>
                                @elseif($psn != null)
                                    <option readonly value={{ $psn->id }}>
                                        {{ $psn->nama }}
                                    </option>
                                @elseif($pr != null)
                                    <option readonly value={{ $pr->id }}>
                                        {{ $pr->nama }}
                                    </option>
                                @elseif($pdk != null)
                                    <option readonly value={{ $pdk->id }}>
                                        {{ $pdk->nama }}
                                    </option>
                                @endif


                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil2" class="label">Personil 2</label>
                            <select class="form-control" aria-label="Default select example" name=personil2 readonly
                                disabled>
                                @if ($p2 != null)
                                    <option value={{ $p2->id }}>
                                        {{ $p2->nama }}
                                    </option>
                                @elseif ($pAmbulan != null)
                                    <option readonly value={{ $pAmbulan->id }}>
                                        {{ $pAmbulan->nama }}
                                    </option>
                                @elseif($pSecurity != null)
                                    <option readonly value={{ $pSecurity->id }}>
                                        {{ $pSecurity->nama }}
                                    </option>
                                @elseif($pr != null)
                                    <option readonly value={{ $pr->id }}>
                                        {{ $pr->nama }}
                                    </option>
                                @elseif($pdk != null)
                                    <option readonly value={{ $pdk->id }}>
                                        {{ $pdk->nama }}
                                    </option>
                                @elseif($ptis != null)
                                    <option value={{ $ptis->id }}>
                                        {{ $ptis->nama }}
                                    </option>
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
                                        {{ old('personil3') == $data->id ? 'selected' : '' }}>
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
                                        Unit Derek {{ old('derek') ? 'selected' : '' }}
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
                                <select class="form-control" aria-label="Default select example" name=pd>
                                    <option selected disabled>
                                        Petugas Derek {{ old('pd') == $data->id ? 'selected' : '' }}
                                    </option>
                                    @foreach ($derek as $key => $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="form-text text-danger">{{ $errors->first('pd') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="widd" class="label">Waktu Informasi Derek Dibutuhkan</label>
                                <input type="time" class="form-control" name=widd id="widd"
                                    value="{{ old('widd') }}" /><small
                                    class="form-text text-danger">{{ $errors->first('widd') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="wdsl" class="label">Waktu Derek Sampai Lokasi</label>
                                <input type="time" class="form-control" name=wdsl id="wdsl"
                                    value="{{ old('wdsl') }}" onchange="validateTimeDerek()" /><small
                                    class="form-text text-danger">{{ $errors->first('wdsl') }}</small>
                                <small class="form-text text-danger" id="wdsl-error"></small>
                            </div>

                            <div class="form-group">
                                <label for="rtd" class="label">Respon Time Derek</label>
                                <input class="form-control" readonly name=rtd id="rtd"
                                    value="{{ old('rtd') }}" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="ket" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" name=keterangan
                                value="{{ old('keterangan') }}" /><small
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

    @include('partials.js')
    <script>
        function displayImage() {
            var input = document.getElementById("dokumentasi-input");
            var selectedImage = document.getElementById("selected-image");
            var imageTitle = document.getElementById("image-title");

            selectedImage.style.display = "block";
            imageTitle.style.display = "block";

            selectedImage.src = URL.createObjectURL(input.files[0]);
            imageTitle.textContent = 'Preview Image';
        }
    </script>
    <script>
        function showForm() {
            var form = document.getElementById("myForm");

            // var radioYes = document.getElementById("yes");
            // var radioValue = "{{ session('inlineRadioOptions') }}";

            if (document.getElementById("yes").checked) {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }

        }
        document.addEventListener("DOMContentLoaded", showForm);
    </script>

</body>

</html>
