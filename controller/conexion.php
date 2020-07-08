<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=inventorysystem', 'root', '');
}catch(PDOException $e){
    echo 'Error: '.$e->getMessage();
}
?>