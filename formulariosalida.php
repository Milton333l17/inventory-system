<?php
require_once('controller/load.php');

$cantidadpro = find_all('unidad_medida');
$categoria = find_all('categorias');
$nombreclien =find_all('nombreclien');
$fecha = $_POST["fecha"];

if (isset($_POST['registrar'])) {
    $req_fields = array('nombrepro', 'categorias','nombreclien');
    validate_fields($req_fields);

    if (empty($errors)) {
        $nombreproducto = $_POST["nombrepro"];
         $categoria =(int)$_POST['categoria'];
         $nombreclien = $_POST['nombreclien'];
        $cantidadnum = (int)$_POST["cantidadpro"];
        $nombreclien = (int)$_POST["nombreclien"];
       


        if (!isset($categoria)) {
            $session->msg("d", "La categoria no puede estar en blanco.");
            redirect('formulariosalida.php', false);
        }

        $sql = "INSERT INTO productos (producto_id, categoria_id,nombre_cliente, fecha,empleado,cantidad_producto) VALUES ('{$nombreproducto}','{$categoria}',{$nombreclien},{$fecha},{$nombreempleado},{$cantidadnum})";
        if ($pdo->query($sql)) {
            $session->msg("s", 'Producto Vendido Exitosamente!');
            redirect('salidas.php', false);
        } else {
            $session->msg("d", 'Error al vender el producto.' . $sql);
            redirect('salidas.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('formulariosalida.php', false);
    }
}
include_once("layouts/header.php");


?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Vender Nuevo Producto</div>
            <?php echo display_msg($msg); ?>
            <div class="card-body">
                <form action="formulariosalida.php" method="POST">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nombre del Producto</label>
                        <input id="cc-pament" name="nombrepro" type="text" class="form-control" aria-invalid="false">
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-6">
                            <label for="select" class=" form-control-label">Categoria</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="categoria" id="select" class="form-control">
                                <option value="">Seleccione el tipo de categoria </option>
                                <?php foreach ($categoria as $categorias) : ?>
                                    <option value="<?php echo $categorias['id'] ?>">
                                        <?php echo $categorias['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="formulariosalida.php" method="POST">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Nombre del Cliente</label>
                                <input id="cc-pament" name="nombreclien" type="text" class="form-control" aria-invalid="false">
                            </div>

                            <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Fecha</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="date" name="fecha" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" class="form-control" require>
                        </div>
                        
                    </div>

                            <p>empleado</p>

                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="select" class=" form-control-label">Cantidad del producto</label>
                                </div>
                                <div class="col col-md-4"><input id="cc-pament" name="cantidadpro" type="number" class="form-control" aria-invalid="false" min="0"></div>

                            </div>



                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="salida">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;Vender Producto

                            </button>
                        </form>

                    </div>
            </div>
        </div>
    </div>

    <?php
    include("layouts/footer.php")
    ?>