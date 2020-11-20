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
$countsql = $pdo->prepare("SELECT COUNT(id) FROM entradas ORDER BY id DESC");
$countsql->execute();
$row = $countsql->fetch();
$numbtotal = $row[0];
$numblink = ceil($numbtotal / $result_to_pages);
$page = $_GET['start'];
$starts = $page * $result_to_pages;




$entrada = find_all_entradas($result_to_pages, $starts);


$modificar = "ent_modificar.php";
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
                <th>Cant.</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($entrada as $entradas) : ?>
                <tr class="tr-shadow">
                    <td><?= $entradas['id'] ?></td>
                    <td><?= $entradas['nombre'] ?></td>
                    <td><?= $entradas['nombres'] . $entradas['apellidos'] ?></td>
                    <td><?= $entradas['tipo_estado'] ?></td>
                    <td><?= $entradas['fecha'] ?></td>
                    <td><?= $entradas['cantidad'] ?></td>
                    <td><button type="button" class="btn btn-warning font-italic openBtn" data-toggle="modal" data-target="#Modificar<?=$entradas['id']; ?>">Modificar</button></td>


                </tr>
            <?php endforeach; ?>
        </tbody>
        <br>


    </table>

    <div class="float-right mt-3">
        <?php for ($e = 0; $e <= $numblink; $e++) : ?>
            <a class="btn btn-success " href="entradas.php?start=<?= $e; ?>"><?= $e; ?></a>
        <?php endfor ?>
    </div>

</div>

<?php
include_once("layouts/footer.php");
?>
<?php foreach ($entrada as $entradas) : ?>
<div class="modal fade" id="Modificar<?=$entradas['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar Entrada N°  <?=$entradas['id']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="add_entradas.php?id=<?= $entradas['id']; ?>" method="POST" autocomplete="off">
        <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label" >Producto</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="producto" id="select" class="form-control" >
                                <option value="">seleccionar un elemento</option>
                                <?php 
                                $entrada = $entradas['nombre'];
                                foreach ($producto as $productos) : ?>
                                   
                                
                                         <option  <?php if($entrada === $productos['nombre']): ?>
                                            <?="selected"?>
                                         <?php endif; ?>
                                          value="<?php echo $productos['id'] ?>">


                                         <?php echo $productos['nombre']; ?>
                                         </option>
                                 
                                       
                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Cantidad</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="number" name="cantidad_modal" " min="1" max="100" class="form-control" value="<?= $entradas['cantidad'] ?>" require>
                        </div>
                        
                    </div>
                    <div class="col-12 col-md-8">
                            <input onliread  type="hidden" name="id" value="<?= $entradas['id'] ?>"require describe>
                        </div>
            
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Fecha</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="date" name="fecha_modal" value="<?= $entradas['fecha'] ?>" min="<?=date('Y-m-d')?>" class="form-control" require>
                        </div>
                        
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Estado</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="estado" id="select" class="form-control" >
                                <option value="">Tipo de estado </option>
                                <?php 
                                $animo = $entradas['tipo_estado'];
                                foreach ($estado as $estados ) : ?>
                                   
                               

                                    
                                         <option  <?php if($animo === $estados['tipo_estado']): ?>
                                            <?="selected"?>
                                         <?php endif; ?> value="<?php echo $estados['idestado'] ?>">


                                         <?php echo $estados['tipo_estado']; ?>
                                         </option>
                                   
                                       
                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>

  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
            </div></form>
        </div>  
    </div>
</div>
<?php endforeach ?>