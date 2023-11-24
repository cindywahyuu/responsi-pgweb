<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi_pgweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$nama = $_POST['nama'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Insert data into the database
$sql = "INSERT INTO banksampah (Nama, Latitude, Longitude) VALUES ('$nama', '$latitude', '$longitude')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
