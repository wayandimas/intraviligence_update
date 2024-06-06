<!doctype html>
<html lang="en">

<head>
    <title>Log Kelengkapan Kendaraan Derek</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
    <style>
        .checkbox-1x {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-50 p-b-50 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-info" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                    <form action="{{ route('derek.update', $datasBesar->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="personil" class="label">Personil</label>
                            <select class="form-control" aria-label="Default select example" name=personil>
                                    <option value={{ $personil->id }}>
                                        {{ $personil->nama }}
                                    </option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Shift</label>
                            <input type="number" class="form-control" placeholder="" readonly name=shift
                                value="{{ $datasKecil->shift }}" />

                            <h2 class="title mt-5">
                                Silahkan Isi Checklist Kendaraan Operasional Derek Kecil
                            </h2>
                            <div class="form-group">
                                <label for="odo-meter" class="label">Odo Meter</label>
                                <input type="number" class="form-control" placeholder="" name=odo
                                    value="{{ $datasKecil->km_awal }}" />
                            </div>

                            @foreach ($categories as $key => $categori)
                                @if ($categori->id != 27 && $categori->id != 28 && $categori->id != 29 && $categori->id != 30 && $categori->id != 31)
                                    <div class="form-group">
                                        <label for="rdb" class="label">{{ $categori->nama }}</label>
                                        <button class="btn btn-outline-dark btn-block" type="button"
                                            data-toggle="collapse" data-target="#collapse{{ $categori->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $categori->id }}">
                                            {{ $categori->nama }}
                                        </button>


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
                                                    $component->id == 14 ||
                                                        $component->id == 46 ||
                                                        $component->id == 61 ||
                                                        $component->id == 86 ||
                                                        $component->id == 102 ||
                                                        $component->id == 114)
                                                    @continue
                                                @endif
                                                <div class="row">
                                                    <div class="col-3">
                                                        {{ $component->nama }}
                                                    </div>
                                                    @if ($component->id == 8)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->ban_kanan_depan)
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
                                                    @if ($component->id == 9)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->ban_kanan_belakang)
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
                                                    @if ($component->id == 10)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->ban_kiri_depan)
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
                                                    @if ($component->id == 11)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->ban_kiri_belakang)
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
                                                    @if ($component->id == 12)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->ban_serep)
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
                                                    @if ($component->id == 13)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->velg_roda_drop)
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
                                                    @if ($component->id == 33)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->stnk)
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
                                                    @if ($component->id == 34)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_dashboard )
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
                                                    @if ($component->id == 35)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_depan )
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
                                                    @if ($component->id == 36)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_belakang )
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
                                                    @if ($component->id == 37)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_rem )
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
                                                    @if ($component->id == 38)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_sein )
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
                                                    @if ($component->id == 39)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_mundur)
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
                                                    @if ($component->id == 40)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_kabut)
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
                                                    @if ($component->id == 41)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->radio_tape)
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
                                                    @if ($component->id == 42)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->klakson)
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
                                                    @if ($component->id == 43)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->wiper)
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
                                                    @if ($component->id == 44)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->speaker)
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
                                                    @if ($component->id == 45)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->seat_belt)
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
                                                    @if ($component->id == 51)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->dongkrak_hidrolik_20_ton)
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
                                                    @if ($component->id == 52)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->tangki_oli_hidrolik)
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
                                                    @if ($component->id == 53)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->winch_warm_5_ton)
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
                                                    @if ($component->id == 54)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->kait_hook)
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
                                                    @if ($component->id == 55)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->kunci_roda)
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
                                                    @if ($component->id == 56)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->dongkrak_buaya)
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
                                                    @if ($component->id == 57)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->p3k)
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
                                                    @if ($component->id == 58)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->sarung_tangan)
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
                                                    @if ($component->id == 59)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->helm)
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
                                                    @if ($component->id == 60)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->jas_hujan)
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
                                                    @if ($component->id == 81)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->public_adress)
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
                                                    @if ($component->id == 82)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->lampu_rotary)
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
                                                    @if ($component->id == 83)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->webbing_sling)
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
                                                    @if ($component->id == 84)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->parking_shock)
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
                                                    @if ($component->id == 85)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->segel)
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
                                                    @if ($component->id == 94)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->engine_condition)
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
                                                    @if ($component->id == 95)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->running_test)
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
                                                    @if ($component->id == 96)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->air_radiator)
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
                                                    @if ($component->id == 97)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->air_accu)
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
                                                    @if ($component->id == 98)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->oli_mesin)
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
                                                    @if ($component->id == 99)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->minyak_rem)
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
                                                    @if ($component->id == 100)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->apar)
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
                                                    @if ($component->id == 101)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->oil_power_steering)
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
                                                    @if ($component->id == 109)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->samping_kiri)
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
                                                    @if ($component->id == 110)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->samping_kanan)
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
                                                    @if ($component->id == 111)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->depan)
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
                                                    @if ($component->id == 112)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->belakang)
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
                                                    @if ($component->id == 113)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasKecil->atas)
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
                                               @if ($component->id==14)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasKecil->ket_roda_ban }}">
                                            </div>
                                               @endif
                                               @if ($component->id==46)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasKecil->ket_bagian_dalam }}">
                                            </div>
                                               @endif
                                               @if ($component->id==61)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasKecil->ket_peralatan }}">
                                            </div>
                                               @endif
                                               @if ($component->id==86)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasKecil->ket_peralatan_tambahan }}">
                                            </div>
                                               @endif
                                               @if ($component->id==102)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasKecil->ket_engine }}">
                                            </div>
                                               @endif
                                               @if ($component->id==114)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasKecil->ket_body_cat }}">
                                            </div>
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <h2 class="title mt-5">
                                Silahkan Isi Checklist Kendaraan Operasional Derek Besar
                            </h2>
                            <div class="form-group">
                                <label for="odo-meter2" class="label">Odo Meter</label>
                                <input type="number" class="form-control" placeholder="" name=odo2
                                    value="{{ $datasBesar->km_awal }}" />
                            </div>
                            @foreach ($categories as $key => $categori)
                                @if ($categori->id == 27 || $categori->id == 28 || $categori->id == 29 || $categori->id == 30 || $categori->id == 31)
                                    <div class="form-group">
                                        <label for="rdb" class="label">{{ $categori->nama }}</label>
                                        <button class="btn btn-outline-dark btn-block" type="button"
                                            data-toggle="collapse" data-target="#collapse{{ $categori->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $categori->id }}">
                                            {{ $categori->nama }}
                                        </button>


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
                                                    $component->id == 199 ||
                                                        $component->id == 215 ||
                                                        $component->id == 233 ||
                                                        $component->id == 241 ||
                                                        $component->id == 247)
                                                    @continue
                                                @endif
                                                <div class="row">
                                                    <div class="col-3">
                                                        {{ $component->nama }}
                                                    </div>
                                                    @if ($component->id == 194)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->ban_kanan_depan)
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
                                                    @if ($component->id == 195)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->ban_kanan_belakang)
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
                                                    @if ($component->id == 196)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->ban_kiri_depan)
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
                                                    @if ($component->id == 197)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->ban_kiri_belakang)
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
                                                    @if ($component->id == 198)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->ban_serep)
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
                                                    @if ($component->id == 200)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->stnk)
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
                                                    @if ($component->id == 201)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_dashboard)
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
                                                    @if ($component->id == 202)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_depan)
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
                                                    @if ($component->id == 203)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_belakang)
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
                                                    @if ($component->id == 204)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_rem)
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
                                                    @if ($component->id == 205)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_sein)
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
                                                    @if ($component->id == 206)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_mundur)
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
                                                    @if ($component->id == 207)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_kabut)
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
                                                    @if ($component->id == 208)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_strobo)
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
                                                    @if ($component->id == 209)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->lampu_sorot)
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
                                                    @if ($component->id == 210)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->air_conditioner)
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
                                                    @if ($component->id == 211)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->klakson)
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
                                                    @if ($component->id == 212)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->wiper)
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
                                                    @if ($component->id == 213)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->seat_belt)
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
                                                    @if ($component->id == 214)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->apar)
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
                                                    @if ($component->id == 216)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->balok)
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
                                                    @if ($component->id == 217)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->p3k)
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
                                                    @if ($component->id == 218)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->katrol)
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
                                                    @if ($component->id == 219)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->dongkrak_hidrolik_20_ton)
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
                                                    @if ($component->id == 220)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->kunci_shock)
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
                                                    @if ($component->id == 221)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->kunci_moment)
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
                                                    @if ($component->id == 222)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->kunci_pipa)
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
                                                    @if ($component->id == 223)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->rantai_m)
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
                                                    @if ($component->id == 224)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->tali_sling)
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
                                                    @if ($component->id == 225)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->rantai_besi)
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
                                                    @if ($component->id == 226)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->segel)
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
                                                    @if ($component->id == 227)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->selang_kompresor)
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
                                                    @if ($component->id == 228)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->helm)
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
                                                    @if ($component->id == 229)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->jas_hujan)
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
                                                    @if ($component->id == 230)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->sarung_tangan)
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
                                                    @if ($component->id == 231)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->sepatu_boat)
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
                                                    @if ($component->id == 232)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->senter_charge)
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
                                                    @if ($component->id == 234)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->engine_condition)
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
                                                    @if ($component->id == 235)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->running_test)
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
                                                    @if ($component->id == 236)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->air_accu)
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
                                                    @if ($component->id == 237)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->air_radiator)
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
                                                    @if ($component->id == 238)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->oli_mesin)
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
                                                    @if ($component->id == 239)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->minyak_rem)
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
                                                    @if ($component->id == 240)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->oil_power_steering)
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
                                                    @if ($component->id == 242)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->samping_kiri)
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
                                                    @if ($component->id == 243)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->samping_kanan)
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
                                                    @if ($component->id == 244)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->depan)
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
                                                    @if ($component->id == 245)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->belakang)
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
                                                    @if ($component->id == 246)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datasBesar->atas)
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
                                                @if ($component->id==199)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasBesar->ket_body_cat }}">
                                            </div>
                                               @endif
                                                @if ($component->id==215)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasBesar->ket_bagian_dalam }}">
                                            </div>
                                               @endif
                                                @if ($component->id==233)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasBesar->ket_peralatan }}">
                                            </div>
                                               @endif
                                                @if ($component->id==241)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasBesar->ket_engine }}">
                                            </div>
                                               @endif
                                                @if ($component->id==247)
                                               <div class="col">
                                                <input type="text" class="form-control"
                                                    name="{{ $component->alias }}" value="{{ $datasBesar->ket_body_cat }}">
                                            </div>
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
    <script>
        function handleCheckboxChange(checkbox) {
            const row = checkbox.closest('.row');
            const statusCheckbox = row.querySelector('input[name$="[status]"][value="0"]');
            const kondisiCheckboxes = row.querySelectorAll('input[name$="[kondisi]"]');
            const tidakAdaCheckbox = row.querySelector('input[name$="[status]"][value="1"]');

            if (checkbox === statusCheckbox) {
                kondisiCheckboxes.forEach(cb => {
                    cb.disabled = statusCheckbox.checked;
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });
            }
            const checkboxes = document.querySelectorAll(`input[name="${checkbox.name}"]`);
            checkboxes.forEach(cb => {
                if (cb !== checkbox) {
                    cb.disabled = checkbox.checked;
                    cb.checked = false;
                }
            });


        }


        // Tambahkan event listener ke semua checkbox status dan kondisi
        const statusCheckboxes = document.querySelectorAll('.ya-checkbox-status, .tidak-checkbox-status,');
        statusCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleCheckboxChange(this);
            });
        });

        const kondisiCheckboxes = document.querySelectorAll('.ya-checkbox-kondisi, .tidak-checkbox-kondisi');
        kondisiCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleCheckboxChange(this);
            });
        });
    </script>

</body>

</html>
