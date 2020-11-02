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
    $sql = $pdo->prepare('Select * from login_usuario');
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
/*--------------------------------------------------------------*/
/* Función para verificar categoría existente
/*--------------------------------------------------------------*/
function verify_category($category){
    global $pdo;
    $sql = "SELECT nombre FROM categorias WHERE nombre=$category";
    $result = $pdo->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para verificar proveedor existente
/*--------------------------------------------------------------*/
function verify_proveedor($nombre, $telefono, $direccion ){
    global $pdo;
    $sql = "SELECT * FROM provedor WHERE nombre=$nombre ,telefono=$telefono, direccion=$direccion  ";
    $result = $pdo->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para cambiar estado
/*--------------------------------------------------------------*/
function change_state($table, $id, $state){
    global $pdo;
    $estado = 1;
    if ($state === "1") {
        $estado = 0;
    }

    $sql = "UPDATE ".$table." SET estado='{$estado}' WHERE id='{$id}'";
    $result = $pdo->prepare($sql);
    $result->execute();
}
/*--------------------------------------------------------------*/
/* Función para verificar producto existente
/*--------------------------------------------------------------*/
function verify_productos($productos){
    global $pdo;
    $sql = "SELECT nombre FROM productos WHERE nombre=$productos";
    $result = $pdo->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        return true;
    }
    return false;
}
/*-------------------------------------------------------------*/
/* Función para selecionar los datos ligados a las enttrada 
/*-------------------------------------------------------------*/
function table_entry(){
    global $pdo;
    $sql = "SELECT * FROM entradas LEFT JOIN productos ON e.productos_id = p.id ";
    $result = $pdo->prepare($sql);
    $result->execute();
    $row = $result->fetchAll();
    return $row;
    
}
