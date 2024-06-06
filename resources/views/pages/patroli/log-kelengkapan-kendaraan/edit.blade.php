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
                    <form action="{{ route('patroli.update', $datas->id) }}" method="POST">
                        @method('PATCH')
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
                                                $component->id == 50 ||
                                                $component->id == 80 ||
                                                $component->id == 93 ||
                                                $component->id == 108)
                                            @continue
                                        @endif
                                        <div class="row">
                                            <div class="col-3">
                                                {{ $component->nama }}
                                            </div>
                                            @if ($component->id == 1)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->ban_kanan_depan)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 2)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->ban_kanan_belakang)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 3)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->ban_kiri_depan)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 4)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->ban_kiri_belakang)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 5)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->ban_serep)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 6)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->velg_roda_drop)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 15)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->stnk)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 16)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_dashboard)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 17)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_depan)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 18)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_belakang)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 19)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_rem)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 20)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_sein)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 21)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_mundur)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 22)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->radio_tape)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 23)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->air_conditioner)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 24)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->sandaran_kepala)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 25)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->karpet)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 26)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->sarung_jok)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($component->id == 27)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->klakson)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 28)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->wiper)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 29)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->speaker)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 30)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->power_window)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 31)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->seat_belt)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 47)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->kunci_roda)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 48)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->dongkrak)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 49)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->p3k)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 62)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->public_adress)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 63)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_strobo)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 64)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->lampu_sorot)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 65)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->apar)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 66)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->rubber_cone)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 67)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->rambu_tanda_seru)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 68)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->rambu_tanda_seru)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 69)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->bendera)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 70)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->oil_absorbent)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 71)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->senter_charger)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 72)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->sepatu_boat)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 73)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->jas_hujan)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 74)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->senter_lalin)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 75)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->safety_glasess)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 76)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->helm)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 77)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->safety_gloves)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 78)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->sekop)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 79)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->sapu_lidi)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 87)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->engine_condition)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 88)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->air_accu)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 89)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->air_radiator)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 90)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->oli_mesin)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 91)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->minyak_rem)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 92)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->oil_power_steering)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 103)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->samping_kiri)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 104)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->samping_kanan)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 105)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->depan)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 106)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->belakang)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($component->id == 107)
                                                @php
                                                    $kd = DB::table('condition_status')
                                                        ->select()
                                                        ->where('id', $datas->atas)
                                                        ->first();
                                                @endphp
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="1"
                                                            @if (old($component->alias . '[status]') == '1') checked @endif
                                                            @if ($kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-status"
                                                            name="{{ $component->alias }}[status]" value="0"
                                                            @if (old($component->alias . '[status]') == '0') checked @endif
                                                            @if ($kd->status == 0) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x ya-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="1"
                                                            @if (old($component->alias . '[kondisi]')) checked @endif
                                                            @if ($kd->kondisi == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <input type="checkbox"
                                                            class="checkbox-1x tidak-checkbox-kondisi"
                                                            name="{{ $component->alias }}[kondisi]" value="0"
                                                            @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                            @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                            onchange="handleCheckboxChange(this)">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="row" style="margin-top: 15px">
                                        <div class="col">
                                            Keterangan {{ $categori->nama }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if ($component->id == 7)
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}"
                                                    value="{{ old($component->alias) ?? $datas->ket_roda_ban }} ">
                                            </div>
                                        @endif
                                        @if ($component->id == 32)
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}"
                                                    value="{{ old($component->alias) ?? $datas->ket_bagian_dalam }} ">
                                            </div>
                                        @endif
                                        @if ($component->id == 50)
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}"
                                                    value="{{ old($component->alias) ?? $datas->ket_peralatan }} ">
                                            </div>
                                        @endif
                                        @if ($component->id == 80)
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}"
                                                    value="{{ old($component->alias) ?? $datas->ket_peralatan_tambahan }} ">
                                            </div>
                                        @endif
                                        @if ($component->id == 93)
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}"
                                                    value="{{ old($component->alias) ?? $datas->ket_engine }} ">
                                            </div>
                                        @endif
                                        @if ($component->id == 108)
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}"
                                                    value="{{ old($component->alias) ?? $datas->ket_body_cat }} ">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <div class="p-t-15">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Update
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
</body>

</html>
