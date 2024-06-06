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
                    <form action="{{ route('derek.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="personil" class="label">Personil</label>
                            <select class="form-control" aria-label="Default select example" name=personil>
                                <option selected disabled="disabled">
                                    Personil
                                </option>
                                @foreach ($datas as $key => $data)
                                    <option value={{ $data->id }}
                                        {{ old('personil') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="odo-meter" class="label">Shift</label>
                            <input type="number" class="form-control" placeholder="" readonly name=shift
                                value="{{ $shift }}" />

                            <h2 class="title mt-5">
                                Silahkan Isi Checklist Kendaraan Operasional Derek Kecil
                            </h2>
                            <div class="form-group">
                                <label for="odo-meter" class="label">Odo Meter</label>
                                <input type="number" class="form-control" placeholder="" name=odo
                                    value="{{ old('odo') }}" />
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
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]" value="1"
                                                                {{ old($component->alias . '[status]') ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]" value="0"
                                                                {{ old($component->alias . '[status]') === '0' ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]" value="1"
                                                                {{ old($component->alias . '[kondisi]') ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]" value="0"
                                                                {{ old($component->alias . '[kondisi]') === '0' ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
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
                                @endif
                            @endforeach
                            <h2 class="title mt-5">
                                Silahkan Isi Checklist Kendaraan Operasional Derek Besar
                            </h2>
                            <div class="form-group">
                                <label for="odo-meter2" class="label">Odo Meter</label>
                                <input type="number" class="form-control" placeholder="" name=odo2
                                    value="{{ old('odo2') }}" />
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
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-status"
                                                                name="{{ $component->alias }}[status]" value="1"
                                                                {{ old($component->alias . '[status]') ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-status"
                                                                name="{{ $component->alias }}[status]" value="0"
                                                                {{ old($component->alias . '[status]') === '0' ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x ya-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="1"
                                                                {{ old($component->alias . '[kondisi]') ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <input type="checkbox"
                                                                class="checkbox-1x tidak-checkbox-kondisi"
                                                                name="{{ $component->alias }}[kondisi]"
                                                                value="0"
                                                                {{ old($component->alias . '[kondisi]') === '0' ? 'checked' : '' }}
                                                                onchange="handleCheckboxChange(this)">
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
