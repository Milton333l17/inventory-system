<?php

require_once('controller/load.php');

$salidas = find_all('salida');
$productos = find_all('productos');

if (isset($_POST['add_salidas'])) {
    $req_fields = array('nombreclien','cantidadnum');
    validate_fields($req_fields);

    if (empty($errors)) {
        $producto = (int)$_POST["produc"];
        $cantidad = (int)$_POST["cantidadnum"];
        $nombre = $_POST["nombreclien"];
        
        //validacion cantidad
        if($cantidad<=0){
            $session->msg("i", "La cantidad debe ser positiva");
            redirect('salidas.php', false);
            
           
        }
        $producto_id = find_by_id('productos', $producto);
        if($producto_id['cantidad']<$cantidad){
            $session->msg("w", "La cantidad supera la existencia del producto");
            redirect('salidas.php', false);
        }
        

        $sql = "INSERT INTO salida(producto_id,cantidad,nombre_cliente) VALUES ({$producto},{$cantidad},'{$nombre}')";
        if ($pdo->query($sql)) {
            // $suma = sum_product($producto,$cantidad);
            $restar = restar_producto($producto,$cantidad);
            $session->msg("s", 'Salida Exitosa!');
            redirect('salidas.php', false);
            
        } else {
            $session->msg("d", 'Error al crear la Salidas.');
            redirect('salidas.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('salidas.php', false);
    }
}
include_once("layouts/header.php");
?>
<div class="modal-content">
    <form action="venderproducto.php" method="POST">
        <div class="modal-header">
            <h5 class="modal-title">Vender Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Nombre y Apellido Cliente</label>
                <input id="cc-pament" name="nombreclien" type="text" class="form-control" aria-invalid="false" required>
            </div>
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Cantidad</label>
                <input id="cc-pament" name="cantidadnum" type="number" class="form-control" aria-invalid="false" required min="1">
            </div>
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Producto</label>
                <select name="produc" id="select" class="form-control" >
                                <option value="">Seleccione un producto</option>
                                <?php foreach ($productos as $producto) : ?>
                                   
                               
                                         <option value="<?php echo $producto['id'] ?>">


                                         <?php echo $producto['nombre']; ?>
                                         </option>
                                   
                                       
                                    
                                <?php endforeach; ?>
                            </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add_salidas">Crear</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
</div>

<?php
include_once("layouts/footer.php");
?>