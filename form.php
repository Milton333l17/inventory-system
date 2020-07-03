<?php
include("layouts/header.php")
?>

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Registro Nuevo Usuario</div>
                        <div class="card-body">

                            <form action="" method="post" novalidate="novalidate">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Nombres</label>
                                    <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Apellidos</label>
                                    <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="select" class=" form-control-label">Tipo de documento</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="select" id="select" class="form-control">
                                            <option value="T.I">T.I</option>
                                            <option value="C.C">C.C</option>
                                            <option value="C.E">C.E</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Documento</label>
                                    <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group">
                                    <label for="cc-number" class="control-label mb-1">Contraseña</label>
                                    <input id="cc-number" name="cc-number" type="password" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                    <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Rol</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="select" id="select" class="form-control">
                                            <option value="administrador">Administrador</option>
                                            <option value="empleado">Empleado</option>

                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Registrar</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    <!-- MAIN CONTENT FINISH-->

    <?php
    include("layouts/footer.php")
    ?>