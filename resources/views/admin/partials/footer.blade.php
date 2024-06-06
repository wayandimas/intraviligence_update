</div>
</div>
</div>
</div>
</div>
<script>
    // function goBack() {
    //   window.history.back();
    // }
</script>
<!-- Jquery JS-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/daterangepicker.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('assets/js/global.js') }}"></script>
<script src="{{ asset('assets/js/date.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>


<script src="{{ asset('assets/superadmin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/detect.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/waves.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/superadmin/js/jquery.scrollTo.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/superadmin/js/app.js') }}"></script>



<!-- Required datatable js -->
<script src="{{ asset('assets/superadmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/superadmin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/superadmin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/superadmin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/superadmin/pages/datatables.init.js') }}"></script>

<!-- App js -->

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
</script>
<script>
    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons({
                "color": "#fff"
            }, {
                "resizeClear": true
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    };

    // scroll

    $(document).ready(function() {

        $("#boxscroll").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });
        $("#boxscroll2").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });

    });
</script>

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
                                    icon: '{{ url('assets/images/car.png') }}'
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
</body>

</html>
