<?php

    require_once('controller/load.php');

    $documento = $_POST['documento'];
    $password = $_POST['password'];
    $password = sha1($password);

    $req_fields = array('documento', 'password');
    validate_fields($req_fields);

    $sql = "SELECT id, documento, contraseña, nombres FROM login_usuario WHERE documento = :doc";
    $stm = $pdo->prepare($sql);
    
    $stm->bindValue(':doc', $documento);
    $stm->execute();
    $user = $stm->fetchAll();

    if($password === $user[0]['contraseña']){
        $_SESSION['user_id'] = $user[0]['id'];

        $session->login($_SESSION['user_id']);
        header("location: usuarios.php");
    }else{
        header("location: login.php");
    }

?>