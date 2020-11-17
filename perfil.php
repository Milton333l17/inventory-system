<?php 
require_once('controller/load.php');
include("layouts/header.php");

$sql = "UPDATE login_usuario SET documento='{$documento}', nombre='{}'WHERE id='{$id}'";

?>


<?php
include("layouts/footer.php");
?>