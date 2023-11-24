<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form_pengaduan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$pelapor = $_POST['nama']; 
$waktu = $_POST['waktu'];
$telp = $_POST['telp'];
$Longitude = $_POST['longitude'];
$Latitude = $_POST['latitude'];
$kasus = $_POST['kasus'];

// Insert data into the database
$sql = "INSERT INTO pengaduan (pelapor, waktu, telp, longitude, latitude, kasus) VALUES ('$pelapor', '$waktu', '$telp', '$Longitude', '$Latitude', '$kasus')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
