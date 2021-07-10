<?php 
session_start();
$varsession = $_SESSION['email'];
$auth = $_SESSION['var'];
if($varsession==null || $varsession=''){
    echo 'Usted no tiene autorizacion';
	header("Location: index.php");
    die();
}

include("conexion.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

    <script src="https://kit.fontawesome.com/d248edc114.js" crossorigin="anonymous"></script>
    <script src="assets/script.js" crossorigin="anonymous"></script>

    <title>Modulo de Ventas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel|Poiret+One|ZCOOL+XiaoWei&display=swap">
</head>
<body>
    <!--
<div class="col-md-12 ml-auto bg-secondary fixed-top top-navbar">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h4 class="text-light mb-0">Almacen Keka</h4>
        </div>
        <div class="col-md-6">
        <ul class="navbar-nav">
        
        <?php
        if ($_SESSION['var'] == 'admin'){
                    ?>
                    <li class="nav-item ml-md-auto"><a href="dashboard.php" class="nav-link text-dark bg-primary border border-primary rounded my-2">Panel de Administracion<i class="fas fa-sign-out-alt text-dark fa-lg"></i></a></li>
                    <?php
                }?>
                <li class="nav-item ml-md-auto"><a href="" class="nav-link text-dark bg-danger border border-danger rounded mb-2" data-toggle="modal" data-target="#sign-out">Cerrar Sesion <i class="fas fa-sign-out-alt text-dark fa-lg"></i></a></li>
        </ul>
        </div>
    </div>
</div>
  -->
<div class="row align-items-center bg-secondary d-flex justify-content-between">
<div class="col-3">
    <h5 class="text-light mb-0">Almacen Keka</h4>
</div>
<div class="col-6">
    <h2 style="margin-top: 20px;">MODULO DE VENTAS</h2>
</div>
<div class="col-3">
<?php if ($_SESSION['var'] == 'admin'){ ?>
        <a href="dashboard.php" class="btn btn-primary btn-sm">Panel de Administración<i class="fas fa-chart-bar text-dark fa-lg"></i></a>
<?php } ?>
        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#sign-out">Cerrar Sesión<i class="fas fa-sign-out-alt text-dark fa-lg"></i></a>
</div>


<?php include("includes/footer.php"); 
unset($_SESSION["message"]);
?>
