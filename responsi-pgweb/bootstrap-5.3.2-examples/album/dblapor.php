<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS Library -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    

     <!-- Google Maps API -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhip-SFbA9BHPnt2orUwZTExwOsiWYkIM&libraries=places"></script>

</head>
<body>
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Partisipatif Pemetaan Bank Sampah</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Input <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="petalapor.php">Peta Pelaporan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">Back to home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ayo berpartisipasi untuk lingkungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to input data -->
                    <form action="lapor.php" method="post">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Pelapor:</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama Bank Sampah">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="waktu" class="col-sm-2 col-form-label">Waktu:</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="waktu" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="latitude" class="col-sm-2 col-form-label">Lokasi:</label>
                            <div class="col-sm-10">
                                <button type="button" onclick="getCurrentLocation()" class="btn btn-primary">Dapatkan Lokasi Saat Ini</button>
                                <div id="selectedLocation"></div>
                                <input type="hidden" name="latitude" id="latitude" required>
                                <input type="hidden" name="longitude" id="longitude" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kasus" class="col-sm-2 col-form-label">Kasus:</label>
                            <div class="col-sm-10">
                                <input type="text" name="kasus" class="form-control" required placeholder="Contoh: Sampah menumpuk di pinggir jalan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telp" class="col-sm-2 col-form-label">Telp:</label>
                            <div class="col-sm-10">
                                <input type="text" name="telp" class="form-control" required placeholder="Contoh: 081234567890">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <input type="submit" value="Laporkan" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                    <!-- Add the following script to handle location retrieval -->
                    <script>
                        function getCurrentLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition);
                            } else {
                                alert("Geolocation is not supported by this browser.");
                            }
                        }

                        function showPosition(position) {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;

                            // Display the selected location
                            document.getElementById("selectedLocation").innerHTML = "Lokasi terpilih: " + latitude + ", " + longitude;

                            // Set the values of the hidden fields
                            document.getElementById("latitude").value = latitude;
                            document.getElementById("longitude").value = longitude;
                        }
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Sesuaikan dengan setting MySQL
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
    $sql = "SELECT * FROM pengaduan";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1px'><tr>
        <th>Pelapor</th>
        <th>Waktu</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Telp</th>
        <th>Kasus</th>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["pelapor"]."</td><td>".
            $row["waktu"]."</td><td align='right'>".
            $row["Longitude"]."</td><td>".
            $row["Latitude"]."</td><td>".
            $row["telp"]."</td><td>".
            $row["kasus"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>


    <!-- Bootstrap JavaScript Library (Popper.js and jQuery required) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
