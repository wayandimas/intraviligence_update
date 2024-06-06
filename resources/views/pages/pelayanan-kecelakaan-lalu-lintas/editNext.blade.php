<!doctype html>
<html lang="en">

<head>
    <title>Laporan Pelayanan Kecelakaan Lalu Lintas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <script>
        function showForm() {
            var form = document.getElementById("myForm");
            if (document.getElementById("yes").checked) {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        function goBack() {
            
            window.history.back();
        }
    </script>
    
    @include('partials.css')

    <style>
        .thick-hr {
    border: none;
    border-top: 3px solid black; /* Change the thickness as desired */
    margin-top: 20px; /* Optional: Add some margin to the horizontal line */
}
    </style>
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
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

                    <h2 class="title">Form Pelayanan Penanganan Kecelakaan Lalu Lintas</h2>
                    <form action="{{ route('pelayanan-kendaraan-kecelakaan.nextUpdate', $datas->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div id="korban-container">
                            @foreach ($korban as $key => $k)
                                <div class="form-group korban-entry" id="korban-wrapper-{{ $key }}">
                                    <div class="mb-1">
                                        <label for="korban" class="label">Nama Korban {{ $key+1 }}</label>
                                        <input type="text" class="form-control" placeholder="" value="{{ $k->nama }}" onkeyup="this.value = this.value.toUpperCase()" name="korban[]" />
                                        <small class="form-text text-danger">{{ $errors->first('korban[]') }}</small>
                                    </div>
                                    <div class="mb-1">
                                        <label for="umur" class="label umur">Umur Korban {{ $key+1 }}</label>
                                        <input type="text" class="form-control" placeholder="" value="{{ $k->umur }}" onkeyup="this.value = this.value.toUpperCase()" name="umur[]" />
                                        <small class="form-text text-danger">{{ $errors->first('umur[]') }}</small>
                                    </div>
                                    <div class="mb-1">
                                        <label for="kondisi" class="label kondisi">Kondisi Korban {{ $key+1 }}</label>
                                        <select class="form-control" aria-label="Default select example" name="kondisi[]">
                                            <option>Select Kondisi Korban</option>
                                            @foreach ($kondisi as $cond)
                                                <option value="{{ $cond->id }}" {{ $k->kondisi == $cond->id ? 'selected' : '' }}>{{ $cond->nama }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">{{ $errors->first('kondisi[]') }}</small>
                                    </div>
                                    <div class="mb-1">
                                        <label for="tindakan" class="label tindakan">Tindakan Korban {{ $key+1 }}</label>
                                        <input type="text" class="form-control" placeholder="" value="{{ $k->tindakan }}" onkeyup="this.value = this.value.toUpperCase()" name="tindakan[]" />
                                        <small class="form-text text-danger">{{ $errors->first('tindakan[]') }}</small>
                                    </div>
                                    @if ($key > 0)
                                        <button class="btn btn-danger hapus-korban" data-id="{{ $key }}">Hapus</button>
                                    @endif
                                    <hr class="thick-hr"> 
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <a class="btn btn-primary" style="width: 100%; color:white;" id="add-korban" data-id={{ count($korban) }}>Tambah</a>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="widm" class="label">Waktu Info Medis Dibutuhkan</label>
                            <input type="time" class="form-control" name=widm id="widm" value="{{ $datas->waktu_info_medis_dibutuhkan }}" /><small
                                class="form-text text-danger">{{ $errors->first('widm') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wtmt" class="label">Waktu Tiba Medis di TKP</label>
                            <input type="time" class="form-control" name=wtmt id="wtmt" value="{{ $datas->waktu_tiba_medis }}"
                                onchange="validateTimePetugasMedis()" /><small
                                class="form-text text-danger"id="wtmt-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="rtpm" class="label">Respon Time Petugas Medis</label>
                            <input class="form-control" readonly name=rtpm id="rtpm" value="{{ $datas->respond_time_medis }}" />
                        </div>
                        <div class="form-group">
                            <label for="wmmt" class="label">Waktu Medis Meninggalkan TKP</label>
                            <input type="time" class="form-control" name=wmmt id="wmmt" value="{{ $datas->waktu_medis_meninggalkan_tkp }}"
                                onchange="validateTimePenangananMedis()" /><small
                                class="form-text text-danger"id="wmmt-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dpn" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dpn id="dpn" value="{{ $datas->durasi_penanganan_medis }}" />
                        </div>
                        <div class="form-group">
                            <label for="wmrs" class="label">Waktu Medis Sampai RS</label>
                            <input type="time" class="form-control" name=wmrs id="wmrs" value="{{ $datas->waktu_sampai_rs }}"
                                onchange="validateTimeDurasiPerjalanan()" /><small
                                class="form-text text-danger"id="wmrs-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dpe" class="label">Durasi Perjalanan</label>
                            <input class="form-control" readonly name=dpe id="dpe" value="{{ $datas->durasi_perjalanan }}" />
                        </div>

                        <div class="form-group" style="display: flex; justify-content: center">
                            <div class="p-t-15" style="margin-right: 10px;">
                                <button type="button" class="btn btn-primary btn-block" onclick="goBack();">
                                    Prev
                                </button>
                            </div>
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

    <!-- Jquery JS-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"
        integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js" integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function() {
                // Click event handler for "Tambah" button
                $("#add-korban").click(function() {
                    // Get the current data-id and increment it by 1
                    let id = parseInt($(this).attr("data-id")) + 1;
                    $(this).attr("data-id", id);
        
                    // New input for Korban
                    let input = `
                        <div class="form-group korban-entry" id="korban-wrapper-${id}">
                            <div class="mb-1">
                                <label for="korban" class="label">Nama Korban ${id}</label>
                                <input type="text" class="form-control" placeholder="" value="" onkeyup="this.value = this.value.toUpperCase()" name="korban[]" />
                                <small class="form-text text-danger"></small>
                            </div>
                            <div class="mb-1">
                                <label for="umur" class="label umur">Umur Korban ${id}</label>
                                <input type="text" class="form-control" placeholder="" value="" onkeyup="this.value = this.value.toUpperCase()" name="umur[]" />
                                <small class="form-text text-danger"></small>
                            </div>
                            <div class="mb-1">
                                <label for="kondisi" class="label kondisi">Kondisi Korban ${id}</label>
                                <select class="form-control" aria-label="Default select example" name="kondisi[]">
                                    <option>Select Kondisi Korban</option>
                                    @foreach ($kondisi as $cond)
                                        <option value="{{ $cond->id }}">{{ $cond->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-danger"></small>
                            </div>
                            <div class="mb-1">
                                <label for="tindakan" class="label tindakan">Tindakan Korban ${id}</label>
                                <input type="text" class="form-control" placeholder="" value="" onkeyup="this.value = this.value.toUpperCase()" name="tindakan[]" />
                                <small class="form-text text-danger"></small>
                            </div>
                            <button class="btn btn-danger hapus-korban" data-id="${id}">Hapus</button>
                            <hr class="thick-hr"> 
                        </div>
                    `;
        
                    // Append new inputs to the korban container
                    $("#korban-container").append(input);
                });
        
                // Click event handler for "Hapus" button
                $(document).on('click', '.hapus-korban', function() {
                    var id = parseInt($(this).data("id"));
                    $('#korban-wrapper-' + id).remove();
                });
            });
        </script>
        

    @include('partials.js')

</body>

</html>
