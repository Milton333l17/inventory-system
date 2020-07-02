<?php
$title = "Login";
require('layouts/header.php');
?>
<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <H1>INVENTORY SYSTEM</H1>
                </a>
            </div>
            <div class="login-form">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Documento</label>
                        <input class="au-input au-input--full" type="email" name="email" placeholder="Document">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="login-checkbox">
                        <label>
                            <input type="checkbox" name="remember">Recordarme
                        </label>
                        <label>
                            <a href="#">¿Olvidó su contraseña?</a>
                        </label>
                    </div>
                    <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">INICIAR SESION</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require('layouts/footer.php');
