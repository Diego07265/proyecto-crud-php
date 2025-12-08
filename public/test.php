<?php
require_once __DIR__ . '/../config/bd.php';

try {
    echo "Conexión exitosa a la base de datos!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
