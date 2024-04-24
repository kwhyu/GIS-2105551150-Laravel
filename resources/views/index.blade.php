<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GIS-2105551150</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/ooo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Map Stuff -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.3/dist/leaflet.min.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="assets/img/pp.jpeg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">GIS - 2105551150</a></h1>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about" class="nav-link scrollto"><i class="bx bx-map"></i> <span>Map</span></a></li>
          <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>List Rumah Sakit</span></a></li>
          <!-- <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>Services</span></a></li>
          <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li> -->
        </ul>
      </nav>
      <!-- .nav-menu -->
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1>???</h1>
      <p>This <span class="typed" data-typed-items="M, A, P, Map"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Leaflet Map</h2>
        </div>
        <div id="mapid"></div>
        <script>
          var mymap = L.map('mapid').setView([-8.4095188, 115.188919], 11);

          //Map Option
          var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18,
          }).addTo(mymap);

          var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
          });

          var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
          });

          //Leaflet layer control
          var baseMaps = {
            'Base': osm,
            'Topografi': OpenTopoMap,
            'Imagery': Esri_WorldImagery
          }
          L.control.layers(baseMaps).addTo(mymap)

          var markers = [];
          var isOnDrag = false;
          var myIcon = L.icon({
            iconUrl: 'assets/img/logo.png',
            iconSize: [35, 40],
            iconAnchor: [20, 40],
          });

          // Format popup content
          formatContent = function(lat, lng, index) {
            return `
                <div class="wrapper">
                    <div class="row">
                        <div class="cell merged" style="text-align:center">Marker [ ${index+1} ]</div>
                    </div>
                    <div class="row">
                        <div class="col">Latitude</div>
                        <div class="col2">${lat}</div>
                    </div>
                    <div class="row">
                        <div class="col">Longitude</div>
                        <div class="col2">${lng}</div>
                    </div>

                </div>
            `;
          }

          addMarker = function(latlng, index) {

            // Menambahkan marker
            var marker = L.marker(latlng, {
              icon: myIcon,
              draggable: true
            }).addTo(mymap);

            // Membuat popup baru
            var popup = L.popup({
                offset: [0, -30]
              })
              .setLatLng(latlng);

            // Binding popup ke marker
            marker.bindPopup(popup);

            // Menambahkan event listener pada marker
            marker.on('click', function() {
              popup.setLatLng(marker.getLatLng()),
                popup.setContent(formatContent(marker.getLatLng().lat, marker.getLatLng().lng, index));
            });

            marker.on('dragstart', function(event) {
              isOnDrag = true;
            });

            // Menambahkan event listener pada marker
            marker.on('drag', function(event) {
              popup.setLatLng(marker.getLatLng()),
                popup.setContent(formatContent(marker.getLatLng().lat, marker.getLatLng().lng, index));
              marker.openPopup();
            });

            marker.on('dragend', function(event) {
              setTimeout(function() {
                isOnDrag = false;
              }, 500);
            });

            marker.on('contextmenu', function(event) {
              // Hapus semua marker dari array markers
              markers.forEach(function(m, i) {
                if (marker == m) {
                  m.removeFrom(mymap); // hapus marker dari peta
                  markers.splice(i, 1);
                }
              });
              //console.log(markers);
            });

            // Return marker
            return marker;
          }

          // Tambahkan event listener click pada peta
          mymap.on('click', function(e) {
            console.log(isOnDrag);
            if (!isOnDrag) {
              // Buat marker baru
              var newMarker = addMarker(e.latlng, markers.length);

              // Tambahkan marker ke array markers
              markers.push(newMarker);
              console.log(markers);
            }
          });
        </script>
      </div>
      <div class="container">
        <div class="base">
          <div class="kiri">
            <button onclick="getMarker()" type="button" class="btn btn-dark">Tampilkan Marker</button>
          </div>
          <div class="kanan">
            <button onclick="resetMarkers()" type="button" class="btn btn-dark">Reset Marker</button>
          </div>
        </div>
        <script>
          function getMarker() {
            var rsIcon = L.icon({
            iconUrl: 'assets/img/rs.png',
            iconSize: [35, 40],
            iconAnchor: [20, 40],
          });
            fetch("{{ route('getMarker') }}")
              .then(response => response.json())
              .then(data => {
                data.forEach(item => {
                  var latlng = item.latlng_rs.split(',');
                  var latitude = parseFloat(latlng[0]);
                  var longitude = parseFloat(latlng[1]);

                  // Buat marker pada peta menggunakan nilai latitude dan longitude
                  var marker = L.marker([latitude, longitude], { icon: rsIcon }).addTo(mymap);
                  marker.bindPopup('<div class="popup-content"><div class="popup-row"><span class="popup-col">ID RS:</span> ' + item.id_rs + '</div><div class="popup-row"><span class="popup-col">Nama RS:</span> ' + item.nama_rs + '</div><div class="popup-row"><span class="popup-col">Kelas:</span> ' + item.tipe_rs + '</div><div class="popup-row"><span class="popup-col">LatLng:</span> ' + item.latlng_rs + '</div></div>');
                });
              })
              .catch(error => console.error('Error:', error));
          }

          function resetMarkers() {
            mymap.eachLayer(function(layer) {
              if (layer instanceof L.Marker) {
                mymap.removeLayer(layer);
              }
            });
          }
        </script>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Input New Marker</h2>
        </div>
        <div class="form-input">
          <form action="{{ route('storeData') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="nama_rs" class="form-label">Nama Rumah Sakit</label>
              <input type="text" class="form-control" id="nama_rs" name="nama_rs" required>
            </div>

            <div class="mb-3">
              <label for="latlng_rs" class="form-label">Latitude,Longitude</label>
              <input type="text" class="form-control" id="latlng_rs" name="latlng_rs" required>
            </div>

            <div class="mb-3">
              <label for="tipe_rs" class="form-label">Tipe Rumah Sakit</label>
              <input type="text" class="form-control" id="tipe_rs" name="tipe_rs" required>
            </div>

            <div class="mb-3">
              <label for="alamat_rs" class="form-label">Alamat Rumah Sakit</label>
              <input type="text" class="form-control" id="alamat_rs" name="alamat_rs" required>
            </div>

            <div class="mb-3">
              <label for="gambar_rs" class="form-label">Gambar Rumah Sakit</label>
              <input type="file" class="form-control" id="gambar_rs" name="gambar_rs" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

      </div>
    </section><!-- End Facts Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>List Rumah Sakit Terdaftar</h2>
        </div>
        <div class="data_rs">
          @php
          $ar_judul = ['No','Nama','LatLng','Tipe','Alamat'];
          $no = 1;
          @endphp
          <table id="rsTable">
            <thead>
              <tr>
                @foreach($ar_judul as $jdl)
                <th>{{ $jdl }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody id="rsTableBody">
              @if(isset($data) && count($data) > 0)
              @foreach($data as $dx)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dx->nama_rs }}</td>
                <td>{{ $dx->latlng_rs}}</td>
                <td>{{ $dx->tipe_rs }}</td>
                <td>{{ $dx->alamat_rs}}</td>
              </tr>
              <tr>
                @php
                $base64_image = base64_encode($dx->gambar_rs);
                $image_src = 'data:image/jpeg;base64,' . $base64_image;
                @endphp
                <td>
                <td>
                <td><img src="{{ $image_src }}" alt="Gambar Rumah Sakit" style="width: 400px; height: 300px;">
                <td>
                <td></td>
                </td>
                </td>
                </td>
                </td>
              </tr>
              @endforeach
              @else
              <p>Tidak ada data tersedia</p>
              @endif
            </tbody>
          </table>
        </div>
      </div>

      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; NIM <strong><span>2105551150</span></strong>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <!-- <script src="{{ asset('assets/js/server.js') }}"></script> -->

</body>

</html>