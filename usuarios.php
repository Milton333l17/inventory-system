<?php
include("layouts/header.php");
require('controller/load.php');
?>
<div class="row">
    <div class="col-lg-12">
        <!-- Usuarios Registro-->
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>Usuarios Registrados</h3>
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
                <table class="table">
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Rol</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="table-data__info">
                                    <h6>lori lynch</h6>
                                    <span>
                                        <a href="#">johndoe@gmail.com</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="role admin">admin</span>
                            </td>
                            <td>
                                <!-- botones -->
                                <button type="button" class="btn btn-secondary">Desactivar</button>
                                <button type="button" class="btn btn-success">Modificar</button>
                            </td>
                        </tr> 
                    </tbody>  
                </table>         
            </div>
        </div>
    </div>
    <!-- END USER DATA-->
</div>
</div>
<?php
include("layouts/footer.php")
?>