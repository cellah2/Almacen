<?php
session_start();
$varsession = $_SESSION['email'];
$auth = $_SESSION['var'];
if($varsession==null || $varsession=''){
    echo 'Usted no tiene autorizacion';
	header("Location: index.php");
    die();
}
if ($auth == null || $auth == 'user' || $auth == ''){
    //echo 'Usted no tiene autorizacion';
    echo "<script> alert('No tienes autorizacion para este modulo'); 
    window.location.href='index.php';</script>";
    die();
}


include("conexion.php");


if(isset($_GET['id_marca'])){
    $id = $_GET['id_marca'];
    $query = "SELECT id_marca, nombre_marca FROM marcas WHERE id_marca = $id";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $id_mar = $row['id_marca'];
        $nom_mar = $row['nombre_marca'];
    }

}
if (isset($_POST['update'])){
    $id = $_GET['id_marca'];
    $id_mar = $_POST['id_marca'];
    $nombre_mar = $_POST['nombre_marca'];


    $query = "UPDATE marcas set id_marca=$id_mar, nombre_marca='$nombre_mar' WHERE id_marca = $id";
    mysqli_query($link,$query);

    $_SESSION['message'] = "Marca editada satisfactoriamente !";
    $_SESSION['message_type'] = "warning";
    header("Location: marcas.php");

}else if (isset($_POST['delete'])){
    $id = $_GET['id_marca'];
    $id_mar = $_POST['id_marca'];
    $nombre_mar = $_POST['nombre_marca'];

    $query = "DELETE from marcas where id_marca=$id_mar and nombre_marca='$nombre_mar'";

    mysqli_query($link,$query);

    $_SESSION['message'] = "Marca ".$nombre_mar. " eliminada correctamente!";
    $_SESSION['message_type'] = "danger";
    header("Location: marcas.php");

}



?>

<?php include("includes/header.php"); ?>

<section>
    <div class="container-fluid">
        
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 mt-5 ml-auto">

<div class="col-auto col-lg-8 mx-auto">

<div class="card border-success">
                    <div class="card-header bg-success text-white">
                        <strong><i class="fa fa-pencil"></i>Editar Marca</strong>
                    </div>
                    <div class="card-body">
                        <form action="editar_marca.php?id_marca=<?php echo $_GET['id_marca']; ?>" method="post">
                            <div class="form-group col-auto">
                                <label for="id_marca" class="col-form-label">ID: (dejar en blanco para autoasignar)</label>
                                <input type="number" class="form-control border border-primary" id="id_marca" name="id_marca" value="<?php echo $id_mar; ?>" placeholder="omitir si no sabe...">
                            </div>
                            <div class="form-group col-auto">
                                <label for="nombre_marca" class="col-form-label">Nombre de la Marca</label>
                                <input type="text" class="form-control border border-primary" id="nombre_marca" name="nombre_marca" value="<?php echo $nom_mar; ?>" placeholder="Nombre..." required>
                            </div>
                            <button name="update" class="btn btn-primary btn-lg px-5"><i class="fa fa-check-circle"></i> Guardar</button>
                            <button name="delete" class="btn btn-warning ml-4"><i class="fa fa-trash-alt"></i> Eliminar marca</button>

                        </form>

                    </div>
                </div>

                </div>
                </div>
</div>
</section>

<?php include("includes/footer.php"); ?>