<?php
require_once('controller/load.php');
if(!$session->logout()){
    redirect("login.php");
}