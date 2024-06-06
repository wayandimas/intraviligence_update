<!doctype html>
<html lang="en">

<head>
    <title>Laporan Serah Terima Inventaris Gerbang Tol</title>
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
                                    aria-expanded="false">{{ $datas->lokasi_aset }}</a>
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
                    <form action="{{ route('security.update', $datas->id) }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="personil" class="label">Personil</label>
                            <select class="form-control" aria-label="Default select example" name=personil>

                                <option value="{{ $personil->id }}">{{ $personil->nama }}</option>
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('personil') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="shift" class="label">Shift</label>
                            <input type="number" class="form-control" placeholder="" required readonly name=shift
                                value="{{ $datas->shift }}" /><small
                                class="form-text text-danger">{{ $errors->first('shift') }}</small>
                        </div>

                        <h2 class="title mt-5">
                            Silahkan Isi Checklist Serah Terima Inventaris Gerbang Tol
                        </h2>
                        <div class="form-group">
                            <label for="lokasi" class="label">Lokasi Aset</label>
                            <input type="text" class="form-control" placeholder="" required name=lokasi readonly
                                value="{{ $datas->unit }}" /><small
                                class="form-text text-danger">{{ $errors->first('lokasi') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="jmlh_ht" class="label">Jumlah Hand Talkie</label>
                            <select class="form-control" aria-label="Default select example" name="jmlh_ht">
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_ht') == $data) selected @endif
                                        @if ($datas->jumlah_handy_talkie == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_ht') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ht" class="label">Hand Talkie</label>
                            <select class="form-control" aria-label="Default select example" name=ht>
                                <option selected disabled>
                                    Hand Talkie
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('ht') == $data->id || $datas->handy_talkie == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('ht') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_bc" class="label">Jumlah Batok Charger</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_bc>
                                <option selected disabled>
                                    Jumlah Batok Charger
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_bc') == $data) selected @endif
                                        @if ($datas->jumlah_batok_charger == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_bc') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="bc" class="label">Batok Charger</label>
                            <select class="form-control" aria-label="Default select example" name=bc>
                                <option selected disabled>
                                    Batok Charger
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('ht') == $data->id || $datas->batok_charger == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('bc') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_acr" class="label">Jumlah Adaptor Charger</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_acr>
                                <option selected disabled>
                                    Jumlah Adaptor Charger
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_acr') == $data) selected @endif
                                        @if ($datas->jumlah_adaptor_charger == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_acr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ac" class="label">Adaptor Charger</label>
                            <select class="form-control" aria-label="Default select example" name=acr>
                                <option selected disabled>
                                    Adaptor Charger
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('acr') == $data->id || $datas->adapter_charger == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('ac') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_tt" class="label">Jumlah Tongkat T</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_tt>
                                <option selected disabled>
                                    Jumlah Tongkat T
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_tt') == $data) selected @endif
                                        @if ($datas->jumlah_tongkat_t == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_tt') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="tt" class="label">Tongkat T</label>
                            <select class="form-control" aria-label="Default select example" name=tt>
                                <option selected disabled>
                                    Tongkat T
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('tt') == $data->id || $datas->tongkat_t == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('tt') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_ts" class="label">Jumlah Tali Sling</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_ts>
                                <option selected disabled>
                                    Jumlah Tali Sling
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_ts') == $data) selected @endif
                                        @if ($datas->jumlah_tali_sling == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_ts') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ts" class="label">Tali Sling</label>
                            <select class="form-control" aria-label="Default select example" name=ts>
                                <option selected disabled>
                                    Tali Sling
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('ts') == $data->id || $datas->tali_sling == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('ts') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_ar" class="label">Jumlah Amplifier</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_ar>
                                <option selected disabled>
                                    Jumlah Amplifier
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_ar') == $data) selected @endif
                                        @if ($datas->jumlah_amplifier == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_ar') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ar" class="label">Amplifier</label>
                            <select class="form-control" aria-label="Default select example" name=ar>
                                <option selected disabled>
                                    Amplifier
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('ar') == $data->id || $datas->amplifier == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('ar') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_ws" class="label">Jumlah Wireless</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_ws>
                                <option selected disabled>
                                    Jumlah Wireless
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_ws') == $data) selected @endif
                                        @if ($datas->jumlah_wireless == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_ws') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ws" class="label">Wireless</label>
                            <select class="form-control" aria-label="Default select example" name=ws>
                                <option selected disabled>
                                    Wireless
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('ws') == $data->id || $datas->wireless == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('ws') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_am" class="label">Jumlah Alarm</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_am>
                                <option selected disabled>
                                    Jumlah Alarm
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_am') == $data) selected @endif
                                        @if ($datas->jumlah_alarm == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_am') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="am" class="label">Alarm</label>
                            <select class="form-control" aria-label="Default select example" name=am>
                                <option selected disabled>
                                    Alarm
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('am') == $data->id || $datas->alarm == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('am') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_sl" class="label">Jumlah Senter Lalin</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_sl>
                                <option selected disabled>
                                    Jumlah Senter Lalin
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_sl') == $data) selected @endif
                                        @if ($datas->jumlah_senter_lalin == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_sl') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sl" class="label">Senter Lalin</label>
                            <select class="form-control" aria-label="Default select example" name=sl>
                                <option selected disabled>
                                    Senter Lalin
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('sl') == $data->id || $datas->senter_lalin == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('sl') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_apr" class="label">Jumlah APAR</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_apr>
                                <option selected disabled>
                                    Jumlah APAR
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_apr') == $data) selected @endif
                                        @if ($datas->jumlah_apar == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_apr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="apr" class="label">APAR</label>
                            <select class="form-control" aria-label="Default select example" name=apr>
                                <option selected disabled>
                                    APAR
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('apr') == $data->id || $datas->apar == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('apr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_bapr" class="label">Jumlah Box APAR</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_bapr>
                                <option selected disabled>
                                    Jumlah Box APAR
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_bapr') == $data) selected @endif
                                        @if ($datas->jumlah_box_apar == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_bapr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="bapr" class="label">Box APAR</label>
                            <select class="form-control" aria-label="Default select example" name=bapr>
                                <option selected disabled>
                                    Box APAR
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('bapr') == $data->id || $datas->box_apar == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('bapr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_ac" class="label">Jumlah AC</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_ac>
                                <option selected disabled>
                                    Jumlah AC
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_ac') == $data) selected @endif
                                        @if ($datas->jumlah_ac == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_ac') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ac" class="label">AC</label>
                            <select class="form-control" aria-label="Default select example" name=ac>
                                <option selected disabled>
                                    AC
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('ac') == $data->id || $datas->ac == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('ac') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_jh" class="label">Jumlah Jas Hujan</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_jh>
                                <option selected disabled>
                                    Jumlah Jas Hujan
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_jh') == $data) selected @endif
                                        @if ($datas->jumlah_jas_hujan == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_jh') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jh" class="label">Jas Hujan</label>
                            <select class="form-control" aria-label="Default select example" name=jh>
                                <option selected disabled>
                                    Jas Hujan
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('jh') == $data->id || $datas->jas_hujan == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jh') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_lm" class="label">Jumlah Layar Monitor</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_lm>
                                <option selected disabled>
                                    Jumlah Layar Monitor
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_lm') == $data) selected @endif
                                        @if ($datas->jumlah_layar_monitor == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_lm') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="lm" class="label">Layar Monitor</label>
                            <select class="form-control" aria-label="Default select example" name=lm>
                                <option selected disabled>
                                    Layar Monitor
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('lm') == $data->id || $datas->layar_monitor == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('lm') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_cctv" class="label">Jumlah CCTV</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_cctv>
                                <option selected disabled>
                                    Jumlah CCTV
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_cctv') == $data) selected @endif
                                        @if ($datas->jumlah_cctv == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_cctv') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="cctv" class="label">CCTV</label>
                            <select class="form-control" aria-label="Default select example" name=cctv>
                                <option selected disabled>
                                    CCTV
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('cctv') == $data->id || $datas->cctv == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('cctv') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_lla" class="label">Jumlah LLA</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_lla>
                                <option selected disabled>
                                    Jumlah LLA
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_lla') == $data) selected @endif
                                        @if ($datas->jumlah_lla == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_lla') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="lla" class="label">LLA</label>
                            <select class="form-control" aria-label="Default select example" name=lla>
                                <option selected disabled>
                                    LLA
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('lla') == $data->id || $datas->lla == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('lla') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_rmax" class="label">Jumlah R.Max (4,1 m)</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_rmax>
                                <option selected disabled>
                                    Jumlah R.Max (4,1 m)
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_rmax') == $data) selected @endif
                                        @if ($datas->jumlah_r_max == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_rmax') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="rmax" class="label">R.Max (4,1 m)</label>
                            <select class="form-control" aria-label="Default select example" name=rmax>
                                <option selected disabled>
                                    R.Max (4,1 m)
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('rmax') == $data->id || $datas->r_max == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('r2') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_r2" class="label">Jumlah R.2,1 m</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_r2>
                                <option selected disabled>
                                    Jumlah R.2,1 m
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_r2') == $data) selected @endif
                                        @if ($datas->jumlah_r_21 == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_rmax') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="r2" class="label">R.2,1 m</label>
                            <select class="form-control" aria-label="Default select example" name=r2>
                                <option selected disabled>
                                    R.2,1 m
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('r2') == $data->id || $datas->r_21 == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('r2') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="jmlh_mg" class="label">Jumlah Mesin Genset</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_mg>
                                <option selected disabled>
                                    Jumlah Mesin Genset
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_mg') == $data) selected @endif
                                        @if ($datas->jumlah_mesin_genset == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_mg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="mg" class="label">Mesin Genset</label>
                            <select class="form-control" aria-label="Default select example" name=mg>
                                <option selected disabled>
                                    Mesin Genset
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('mg') == $data->id || $datas->mesin_genset == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('mg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_acu" class="label">Jumlah Accu</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_acu>
                                <option selected disabled>
                                    Jumlah Accu
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_acu') == $data) selected @endif
                                        @if ($datas->jumlah_accu == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_acu') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="acu" class="label">Accu</label>
                            <select class="form-control" aria-label="Default select example" name=acu>
                                <option selected disabled>
                                    Accu
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('acu') == $data->id || $datas->accu == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('acu') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_rsp" class="label">Jumlah R.Stop</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_rsp>
                                <option selected disabled>
                                    Jumlah R.Stop
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_rsp') == $data) selected @endif
                                        @if ($datas->jumlah_r_stop == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_rsp') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="rsp" class="label">R.Stop</label>
                            <select class="form-control" aria-label="Default select example" name=rsp>
                                <option selected disabled>
                                    R.Stop
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('rsp') == $data->id || $datas->r_stop == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('rsp') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_pg" class="label">Jumlah R.Palang</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_pg>
                                <option selected disabled>
                                    Jumlah R.Palang
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_pg') == $data) selected @endif
                                        @if ($datas->jumlah_r_palang == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_pg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="pg" class="label">R.Palang</label>
                            <select class="form-control" aria-label="Default select example" name=pg>
                                <option selected disabled>
                                    R.Palang
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('pg') == $data->id || $datas->r_palang == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('pg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_sb" class="label">Jumlah Sepatu Boat</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_sb>
                                <option selected disabled>
                                    Jumlah Sepatu Boat
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_sb') == $data) selected @endif
                                        @if ($datas->jumlah_sepatu_boat == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_sb') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sb" class="label">Sepatu Boat</label>
                            <select class="form-control" aria-label="Default select example" name=sb>
                                <option selected disabled>
                                    Sepatu Boat
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('sb') == $data->id || $datas->sepatu_boat == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('sb') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_pyg" class="label">Jumlah Payung</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_pyg>
                                <option selected disabled>
                                    Jumlah Payung
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_pyg') == $data) selected @endif
                                        @if ($datas->jumlah_payung == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_pyg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="pyg" class="label">Payung</label>
                            <select class="form-control" aria-label="Default select example" name=pyg>
                                <option selected disabled>
                                    Payung
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option
                                        value="{{ $data->id }}"{{ old('pyg') == $data->id || $datas->payung == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('pyg') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_dr" class="label">Jumlah Dispenser</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_dr>
                                <option selected disabled>
                                    Jumlah Dispenser
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_dr') == $data) selected @endif
                                        @if ($datas->jumlah_dispenser == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_dr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="dr" class="label">Dispenser</label>
                            <select class="form-control" aria-label="Default select example" name=dr>
                                <option selected disabled>
                                    Dispenser
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('dr') == $data->id || $datas->dispenser == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('dr') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_gn" class="label">Jumlah Galon</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_gn>
                                <option selected disabled>
                                    Jumlah Galon
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_gn') == $data) selected @endif
                                        @if ($datas->jumlah_galon == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_gn') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="gn" class="label">Galon</label>
                            <select class="form-control" aria-label="Default select example" name=gn>
                                <option selected disabled>
                                    Galon
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option
                                        value="{{ $data->id }}"{{ old('gn') == $data->id || $datas->galon == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('gn') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_sa" class="label">Jumlah Speaker Active</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_sa>
                                <option selected disabled>
                                    Jumlah Speaker Active
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_sa') == $data) selected @endif
                                        @if ($datas->jumlah_speaker_active == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_sa') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sa" class="label">Speaker Active</label>
                            <select class="form-control" aria-label="Default select example" name=sa>
                                <option selected disabled>
                                    Speaker Active
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('sa') == $data->id || $datas->speaker_active == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('sa') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="jmlh_rc" class="label">Jumlah Rubber Cone</label>
                            <select class="form-control" aria-label="Default select example" name=jmlh_rc>
                                <option selected disabled>
                                    Jumlah Rubber Cone
                                </option>
                                @foreach (range(0, 10) as $data)
                                    <option value="{{ $data }}"
                                        @if (old('jmlh_rc') == $data) selected @endif
                                        @if ($datas->jumlah_rubber_cone == $data) selected @endif>
                                        {{ $data }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('jmlh_rc') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="rc" class="label">Rubber Cone</label>
                            <select class="form-control" aria-label="Default select example" name=rc>
                                <option selected disabled>
                                    Rubber Cone
                                </option>
                                @foreach ($condition as $key => $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('rc') == $data->id || $datas->rubber_cone == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{ $errors->first('rc') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="label">Keterangan</label>
                            <input type="text" class="form-control" placeholder="" name=ket
                                value="{{ $datas->keterangan }}" /><small
                                class="form-text text-danger">{{ $errors->first('ket') }}</small>
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
