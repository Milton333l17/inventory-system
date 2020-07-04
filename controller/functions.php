<?php
require_once('load.php');

$errors = array();

/*--------------------------------------------------------------*/
/* Función para verificar los campos que esten vacios
/*--------------------------------------------------------------*/
function validate_fields($var){
    global $errors;
    foreach ($var as $field) {
        if ($_POST[$field] == '') {
            $errors = $field . " no puede estar en blanco.";
            return $errors;
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
?>