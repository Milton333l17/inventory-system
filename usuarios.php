<?php
require_once('controller/load.php');
$users = find_all_users();

include("layouts/header.php");
?>
<div class="row">
    <div class="col-lg-12">
        <!-- Usuarios Registro-->
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>Usuarios Registrados
            </h3>
            <?php echo display_msg($msg); ?>
            <div class="filters m-b-45">
                <div class="form-row">
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border col-lg-3">
                        <select class="js-select2 au-select-dark" name="time">
                            <option selected="selected">Ultimos Registros</option>
                            <option value="">Ultimos Meses</option>
                            <option value="">Ultimos Dias</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-data">
                <table class="table table-striped">
                    <thead class="thead-dark text-center ">
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr class="text-center">
                                <td><?php echo $user['nombres'] ?></p>
                                </td>
                                <td><?php echo $user['apellidos']; ?></td>
                                <td><?php echo $user['documento']; ?></td>
                                <td><?php echo $user['email'];    ?></td>
                                <td>
                                    <?php
                                    if ($user['rol_id'] === '1') {
                                        echo '<span class="role admin">Administrador</span>';
                                    } else if ($user['rol_id'] === '2') {
                                        echo '<span class="role user">Empleado</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <?php
                                        if ($user['estado'] === '1') {
                                            echo '<button class="item" data-toggle="tooltip" data-placement="top" title="Active">
                                            <i class="zmdi zmdi-mood"></i></button>';
                                        } else if ($user['estado'] === '0') {
                                            echo '<button class="item" data-toggle="tooltip" data-placement="top" title="Inactive">
                                            <i class="zmdi zmdi-mood-bad"></i>
                                            </button>';
                                        } ?>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END USER DATA-->
</div>
</div>
<?php
include("layouts/footer.php");
?>