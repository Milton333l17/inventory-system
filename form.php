<?php
require('controller/load.php');
include_once("layouts/header.php");
$roles = select_all('rol');
$tipo_doc = select_all('tip_doc');

//Registrar nuevo usuario
if (isset($_POST['registrar'])) {
    $req_fields = array('nombres', 'apellidos', 'documento', 'password');
    validate_fields($req_fields);
    if(empty($_POST['rol'])){
        display_msg('danger', 'Seleccione el rol.');
    }
    if(empty($_POST['tipodoc'])){
        display_msg('danger', 'Selecione el tipo de docuemnto.');
    }
    
    if(empty($errors)){
        $nombre = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $contrasena = $_POST["password"];
        $contrasena = sha1($contrasena);
        $documento = $_POST["documento"];
        $email = $_POST['email'];
        $rol = $_POST["rol"];
        $tipodoc = $_POST["tipodoc"];

        if(verify_doc($documento)){
            display_msg('warning', 'Documento ya existente.');
        }else if(verify_email($email)){
            display_msg('warning', 'Email ya existente.');
        }else{
            $sql = "INSERT INTO login_usuario(documento, nombres, apellidos, email, contraseña, Tip_doc_idTip_doc, Rol_idRol) VALUES ({$documento},'{$nombre}','{$apellidos}', '{$email}', '{$contrasena}',{$tipodoc}, {$rol})";
            if($pdo->query($sql)){
                display_msg('success', 'Usuario registrado exitosamente!');
            }else{
                display_msg('danger', 'Error al crear el usuario.');
            }
        }
    }
}

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Registro Nuevo Usuario</div>
            <div class="card-body">

                <form action="form.php" method="post">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nombres</label>
                        <input id="cc-pament" name="nombres" type="text" class="form-control" aria-required="true" aria-invalid="false" required="true">
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Apellidos</label>
                        <input id="cc-pament" name="apellidos" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Tipo de documento</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="tipodoc" id="select" class="form-control" required>
                                <option value="">Selecione el tipo de documento</option>
                                <?php foreach ($tipo_doc as $doc) : ?>
                                    <option value="<?php echo $doc['idTip_doc'] ?>">
                                        <?php echo $doc['descripcion']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group has-success">
                        <label for="cc-name" class="control-label mb-1">Documento</label>
                        <input id="cc-name" name="documento" type="text" class="form-control cc-documento" required>
                        <span class="help-block field-validation-valid" data-valmsg-for="cc-documento" data-valmsg-replace="true" required></span>
                    </div>
                    <div class="form-group">
                        <label for="cc-email" class="control-label mb-1">Email</label>
                        <input id="cc-email" name="email" type="text" class="form-control cc-email valid" required>
                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true" required></span>
                    </div>
                    <div class="form-group">
                        <label for="cc-number" class="control-label mb-1">Contraseña</label>
                        <input id="cc-number" name="password" type="password" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true" required></span>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Rol</label>
                        </div>
                        <div class="col-12 col-md-9">

                            <select name="rol" id="select" class="form-control" required>
                                <option value="">Selecione el rol</option>
                                <?php foreach ($roles as $rol) : ?>
                                    <option value="<?php echo $rol['idRol'] ?>">
                                        <?php echo $rol['rol']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="registrar">
                        <i class="fa fa-lock fa-lg"></i>&nbsp;Registrar
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT FINISH-->

<?php
include("layouts/footer.php")
?>