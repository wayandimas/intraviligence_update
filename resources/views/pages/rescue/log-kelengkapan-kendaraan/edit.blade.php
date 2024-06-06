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
                    <form action="{{ route('rescue.update',$datas->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="personil" class="label">Personil</label>
                            <select class="form-control" aria-label="Default select example" name=personil>
                                    <option value={{ $p1->id }}>
                                        {{ $p1->nama }}
                                    </option>
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil') }}</small>
                        </div>
                        <h2 class="title mt-5">
                            Silahkan Isi Checklist Kendaraan Operasional Rescue
                        </h2>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Odo Meter</label>
                            <input type="number" class="form-control" placeholder="" name=odo
                                value="{{ $datas->km_awal }}" />
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Shift</label>
                            <input type="number" class="form-control" placeholder="" readonly name=shift
                                value="{{ $datas->shift }}" />
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
                                            $component->id == 253 ||
                                                $component->id == 263 ||
                                                $component->id == 284 ||
                                                $component->id == 301 ||
                                                $component->id == 314 ||
                                                $component->id == 320)
                                            @continue
                                        @endif
                                        <div class="row">
                                            <div class="col-3">
                                                {{ $component->nama }}
                                            </div>
                                            @if ($component->id==248)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->ban_kanan_depan)->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==249)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->ban_kanan_belakang)->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==250)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->ban_kiri_depan)->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==251)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->ban_kiri_belakang)->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==252)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->ban_serep)->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==254)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->stnk )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==255)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_depan  )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==256)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_belakang )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==257)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_rem )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==258)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_sein )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==259)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_sein )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==260)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_ruangan )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==261)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->air_conditioner )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==262)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->klakson )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==264)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->mobile_power_unit  )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==265)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->spreaders  )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==266)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->cutters )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==267)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->rescue_rams )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==268)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lrc_ram )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==269)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->hose_extention )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==270)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->vetter_air_liftingbag )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==271)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->vetter_air_attack )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==272)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->air_cylinder )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==273)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->spring_loaded )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==274)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->pressure_regulator )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==275)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->controller )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==276)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->hydrant_portable )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==277)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->gasoline_cans )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==278)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->chainset )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==279)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->fire_hose )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==280)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->nossel )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==281)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->water_hose )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==282)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->generator_krisbow )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==283)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_sorot_krisbow )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==285)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->lampu_strobo )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==286)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->public_adress )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==287)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->raincoat )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==288)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->bottle_jack )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==289)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->cable_cutter )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==290)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->apar_6kg )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==291)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->apar_9kg )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==292)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->safety_line )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==293)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->first_aid )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==294)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->thermal_blanket )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==295)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->kunci_roda )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==296)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->cribing )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==297)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->jerry_water )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==298)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->parking_chock )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==299)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->webing_sling )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==300)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->oil_absorbent )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==302)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->safety_glove )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==303)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->safety_boots )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==304)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->safety_glasses )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==305)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->headlamp )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==306)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->helm_safety )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==307)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->apron )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==308)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->knee )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==309)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->faceshild )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==310)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->goggles )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==311)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->single_mask )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==312)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->flip_cover )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==313)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->fire_boots )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==315)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->running_test )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==316)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->air_radiator )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==317)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->oil )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==318)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->minyak_rem )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            @endif
                                            @if ($component->id==319)
                                            @php
                                            $kd = DB::table('condition_status')->select()->where('id', $datas->oil_power_steering )->first();
                                            @endphp
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="1"
                                                        @if (old($component->alias . '[status]') == '1') checked @endif
                                                        @if ($kd->status==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-status"
                                                        name="{{ $component->alias }}[status]" value="0"
                                                        @if (old($component->alias . '[status]') == '0') checked @endif
                                                        @if ($kd->status==0) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x ya-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="1"
                                                        @if (old($component->alias . '[kondisi]')) checked @endif
                                                        @if ($kd->kondisi==1) checked @endif
                                                        onchange="handleCheckboxChange(this)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" class="checkbox-1x tidak-checkbox-kondisi"
                                                        name="{{ $component->alias }}[kondisi]" value="0"
                                                        @if (old($component->alias . '[kondisi]') == '0') checked @endif
                                                        @if ($kd->kondisi==0&&$kd->status==1) checked @endif
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
                                        @if ($component->id==253)
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}" value="{{ $datas->ket_roda_ban }}">
                                        </div> 
                                        @endif
                                        @if ($component->id==263)
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}" value="{{ $datas->ket_bagian_dalam }}">
                                        </div> 
                                        @endif
                                        @if ($component->id==284)
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}" value="{{ $datas->ket_peralatan   }}">
                                        </div> 
                                        @endif
                                        @if ($component->id==301)
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}" value="{{ $datas->ket_peralatan_tambahan   }}">
                                        </div> 
                                        @endif
                                        @if ($component->id==314)
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}" value="{{ $datas->ket_personal_protection   }}">
                                        </div> 
                                        @endif
                                        @if ($component->id==320)
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                name="{{ $component->alias }}" value="{{ $datas->ket_engine   }}">
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
