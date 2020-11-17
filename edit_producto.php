<?php
require_once('controller/load.php');
$id = (int)$_GET['id'];

$producto = find_by_id("productos", $id);

$cantidadpro = find_all('unidad_medida');
$categoria = find_all('categorias');
$estado = find_all('estado');
$proveedores = find_all('provedor');

if (isset($_POST['actualizar'])) {
    $id_pro = (int)$_POST["id"];
    $req_fields = array('nombrepro', 'descripcion', 'cantidad');
    validate_fields($req_fields);

    if (empty($errors)) {
        $nombreproducto = $_POST["nombrepro"];
        $descripcionprodu = $_POST["descripcion"];
        $cantidad = (int)$_POST["cantidad"];
        $cantidadnum = (int)$_POST["cantidadpro"];
        $categoria = (int)$_POST["categoria"];
        $estado = (int)$_POST['estado'];
        $proveedor = (int)$_POST["proveedor"];

        if (!isset($cantidad)) {
            $session->msg("d", "escoja la unidad de medida.");
            redirect('formproductos.php', false);
        }

        if (!isset($categoria)) {
            $session->msg("d", "La categoria no puede estar en blanco.");
            redirect('formproductos.php', false);
        }
        if (!isset($estado)) {
            $session->msg("d", "El estado del producto no puede estar en blanco.");
            redirect('formproductos.php', false);
        }
        if (!isset($proveedor)) {
            $session->msg("d", "EL proveedor del producto no puede estar en blanco.");
            redirect('formproductos.php', false);
        }

        $sql = "UPDATE productos SET nombre='{$nombreproducto}', descripcion = '{$descripcionprodu}', unidad_medida_id = '{$cantidad}', cantidad= $cantidadnum, categoria_id =$categoria, estado_id = $estado, provedor_id = $proveedor WHERE id=$id_pro";
        $result = $pdo->prepare($sql);
        if ($pdo->query($sql)) {
            $session->msg("s", 'Producto Actualizado Exitosamente!');
            redirect('productos.php', false);
        } else {
            $session->msg("d", 'Error al Actualizar el producto.');
            redirect('productos.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_producto.php?id=' . $id_pro, false);
    }
}


include_once("layouts/header.php");


?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Actualizar Producto</div>
            <?php echo display_msg($msg); ?>
            <div class="card-body">
                <form action="edit_producto.php" method="POST">
                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nombre del Producto</label>
                        <input id="cc-pament" name="nombrepro" type="text" class="form-control" aria-invalid="false" value="<?= $producto['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <p>Descripcion del producto</p>
                        <textarea name="descripcion" rows="5" cols="5" class="form-control"><?= $producto['descripcion'] ?></textarea>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Unidad de Medida</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="cantidad" id="select" class="form-control">
                                <option value="">Selecione el tipo de cantidad del producto</option>
                                <?php foreach ($cantidadpro as $cantidadpros) : ?>
                                    <option value="<?= $cantidadpros['idunidad_medida']; ?>" <?php if ($cantidadpros['idunidad_medida'] == $producto['unidad_medida_id']) :     echo 'selected';
                                                                                                endif; ?>>
                                        <?= $cantidadpros['medida']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="select" class=" form-control-label">Cantidad del producto</label>
                            </div>
                            <div class="col col-md-6">
                                <input id="cc-pament" name="cantidadpro" type="number" class="form-control" aria-invalid="false" min="0" aria-invalid="false" value="<?= $producto['cantidad'] ?>">
                            </div>

                        </div>

                   
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Categoria</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="categoria" id="select" class="form-control">
                                <option value="">Seleccione el tipo de categoria </option>
                                <?php foreach ($categoria as $categorias) : ?>
                                    <option value="<?= $categorias['id'] ?>" <?php if ($categorias['id'] == $producto['categoria_id']) :
                                                                                    echo 'selected';
                                                                                endif; ?>>
                                        <?= $categorias['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Estado del producto</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="estado" id="select" class="form-control">
                                <option value="">Seleccione el tipo de estado del producto </option>
                                <?php foreach ($estado as $estados) : ?>
                                    <option value="<?= $estados['idestado'] ?>" <?php if ($estados['idestado'] == $producto['estado_id']) :
                                                                                    echo 'selected';
                                                                                endif; ?>>
                                        <?= $estados['tipo_estado']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Proveedores</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="proveedor" id="select" class="form-control">
                                <option value="">Seleccione el proveedor</option>
                                <?php foreach ($proveedores as $proveedor) : ?>
                                    <option value="<?= $proveedor['id'] ?>" <?php if ($proveedor['id'] == $producto['provedor_id']) :
                                                                                echo 'selected';
                                                                            endif; ?>>
                                        <?= $proveedor['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="actualizar">
                        <i class="fa fa-lock fa-lg"></i>&nbsp;Actualizar Producto
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
include("layouts/footer.php")
?>