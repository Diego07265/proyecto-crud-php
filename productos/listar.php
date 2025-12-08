<?php
include("../db/conexion.php");
$sql = "select
            p.producto_id,
            p.nombre, 
            c.nombre AS categoria, 
            p.precio, 
            p.stock, 
            p.fecha_vencimiento, 
            p.requiere_receta,
            prov.nombre AS proveedor
FROM Producto p
inner join categoria c on p.categoria_id = c.categoria_id
inner join proveedor prov on p.id_proveedor = prov.id_proveedor";

$resultado = $conn->query($sql);
?>

<h2>Lista de Productos</h2>
<a href="crear.php">Agregar Producto</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Fecha de Vencimiento</th>
        <th>Receta</th>
        <th>Proveedor</th>
        <th>Acciones</th>
    </tr>

    <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['producto_id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['categoria']; ?></td>
            <td><?php echo $row['precio']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['fecha_vencimiento']; ?></td>
            <td><?php echo $row['requiere_receta'] ? 'Sí' : 'No'; ?></td>
            <td><?php echo $row['proveedor']; ?></td>
            <td>
                <a href="editar.php?id=<?=$row['producto_id']; ?>">Editar</a>
                <a href="eliminar.php?id=<?=$row['producto_id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php } ?>

</table>