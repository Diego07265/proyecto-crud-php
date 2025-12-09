<?php
declare(strict_types=1);

/**
 * config/bd.php
 * Conexión a la base de datos usando PDO
 */

$host = '127.0.0.1';
$nombreBD = 'drogueriapharmatrack';
$user = 'root';
$pass = ''; // vacío en XAMPP
$port = 3306;

$dsn = "mysql:host={$host};port={$port};dbname={$nombreBD};charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Aquí creamos el objeto PDO en $pdo (nombre recomendado)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Error de conexión a la base de datos: ' . htmlspecialchars($e->getMessage());
    exit;
}

