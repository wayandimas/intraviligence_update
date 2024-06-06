<!doctype html>
<html lang="en">

<head>
    <title>Form Petugas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
    <style>
        .checkbox-1x {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
        }

        .collapse.show {
            display: block !important;
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-50 p-b-50 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
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

                    <h2 class="title">Silahkan Pilih Petugas</h2>
                    <form action="{{ route('patroli.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="personil1" class="label">Personil 1</label>
                            <select class="form-control" aria-label="Default select example" name=personil1>

                                <option value="{{ $p1->id }}">{{ $p1->nama }}</option>

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="personil2" class="label">Personil 2</label>
                            <select class="form-control" aria-label="Default select example" name=personil2>
                                <option value="{{ $p2->id }}">{{ $p2->nama }}</option>
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil2') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="odo-meter" class="label">Shift</label>
                            <input type="number" class="form-control" placeholder="" required readonly name=shift
                                value="{{ $datas->shift }}" /><small
                                class="form-text text-danger">{{ $errors->first('shift') }}</small>
                        </div>

                        <h2 class="title mt-5">
                            Silahkan Isi Checklist Kendaraan Operasional Patroli
                        </h2>

                        <div class="form-group">
                            <label for="odo-meter" class="label">Odo Meter</label>
                            <input type="text" class="form-control" placeholder="" required name=odo
                                value="{{ $datas->km_awal }}" /><small
                                class="form-text text-danger">{{ $errors->first('odo') }}</small>
                        </div>

                        @foreach ($categories as $key => $categori)
                            <div class="form-group">
                                <label for="rdb" class="label">{{ $categori->nama }}</label>
                                <button class="btn btn-outline-dark btn-block" type="button" data-toggle="collapse"
                                    data-target="#collapse{{ $categori->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $categori->id }}">
                                    {{ $categori->nama }}
                                </button>
                                <small class="form-text text-danger">{{ $errors->first($categori->nama) }}</small>

                                <!-- Collapse content -->
                                <div class="collapse" id="collapse{{ $categori->id }}">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col" style="text-align: center;">
                                            Ada
                                        </div>
                                        <div class="col" style="text-align: center;">
                                            Tidak Ada
                                        </div>
                                        <div class="col" style="text-align: center;">
                                            Baik
                                        </div>
                                        <div class="col" style="text-align: center;">
                                            Rusak
                                        </div>
                                    </div>

                                    @php
                                        $components = DB::table('components')
                                            ->select()
                                            ->where('categori_id', $categori->id)
                                            ->get();
                                    @endphp

                                    @foreach ($components as $key => $component)
                                        @if (
                                            $component->id == 7 ||
                                                $component->id == 32 ||
                                                $component->id == 49 ||
                                                $component->id == 79 ||
                                                $component->id == 92 ||
                                                $component->id == 107)
                                            @continue
                                        @endif
                                        <div class="row">
                                            <div class="col-3">
                                                {{ $component->nama }}
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x"
                                                        name="{{ $component->alias }}[]" value="1">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x"
                                                        name="{{ $component->alias }}[]" value="0">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x"
                                                        name="{{ $component->alias }}[]" value="1">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x"
                                                        name="{{ $component->alias }}[]" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="row" style="margin-top: 15px">
                                        <div class="col">
                                            Keterangan {{ $categori->nama }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



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
