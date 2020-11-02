<?php
require_once('controller/load.php');

$producto = find_all_producto();


include_once("layouts/header.php");
?>
<h3 class="title-5 m-b-35">Productos</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <a href="formproductos.php" class="btn btn-info"> Nuevo Producto</a>
    </div>
</div>

<div class="table-responsive">
    <?php echo display_msg($msg); ?>
    <table class="table">
        <thead class="thead-dark">
            <tr class="text-white">
                <th>#</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>unidad de medida</th>
                <th>Categoria</th>
                <th>Estado</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($producto as $productos) : ?>
                <tr class="tr-shadow">
                    <td><?php echo $i;
                        $i++; ?></td>
                    <td><?php echo $productos['pnombre'] ?></td>
                    <td><?php echo $productos['descripcion'] ?></td>
                    <td><?php echo $productos['medida'] ?></td>
                    <td><?php echo $productos['nombre'] ?></td>
                    <td><?php echo $productos['tipo_estado'] ?></td>
                    <td><?php echo $productos['pronombre'] ?></td>
                    <td>
                        <div class="fa-2x">
                            <a href="edit_producto.php?id=<?= $productos['id']; ?>" class="item" data-placement="top">
                                <i class="zmdi zmdi-edit text-warning"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
include_once("layouts/footer.php");
?>