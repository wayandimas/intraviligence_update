<!doctype html>
<html lang="en">

<head>
    <title>Form Perbaikan Kerusakan dan Perawatan Kendaraan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')

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

                    <h2 class="title">Form Perbaikan Kerusakan dan Perawatan Kendaraan
                    </h2>
                    <form action="{{ route('lapenam.perawatan-kendaraan.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="unit_perawatan" class="label">Unit Perawatan</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=unit_perawatan>
                                    <option selected disabled="disabled">
                                        Unit Perawatan
                                    </option>
                                    @foreach ($unitPerawatan as $key => $data)
                                        <option value={{ $data->id }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('unit_perawatan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_perawatan" class="label">Tanggal Perawatan</label>
                            <input type="date" class="form-control" placeholder="" value="{{ date('Y-m-d') }}"
                                name=tgl_perawatan /><small
                                class="form-text text-danger">{{ $errors->first('tgl_perawatan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="odo_meter" class="label">Odometer Perawatan</label>
                            <input type="number" class="form-control" placeholder="" name=odo_meter
                                value="{{ old('odo_meter') }}" /><small
                                class="form-text text-danger">{{ $errors->first('odo_meter') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jenis_perawatan" class="label">Jenis Perawatan</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=jenis_perawatan>
                                    <option selected disabled="disabled">
                                        Jenis Perawatan
                                    </option>
                                    @foreach ($jenisPerawatan as $key => $data)
                                        <option value={{ $data->id }}>
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
                                        <option value={{ $data->id }}>
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('bengkel') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" name=keterangan /><small
                                class="form-text text-danger">{{ $errors->first('keterangan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugas1" class="label">Nama Petugas 1</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=personil1
                                >
                                       @foreach ($petugas as $key => $data)
                                    <option
                                        value="{{ $data->id }}">
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                               
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('petugas1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="petugas2" class="label">Nama Petugas 2</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=personil2
                                    >
                                    
                                       @foreach ($petugas as $key => $data)
                                    <option
                                        value="{{ $data->id }}">
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                                   
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('petugas2') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="label">Foto Odometer</label>
                            <input type="file" class="form-control-input" name="foto" />
                            <small class="form-text text-danger">{{ $errors->first('foto') }}</small>
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
