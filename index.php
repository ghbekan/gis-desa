<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>SIG Desa Bulungan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- Leaflet Marker Cluster CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Map Container Styling */
        .dashboard-container {
            padding: 2rem;
            min-height: calc(100vh - 76px);
        }

        .map-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            height: calc(100vh - 120px);
        }

        .map-header {
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .map-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .stats-cards {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .stat-info h4 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
        }

        .stat-info p {
            font-size: 0.9rem;
            color: #6c757d;
            margin: 0;
        }

        #map {
            height: calc(100% - 140px);
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Legend Styling */
        .legend {
            padding: 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .legend-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 0.3rem;
        }

        .legend-item:hover {
            background: #f8f9fa;
        }

        .legend-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-right: 0.8rem;
        }

        .legend-text {
            font-size: 0.9rem;
            font-weight: 500;
            color: #2c3e50;
        }

        /* Popup Styling */
        .leaflet-popup-content-wrapper {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .popup-content {
            padding: 0.5rem;
        }

        .popup-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .popup-address {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .popup-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-map-marked-alt me-2"></i>
                SIG Desa Bulungan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/pendidikan/index.php">
                            <i class="fas fa-school me-2"></i>Pendidikan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/tempat_ibadah/index.php">
                            <i class="fas fa-mosque me-2"></i>Tempat Ibadah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/tempat_umum/index.php">
                            <i class="fas fa-building me-2"></i>Tempat Umum
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <div class="map-section">
            <div class="map-header">
                <h2 class="map-title">Peta Persebaran Lokasi</h2>
            </div>
            
            <!-- Statistik Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #e3f2fd; color: #1e88e5;">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="stat-info">
                        <h4><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pendidikan")); ?></h4>
                        <p>Pendidikan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #e8f5e9; color: #43a047;">
                        <i class="fas fa-mosque"></i>
                    </div>
                    <div class="stat-info">
                        <h4><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tempat_ibadah")); ?></h4>
                        <p>Tempat Ibadah</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fff3e0; color: #fb8c00;">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-info">
                        <h4><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tempat_umum")); ?></h4>
                        <p>Tempat Umum</p>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div id="map"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.5851, 110.7175], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Ambil data tempat ibadah
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM tempat_ibadah");
        while($data = mysqli_fetch_array($query)) {
            echo "L.marker([".$data['latitude'].", ".$data['longitude']."])
                .bindPopup('".$data['nama']." - ".$data['jenis']."')
                .addTo(map);";
        }
        ?>

        // Ambil data pendidikan
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM pendidikan");
        while($data = mysqli_fetch_array($query)) {
            echo "L.marker([".$data['latitude'].", ".$data['longitude']."])
                .bindPopup('".$data['nama']." - ".$data['jenjang']."')
                .addTo(map);";
        }
        ?>

        // Ambil data tempat umum
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM tempat_umum");
        while($data = mysqli_fetch_array($query)) {
            echo "L.marker([".$data['latitude'].", ".$data['longitude']."])
                .bindPopup('".$data['nama']." - ".$data['jenis']."')
                .addTo(map);";
        }
        ?>
    </script>
</body>
</html>