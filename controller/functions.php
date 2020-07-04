<?php
require_once('load.php');

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