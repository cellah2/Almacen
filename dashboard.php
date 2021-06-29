<?php 


session_start();

$varsession = $_SESSION['email'];
$auth = $_SESSION['var'];
if($varsession==null || $varsession=''){
    echo 'Usted no tiene autorizacion';
    die();
}
if ($auth == null || $auth == 'user' || $auth == ''){
    //echo 'Usted no tiene autorizacion';
    echo "<script> alert('No tienes autorizacion para este modulo'); 
    window.location.href='index.php';</script>";
    die();
}

include("conexion.php");
include("includes/header.php");

$conn=mysqli_connect("localhost","root","","almacenkeka");


$consulta="SELECT * FROM productos";
$resultado = mysqli_query($conn,$consulta);

$rcount=mysqli_num_rows($resultado);


?>


<section>
<div class="container-fluid">
            <div class="row mt-1">
                <div class="col-xl-10 col-lg-9 col-md-8 mt-5 ml-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>  
                        </ol>
                    </nav>
                    <h3>Bienvenido al Administrador sr. <?php echo $_SESSION['var']?></h3>
                    
                    <section>
                    <div class="row pt-5 mt-3 mb-5">
                            <div class="col-sm-6 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fas fa-shopping-cart fa-3x text-warning"></i>
                                            <div class="text-right text-secondary">
                                            <h5>Cantidad de Productos</h5>
                                            <h3><?php echo $rcount; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <i class="fas fa-sync mr-3"></i>
                                        <span>Actualizado ahora</span>
                                    </div>   
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fas fa-money-bill-alt fa-3x text-success"></i>
                                            <div class="text-right text-secondary">
                                            <h5>Ventas</h5>
                                            <h3>$135.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <i class="fas fa-sync mr-3"></i>
                                        <span>Actualizado ahora</span>
                                    </div>   
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fas fa-users fa-3x text-info"></i>
                                            <div class="text-right text-secondary">
                                            <h5>Usuarios</h5>
                                            <h3>20</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <i class="fas fa-sync mr-3"></i>
                                        <span>UPdated now</span>
                                    </div>   
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fas fa-chart-line fa-3x text-danger"></i>
                                            <div class="text-right text-secondary">
                                            <h5>Ofertas</h5>
                                            <h3>120</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <i class="fas fa-sync mr-3"></i>
                                        <span>UPdated now</span>
                                    </div>   
                                </div>
                            </div>
                            
                        </div>
                    </section>
                <!--
                <div class="row align-items-center">
                    <div class="col p-2 m-3 border border-primary rounded-left">
                        <span class="text-primary">Cantidad de Productos: </span><small><?php echo $rcount; ?></small>
                    </div>

                    <div class="col p-2 m-3 border border-success rounded">
                    <span class="text-success">Total de Categorias: </span><small>8</small>
                    </div>

                    <div class="col p-2 m-3 border border-danger rounded-right">
                    <span class="text-danger">Productos en oferta: </span><small>38</small>
                    </div>

                </div>
                -->
                
                </div>
            </div>
</div>
    </section>


<?php include("includes/footer.php") ?>