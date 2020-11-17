<?php
require_once('load.php');

$errors = array();
/*--------------------------------------------------------------*/
/* Función para redirigir
/*--------------------------------------------------------------*/
function redirect($url, $permanent=false){
    if (headers_sent() === false){
        header('Location: '.$url, true, ($permanent===true) ? 301 : 302);
    }
    exit();
}
/*--------------------------------------------------------------*/
/* Función para remover caracteres especiales
/*--------------------------------------------------------------*/
function remove_specials($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Función para mostrar mensaje en pantalla
/*--------------------------------------------------------------*/
function display_msg($msg){
    if(isset($msg)){
        foreach($msg as $key => $value){
            $result  = "<div class='alert alert-".$key." alert-dismissible fade show rounded-0' role='alert'>";
            $result .= remove_specials($value);
            $result .=	"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            $result .=	"<span aria-hidden='true'>&times;</span></button></div>";
            return $result;
        }
    }else{
        return "";
    }
}
/*--------------------------------------------------------------*/
/* Función para verificar los campos que esten vacios
/*--------------------------------------------------------------*/
function validate_fields($var){
    global $errors;
    foreach ($var as $field) {
        $val = remove_specials($_POST[$field]);
        if(isset($val) && $val==''){
            $errors = ucwords($field)." no puede estar en blanco.";
            return $errors;
        }
    }
}
/*--------------------------------------------------------------*/
/* Función para crear string random
/*--------------------------------------------------------------*/
function randString($lenght = 5){
    $str = '';
    $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

    for($x=0;$x<$lenght; $x++){
        $str .= $cha[mt_rand(0, strlen($cha))];
        return $str;
    }
}