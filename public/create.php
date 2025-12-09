<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <title>Agregar Producto - Pharma Track</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar Nuevo Producto</h1>
        <form action="store.php" method="post">
            <!-- Aquí van los campos del formulario -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoria ID</label>
                <input type="number" class="form-control" id="categoria_id" name="categoria_id" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>   
            </div>
            <div class="mb-3">
                <label for="requiere_receta" class="form-label">Requiere Receta</label>
                <select class="form-select" id="requiere_receta" name="requiere_receta" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_proveedor" class="form-label">ID Proveedor</label>
                <input type="number" class="form-control" id="id_proveedor" name="id_proveedor" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>