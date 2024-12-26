<?php
include '../../config/koneksi.php';

if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis = $_POST['jenis'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    
    $query = mysqli_query($koneksi, "INSERT INTO tempat_ibadah (nama, alamat, jenis, latitude, longitude) 
                                    VALUES ('$nama', '$alamat', '$jenis', '$latitude', '$longitude')");
    
    if($query) {
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tempat Ibadah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-header bg-primary bg-gradient text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-mosque me-2"></i> Tambah Tempat Ibadah
                            </h4>
                            <a href="index.php" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nama Tempat Ibadah</label>
                                <input type="text" name="nama" class="form-control" required>
                                <div class="invalid-feedback">
                                    Nama tempat ibadah harus diisi
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Alamat harus diisi
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="Masjid">Masjid</option>
                                    <option value="Musholla">Musholla</option>
                                    <option value="Gereja">Gereja</option>
                                    <option value="Pura">Pura</option>
                                    <option value="Vihara">Vihara</option>
                                </select>
                                <div class="invalid-feedback">
                                    Jenis tempat ibadah harus dipilih
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Latitude harus diisi
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Longitude harus diisi
                                    </div>
                                </div>
                            </div>
                            <div id="map" style="height: 400px" class="mb-3"></div>
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Initialize map
        var map = L.map('map').setView([-6.5971, 110.9931], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var marker;
        map.on('click', function(e) {
            if (marker) map.removeLayer(marker);
            marker = L.marker(e.latlng).addTo(map);
            document.querySelector('input[name="latitude"]').value = e.latlng.lat;
            document.querySelector('input[name="longitude"]').value = e.latlng.lng;
        });
    </script>
</body>
</html>
