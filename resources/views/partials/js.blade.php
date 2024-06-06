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
       <script src="{{ asset('assets/js/responTime.js') }}"></script>
       <script src="{{ asset('assets/js/validateTime.js') }}"></script>
       <script src="{{ asset('assets/js/responTimeMedis.js') }}"></script>
       <script src="{{ asset('assets/js/responTimeKecelakaan.js') }}"></script>
       <script src="{{ asset('assets/js/responTimeDerek.js') }}"></script>
       <script src="{{ asset('assets/js/responTimeOperasional.js') }}"></script>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
       <script>
           $(document).ready(function() {
               $('input[name="kembalian"]').on('input', function() {
                   // Hapus karakter selain angka
                   var number = $(this).val().replace(/[^0-9]/g, '');
                   $('input[name="kembalian_numeric"]').val(
                       number); // Set the numeric value in the hidden input
                   $(this).val(formatRupiah(number)); // Display the formatted rupiah amount
               });

               // Fungsi untuk mengubah angka menjadi format rupiah
               function formatRupiah(angka) {
                   var number_string = angka.toString().replace(/[^,\d]/g, ''),
                       split = number_string.split(','),
                       sisa = split[0].length % 3,
                       rupiah = split[0].substr(0, sisa),
                       ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                   // Tambahkan titik jika ada ribuan
                   if (ribuan) {
                       separator = sisa ? '.' : '';
                       rupiah += separator + ribuan.join('.');
                   }

                   // Tambahkan koma dan angka desimal jika ada
                   rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                   return rupiah;
               }
           });
       </script>
       <script>
           function displayImage() {
               var input = document.getElementById("dokumentasi-input");
               var selectedImage = document.getElementById("selected-image");
               var imageTitle = document.getElementById("image-title");

               selectedImage.style.display = "block";
               imageTitle.style.display = "block";

               selectedImage.src = URL.createObjectURL(input.files[0]);
               imageTitle.textContent = 'Preview Image';
           }
       </script>
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
