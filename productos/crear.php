<?php
include("../db/conexion.php");

// Consultar categorías
$categorias = $conn->query("SELECT * FROM Categoria");

// Consultar proveedores
$proveedores = $conn->query("SELECT * FROM Proveedor");

// Si el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $requiere_receta = isset($_POST['requiere_receta']) ? 1 : 0;
    $id_proveedor = $_POST['id_proveedor'];

    // Insert real según tu BD
    $sql = "INSERT INTO Producto 
            (nombre, categoria_id, precio, stock, fecha_vencimiento, requiere_receta, id_proveedor)
            VALUES 
            ('$nombre', '$categoria_id', '$precio', '$stock', '$fecha_vencimiento', '$requiere_receta', '$id_proveedor')";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php");
        exit();
    } else {
        echo "<p>Error al guardar el producto</p>";
        echo "<pre>" . $conn->error . "</pre>";
    }
}
?>


