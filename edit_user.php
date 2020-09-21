<?php
require_once('controller/load.php');

@$id = (int)$_GET['id'];

//Actualizar usuario
if (isset($_POST['actualizar'])) {
    $rol = $_POST["tip_rol"];
    if(!isset($rol)){
        $session->msg("d", "Rol no puede estar en blanco.");
        redirect('usuarios.php', false);
    }

    if(empty($errors)){
        $sql = "UPDATE login_usuario SET rol_id = ? WHERE id = ?";
        $result = $pdo->prepare($sql);
        $result->bindparam(1, $rol, PDO::PARAM_STR);
        $result->bindparam(2, $id, PDO::PARAM_INT);
        if($result->execute()){
            $session->msg("s", 'Usuario actualizado exitosamente!');
            redirect('usuarios.php', false);
        }else{
            $session->msg("d", 'Error al crear el usuario.');
            redirect('usuarios.php', false);
        }
    }else{
        $session->msg("d", $errors);
        redirect('form.php', false);
    }
}