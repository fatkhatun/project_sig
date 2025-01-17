<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Kecamatan dan Layanan Kesehatan Banyumas</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map { height: 700px; }
    </style>
</head>
<body>
    <h1>Peta Kecamatan dan Layanan Kesehatan Kabupaten Banyumas</h1>
    <a href="crud.php" target="_blank">
        <button>Data</button>
    </a>
    <div id="map"></div>

    <!-- Peta Kecamatan dengan data dari file JSON -->
    <script type="text/javascript" src="data/kecamatan.json"></script>

    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([-7.450161992561026, 109.16218062235068], 11);

        // Menambahkan tile layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Menambahkan polygon kecamatan
        L.geoJSON(kecamatan, {
            style: function (feature) {
                return { color: 'blue', weight: 2 };
            }
        }).addTo(map);

        // Menambahkan marker untuk layanan kesehatan dari database
        <?php
        include 'db_connection.php'; // Memanggil file koneksi database

        // Mengambil data dari tabel health_services
        $sql = "SELECT name, latitude, longitude FROM health_services";
        $result = $conn->query($sql);

        // Mengecek dan menampilkan data sebagai marker di peta
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "L.marker([" . $row["latitude"] . ", " . $row["longitude"] . "]).addTo(map)
                      .bindPopup('<b>" . addslashes($row["name"]) . "</b>');\n";
            }
        }
        $conn->close(); // Menutup koneksi
        ?>
    </script>
</body>
</html>
