<?php
require_once('controller/load.php');
$modal = "add_categoria.php";
$categorias = find_all('categorias');

@$id = $_GET['id'];
$categoria = find_by_id("categorias", $id);
if (isset($id)) {
    change_state("categorias", $id, $categoria['estado']);
    redirect("categorias.php", false);
}

include_once("layouts/header.php");
?>
<h3 class="title-5 m-b-35">Categorías</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <button type="button" class="btn btn-success openBtn" data-toggle="modal" data-target="#Modal">
            <i class="fa fa-plus mr-1" aria-hidden="true"></i>Nueva Categoría
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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($categorias as $categoria) : ?>
                <tr class="tr-shadow">
                    <td><?php echo $i;
                        $i++; ?></td>
                    <td><?php echo $categoria['nombre'] ?></td>
                    <td>
                        <div class="fa-2x">
                            <a href="categorias.php?id=<?= $categoria['id']; ?>" class="item mr-1" data-toggle="tooltip" data-placement="top" <?php if ($categoria['estado'] === '1') : ?> title="Activo">
                                <i class="zmdi zmdi-mood text-success"></i>
                            <?php else : ?>
                                title="Inactivo">
                                <i class="zmdi zmdi-mood-bad text-danger"></i>
                            <?php endif; ?>
                            </a>
                            <button type="button" class="item" data-placement="top" data-toggle="modal" data-target="#Edit<?= $categoria['id']; ?>">
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
<?php foreach ($categorias as $categoria) : ?>
    <div class="modal" tabindex="-1" id="Edit<?= $categoria['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_categoria.php?id=<?= $categoria['id']; ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Nombre</label>
                            <input id="cc-pament" name="nombre_modal" type="text" class="form-control" aria-invalid="false" value="<?php echo $categoria['nombre']?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="update_categoria">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>