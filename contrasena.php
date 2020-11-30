<?php
require_once('controller/load.php');
is_logged_in();
$user = current_user();

if (isset($_POST['actualizar'])) {
    $req_fields = array('contra1', 'contra2', 'contra3');
    validate_fields($req_fields);

    if (empty($errors)) {
        $id = $user['id'];
        $contra_antigua = $_POST["contra1"];
        $contra_nueva = $_POST["contra2"];
        $contra_verificacion = $_POST["contra3"];

        $document = $user['documento'];

        $user_password = verify_password($id, $contra_antigua);
        if ($contra_antigua == $user_password) {
            if ($contra_nueva == $contra_verificacion) {
                $contra_verificacion_bien = password_hash($_POST["contra2"], PASSWORD_DEFAULT);
                $sql = "UPDATE login_usuario SET password='{$contra_verificacion_bien}' WHERE id=$id";
                $result = $pdo->prepare($sql);
                if ($pdo->query($sql)) {
                    $session->msg("s", 'Contraseña actualizado exitosamente!');
                    redirect('logout.php', false);
                } else {
                    $session->msg("d", 'Error al actualizar la contraseña.');
                    redirect('contrasena.php', false);
                }
            }
            $session->msg("d", 'la contraseña nuevas no coinciden');
            redirect('contrasena.php', false);
        } else {
            $session->msg("d", 'la contraseña antigua no es correcta');
            redirect('contrasena.php', false);
        }
    } else {
        $session->msg("d", 'error al intentar cambiar la contraseña');
        redirect('contrasena.php', false);
    }
}

include_once("layouts/header.php");
?>
<link rel="stylesheet" href="css/estilo_imagen.css">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Actualizar Contraseña</div>
            <?php echo display_msg($msg); ?>
            <div class="card-body">
                <form action="contrasena.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Contraseña Antigua</label>
                                <input id="cc-pament" name="contra1" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Contraseña Nueva</label>
                                <input id="cc-pament" name="contra2" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Verificar Contraseña Nueva</label>
                                <input id="cc-pament" name="contra3" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="actualizar">
                        <i class="fa fa-send fa-lg"></i>&nbsp;Actualizar Contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include("layouts/footer.php");
?>