<!doctype html>
<html lang="en">

<head>
    <title> Form Pengisian Bahan Bakar Mesin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body" style="padding:0px">
                    <a href="{{ route('lapenam.pengisian-bbm.index') }}" type="button" class="btn btn-primary"
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

                    <h2 class="title">Edit Form Pengisian Bahan Bakar Mesin
                    </h2>
                    <form action="{{ route('lapenam.pengisian-bbm.update', $datas->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="unit_pengisian" class="label">Unit Pengisian</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=unit_pengisian>
                                    <option selected disabled="disabled">
                                        Unit Pengisian
                                    </option>
                                    @foreach ($unitPengisian as $key => $data)
                                        <option value={{ $data->id }}
                                            {{ $datas->unit_pengisian == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('unit_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pengisian" class="label">Tanggal Pengisian</label>
                            <input type="date" class="form-control" placeholder="" required
                                value="{{ $datas->tanggal_pengisian ? \Carbon\Carbon::parse($datas->tanggal_pengisian)->format('Y-m-d') : '' }}"
                                name=tgl_pengisian /><small
                                class="form-text text-danger">{{ $errors->first('tgl_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="waktu_pengisian" class="label">Waktu Pengisian</label>
                            <input type="time" class="form-control" required id="waktu_pengisian"
                                value="{{ $datas->waktu_pengisian }}" name=waktu_pengisian /><small
                                class="form-text text-danger">{{ $errors->first('waktu_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Odometer Pengisian</label>
                            <input type="text" class="form-control" placeholder="" required name=odo_meter
                                value="{{ $datas->odo_meter }}" /><small
                                class="form-text text-danger">{{ $errors->first('odo') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_pengisian" class="label">Jumlah Pengisian (Isi Sesuai Jumlah Kupon
                                Terpakai)</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_pengisian>
                                <option selected disabled="disabled">
                                    Jumlah Pengisian
                                </option>
                                @foreach (range(1, 10) as $key => $data)
                                    <option value="{{ $key }}"
                                        {{ $datas->jumlah_pengisian == $key ? 'selected' : '' }}>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugas1" class="label">Nama Petugas 1 (Saat Pengisian)</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=personil1>
                                    <option selected disabled="disabled">
                                        Nama Petugas 1
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
                            <label for="petugas2" class="label">Nama Petugas 2 (Saat Pengisian)</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=personil2>
                                    <option selected disabled="disabled">
                                        Nama Petugas 2
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
                            <label for="kembalian" class="label">Kembalian Pengisian (Isi Dengan Angka Saja) Kalau
                                Tidak Ada Kembalian
                                Isikan Angka (0)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <!-- Hidden input to store the numeric value without separators -->
                                <input type="hidden" name="kembalian_numeric" value="{{ $datas->kembalian }}" />
                                <!-- Visible input to display formatted rupiah amount -->
                                <input type="text" class="form-control" placeholder="" name="kembalian"
                                    value="{{ number_format($datas->kembalian, 0, ',', '.') }}" />
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('kembalian') }}</small>
                        </div>

                        {{-- <div class="form-group">
                            <label for="foto" class="label">Foto Struk Pengisian (Dilengkapi Dengan
                                Odometer)</label>
                            <input type="file" class="form-control-input" required name="foto" />
                            <small class="form-text text-danger">{{ $errors->first('foto') }}</small>
                        </div> --}}
                        <div class="form-group">
                            <label for="doc" class="label">Foto Struk Pengisian (Dilengkapi Dengan
                                Odometer)</label>
                            <input type="file" class="form-control-input" name="foto" id="dokumentasi-input"
                                onchange="displayImage()" />
                            <img id="selected-image" width="200" src="#" alt="Selected Image"
                                style="display: none;">
                            <p id="image-title" style="display: none;"></p>
                            <small class="form-text text-danger">{{ $errors->first('foto') }}</small>
                        </div>
                        <div>
                            @if ($datas->foto_struk)
                                <img width="200" src="{{ asset('LPBBM/' . $datas->foto_struk) }}" alt="">
                                <p>Current Image: {{ $datas->foto_struk }}</p>
                            @else
                                <p>No image uploaded.</p>
                            @endif
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
