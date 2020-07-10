<?php
require_once('load.php');

$errors = array();

/*--------------------------------------------------------------*/
/* Función para verificar doc. existente
/*--------------------------------------------------------------*/
function verify_doc($doc){
    global $pdo;
    $sql = "SELECT n°documento FROM login_usuario WHERE n°documento=$doc";
    $result = $pdo->query($sql);
    if($result->fetchColumn() > 0){
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para verificar email existente
/*--------------------------------------------------------------*/
function verify_email($email){
    global $pdo;
    $sql = "SELECT email FROM login_usuario WHERE email='{$email}'";
    $result = $pdo->query($sql);
    if($result->fetchColumn() > 0){
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para mostrar mensaje en pantalla
/*--------------------------------------------------------------*/
function display_msg($type='info', $msg=''){
    echo '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>'.$msg.
         '</div>';
}
/*--------------------------------------------------------------*/
/* Función para verificar los campos que esten vacios
/*--------------------------------------------------------------*/
function validate_fields($var){
    global $errors;
    foreach($var as $field) {
        if ($_POST[$field] == '') {
            echo '<div class="alert alert-danger" role="alert">
                    <p class="mb-0"><strong>'.ucwords($field).'</strong> no puede estar en blanco.</p>
                </div>';
        }
    }
}
/*-------------------------------------------------------------*/
/* Función para selecionar todos los registros de una tabla
/*-------------------------------------------------------------*/
function select_all($table){
    global $pdo;
    $sql = $pdo->prepare('Select * from '.$table);
    $sql->execute();
    $resultado = $sql->fetchAll();
    return $resultado;
}
