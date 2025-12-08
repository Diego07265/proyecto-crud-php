<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pharmatrack</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center py-4">
                <h1 class="mb-0">Bienvenido a PharmaTrack</h1>
                <p class="mb-0 mt-2">Sistema de gestión de farmacia</p>
            </div>
            <div class="card-body p-4">
                <div class="list-group">
                    <a href="bd/crearProducto.php" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">📝 Crear registro (POST)</h5>
                        <p class="mb-0 small text-muted">Añadir nuevos registros a la base de datos</p>
                    </a>
                    <a href="bd/leer.php" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">📋 Listar registros (GET)</h5>
                        <p class="mb-0 small text-muted">Ver todos los registros existentes</p>
                    </a>
                    <a href="proveedores/" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">🏭 Módulo Proveedores</h5>
                        <p class="mb-0 small text-muted">Gestionar proveedores</p>
                    </a>
                    <a href="ventas/" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">💰 Módulo Ventas</h5>
                        <p class="mb-0 small text-muted">Registrar y consultar ventas</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>