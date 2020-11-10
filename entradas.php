<?php


require_once('controller/load.php');

$modal = "add_entradas.php";

include_once("layouts/header.php");


@$id = $_GET['id'];
$proveedor = find_by_id("provedor", $id);

///////////////////////////////
//   tabla personalizada     //
//////////////////////////////
$result_to_pages = 7;
$countsql = $pdo->prepare("SELECT COUNT(identradas) FROM entradas ORDER BY identradas DESC");
$countsql ->execute();
$row = $countsql->fetch();
$numbtotal = $row[0];
$numblink = ceil($numbtotal/$result_to_pages);
$page =$_GET['start'];
$starts = $page*$result_to_pages;


/*
global $pdo;
$sql = $pdo->prepare('SELECT e.identradas, e.cantidad AS cantidad , e.fecha AS fecha, l.nombres, l.apellidos, es.tipo_estado, p.nombre  FROM entradas e LEFT JOIN login_usuario l ON e.login_usuario_id = l.id LEFT JOIN estado es ON e.estado_id= es.idestado LEFT JOIN productos p ON e.producto_id = p.id LIMIT '.$start .",".$result_to_pages);
$sql->execute();
$entrada = $sql->fetchAll();*/

$entrada =find_all_entradas($result_to_pages,$starts);
//$result_to_pages * $start;


?>

<h3 class="title-5 m-b-35">Entradas</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <button type="button" class="btn btn-success openBtn" data-toggle="modal" data-target="#Modal">
            <i class="fa fa-plus mr-1" aria-hidden="true"></i>Nuevas Entradas
        </button>
    </div>
</div>
<div class="table-responsive">
    <?php echo display_msg($msg); ?>
    <table class="table">
        <thead class="thead-dark">
            <tr class="text-white">
                <th>#</th>
                <th>Producto</th>
                <th>Empleado</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($entrada as $entradas) : ?>
                <tr class="tr-shadow">
                    <td><?= $entradas['identradas']?></td>
                    <td><?= $entradas['nombre'] ?></td>
                    <td><?= $entradas['nombres'].$entradas['apellidos'] ?></td>
                    <td><?= $entradas['tipo_estado'] ?></td>
                    <td><?= $entradas['fecha'] ?></td>
                    <td><?= $entradas['cantidad'] ?></td>
                  
                   
                </tr>
            <?php endforeach; ?>
        </tbody>
       <br>
     
       
         </table> 
         
         <div class="float-right mt-3">
<?php for($e=0;$e<=$numblink;$e++): ?>         
<a class="btn btn-success " href="entradas.php?start=<?=$e;?>"><?=$e;?></a>
<?php endfor ?>
</div>

</div>

<?php
include_once("layouts/footer.php");
?>
