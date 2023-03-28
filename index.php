<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Mapy.cz</title>
    <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
    <script type="text/javascript">Loader.load();</script>
</head>
<body class="bg-light text-dark">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mapa";

if(isset($_POST['souradnice'])){
    $conn = mysqli_connect($servername, $username, $password, $dbname);

// Kontrola připojení
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Získání hodnoty koordinací z pole $_POST a úprava na řetězec
    $souradnice = mysqli_real_escape_string($conn, str_replace('"', '', $_POST['souradnice']));

// Uložení dat do tabulky
    $sql = "INSERT INTO map (souradnice) VALUES ('$souradnice')";

    if (mysqli_query($conn, $sql)) {
        echo "Data byla úspěšně uložena do databáze.";
    } else {
        echo "Chyba: " . $sql . "<br>" . mysqli_error($conn);
    }

// Ukončení spojení s databází
    mysqli_close($conn);
}

?>

<div class="container text-center" id="mainCon">
    <h1 class="mt-5">Mapa</h1>
    <form method="post" action="index.php">
        <input id="souradnice" class="form-control" style="width: 50%; margin-left: 325px" readonly name="souradnice"
               method="post" required>
        <button type="submit" id="btn" class="btn btn-primary mb-3 mt-3">Uložit
            souřadnice
        </button>
    </form>
    <div class="text-center" id="m" style="height:500px"></div>
</div>
</body>
<script src="map.js"></script>
<script src="souradnice.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</html>