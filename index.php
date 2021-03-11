<?php
require_once('controller/load.php');




include_once("layouts/header.php");

$countsql = $pdo->prepare("SELECT COUNT(id) FROM entradas ");
$countsql->execute();
$row = $countsql->fetch();
$numbentrada = $row[0];

$countsql = $pdo->prepare("SELECT COUNT(id) FROM productos ");
$countsql->execute();
$row = $countsql->fetch();
$numbproduct = $row[0];

$countsql = $pdo->prepare("SELECT COUNT(id) FROM login_usuario ");
$countsql->execute();
$row = $countsql->fetch();
$numbuser = $row[0];

$countsql = $pdo->prepare("SELECT COUNT(id) FROM salida ");
$countsql->execute();
$row = $countsql->fetch();
$numbsalidas = $row[0];
?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1" >INICIO</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $numbuser ?></h2>
                                                <span>N° Usuarios</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $numbsalidas ?></h2>
                                                <span>N° Salidas</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $numbentrada ?></h2>
                                                <span>N° Entradas</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $numbproduct  ?></h2>
                                                <span>N° Productos</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
include_once("layouts/footer.php");
?>