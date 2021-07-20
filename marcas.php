<?php 
session_start();

$varsession = $_SESSION['email'];
$auth = $_SESSION['var'];
if($varsession == null || $varsession=''){
    echo 'No esta autorizado';
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
?>

<section>
    <div class="container-fluid w-auto">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-9 mt-5 ml-auto mb-2"> <!-- CAJA LADO DE SIDEBAR -->
            <?php 
                if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" data-auto-dismiss="1000" id="success-alert" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
                </div>
                <?php } ?>

                <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Marcas</li>  
                        </ol>
                </nav>
                    <!-- END NOTIF Y BREADCRUM -->
            <!-- INICIO LISTADO DE MARCAS -->
            <div class="row">
            <div class="col-xl-5 col-md-6 col-sm-5">    

                <h4>Lista de Marcas</h3>

                <table class="table">
                    <thead>
                        <tr class="table-danger">
                        <th scope="col">Marca</th>
                        <th scope="col">Productos</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
            $query_marcas = "SELECT * FROM marcas";
            $res = $link->query($query_marcas);
            while($mostrar=$res->fetch_assoc()){
                $id = $mostrar['id_marca'];
                $query_marcas = "SELECT * FROM productos WHERE cod_marca=$id";
                $result = mysqli_query($link,$query_marcas);
                $rcount = mysqli_num_rows($result);
            ?>
                        <tr>
                            <td>   <?php echo $mostrar['id_marca'] ?> - <?php echo $mostrar['nombre_marca'] ?></td>
                            <td><span class="badge badge-danger badge-pill"><?php echo $rcount; ?></span></td>
                            <td><a href="editar_marca.php?id_marca='<?php echo $id ?>'"><span class="badge badge-warning badge-pill">Editar</span></a></td>
                        </tr>
            <?php } ?>
                    </tbody>
            </table>
        

            </div>

            <div class="col-xl-5 col-md-6 col-sm-7">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <strong><i class="fa fa-plus"></i>Crear nueva Marca</strong>
                    </div>
                    <div class="card-body">
                        <form action="crear_marca.php" method="post">
                            <div class="form-group col-auto">
                                <label for="id_marca" class="col-form-label">ID: (dejar en blanco para autoasignar)</label>
                                <input type="number" class="form-control border border-danger" id="id_marca" name="id_marca" placeholder="omitir si no sabe...">
                            </div>
                            <div class="form-group col-auto">
                                <label for="nombre_marca" class="col-form-label">Nombre de la Marca</label>
                                <input type="text" class="form-control border border-danger" id="nombre_marca" name="nombre_marca" placeholder="Nombre..." required>
                            </div>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-check-circle"></i> Guardar</button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
            <!-- FINAL LISTA DE DE MARCAS -->
            </div> <!-- END CAJA PRINCIPAL -->
        </div>

           
    </div>
    
</section>
<?php include("includes/footer.php"); 
unset($_SESSION["message"]);
?>