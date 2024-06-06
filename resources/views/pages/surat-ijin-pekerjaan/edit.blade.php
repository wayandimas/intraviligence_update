<!doctype html>
<html lang="en">

<head>
    <title> Form Pengisian Surat Ijin Aktivitas Pekerjaan</title>
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
                    <a href="{{ route('siap.index') }}" type="button" class="btn btn-primary"
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

                    <h2 class="title">Form Pengisian Surat Ijin Aktivitas Pekerjaan
                    </h2>
                    <form action="{{ route('siap.update', $datas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="tgl_mulai_kerja" class="label">Tanggal Mulai Pekerjaan</label>
                            <input type="date" class="form-control" placeholder=""
                                value="{{ $datas->tanggal_mulai_pekerjaan ? \Carbon\Carbon::parse($datas->tanggal_mulai_pekerjaan)->format('Y-m-d') : '' }}"
                                name=tgl_mulai_kerja /><small
                                class="form-text text-danger">{{ $errors->first('tgl_mulai_kerja') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai_izin" class="label">Tanggal Mulai Izin Kerja</label>
                            <input type="date" class="form-control" placeholder=""
                                value="{{ $datas->tanggal_mulai_izin ? \Carbon\Carbon::parse($datas->tanggal_mulai_izin)->format('Y-m-d') : '' }}"
                                name=tgl_mulai_izin /><small
                                class="form-text text-danger">{{ $errors->first('tgl_mulai_izin') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai_izin" class="label">Tanggal Selesai Izin Kerja</label>
                            <input type="date" class="form-control" placeholder=""
                                value="{{ $datas->tanggal_selesai_izin ? \Carbon\Carbon::parse($datas->tanggal_selesai_izin)->format('Y-m-d') : '' }}"
                                name=tgl_selesai_izin /><small
                                class="form-text text-danger">{{ $errors->first('tgl_selesai_izin') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jenis_pekerjaan" class="label">Jenis Pekerjaan</label>
                            <input type="text" class="form-control" placeholder="" name=jenis_pekerjaan
                                value="{{ $datas->jenis_pekerjaan }}" /><small
                                class="form-text text-danger">{{ $errors->first('jenis_pekerjaan') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="kontraktor" class="label">Kontraktor/Vendor</label>
                            <input type="text" class="form-control" placeholder="" name=kontraktor
                                value="{{ $datas->kontraktor }}" /><small
                                class="form-text text-danger">{{ $errors->first('kontraktor') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="dokumentasi" class="label">Foto Surat Izin Kerja</label>
                            <input type="file" class="form-control-input" name="dokumentasi" id="dokumentasi-input"
                                onchange="displayImage()" />
                            <img id="selected-image" width="200" src="#" alt="Selected Image"
                                style="display: none;">
                            <p id="image-title" style="display: none;"></p>
                            <small class="form-text text-danger">{{ $errors->first('dokumentasi') }}</small>
                        </div>
                        <div>
                            @if ($datas->foto)
                                <img width="200" src="{{ asset('SIAP/' . $datas->foto) }}" alt="">
                                <p>Current Image: {{ $datas->foto }}</p>
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
