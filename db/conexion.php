<?php
$host = "localhost:8080";
$user = "root";
$pass = "";
$db   = "pharmatrack";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

echo "Conectado correctamente a la base de datos";
?>


