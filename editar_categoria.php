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


if(isset($_GET['id_categoria'])){
    $id = $_GET['id_categoria'];
    $query = "SELECT id_categoria, nombre_categoria FROM categorias WHERE id_categoria = $id";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $id_cat = $row['id_categoria'];
        $nom_cat = $row['nombre_categoria'];
    }

}
if (isset($_POST['update'])){
    $id = $_GET['id_categoria'];
    $id_cate = $_POST['id_categoria'];
    $nombre_cate = $_POST['nombre_categoria'];


    $query = "UPDATE categorias set id_categoria=$id_cate, nombre_categoria='$nombre_cate' WHERE id_categoria = $id";
    mysqli_query($link,$query);

    $_SESSION['message'] = "Categoria editada satisfactoriamente !";
    $_SESSION['message_type'] = "warning";
    header("Location: categorias.php");

}else if (isset($_POST['delete'])){
    $id = $_GET['id_categoria'];
    $id_cate = $_POST['id_categoria'];
    $nombre_cate = $_POST['nombre_categoria'];

    $query = "DELETE from categorias where id_categoria=$id_cate and nombre_categoria='$nombre_cate'";
    //$query = "UPDATE categorias set id_categoria=$id_cate, nombre_categoria='$nombre_cate' WHERE id_categoria = $id";
    mysqli_query($link,$query);

    $_SESSION['message'] = "Categoria ".$nombre_cate. " eliminada !";
    $_SESSION['message_type'] = "danger";
    header("Location: categorias.php");

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
                        <strong><i class="fa fa-pencil"></i>Editar Categoria</strong>
                    </div>
                    <div class="card-body">
                        <form action="editar_categoria.php?id_categoria=<?php echo $_GET['id_categoria']; ?>" method="post">
                            <div class="form-group col-auto">
                                <label for="id_categoria" class="col-form-label">ID: (dejar en blanco para autoasignar)</label>
                                <input type="number" class="form-control border border-primary" id="id_categoria" name="id_categoria" value="<?php echo $id_cat; ?>" placeholder="omitir si no sabe...">
                            </div>
                            <div class="form-group col-auto">
                                <label for="nombre_categoria" class="col-form-label">Nombre de la Categoria</label>
                                <input type="text" class="form-control border border-primary" id="nombre_categoria" name="nombre_categoria" value="<?php echo $nom_cat; ?>" placeholder="Nombre..." required>
                            </div>
                            <button name="update" class="btn btn-primary btn-lg px-5"><i class="fa fa-check-circle"></i> Guardar</button>
                            <button name="delete" class="btn btn-warning ml-4"><i class="fa fa-trash-alt"></i> Eliminar categoria</button>

                        </form>

                    </div>
                </div>

                </div>
                </div>
</div>
</section>

<?php include("includes/footer.php"); ?>