<?php
require_once('controller/load.php');
$modal = "add_proveedor.php";
$provedor = find_all('provedor');

@$id = $_GET['id'];
$proveedor = find_by_id("provedor", $id);
if (isset($id)) {
    change_state("provedor", $id, $proveedor['estado']);
    redirect("proveedores.php", false);
}

include_once("layouts/header.php");
?>
<h3 class="title-5 m-b-35">Proveedores</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <button type="button" class="btn btn-success openBtn" data-toggle="modal" data-target="#Modal">
            <i class="fa fa-plus mr-1" aria-hidden="true"></i>Crear Proveedor
        </button>
    </div>
</div>
<div class="table-responsive">
    <?php echo display_msg($msg); ?>
    <table class="table">
        <thead class="thead-dark">
            <tr class="text-white">
                <th>#</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($provedor as $socios) : ?>
                <tr class="tr-shadow">
                    <td><?php echo $i;
                        $i++; ?></td>
                    <td><?php echo $socios['nombre'] ?></td>
                    <td><?php echo $socios['telefono'] ?></td>
                    <td><?php echo $socios['direccion'] ?></td>
                    <td>
                        <div class="fa-2x">
                            <a href="proveedores.php?id=<?= $socios['id']; ?>" class="item mr-1" data-toggle="tooltip" data-placement="top" <?php if ($socios['estado'] === '1') : ?> title="Activo">
                                <i class="zmdi zmdi-mood text-success"></i>
                            <?php else : ?>
                                title="Inactivo">
                                <i class="zmdi zmdi-mood-bad text-danger"></i>
                            <?php endif; ?>
                            </a>
                            <button type="button" class="item" data-placement="top" data-toggle="modal" data-target="#Edit<?= $socios['id']; ?>">
                                <i class="zmdi zmdi-edit text-warning"></i>
                            </button>
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
<?php foreach ($provedor as $socios) : ?>
    <div class="modal" tabindex="-1" id="Edit<?= $socios['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_proveedor.php?id=<?= $socios['id']; ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Nombre</label>
                            <input id="cc-pament" name="nombre_modal" type="text" class="form-control" aria-invalid="false" value="<?php echo $socios['nombre'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">telefono</label>
                            <input id="cc-pament" name="telefono_modal" type="text" class="form-control" aria-invalid="false" value="<?php echo $socios['telefono'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Direccion</label>
                            <input id="cc-pament" name="direccion_modal" type="text" class="form-control" aria-invalid="false" value="<?php echo $socios['direccion'] ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="update_provedor">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>