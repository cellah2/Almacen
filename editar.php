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


if(isset($_GET['id_producto'])){
    $id = $_GET['id_producto'];
    $query = "SELECT * FROM productos WHERE id_producto = $id";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $precio = $row['precio'];
        $stock = $row['stock'];
        $categoria = $row['cod_categoria'];
        $marca = $row['cod_marca'];
    }

}
if (isset($_POST['update'])){
    $id = $_GET['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['cod_categoria'];
    $marca = $_POST['cod_marca'];

    $query = "UPDATE productos set nombre='$nombre', precio=$precio , stock=$stock , cod_categoria=$categoria, cod_marca=$marca WHERE id_producto = $id";
    mysqli_query($link,$query);

    $_SESSION['message'] = "Producto editado satisfactoriamente !";
    $_SESSION['message_type'] = "warning";
    header("Location: mostrar_productos.php");

}

?>

<?php include("includes/header.php"); ?>

<section>
    <div class="container-fluid">
        
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 mt-5 ml-auto">
                <?php 
                if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
                </div>
                <?php } ?>
                
                <div class="col-auto col-lg-8 mx-auto">

                <div class="card border-warning">
                <div class="card-header bg-warning text-white">
                    <strong><i class="fa fa-pencil"></i> Editar Producto</strong>
                </div>

                    <div class="card card-body">
                        <form action="editar.php?id_producto=<?php echo $_GET['id_producto']; ?>" method="POST">
                            <div class="form-group"><p>Nombre:</p>
                                <input type="text" name="nombre" value="<?php echo $nombre; ?>"
                                class="form-control border border-warning" placeholder="Update Nombre">                            
                            </div>
                            <div class="form-group"><p>Precio:</p>
                                <input type="number" name="precio" class="form-control border border-warning" placeholder="Update Precio" 
                                value="<?php echo $precio;?>">
                            </div>
                            <div class="form-group"><p>Stock:</p>
                                <input type="number" name="stock" class="form-control border border-warning" placeholder="Update STOCK" 
                                value="<?php echo $stock;?>">
                            </div>
                            <div class="form-group">
                            <label for="cod_categoria">Categoria:</label>
                            <select name="cod_categoria" id="cod_categoria" class="form-control border border-warning">
                            <?php
$consulta="SELECT * FROM categorias";
$resultado = $link->query($consulta);
        
?>
                                <option selected>Elegir...</option>
                                <?php while($mostrar=$resultado->fetch_assoc()){ ?>
                                <option value="<?php echo $mostrar['id_categoria']?>"><?php echo $mostrar['id_categoria']?> - <?php echo $mostrar['nombre_categoria'] ?></option>
        <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cod_marca">Marca:</label>
                            <select name="cod_marca" id="cod_marca" class="form-control border border-warning">
                            <?php
$consulta2="SELECT * FROM marcas";
$resultado2 = $link->query($consulta2);
        
?>
                                <option selected>Elegir...</option>
                                <?php while($mostrar=$resultado2->fetch_assoc()){ ?>
                                <option value="<?php echo $mostrar['id_marca']?>"><?php echo $mostrar['id_marca']?> - <?php echo $mostrar['nombre_marca'] ?></option>
        <?php } ?>
                            </select>
                        </div>

                            <button class="btn-warning" name="update">
                                Actualizar Producto
                            </button>
                        </form>
                    </div>
                    </div>
                </div>

                </div>
            </div>
    </div>

</section>

<?php include("includes/footer.php"); ?>