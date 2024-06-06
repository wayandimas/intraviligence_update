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
                    <form action="{{ route('pelayanan-kecelakaan-lalu-lintas.storeNext') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="korban-container">
                        <div class="form-group korban-entry" id="korban-wrapper">
                            {{-- <H3 id="korban-heading" > Daftar Korban </H3> --}}
                            <div class="mb-1">
                                <label for="korban" class="label">Nama Korban</label>
                                <input type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()" name="korban[]" />
                                <small class="form-text text-danger">{{ $errors->first('korban[]') }}</small>
                            </div>
                            <div class="mb-1">
                                <label for="umur" class="label umur">Umur Korban</label>
                                <input type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()" name="umur[]" />
                                <small class="form-text text-danger">{{ $errors->first('umur[]') }}</small>
                            </div>
                            <div class="mb-1">
                                <label for="kondisi" class="label kondisi">Kondisi Korban</label>
                                <select class="form-control" aria-label="Default select example" name="kondisi[]">
                                    <option>Select Kondisi Korban</option>
                                    @foreach ($kondisi as $key => $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-danger">{{ $errors->first('kondisi[]') }}</small>
                            </div>
                            <div class="mb-1">
                                <label for="tindakan" class="label tindakan">Tindakan Korban</label>
                                <input type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()" name="tindakan[]" />
                                <small class="form-text text-danger">{{ $errors->first('tindakan[]') }}</small>
                            </div>
                            <hr class="thick-hr"> 
                        </div>

                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <a class="btn btn-primary" style="width: 100%; color:white;" id="add-korban" data-id="0">Tambah</a>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="widm" class="label">Waktu Info Medis Dibutuhkan</label>
                            <input type="time" class="form-control" name=widm id="widm" /><small
                                class="form-text text-danger">{{ $errors->first('widm') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="wtmt" class="label">Waktu Tiba Medis di TKP</label>
                            <input type="time" class="form-control" name=wtmt id="wtmt"
                                onchange="validateTimePetugasMedis()" /><small
                                class="form-text text-danger"id="wtmt-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="rtpm" class="label">Respon Time Petugas Medis</label>
                            <input class="form-control" readonly name=rtpm id="rtpm" />
                        </div>
                        <div class="form-group">
                            <label for="wmmt" class="label">Waktu Medis Meninggalkan TKP</label>
                            <input type="time" class="form-control" name=wmmt id="wmmt"
                                onchange="validateTimePenangananMedis()" /><small
                                class="form-text text-danger"id="wmmt-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dpn" class="label">Durasi Penanganan</label>
                            <input class="form-control" readonly name=dpn id="dpn" />
                        </div>
                        <div class="form-group">
                            <label for="wmrs" class="label">Waktu Medis Sampai RS</label>
                            <input type="time" class="form-control" name=wmrs id="wmrs"
                                onchange="validateTimeDurasiPerjalanan()" /><small
                                class="form-text text-danger"id="wmrs-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="dpe" class="label">Durasi Perjalanan</label>
                            <input class="form-control" readonly name=dpe id="dpe" />
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
<!-- resources/views/form.blade.php -->
<!-- ... -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let korbanCounter = 0;

    function addKorban() {
        korbanCounter++;

        const korbanContainer = document.getElementById('korban-container');
        const korbanWrapper = document.getElementById('korban-wrapper');
        const clonedKorban = korbanWrapper.cloneNode(true);
        clonedKorban.classList.add('korban-entry');

        const inputs = clonedKorban.querySelectorAll('input, select');
        inputs.forEach((input) => {
            input.value = '';
            const inputName = input.name;
            input.name = `${inputName.substring(0, inputName.length - 2)}[${korbanCounter}]`;
        });
        // const korbanHeading = document.getElementById('korban-heading');
        // korbanHeading.textContent = `Daftar Korban `;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Hapus';
        deleteButton.classList.add('btn', 'btn-danger', 'mx-2');
        deleteButton.addEventListener('click', function() {
            hapusKorban(this);
        });
        clonedKorban.appendChild(deleteButton);

        korbanContainer.appendChild(clonedKorban);
    }

    function hapusKorban(button) {
        if (korbanCounter === 0) {
            return;
        }

        const korbanDiv = button.parentElement;
        korbanDiv.remove();
        korbanCounter--;
    }

    document.getElementById('add-korban').addEventListener('click', function() {
        addKorban();
    });

    // Tangani klik tombol "Hapus" untuk setiap elemen korban dengan event delegation
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('btn-danger')) {
            hapusKorban(event.target);
        }
    });
});

</script>



    @include('partials.js')

</body>

</html>
