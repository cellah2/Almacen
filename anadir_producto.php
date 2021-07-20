<?php 


session_start();

$varsession = $_SESSION['email'];

if($varsession==null || $varsession=''){
    echo 'Usted no tiene autorizacion';
    die();
}
if ($_SESSION['var'] == null || $_SESSION['var'] == 'user' || $_SESSION['var'] == ''){
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
            
        <div class="col-xl-10 col-lg-9 col-md-8 mt-5 ml-auto">
        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Añadir Producto</li>  
                        </ol>
                    </nav>
        <div class="col-auto col-lg-8 mx-auto p-2">
        
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <strong><i class="fa fa-plus"></i> Agregar Nuevo Producto</strong>
                </div>
                <div class="card-body">
                    <form action="anadir.php" method="post">
                        
                            <div class="form-group col-auto">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control border border-success" id="nombre" name="nombre" placeholder="Nombre..." required>
                            </div>
                        
                            <div class="form-group col-auto">
                            <label for="precio" class="col-form-label">Precio: (ingrese solo numeros)</label>
                            <input type="text" class="form-control border border-success" id="precio" name="precio" placeholder="Precio ($)..." required>
                            </div>
                        
                        <div class="form-group col-auto">
                        <label for="stock" class="col-form-label">Stock: (ingrese solo numeros)</label>
                            <input type="text" class="form-control border border-success" id="stock" name="stock" placeholder="Stock..." required>
                            </div>
                        
                        
                          <div class="form-group">
                            <label for="cod_categoria">Categoria: selecciona una categoria</label>
                            <select name="cod_categoria" id="cod_categoria" class="form-control border border-success">
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
                            <label for="cod_marca">Marca: selecciona una marca</label>
                            <select name="cod_marca" id="cod_marca" class="form-control border border-success">
                            <?php
$consulta2="SELECT * FROM marcas";
$resultado2 = $link->query($consulta2);
        
?>
                                <option selected>Elegir...</option>
                                <?php while($mostrar2=$resultado2->fetch_assoc()){ ?>
                                <option value="<?php echo $mostrar2['id_marca']?>"><?php echo $mostrar2['id_marca']?> - <?php echo $mostrar2['nombre_marca'] ?></option>
        <?php } ?>
                            </select>
                        </div>            

                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>Guardar</button>
                    </form>
                
                
                </div>

            </div>
            </div>
        </div>
        </div>
    </div>

</section>

<?php include("includes/footer.php"); ?>