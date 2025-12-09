<?php
require_once "../config/bd.php";

echo "<h2>Conexión a la base de datos EXITOSA </h2>";

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM producto");
$r = $stmt->fetch();

echo "Registros en producto: " . $r['total'];

