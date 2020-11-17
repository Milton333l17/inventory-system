<?php
require_once('controller/load.php');

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch($accion){
    case 'agregar':
        $agregar = $pdo->prepare("INSERT INTO calendario(title,descripcion,color,textColor,start,end)
        VALUE(:title,:descripcion,:color,:textColor,:start,:end)");
        $respuesta=$agregar->execute(array(
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end'],
        ));
        echo json_encode($respuesta);

        break;
    case 'eliminar':
        $respuesta=false;
        if(isset($_POST['id'])){
            $eliminar = $pdo->prepare("DELETE FROM calendario WHERE id = :id");
            $respuesta = $eliminar->execute(array("id"=>$_POST['id']));
        }
        echo json_encode($respuesta);
        break;
    case 'modificar':
        $modificar = $pdo->prepare("UPDATE calendario SET 
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start,
        end=:end
        WHERE id=:id");
        $respuesta=$modificar->execute(array(
            "id"=>$_POST['id'],
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end'],
        ));
        echo json_encode($respuesta);
        break;
    default:
    $calendario = $pdo->prepare("SELECT * FROM calendario");
    $calendario->execute();
    $result = $calendario->fetchAll(PDO::FETCH_ASSOC);
    
    echo $resultado = json_encode($result);
    break;
}
?>
