<?php


require_once('controller/load.php');


include_once("layouts/header.php");


@$id = $_GET['id'];
$proveedor = find_by_id("provedor", $id);



?>

<h3 class="title-5 m-b-35">Salidas</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <button type="button" class="btn btn-success openBtn" href="formulariosalida.php">
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
                <th>Producto</th>
                <th>Categoria</th>
                <th>Nombre del Cliente</th>
                <th>Fecha</th>
                <th>Empleado</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($salida as $salidas) : ?>
                <tr class="tr-shadow">
                    <td><?php echo $i;
                        $i++; ?></td>
                    <td><?= $salidas['nombre'] ?></td>
                    <td><?= $salidas['categoria']?></td>
                    <td><?= $salidas['nombreclien']?></td>
                    <td><?= $entradas['fecha'] ?></td>
                    <td><?= $salidas['nombres'].$salidas['apellidos'] ?></td>
                      <td><?= $entradas['cantidad'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php
include_once("layouts/footer.php");
?>