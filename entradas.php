<?php


require_once('controller/load.php');

$modal = "add_entradas.php";
$entrada =find_all_entradas();
include_once("layouts/header.php");


@$id = $_GET['id'];
$proveedor = find_by_id("provedor", $id);



?>

<h3 class="title-5 m-b-35">Entradas</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <button type="button" class="btn btn-success openBtn" data-toggle="modal" data-target="#Modal">
            <i class="fa fa-plus mr-1" aria-hidden="true"></i>Nuevas Entradas
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
                <th>Empleado</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($entrada as $entradas) : ?>
                <tr class="tr-shadow">
                    <td><?php echo $i;
                        $i++; ?></td>
                    <td><?= $entradas['nombre'] ?></td>
                    <td><?= $entradas['nombres'].$entradas['apellidos'] ?></td>
                    <td><?= $entradas['tipo_estado'] ?></td>
                    <td><?= $entradas['fecha'] ?></td>
                    <td><?= $entradas['cantidad'] ?></td>
                  
                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php
include_once("layouts/footer.php");
?>
