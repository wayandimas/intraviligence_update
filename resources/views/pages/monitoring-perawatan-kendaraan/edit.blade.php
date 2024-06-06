<!doctype html>
<html lang="en">

<head>
    <title>Monitoring Perawatan Kendaraan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body" style="padding:0px">
                    <a href="{{ route('lapenam.perawatan-kendaraan.index') }}" type="button" class="btn btn-primary"
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

                    <h2 class="title"> Edit Monitoring Perawatan Kendaraan
                    </h2>
                    <form action="{{ route('lapenam.perawatan-kendaraan.update', $datas->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="unit_perawatan" class="label">Unit Perawatan</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=unit_perawatan>
                                    <option selected disabled="disabled">
                                        Unit Perawatan
                                    </option>
                                    @foreach ($unitPerawatan as $key => $data)
                                        <option value={{ $data->id }}
                                            {{ $datas->unit_perawatan == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('unit_perawatan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_perawatan" class="label">Tanggal Kejadian</label>
                            <input type="date" class="form-control" placeholder="" required
                                value="{{ $datas->tanggal_perawatan ? \Carbon\Carbon::parse($datas->tanggal_perawatan)->format('Y-m-d') : '' }}"
                                name=tgl_perawatan /><small
                                class="form-text text-danger">{{ $errors->first('tgl_perawatan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Odometer Perawatan</label>
                            <input type="text" class="form-control" placeholder="" required name=odo_meter
                                value="{{ $datas->odo_meter }}" /><small
                                class="form-text text-danger">{{ $errors->first('odo') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jenis_perawatan" class="label">Jenis Perawatan</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=jenis_perawatan>
                                    <option selected disabled="disabled">
                                        Jenis Perawatan
                                    </option>
                                    @foreach ($jenisPerawatan as $key => $data)
                                        <option value={{ $data->id }}
                                            {{ $datas->jenis_perawatan == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('jenis_perawatan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="bengkel" class="label">Tempat Bengkel Perbaikan</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=bengkel>
                                    <option selected disabled="disabled">
                                        Tempat Bengkel Perbaikan
                                    </option>
                                    @foreach ($bengkel as $key => $data)
                                        <option value={{ $data->id }}
                                            {{ $datas->bengkel == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('bengkel') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" required name=keterangan
                                value="{{ $datas->keterangan }}" /><small
                                class="form-text text-danger">{{ $errors->first('ket') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugas1" class="label">Nama Petugas 1 (Saat Perawatan)</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=personil1>
                                    <option selected disabled="disabled">
                                        Nama Petugas 1 (Saat Perawatan)
                                    </option>
                                    @foreach ($petugas as $key => $data)
                                        <option value={{ $data->id }}
                                            {{ $datas->personil1 == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugas2" class="label">Nama Petugas 2 (Saat Perawatan)</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=personil2>
                                    <option selected disabled="disabled">
                                        Nama Petugas 2 (Saat Perawatan)
                                    </option>
                                    @foreach ($petugas as $key => $data)
                                        <option value={{ $data->id }}
                                            {{ $datas->personil2 == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="doc" class="label">Foto Odometer</label>
                            <input type="file" class="form-control-input" name="foto" id="dokumentasi-input"
                                onchange="displayImage()" />
                            <img id="selected-image" width="200" src="#" alt="Selected Image"
                                style="display: none;">
                            <p id="image-title" style="display: none;"></p>
                            <small class="form-text text-danger">{{ $errors->first('foto') }}</small>
                        </div>
                        <div>
                            @if ($datas->foto_odo_meter)
                                <img width="200" src="{{ asset('LPKPK/' . $datas->foto_odo_meter) }}"
                                    alt="">
                                <p>Current Image: {{ $datas->foto_odo_meter }}</p>
                            @else
                                <p>No image uploaded.</p>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label for="foto" class="label">Foto Odometer</label>
                            <input type="file" class="form-control-input" required name="foto" />
                            <small class="form-text text-danger">{{ $errors->first('foto') }}</small>
                        </div> --}}
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
