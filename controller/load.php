<?php

//Define alias separados
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

//Define la ruta raíz
defined('SITE_ROOT') ? null: define('SITE_ROOT', realpath(dirname(__FILE__)));

//Archivo para cargar multiples archivos php
require_once('conexion.php');
require_once('functions.php');
require_once('session.php');
require_once('sql.php');
require_once('upload.php');
?>