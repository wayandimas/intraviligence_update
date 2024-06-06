<!doctype html>
<html lang="en">

<head>
    <title>Log Kelengkapan Kendaraan Ambulan</title>
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
                    <form action="{{ route('ambulan.update', $datas->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="personil" class="label">Personil</label>
                            <select class="form-control" aria-label="Default select example" name=personil>

                                <option value={{ $p->id }}>
                                    {{ $p->nama }}
                                </option>

                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil1') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Shift</label>
                            <input type="number" class="form-control" placeholder="" readonly name=shift
                                value="{{ $datas->shift }}" /><small
                                class="form-text text-danger">{{ $errors->first('shift') }}</small>
                        </div>

                        <h2 class="title mt-5">
                            Silahkan Isi Checklist Kendaraan Operasional Ambulan
                        </h2>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Odo Meter</label>
                            <input type="text" class="form-control" placeholder="" name=odo
                                value="{{ $datas->km_awal }}" /><small
                                class="form-text text-danger">{{ $errors->first('odo') }}</small>
                        </div>
                        @foreach ($categories as $key => $categori)
                            @if ($categori->nama != 'Ambulance' && $categori->nama != 'Ruang Medis')
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
                                                $component->id == 120 ||
                                                    $component->id == 133 ||
                                                    $component->id == 137 ||
                                                    $component->id == 142 ||
                                                    $component->id == 149 ||
                                                    $component->id == 155)
                                                @continue
                                            @endif
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ $component->nama }}
                                                </div>
                                                @if ($component->id == 115)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->ban_kanan_depan)
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
                                                @if ($component->id == 116)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->ban_kanan_belakang)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 117)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->ban_kiri_depan)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 118)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->ban_kiri_belakang)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 119)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->ban_serep)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 121)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->stnk)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 122)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_dashboard)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 123)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_depan)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 124)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_belakang)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 125)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_rem)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 126)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_sein)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 127)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_mundur)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 128)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->air_conditioner)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 129)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->klakson)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 130)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->wiper)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 131)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->seat_belt)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 132)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->handle_kaca_pintu)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 134)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->kunci_roda)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 135)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->dongkrak)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 136)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->p3k)
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
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 138)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->public_adress)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 139)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_strobo)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 140)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->lampu_sorot)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 141)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->apar)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 143)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 144)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->running_tes)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 145)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 146)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $datas->oli)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 147)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 148)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 150)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 151)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 152)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 153)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 154)
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
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
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
                                            @if ($component->id == 120)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ old($component->alias) ?? $datas->ket_roda_ban }} ">
                                                </div>
                                            @endif
                                            @if ($component->id == 133)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ old($component->alias) ?? $datas->ket_bagian_dalam }} ">
                                                </div>
                                            @endif
                                            @if ($component->id == 137)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ old($component->alias) ?? $datas->ket_peralatan }} ">
                                                </div>
                                            @endif
                                            @if ($component->id == 142)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ old($component->alias) ?? $datas->ket_peralatan_tambahan }} ">
                                                </div>
                                            @endif
                                            @if ($component->id == 149)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ old($component->alias) ?? $datas->ket_engine }} ">
                                                </div>
                                            @endif
                                            @if ($component->id == 155)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ old($component->alias) ?? $datas->ket_body_cat }} ">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                        <h2 class="title mt-5">
                            Silahkan Isi Checklist Kelengkapan Peralatan Medis
                        </h2>
                        @foreach ($categories as $key => $categori)
                            @if ($categori->nama == 'Ambulance' || $categori->nama == 'Ruang Medis')
                                <div class="form-group">
                                    <label for="rdb" class="label">{{ $categori->nama }}</label>
                                    <button class="btn btn-outline-dark btn-block" type="button"
                                        data-toggle="collapse" data-target="#collapse{{ $categori->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $categori->id }}">
                                        {{ $categori->nama }}
                                    </button>
                                    <small
                                        class="form-text text-danger">{{ $errors->first($categori->nama) }}</small>

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
                                            @if ($component->id == 177 || $component->id == 193)
                                                @continue
                                            @endif
                                            <div class="row">
                                                <div class="col-3">
                                                    {{ $component->nama }}
                                                </div>
                                                @if ($component->id == 156)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->cairan_nacl)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 157)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->nirbekken)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 158)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->pinset_anatomi)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 159)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->sunction_manual)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 160)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->tabung_o2)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 161)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->tandu_skop)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 162)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->brangkar)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 163)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kantong_mayat)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 164)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->betadine)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 165)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->alcohol)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 166)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kasa_steril)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 167)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->perban_elastis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 168)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kapas)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 169)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->handskun)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 170)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->selang_o2)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 171)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->extrication_collar)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 172)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->bidai_tiup)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 173)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->masker)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 174)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->gunting)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 175)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->plester)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 176)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->ambu_bag_masker)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 178)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->alat_sterilisator)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 179)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->tempat_tidur_pasien)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 180)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kantong_mayat_medis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 181)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->tensi_meter)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 182)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->stetescop)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 183)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kotak_p3k)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 184)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->gunting_plester)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 185)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->clem)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 186)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kasa_steril_medis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 187)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kasa_gulung)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 188)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->cairan_nacl_medis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 189)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->kapas_medis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 190)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->hipafix)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 191)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->tabung_o2_medis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                                @if ($kd->kondisi == 0 && $kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($component->id == 192)
                                                    @php
                                                        $kd = DB::table('condition_status')
                                                            ->select()
                                                            ->where('id', $dataMedis->betadine_medis)
                                                            ->first();
                                                    @endphp
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="1"
                                                                @if (old($component->alias . '[status]') == '1') checked @endif
                                                                @if ($kd->status == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]"
                                                                value="0"
                                                                @if (old($component->alias . '[status]') == '0') checked @endif
                                                                @if ($kd->status == 0) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                @if (old($component->alias . '[kondisi]')) checked @endif
                                                                @if ($kd->kondisi == 1) checked @endif
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
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
                                            @if ($component->id == 177)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ $dataMedis->ket_peralatan_medis }}">
                                                </div>
                                            @endif
                                            @if ($component->id == 193)
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="{{ $component->alias }}"
                                                        value="{{ $dataMedis->ket_ruang_medis }}">
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
