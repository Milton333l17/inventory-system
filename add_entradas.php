<?php
require_once('controller/load.php');
$producto = find_all('productos');
$estado = find_all('estado');
$user = current_user();



//Registrar nuevo proveedor
if (isset($_POST['add_entradas'])) {
    $req_fields = array('producto','cantidad','fecha','estado');
    validate_fields($req_fields);

    if (empty($errors)) {
        $producto = $_POST["producto"];
        $cantidad = $_POST["cantidad"];
        $fecha = $_POST["fecha"];
        $estado = $_POST["estado"];
        
        //validacion cantidad
        if($cantidad<=0){
            $session->msg("i", "La cantidad debe ser positiva");
            redirect('entradas.php?start=0', false);
            
           
        }
        //validacione fecha 
        $actual= date("Y-m-d");
  
    
        if ($actual >= $fecha) {
            $session->msg("i", "La fecha no debe ser antigua");
            redirect('entradas.php?start=0', false);
        }
        

        $sql = "INSERT INTO entradas(producto_id, cantidad,fecha,login_usuario_id,estado_id) VALUES ('{$producto}','{$cantidad}','{$fecha}','{$user['id']}','{$estado}')";
        if ($pdo->query($sql)) {
            $suma = sum_product($producto,$cantidad);
            $session->msg("s", 'Entrada exitosa!');
            redirect('entradas.php?start=0', false);
            
        } else {
            $session->msg("d", 'Error al crear la Entrada.');
            redirect('entradas.php?start=0', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('entradas.php?start=0', false);
    }
}

@$ide = $_GET['identradas'];
if (isset($_POST['actualizar'])) {
    $id = $_POST["id"];
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad_modal"];
    $fecha = $_POST["fecha_modal"];
    $estado = $_POST["estado"];

    $verificar = actua_entrada($id,$producto,$cantidad,$fecha,$estado);
/*UPDATE entradas SET producto_id=33, cantidad=34,fecha=2020-11-17,estado_id=1 WHERE identradas=33
    $sql = "UPDATE entradas SET producto_id=$producto, cantidad=$cantidad,fecha='{$fecha}',estado_id=$estado WHERE identradas=$id";
    $result = $pdo->prepare($sql);
    
    if($result->execute()){
        $session->msg("s", 'Entradas actualizada exitosamente!');
        redirect("entradas.php?start=0", false);
    }else{
        $session->msg("d", 'Error al actualizar');
        redirect("entradas.php?start=0", false);
    }*/
}


?>
<div class="modal-content">


<?php echo display_msg($msg); ?>
    <form action="add_entradas.php" method="POST" autocomplete="off">
        <div class="modal-header">
            <h5 class="modal-title">Agregar nueva entrada </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label" >Producto</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="producto" id="select" class="form-control" >
                                <option value="">Seleccione el producto</option>
                                <?php foreach ($producto as $productos) : ?>
                                   
                               
                                         <option value="<?php echo $productos['id'] ?>">


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
                            <input type="number" name="cantidad" " min="1" max="100" class="form-control"  require>
                        </div>
                        
                    </div>
            
            
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Fecha</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="date" name="fecha" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" class="form-control" require>
                        </div>
                        
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Estado</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="estado" id="select" class="form-control" >
                                <option value="">Tipo de estado </option>
                                <?php foreach ($estado as $estados ) : ?>
                                   
                               
                                         <option value="<?php echo $estados['idestado'] ?>">


                                         <?php echo $estados['tipo_estado']; ?>
                                         </option>
                                   
                                       
                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add_entradas">Crear</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
</div>