<?php

declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

// Obtener todos los productos 
try {
    $stmt = $pdo->query('SELECT * FROM producto ORDER BY producto_id DESC');
    $productos = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error al obtener los productos: " . htmlspecialchars($e->getMessage());
    $productos = [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogueria Pharma Track - Productos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Productos de la Drogueria</h1>
        <a href="create.php" class="btn btn-primary mb-3">Agregar Producto</a>

        <?php if (empty($productos)): ?>
            <div class="alert alert-info">No hay productos disponibles.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Fecha Vencimiento</th>
                        <th>Requiere Receta</th>
                        <th>ID Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$producto['producto_id']) ?></td>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td><?= htmlspecialchars((string)$producto['categoria_id']) ?></td>
                            <td><?= htmlspecialchars((string)$producto['precio']) ?></td>
                            <td><?= htmlspecialchars((string)$producto['stock']) ?></td>
                            <td><?= htmlspecialchars((string)$producto['fecha_vencimiento']) ?></td>
                            <td><?= $producto['requiere_receta'] ? 'Sí' : 'No' ?></td>
                            <td><?= htmlspecialchars((string)$producto['id_proveedor']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= urlencode((string)$producto['producto_id']) ?>"
                                    class="btn btn-warning btn-sm">Editar</a>

                                <a href="delete.php?id=<?= urlencode((string)$producto['producto_id']) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>
</body>

</html>