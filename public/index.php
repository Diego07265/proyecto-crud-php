<?php

declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

//Obtener todos los productos 

$stmt = $bd->query('SELECT * FROM producto ORDER BY producto_id DESC');
$productos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogueria Pharma Track-Productos</title>
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
                        <th>producto_id</th>
                        <th>Nombre</th>
                        <th>Categoria_id</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Fecha de vencimiento</th>
                        <th>Requiere receta</th>
                        <th>ID proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$p['producto_id']) ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= htmlspecialchars((string)$p['categoria_id']) ?></td>
                            <td><?= htmlspecialchars((string)$p['precio']) ?></td>
                            <td><?= htmlspecialchars((string)$p['stock']) ?></td>
                            <td><?= htmlspecialchars($p['fecha_vencimiento']) ?></td>
                            <td><?= $p['requiere_receta'] ? 'Sí' : 'No' ?></td>
                            <td><?= htmlspecialchars((string)$p['id_proveedor']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= urlencode($p['producto_id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="delete.php?id=<?= urlencode($p['producto_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>

</html>