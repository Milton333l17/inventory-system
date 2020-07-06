<?php
include("layouts/header.php");
require('controller/load.php');
$roles = select_all('rol');
$tipo_doc = select_all('tip_doc');

echo '<div class="card-body">
<div class="alert alert-primary" role="alert">
    This is a primary alert with
    <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>';
//Registrar nuevo usuario
if (isset($_POST['registrar'])) {
    $req_fields = array('nombres', 'apellidos', 'password');
    validate_fields($req_fields);
    print_r($errors);

    $nombre = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $contrasena = $_POST["password"];
    $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    $documentos = $_POST["documento"];
    $rol = $_POST["rol"];
    $tipodoc = $_POST["tipodoc"];

    $sql = "INSERT INTO login_usuario(n°documento, nombres, apellidos, contraseña, Tip_doc_idTip_doc, Rol_idRol) VALUES ({$documentos},'{$nombre}','{$apellidos}','{$contrasena}',{$tipodoc}, {$rol})";
    $gsent = $pdo->prepare($sql);
    $gsent->execute();
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Registro Nuevo Usuario</div>
            <div class="card-body">

                <form action="form.php" method="post" novalidate="novalidate">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nombres</label>
                        <input id="cc-pament" name="nombres" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Apellidos</label>
                        <input id="cc-pament" name="apellidos" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Tipo de documento</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="tipodoc" id="select" class="form-control">
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
                        <input id="cc-name" name="documento" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label for="cc-number" class="control-label mb-1">Contraseña</label>
                        <input id="cc-number" name="password" type="password" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Rol</label>
                        </div>
                        <div class="col-12 col-md-9">

                            <select name="rol" id="select" class="form-control">
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
            <div>

            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT FINISH-->

<?php
include("layouts/footer.php")
?>