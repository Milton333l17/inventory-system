<?php
require_once('controller/load.php');

$salidas = find_all('salida');


$modal = "venderproducto.php";

include_once("layouts/header.php");
?>
<h3 class="title-5 m-b-35">Salidas</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
    <button type="button" class="btn btn-success openBtn" data-toggle="modal" data-target="#Modal">
            <i class="fa fa-plus mr-1" aria-hidden="true"></i>Vender Producto
        </button>

    </div>
</div>

<div class="table-responsive">
    <?php echo display_msg($msg); ?>
    <table class="table">
        <thead class="thead-dark">
            <tr class="text-white">
                <th>#</th>
                <th>Nombre Cliente</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($salidas as $salida) : ?>
                <tr class="tr-shadow">
                    <td><?php echo $i;
                        $i++; ?></td>
                    <td><?php echo $salida['nombre_cliente'] ?></td>
                    <td><?php echo $salida['fecha y hora'] ?></td>
                    <td><?php echo $salida['cantidad'] ?></td>
                    <td><?php echo $salida['producto_id'] ?></td>
                    <td>
                        <div class="fa-2x">
                            <a href="edit_salidas.php?id=<?= $salida['id']; ?>" class="item" data-placement="top">
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