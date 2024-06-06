<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Petugas Lalu Lintas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @include('partials.css')
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-60 p-b-100 font-poppins">
        <div class="wrapper wrapper--w1300">
            <div class="card card-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="dropdown">
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ Auth::user()->nama }}</a>
                                {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('logout.index') }}">Logout</a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col" style="text-align: end">
                            <p id="tanggalwaktu" name="tanggalwaktu">
                                Date
                            </p>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 30px">
                        <div id="map" style="width: 100%; height: 400px"></div>
                        {{-- <img src="assets/images/img_mutasi_patroli.png" alt="Image Lalin"
                            style="max-width: 100%; height: auto" /> --}}
                    </div>
                    <div class="row">
                        <h4 class="title col" style="margin-bottom: 0px; max-width: 1300px">
                            Completion of your task
                        </h4>
                    </div>
                    <div class="title row" style="margin-top: 0px">
                        <div class="col">
                            <img src=" assets/images/icon1.png" alt="" />
                            <h5 style="margin-top: 15px">{{ ($total / 16) * 100 }}%</h5>
                        </div>
                        <div class="col">
                            <img src=" assets/images/icon2.png" alt="" />
                            <h5 style="margin-top: 15px">0.00%</h5>
                        </div>
                        <div class="col">
                            <img src=" assets/images/icon3.png" alt="" />
                            <h5 style="margin-top: 15px">0.00%</h5>
                        </div>
                    </div>
                    <div class="title-2 row">
                        <div class="col">
                            <a href="{{ route('aktivitas-harian.index') }}">
                                <div class="card-content" style="padding: 3px">
                                    <img src="assets/images/ashiap.png" alt="" width="120px" height="120px" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    ASHIAP (Aktivitas Harian Petugas)
                                </h5>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('lapenam.index') }}">
                                <div class="card-content">
                                    <img src="assets/images/lapenam.png" height="120px" width="120px" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    LAPANENAM (Laporan Pemeriksaan Kendaraan dan
                                    Monitoring)
                                </h5>
                            </a>
                        </div>
                        <div class="col">
                            @if ($p1 != null && $p2 != null)
                                @php
                                    $export = DB::table('activity_mutation_service_tol')
                                        ->select()
                                        ->where('personil1', $p1->id)
                                        ->where('personil2', $p2->id)
                                        ->whereDate('created_at', now()->toDateString())
                                        ->first();
                                    // dd($export);
                                    if ($export != null) {
                                        $dataExport = DB::table('output_mutation')
                                            ->select()
                                            ->where('no_mutation', $export->no_mutasi)
                                            ->first();
                                    }
                                @endphp
                            @endif
                            @if ($pa != null)
                                @php
                                    $export = DB::table('activity_mutation_service_tol')
                                        ->select()
                                        ->where('personil1', $pa->id)
                                        ->where('personil2', $pa->id)
                                        ->whereDate('created_at', now()->toDateString())
                                        ->first();
                                    // dd($export);
                                    if ($export != null) {
                                        $dataExport = DB::table('output_mutation')
                                            ->select()
                                            ->where('no_mutation', $export->no_mutasi)
                                            ->first();
                                    }
                                @endphp
                            @endif
                            @if ($ps != null)
                                @php
                                    $export = DB::table('activity_mutation_service_tol')
                                        ->select()
                                        ->where('personil1', $ps->id)
                                        ->where('personil2', $ps->id)
                                        ->whereDate('created_at', now()->toDateString())
                                        ->first();
                                    // dd($export);
                                    if ($export != null) {
                                        $dataExport = DB::table('output_mutation')
                                            ->select()
                                            ->where('no_mutation', $export->no_mutasi)
                                            ->first();
                                    }
                                @endphp
                            @endif
                            @if ($pr != null)
                                @php
                                    $export = DB::table('activity_mutation_service_tol')
                                        ->select()
                                        ->where('personil1', $pr->id)
                                        ->where('personil2', $pr->id)
                                        ->whereDate('created_at', now()->toDateString())
                                        ->first();
                                    // dd($export);
                                    if ($export != null) {
                                        $dataExport = DB::table('output_mutation')
                                            ->select()
                                            ->where('no_mutation', $export->no_mutasi)
                                            ->first();
                                    }
                                @endphp
                            @endif
                            @if ($psn != null && $ptis != null)
                                @php
                                    $export = DB::table('activity_mutation_service_tol')
                                        ->select()
                                        ->where('personil1', $psn->id)
                                        ->where('personil2', $ptis->id)
                                        ->whereDate('created_at', now()->toDateString())
                                        ->first();
                                    // dd($export);
                                    if ($export != null) {
                                        $dataExport = DB::table('output_mutation')
                                            ->select()
                                            ->where('no_mutation', $export->no_mutasi)
                                            ->first();
                                    }
                                @endphp
                            @endif
                            @if ($pdk != null)
                                @php
                                    $export = DB::table('activity_mutation_service_tol')
                                        ->select()
                                        ->where('personil1', $pdk->id)
                                        ->where('personil2', $pdk->id)
                                        ->whereDate('created_at', now()->toDateString())
                                        ->first();
                                    // dd($export);
                                    if ($export != null) {
                                        $dataExport = DB::table('output_mutation')
                                            ->select()
                                            ->where('no_mutation', $export->no_mutasi)
                                            ->first();
                                    }
                                @endphp
                            @endif

                            <div class="card-content" style="padding: 20px">
                                <img src="assets/images/output.png" alt="" />
                            </div>
                            <h5 style="margin-top: 15px">Grafik Laporan</h5>


                        </div>
                        <div class="col">
                            <a href="{{ route('siap.index') }}">
                                <div class="card-content" style="padding: 15px">
                                    <img src="assets/images/siap.png" height="100px" width="100px" alt="" />
                                </div>
                                <h5 style="margin-top: 15px">
                                    SIAP (Surat Ijin Aktivitas Pekerjaan)
                                </h5>
                            </a>

                        </div>
                    </div>
                    @if ($total == 16)
                        <a class="btn btn-primary" href="{{ route('logout.index') }}">Logout</a>
                    @elseif ($total == 32)
                        <a class="btn btn-primary" href="{{ route('logout.index') }}">Logout</a>
                    @elseif ($total == 48)
                        <a class="btn btn-primary" href="{{ route('logout.index') }}">Logout</a>
                    @else
                        <a class="btn btn-primary" href="">Logout</a>
                    @endif
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

            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS -->
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="assets/vendor/datepicker/moment.min.js"></script>
    <script src="assets/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="assets/js/global.js"></script>
    <script src="assets/js/date.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx-hxPzuc05rr3CeNGDsAoUvuzZN76-64&callback=initMap"></script>

    <script>
        var map;
        var carMarkers = [];
        const BASE_URL_API = 'https://portal.gps.id/backend/seen/public/';
        let authToken = '';

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15
            });

            // Start polling to update car positions
            setInterval(updateCarPositions, 5000); // Update every 5 seconds
        }


        function login(username, password) {
            return fetch(BASE_URL_API + 'login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username,
                        password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status && data.message && data.message.data && data.message.data.token) {
                        authToken = data.message.data.token; // Simpan token yang diperbarui
                        return authToken;
                    } else {
                        throw new Error('Invalid response');
                    }
                });
        }


        function updateCarPositions() {
            login('MMNJTSE', 'Seksi1234')
                .then(token => {
                    // Fetch car coordinates from API
                    fetch(BASE_URL_API + 'vehicle', {
                            headers: {
                                'Authorization': authToken
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            var cars = data.message.data; // Get
                            cars.forEach((car, index) => {
                                if (carMarkers[index]) {
                                    // Update existing marker position
                                    carMarkers[index].setPosition({
                                        lat: parseFloat(car.latitude),
                                        lng: parseFloat(car.longitude)
                                    });
                                } else {
                                    // Create new marker
                                    var carMarker = new google.maps.Marker({
                                        position: {
                                            lat: parseFloat(car.latitude),
                                            lng: parseFloat(car.longitude)
                                        },
                                        map: map,
                                        icon: 'assets/images/car.png'
                                    });

                                    carMarkers.push(carMarker);
                                }
                            });
                            setMapCenter(cars);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                })
                .catch(error => {
                    console.error('Login failed:', error);
                });
        }

        function setMapCenter(cars) {
            var bounds = new google.maps.LatLngBounds();

            cars.forEach(car => {
                bounds.extend(new google.maps.LatLng(parseFloat(car.latitude), parseFloat(car.longitude)));
            });

            map.setCenter(bounds.getCenter());
        }
    </script>

</body>

</html>
