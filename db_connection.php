<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_sig";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Anda dapat menambahkan pesan sukses jika diperlukan
// echo "Connected successfully";
?>
