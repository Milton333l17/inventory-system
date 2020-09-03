<?php
require_once('controller/load.php');

/*--------------------------------------------------------------*/
/* Función para verificar credenciales del usuario
/*--------------------------------------------------------------*/
function authenticate($document='', $password=''){
    global $pdo;
    $sql = "SELECT id, documento, password, rol_id FROM login_usuario WHERE documento=:document";
    $result = $pdo->prepare($sql);
    $result->bindParam('document', $document, PDO::PARAM_INT);

    $result->execute();
    if($result->rowCount() == 1){
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $user['password'])){
            return $user['id'];
        }
    }
    return false;
  }
/*--------------------------------------------------------------*/
/* Encontrar el actual usuario logeado por id de sessión 
/*--------------------------------------------------------------*/
function current_user(){
    static $current_user;
    global $pdo;
    if(!$current_user){
       if(isset($_SESSION['user_id'])):
           $user_id = intval($_SESSION['user_id']);
           $current_user = find_by_id('login_usuario', $user_id);
        endif;
    }
    return $current_user;
}
/*--------------------------------------------------------------*/
/*  Función para encontrar dato de la tabla por id
/*--------------------------------------------------------------*/
function find_by_id($table, $id){
    global $pdo;
    $id = (int)$id;
    $result = $pdo->prepare("SELECT * FROM ".$table." WHERE id=".$id." LIMIT 1");
    $result->execute();
    if($result->rowCount() == 1){
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }else{
        return null;
    }
}
/*-------------------------------------------------------------*/
/* Función para selecionar todos los registros de una tabla
/*-------------------------------------------------------------*/
function find_all($table){
    global $pdo;
    $sql = $pdo->prepare('Select * from '.$table);
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*-------------------------------------------------------------*/
/* Función para selecionar todos los registros de una tabla
/*-------------------------------------------------------------*/
function find_all_users(){
    global $pdo;
    $sql = $pdo->prepare('Select * from login_usuario WHERE id!=0');
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*--------------------------------------------------------------*/
/* Función para verificar doc. existente
/*--------------------------------------------------------------*/
function verify_doc($doc){
    global $pdo;
    $sql = "SELECT documento FROM login_usuario WHERE documento=$doc";
    $result = $pdo->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para verificar email existente
/*--------------------------------------------------------------*/
function verify_email($email){
    global $pdo;
    $sql = "SELECT email FROM login_usuario WHERE email=$email";
    $result = $pdo->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        return true;
    }
    return false;
}