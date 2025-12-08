<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "DrogueriaPharmaTrack";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

echo "Conectado correctamente a la base de datos";
?>


