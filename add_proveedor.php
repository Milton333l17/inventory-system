<?php
require_once('controller/load.php');

//Registrar nuevo proveedor
if (isset($_POST['add_proveedor'])) {
    $req_fields = array('nombre','telefono','direccion');
    validate_fields($req_fields);

    if (empty($errors)) {
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];

        if (verify_proveedor($nombre, $telefono, $direccion)) {
            $session->msg("w", "Categoría ya existente");
            redirect('proveedores.php', false);
        }
     

        $sql = "INSERT INTO provedor(telefono,nombre,direccion) VALUES ('{$telefono}','{$nombre}','{$direccion}')";
        if ($pdo->query($sql)) {
            $session->msg("s", 'Proveedor registrado exitosamente!');
            redirect('proveedores.php', false);
        } else {
            $session->msg("d", 'Error al crear la proveedor.');
            redirect('proveedores.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('proveedores.php', false);
    }
}

// Actualizar categoria
@$id = $_GET['id'];
if (isset($_POST['update_provedor'])) {
    $nombre = $_POST['nombre_modal'];
    $direccion = $_POST['direccion_modal'];
    $telefono = $_POST['telefono_modal'];

    $sql = "UPDATE provedor SET nombre='{$nombre}',telefono='{$telefono}',direccion='{$direccion}' WHERE id='{$id}'";
    $result = $pdo->prepare($sql);
    if($result->execute()){
        $session->msg("s", 'provedor actualizado exitosamente!');
        redirect("proveedores.php", false);
    }else{
        $session->msg("d", 'Error al actualizar');
        redirect("proveedores.php", false);
    }
}
?>
<div class="modal-content">
    <form action="add_proveedor.php" method="POST">
        <div class="modal-header">
            <h5 class="modal-title">Agregar nuevo proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Nombre</label>
                <input id="cc-pament" name="nombre" type="text" class="form-control" aria-invalid="false" required>
            </div>
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Telefono</label>
                <input id="cc-pament" name="telefono" type="text" class="form-control" aria-invalid="false" required>
            </div>
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Direccion</label>
                <input id="cc-pament" name="direccion" type="text" class="form-control" aria-invalid="false" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add_proveedor">Crear</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
</div>