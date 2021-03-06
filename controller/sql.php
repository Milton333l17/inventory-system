<?php
require_once('controller/load.php');

/*--------------------------------------------------------------*/
/* Función para verificar credenciales del usuario
/*--------------------------------------------------------------*/
function authenticate($document = '', $password = '')
{
    global $pdo;
    $sql = "SELECT id, documento, password, rol_id FROM login_usuario WHERE documento=:document";
    $result = $pdo->prepare($sql);
    $result->bindParam('document', $document, PDO::PARAM_INT);

    $result->execute();
    if ($result->rowCount() == 1) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Encontrar el actual usuario logeado por id de sessión 
/*--------------------------------------------------------------*/
function current_user()
{
    static $current_user;
    global $pdo;
    if (!$current_user) {
        if (isset($_SESSION['user_id'])) :
            $user_id = intval($_SESSION['user_id']);
            $current_user = find_by_id('login_usuario', $user_id);
        endif;
    }
    return $current_user;
}
/*--------------------------------------------------------------*/
/*  Función para encontrar dato de la tabla por id
/*--------------------------------------------------------------*/
function find_by_id($table, $id)
{
    global $pdo;
    $id = (int)$id;
    $result = $pdo->prepare("SELECT * FROM " . $table . " WHERE id=" . $id . " LIMIT 1");
    $result->execute();
    if ($result->rowCount() == 1) {
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return null;
    }
}
/*-------------------------------------------------------------*/
/* Función para selecionar todos los registros de una tabla
/*-------------------------------------------------------------*/
function find_all($table)
{
    global $pdo;
    $sql = $pdo->prepare('Select * from ' . $table);
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*-------------------------------------------------------------*/
/* Función para selecionar todos los registros de una tabla
/*-------------------------------------------------------------*/
function find_all_users()
{
    global $pdo;
    $sql = $pdo->prepare('Select * from login_usuario');
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*--------------------------------------------------------------*/
/* Función para verificar doc. existente
/*--------------------------------------------------------------*/
function verify_doc($doc)
{
    global $pdo;
    $sql = "SELECT documento FROM login_usuario WHERE documento=$doc";
    $result = $pdo->prepare($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para verificar email existente
/*--------------------------------------------------------------*/

function verify_email($email)
{
    global $pdo;
    $sql = "SELECT email FROM login_usuario WHERE email=?";
    $result = $pdo->prepare($sql);
    $result->execute(array($email));
    if ($result->rowCount() > 0) {
        return true;
    }
    return false;
}

/*--------------------------------------------------------------*/
/* Función para verificar categoría existente
/*--------------------------------------------------------------*/
function verify_category($category)
{
    global $pdo;
    $sql = "SELECT nombre FROM categorias WHERE nombre=?";
    $result = $pdo->prepare($sql);
    $result->execute(array($category));
    if ($result->rowCount() > 0) {
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para verificar proveedor existente
/*--------------------------------------------------------------*/

function verify_proveedor($nombre, $telefono, $direccion)
{
    global $pdo;
    $sql = "SELECT * FROM provedor WHERE telefono= :telefono OR nombre=:nombre OR  direccion=:direccion ";
    $result = $pdo->prepare($sql);
    $result->bindParam(':telefono', $telefono);
    $result->bindParam(':nombre', $nombre);
    $result->bindParam(':direccion', $direccion);
    $result->execute();
    if ($result->rowCount() > 0) {
        return true;
    }
    return false;
}
/*--------------------------------------------------------------*/
/* Función para cambiar estado
/*--------------------------------------------------------------*/
function change_state($table, $id, $state)
{
    global $pdo;
    $estado = 1;
    if ($state === "1") {
        $estado = 0;
    }

    $sql = "UPDATE " . $table . " SET estado='{$estado}' WHERE id='{$id}'";
    $result = $pdo->prepare($sql);
    $result->execute();
}
/*--------------------------------------------------------------*/
/* Función para verificar producto existente
/*--------------------------------------------------------------*/
function verify_productos($productos)
{
    global $pdo;
    $sql = "SELECT nombre FROM productos WHERE nombre=$productos";
    $result = $pdo->prepare($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return true;
    }
    return false;
}
/*-------------------------------------------------------------*/
/* Función para selecionar los datos ligados a las enttrada 
/*-------------------------------------------------------------*/
function find_all_entradas($result_to_pages, $starts)
{
    $numb1 = (int)$starts;
    $numb2 = (int)$result_to_pages;
    global $pdo;
    $sql = $pdo->prepare('SELECT e.id, e.cantidad AS cantidad , e.fecha AS fecha, l.nombres, l.apellidos, es.tipo_estado, p.nombre  FROM entradas e  LEFT JOIN login_usuario l ON e.login_usuario_id = l.id LEFT JOIN estado es ON e.estado_id= es.idestado LEFT JOIN productos p ON e.producto_id = p.id ORDER BY id DESC LIMIT ' . $numb1 . "," . $numb2);
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}

/*--------------------------------------------------------------*/
/* Funcion para seleccionar todos los productos
/*--------------------------------------------------------------*/
function find_all_producto()
{
    global $pdo;
    $sql = $pdo->prepare('SELECT p.id, p.nombre AS pnombre, c.nombre, p.descripcion,p.cantidad, m.medida, e.tipo_estado, pro.nombre AS pronombre FROM productos p LEFT JOIN categorias c ON p.categoria_id= c.id LEFT JOIN unidad_medida m ON p.unidad_medida_id= m.idunidad_medida LEFT JOIN estado e ON p.estado_id= e.idestado LEFT JOIN provedor pro ON p.provedor_id=pro.id');
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*--------------------------------------------------------------*/
/* Funcion para sumar cantidade se productos
/*--------------------------------------------------------------*/
function sum_product($id, $cantidad)
{
    global $pdo;

    $id_producto =  (int)$id;
    $tabla = find_by_id('productos', $id_producto);
    $cant_pro = $tabla['cantidad'];

    $total = $cantidad + $cant_pro;
    $sql = "UPDATE productos SET cantidad=? WHERE id=" . $id . " LIMIT 1";
    $result = $pdo->prepare($sql);
    $result->execute([$total]);
}
/*-------------------------------------------------------------*/
/* Función para selecionar los datos ligados a las salidas
/*-------------------------------------------------------------*/
function find_all_salidas()
{
    global $pdo;
    $sql = $pdo->prepare('SELECT e.id, e.cantidad AS cantidad , e.fecha AS fecha, l.nombres, l.apellidos, es.tipo_estado, p.nombre  FROM entradas e LEFT JOIN login_usuario l ON e.login_usuario_id = l.id LEFT JOIN estado es ON e.estado_id= es.idestado LEFT JOIN productos p ON e.producto_id = p.id');
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*--------------------------------------------------------------*/
/* Consultar calendario
/*--------------------------------------------------------------*/
function consul_calendary()
{
    global $pdo;
    $calendario = $pdo->prepare("SELECT * FROM calendario");
    $calendario->execute();
    $result = $calendario->fetchAll(PDO::FETCH_ASSOC);
    $resultado = json_encode($result);
    return $resultado;
}
/*--------------------------------------------------------------*/
/* Función para verificar usuario logeado
/*--------------------------------------------------------------*/
function is_logged_in()
{
    global $session;
    $current_user = current_user();
    //Si el usuario esta logeado
    if (!$session->isUserLoggedIn(true)) {

        redirect('pagerror.php', false);
    }
}
/*--------------------------------------------------------------*/
/* Función para actualizar entradas
/*--------------------------------------------------------------*/
function actua_entrada($id, $pro_nuevo, $cantidad, $fecha, $estado)
{
    global $pdo;

    $entrada = find_by_id('entradas', $id);
    $pro_viejo = $entrada['producto_id'];
    $producto = find_by_id('productos', $pro_nuevo);
    $producto_v = find_by_id('productos', $pro_viejo);

    $pro_viejo = $entrada['producto_id'];
    $cant_vieja = $producto_v['cantidad'];
    $cant_entradas = $entrada['cantidad'];
    $cant_producto  = $producto['cantidad'];
    $cant_restar = ($cant_vieja - $cant_entradas);
    $cant_sumar = ($cant_producto + $cantidad);

    if ($pro_viejo !== $pro_nuevo) {

        // Actualizar cantidad del producto antiguo
        $producto = "UPDATE productos SET cantidad=$cant_restar WHERE id=$pro_viejo";
        $result1 = $pdo->prepare($producto);
        $result1->execute();

        // Actualizar cantidad del producto nuevo 
        $producto = "UPDATE productos SET cantidad=$cant_sumar WHERE id=$pro_nuevo";
        $result1 = $pdo->prepare($producto);
        $result1->execute();

        // Actualizacion de las entradas 
        $entrada = "UPDATE entradas SET producto_id=$pro_nuevo, cantidad=$cantidad,fecha='{$fecha}',estado_id=$estado WHERE id=$id";
        $result2 = $pdo->prepare($entrada);
        if ($result2->execute()) {
            redirect("entradas.php?start=0", false);
        } else {
            redirect("categorias.php", false);
        }
    } elseif ($pro_viejo === $pro_nuevo) {

        // Actualizacion del producto nueva cantidad
        $producto = "UPDATE productos SET cantidad=$cantidad WHERE id=$pro_viejo";
        $result1 = $pdo->prepare($producto);
        $result1->execute();

        // Actualizacion de las entradas
        $entrada = "UPDATE entradas SET producto_id=$pro_nuevo, cantidad=$cantidad,fecha='{$fecha}',estado_id=$estado WHERE id=$id";
        $result2 = $pdo->prepare($entrada);
        if ($result2->execute()) {
            redirect("entradas.php?start=0", false);
        } else {
            redirect("categorias.php", false);
        }
    }
}
/*-------------------------------------------------------------*/
/* Función para selecionar todos los registros de una tabla
/*-------------------------------------------------------------*/
function cant_product()
{
    global $pdo;
    $sql = $pdo->prepare('Select * from login_usuario');
    $sql->execute();
    $result = $sql->fetchAll();
    return $result;
}
/*-------------------------------------------------------------*/
/* Función para verificar contraseñas de la base datos 
/*-------------------------------------------------------------*/
function verify_password($id, $password)
{
    global $pdo;
    $sql = "SELECT password FROM login_usuario WHERE id=:id";
    $result = $pdo->prepare($sql);
    $result->bindParam('id', $id, PDO::PARAM_INT);

    $result->execute();
    if ($result->rowCount() == 1) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            return $password = password_verify($password, $user['password']);
        }
    }
}

/*--------------------------------------------------------------*/
/* Funcion para restar cantidades
/*--------------------------------------------------------------*/
function restar_producto($id, $cantidad)
{
    global $pdo;

    $id_producto =  (int)$id;
    $tabla = find_by_id('productos', $id_producto);
    $cant_pro = $tabla['cantidad'];

    $total = $cant_pro - $cantidad;
    $sql = "UPDATE productos SET cantidad=? WHERE id=" . $id . " LIMIT 1";
    $result = $pdo->prepare($sql);
    $result->execute([$total]);
}
