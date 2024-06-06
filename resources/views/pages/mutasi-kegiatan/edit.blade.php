<!doctype html>
<html lang="en">

<head>
    <title>Mutasi Kegiatan Harian</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body" style="padding:0px">
                    <a href="{{ route('mutasi-kegiatan.index') }}" type="button" class="btn btn-primary"
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

                    <h2 class="title">Mutasi Kegiatan Harian</h2>
                    <form action="{{ route('mutasi.update', $data->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        @if ($p1 != $p2)
                            <div class="form-group">
                                <label for="personil1" class="label">Personil 1</label>
                                <select class="form-control" aria-label="Default select example" name=personil1 readonly
                                    disabled>

                                    <option readonly value={{ $p1->id }}>
                                        {{ $p1->nama }}
                                    </option>

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
                        @endif
                        @if ($p1 == $p2)
                            <div class="form-group">
                                <label for="personil" class="label">Personil</label>
                                <select class="form-control" aria-label="Default select example" name=personil2 readonly
                                    disabled>
                                    <option value={{ $p1->id }}>
                                        {{ $p1->nama }}
                                    </option>
                                </select>
                                <small class="form-text text-danger">{{ $errors->first('personil') }}</small>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="lokasi_pemantauan" class="label">Lokasi Pemantauan</label>
                            <div class="col-xs-2">
                                <select class="form-control" aria-label="Default select example" name=lokasi_pemantauan>
                                    <option selected disabled="disabled">
                                        Lokasi Pemantauan
                                    </option>
                                    @foreach ($locations as $key => $location)
                                        <option value={{ $location->id }}
                                            {{ $data->lokasi_pemantauan == $location->id ? 'selected' : '' }}>
                                            {{ $location->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('waktu_pemantauan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="waktu_pemantauan" class="label">Waktu Pemantauan</label>
                            <select class="form-control" aria-label="Default select example" name=waktu_pemantauan>
                                <option value={{ $times->id }}>
                                    {{ $times->start_time }} - {{ $times->end_time }}
                                </option>
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('waktu_pemantauan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" name="keterangan" required
                                value="{{ $data->keterangan }}" /><small
                                class="form-text text-danger">{{ $errors->first('keterangan') }}</small>
                        </div>
                        <div class="form-group">
                            <div class="p-t-15">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('mutasi-kegiatan.index') }}" class="btn btn-primary" style="color: white">Back</a>
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
    @include('partials.js')
</body>

</html>
