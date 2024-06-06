<!doctype html>
<html lang="en">

<head>
    <title>Laporan Pelayanan dan Pengendalian Operasional</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
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

</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body" style="padding:0px">
                    <a href="{{ route('pelayanan-pengendalian-operasional.index') }}" type="button"
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

                    <h2 class="title">Form Pelayanan dan Pengendalian Operasional</h2>
                    <form action="{{ route('pelayanan-pengendalian-operasional.update', $datas->id) }}" method="POST"
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
                            <input type="date" class="form-control" placeholder=""
                                value="{{ $datas->tanggal_kejadian ? \Carbon\Carbon::parse($datas->tanggal_kejadian)->format('Y-m-d') : '' }}"
                                name=tgl_kejadian /><small
                                class="form-text text-danger">{{ $errors->first('tgl_kejadian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wkpo" class="label">Waktu Kejadian</label>
                            <input type="time" class="form-control" id="wkpo" name=wkpo
                                value="{{ $datas->waktu_kejadian }}" /><small
                                class="form-text text-danger">{{ $errors->first('wkpo') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wspo" class="label">Waktu Sampai</label>
                            <input type="time" class="form-control" id="wspo" name=wspo
                                onchange="validateTimeDurasiPenangananOperasional()"
                                value="{{ $datas->waktu_sampai }}" />
                            <small class="form-text text-danger"id="wspo-error"></small>
                            <small class="form-text text-danger">{{ $errors->first('wspo') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="rtpo" class="label">Respon Time</label>
                            <input class="form-control" readonly name=rtpo id="rtpo"
                                value="{{ $datas->respon_time }}" />
                        </div>

                        <div class="form-group">
                            <label for="wsipo" class="label">Waktu Selesai</label>
                            <input type="time" class="form-control" name=wsipo id="wsipo"
                                onchange="validateTimeSelesai()" value="{{ $datas->waktu_selesai }}" /><small
                                class="form-text text-danger" id="wsipo-error"></small><small
                                class="form-text text-danger">{{ $errors->first('wsipo') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="dppo" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dppo id="dppo"
                                value="{{ $datas->durasi_penanganan }}" />
                        </div>
                        <div class="form-group">
                            <label for="jk" class="label">Jenis Kegiatan</label>
                            <select class="form-control" aria-label="Default select example" name=jk>
                                <option selected disabled>
                                    Jenis Kegiatan
                                </option>
                                @foreach ($activity as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ $datas->jenis_kegiatan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jk') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="dk" class="label">Deskripsi Kegiatan</label>
                            <input type="text" class="form-control" placeholder="" name=dk
                                value="{{ $datas->deskripsi_kegiatan }}" /><small
                                class="form-text text-danger">{{ $errors->first('dk') }}</small>
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
                                @endif

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil2" class="label">Personil 2</label>
                            <select class="form-control" aria-label="Default select example" name=personil2 readonly
                                disabled>
                                <option value={{ $p2->id }}>
                                    {{ $p2->nama }}
                                </option>
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
                                        {{ $datas->personil3 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil3') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil4" class="label">Personil 4</label>
                            <select class="form-control" name=personil4>
                                <option selected disabled="disabled">
                                    Personil 4
                                </option>
                                @foreach ($officer as $key => $data)
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
                                        {{ $datas->personil4 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil4') }}</small>
                        </div>


                        <div class="form-group">
                            <label for="personil5" class="label">Personil 5</label>
                            <select class="form-control" name=personil3>
                                <option selected disabled="disabled">
                                    Personil 5
                                </option>
                                @foreach ($officer as $key => $data)
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
                                        {{ $datas->personil5 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil5') }}</small>
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
                            {{-- @php
                                dd($datas->image);
                            @endphp --}}
                            @foreach ($datas->image as $image)
                                <div>
                                    @if ($image->nama)
                                        <img width="200" src="{{ asset('LPPO/' . $image->nama) }}"
                                            alt="">
                                        <p>Current Image: {{ $image->nama }}</p>
                                    @else
                                        <p>No image uploaded.</p>
                                    @endif
                                </div>
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
    @include('partials.js')
</body>

</html>
