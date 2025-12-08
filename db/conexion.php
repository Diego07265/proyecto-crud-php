<?php
declare(strict_types=1);

/**
 * config/db.php
 * Conexión a la base de datos usando PDO.
 * Sigue buenas prácticas: excepciones, charset y opciones.
 */

$host = '127.0.0.1';
$db   = 'pharmatrack';
$user = 'root';
$pass = ''; // en XAMPP por defecto
$port = 3306;
$dsn  = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // En producción no mostrar mensaje crudo. Aquí útil durante desarrollo.
    http_response_code(500);
    echo 'Error de conexión a la base de datos. Detalle: ' . htmlspecialchars($e->getMessage());
    exit;
}



