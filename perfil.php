<?php
require_once('controller/load.php');
is_logged_in();
$user = current_user();

//Actualizar foto del usuario
if (isset($_POST['submit'])) {
    $photo = new Media();
    $user_id = (int)$user['id'];
    $photo->upload($_FILES['foto']);
    if ($photo->process_user($user_id)) {
        $session->msg("s", "Se ha cambiado la imagen correctamente!");
        redirect('perfil.php');
    } else {
        $session->msg("d", join($photo->errors));
        redirect('perfil.php');
    }
}

//Actualizar información personal
if (isset($_POST['actualizar'])) {
    $req_fields = array('nombres', 'apellidos');
    validate_fields($req_fields);

    if (empty($errors)) {
        $id = $user['id'];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];

        $sql = "UPDATE login_usuario SET nombres='{$nombres}', apellidos='{$apellidos}' WHERE id=$id";
        $result = $pdo->prepare($sql);
        if ($pdo->query($sql)) {
            $session->msg("s", 'Perfil actualizado exitosamente!');
            redirect('perfil.php', false);
        } else {
            $session->msg("d", 'Error al actualizar el perfil.');
            redirect('perfil.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('perfil.php', false);
    }
}
include_once("layouts/header.php");
?>
<link rel="stylesheet" href="css/estilo_imagen.css">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Actualizar Perfil</div>
            <?php echo display_msg($msg); ?>
            <div class="card-body">
                <form action="perfil.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Nombres</label>
                                <input id="cc-pament" name="nombres" type="text" class="form-control" aria-invalid="false" value="<?= $user['nombres'] ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Apellidos</label>
                                <input id="cc-pament" name="apellidos" type="text" class="form-control" aria-invalid="false" value="<?= $user['apellidos'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Documento</label>
                                <input id="cc-pament" name="documento" type="text" class="form-control" aria-invalid="false" disabled value="<?= $user['documento'] ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                <input id="cc-pament" name="email" type="text" class="form-control" disabled aria-invalid="false" value="<?= $user['email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto">
                                <label class="custom-file-label" for="foto">Escoga una imagen</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" name="submit">Subir</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center ">
                        <img src="uploads/users/<?= $user['imagen_url'] ?>" class="rounded" alt="">
                    </div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="actualizar">
                        <i class="fa fa-send fa-lg"></i>&nbsp;Actualizar Perfil
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include("layouts/footer.php");
?>