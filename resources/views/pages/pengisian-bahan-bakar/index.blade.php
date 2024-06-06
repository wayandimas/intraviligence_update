<!doctype html>
<html lang="en">

<head>
    <title> Form Pengisian Bahan Bakar Mesin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

                    <h2 class="title">Form Pengisian Bahan Bakar Mesin
                    </h2>
                    <form action="{{ route('lapenam.pengisian-bbm.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="unit_pengisian" class="label">Unit Pengisian</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=unit_pengisian>
                                    <option selected disabled="disabled">
                                        Unit Pengisian
                                    </option>
                                    @foreach ($unitPengisian as $key => $data)
                                        <option value={{ $data->id }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('unit_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pengisian" class="label">Tanggal Pengisian</label>
                            <input type="date" class="form-control" placeholder="" value="{{ date('Y-m-d') }}"
                                name=tgl_pengisian /><small
                                class="form-text text-danger">{{ $errors->first('tgl_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="waktu_pengisian" class="label">Waktu Pengisian</label>
                            <input type="time" class="form-control" id="waktu_pengisian"
                                name=waktu_pengisian /><small
                                class="form-text text-danger">{{ $errors->first('waktu_pengisian') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="odo_meter" class="label">Odometer Pengisian</label>
                            <input type="number" class="form-control" placeholder="" name=odo_meter /><small
                                class="form-text text-danger">{{ $errors->first('odo_meter') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_pengisian" class="label">Jumlah Pengisian (Isi Sesuai Jumlah Kupon
                                Terpakai)</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_pengisian>
                                <option selected disabled="disabled">
                                    Jumlah Pengisian
                                </option>
                                @foreach (range(1, 10) as $key => $data)
                                    <option value="{{ $key }}">
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_pengisian') }}</small>
                        </div>
                        @if (Auth::user()->operasional_id == 1)
                            <div class="form-group">
                                <label for="petugas1" class="label">Nama Petugas 1</label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil1
                                        disabled>
                                        <option value={{ $p1->id }}>
                                            {{ $p1->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="petugas2" class="label">Nama Petugas 2 </label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil2
                                        disabled>

                                        <option value={{ $p2->id }}>
                                            {{ $p2->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                            </div>
                        @endif
                        @if (Auth::user()->operasional_id == 11)
                            <div class="form-group">
                                <label for="petugas1" class="label">Nama Petugas 1</label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil1
                                        disabled>
                                        <option value={{ $psn->id }}>
                                            {{ $psn->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="petugas2" class="label">Nama Petugas 2 </label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil2
                                        disabled>

                                        <option value={{ $ptis->id }}>
                                            {{ $ptis->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                            </div>
                        @endif
                        @if (Auth::user()->operasional_id == 2)
                            <div class="form-group">
                                <label for="petugas1" class="label">Nama Petugas 1</label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil1
                                        disabled>
                                        <option value={{ $pdk->id }}>
                                            {{ $pdk->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="petugas2" class="label">Nama Petugas 2 </label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil2
                                        disabled>

                                        <option value={{ $pdk->id }}>
                                            {{ $pdk->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                            </div>
                        @endif
                        @if (Auth::user()->operasional_id == 3)
                            <div class="form-group">
                                <label for="petugas1" class="label">Nama Petugas 1</label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil1
                                        disabled>
                                        <option value={{ $pr->id }}>
                                            {{ $pr->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="petugas2" class="label">Nama Petugas 2 </label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil2
                                        disabled>

                                        <option value={{ $pr->id }}>
                                            {{ $pr->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                            </div>
                        @endif
                        @if (Auth::user()->operasional_id == 4)
                            <div class="form-group">
                                <label for="petugas1" class="label">Nama Petugas 1</label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil1
                                        disabled>
                                        <option value={{ $pa->id }}>
                                            {{ $pa->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="petugas2" class="label">Nama Petugas 2 </label>
                                <div class="col-xs-2">
                                    <select class="form-control" aria-label="Default select example" name=personil2
                                        disabled>

                                        <option value={{ $pa->id }}>
                                            {{ $pa->nama }}
                                        </option>

                                    </select>
                                </div>
                                <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="kembalian" class="label">Kembalian Pengisian (Isi Dengan Angka Saja) Kalau
                                Tidak Ada Kembalian
                                Isikan Angka (0)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <!-- Hidden input to store the numeric value without separators -->
                                <input type="hidden" name="kembalian_numeric" value="{{ old('kembalian') }}" />
                                <!-- Visible input to display formatted rupiah amount -->
                                <input type="text" class="form-control" placeholder="" name="kembalian"
                                    value="{{ old('kembalian') ? formatRupiah(old('kembalian')) : '' }}" />
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('kembalian') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="dokumentasi" class="label">Foto Struk Pengisian (Dilengkapi Dengan
                                Odometer)</label>
                            <input type="file" class="form-control-input" name="dokumentasi" />
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
