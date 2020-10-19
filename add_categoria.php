<?php
require_once('controller/load.php');

//Registrar nueva categoria
if (isset($_POST['add_categoria'])) {
    $req_fields = array('nombre');
    validate_fields($req_fields);

    if (empty($errors)) {
        $nombre = $_POST["nombre"];

        if (verify_category($nombre)) {
            $session->msg("w", "Categoría ya existente");
            redirect('categorias.php', false);
        }

        $sql = "INSERT INTO categorias(nombre) VALUES ('{$nombre}')";
        if ($pdo->query($sql)) {
            $session->msg("s", 'Categoría registrada exitosamente!');
            redirect('categorias.php', false);
        } else {
            $session->msg("d", 'Error al crear la categoría.');
            redirect('categorias.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('categorias.php', false);
    }
}

// Actualizar categoria
@$id = $_GET['id'];
if (isset($_POST['update_categoria'])) {
    $nombre = $_POST['nombre_modal'];

    $sql = "UPDATE categorias SET nombre='{$nombre}' WHERE id='{$id}'";
    $result = $pdo->prepare($sql);
    if($result->execute()){
        $session->msg("s", 'Categoría actualizada exitosamente!');
        redirect("categorias.php", false);
    }else{
        $session->msg("d", 'Error al actualizar');
        redirect("categorias.php", false);
    }
}
?>
<div class="modal-content">
    <form action="add_categoria.php" method="POST">
        <div class="modal-header">
            <h5 class="modal-title">Agregar nueva categoría</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Nombre</label>
                <input id="cc-pament" name="nombre" type="text" class="form-control" aria-invalid="false" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add_categoria">Crear</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
</div>