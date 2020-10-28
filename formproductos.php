<?php
require_once('controller/load.php');

$cantidadpro = find_all('unidad_medida');
$categoria = find_all('categorias');
$estado = find_all('estado');
$proveedores = find_all('provedor');

if (isset($_POST['registrar'])) {
    $req_fields = array('nombrepro', 'descripcion');
    validate_fields($req_fields);
    
    if(empty($errors)){
      echo  $nombreproducto= $_POST["nombrepro"];
       echo $descripcionprodu = $_POST["descripcion"];
       echo $cantidad = (int)$_POST["cantidad"];
       echo $categoria = (int)$_POST["categoria"];
       echo $estado = (int)$_POST['estado'];
      echo  $proveedor = (int)$_POST["proveedor"];

        if(!isset($cantidad)){
            $session->msg("d", "escoja la unidad de medida.");
            redirect('formproductos.php', false);
        }

        if(!isset($categoria)){
            $session->msg("d", "La categoria no puede estar en blanco.");
            redirect('formproductos.php', false);
        }
        if(!isset($estado)){
            $session->msg("d", "El estado del producto no puede estar en blanco.");
            redirect('formproductos.php', false);
        }
        if(!isset($proveedor)){
            $session->msg("d", "EL proveedor del producto no puede estar en blanco.");
            redirect('formproductos.php', false);
        }

        $sql = "INSERT INTO productos (nombre, descripcion, unidad_medida_id, categoria_id, estado, provedor_id) VALUES ('{$nombreproducto}','{$descripcionprodu}',{$cantidad}, {$categoria}, {$estado},{$proveedor})";
        if($pdo->query($sql)){
            $session->msg("s", 'Producto Registrado Exitosamente!');
            redirect('usuarios.php', false);
        }else{
            $session->msg("d", 'Error al crear el producto.'.$sql);
            redirect('usuarios.php', false);
        }

    }else{
        $session->msg("d", $errors);
        redirect('formproductos.php', false);
    }
}
include_once("layouts/header.php");


?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Registro Nuevo Producto</div>
            <?php echo display_msg($msg); ?>
            <div class="card-body">
                <form action="formproductos.php" method="POST">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nombre del Producto</label>
                        <input id="cc-pament" name="nombrepro" type="text" class="form-control"  aria-invalid="false" >
                    </div>
                    <div class="form-group">
                        <p>Descripcion del producto</p>
                        <textarea name="descripcion" rows="5" cols="5" class="form-control"></textarea>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Unidad de Medida</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="cantidad" id="select" class="form-control" >
                                <option value="">Selecione el tipo de cantidad del producto</option>
                                <?php foreach ($cantidadpro as $cantidad) : ?>
                                    <option value="<?php echo $cantidad['idunidad_medida'] ?>">
                                        <?php echo $cantidad['medida']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Categoria</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select name="categoria" id="select" class="form-control" >
                                <option value="">Seleccione el tipo de categoria </option>
                                <?php foreach ($categoria as $categorias) : ?>
                                    <option value="<?php echo $categorias['id'] ?>">
                                        <?php echo $categorias['nombre']; ?>
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
                            <select name="estado" id="select" class="form-control" >
                                <option value="">Seleccione el tipo de estado del producto </option>
                                <?php foreach ($estado as $estados) : ?>
                                    <option value="<?php echo $estados['idestado'] ?>">
                                        <?php echo $estados['tipo_estado']; ?>
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
                            <select name="proveedor" id="select" class="form-control" >
                                <option value="">Seleccione el proveedor</option>
                                <?php foreach ($proveedores as $provedores) : ?>
                                   
                                <?php if($provedores['estado'] === "1"): ?>
                                         <option value="<?php echo $provedores['id'] ?>">


                                         <?php echo $provedores['nombre']; ?>
                                         </option>
                                    <?php endif ?>
                                       
                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="registrar">
                        <i class="fa fa-lock fa-lg"></i>&nbsp;Crear Producto
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
include("layouts/footer.php")
?>