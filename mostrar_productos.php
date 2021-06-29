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
include("includes/header.php");
?>

<section>
<?php 
  $busqueda = '';
  $search_categoria='';
  if (empty($_REQUEST['busqueda']))
  {
   // header("location: mostrar_productos.php");
  }

?>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 mt-5 ml-auto">
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
                        <li class="breadcrumb-item active" aria-current="page">Lista de Productos</li>  
                        </ol>
                    </nav>
                <table class="table table-striped table-hover table-bordered table-sm bg-white">
        <thead>
          <tr>
            <td>ID</td>
            <td>PRODUCTO</td>
            <td>PRECIO</td>
            <td>STOCK</td>
	<td>
  <?php
      $query_categorias = mysqli_query($link,"select * from categorias");
      $result_categorias = mysqli_num_rows($query_categorias);
      ?>
      <select name="categorias" id="search_categorias" class="select_location">
      <option selected>CATEGORIA</option>
                  <?php 
                  if($result_categorias > 0){
                    while($categoria = mysqli_fetch_array($query_categorias)) {
                      ?>
                      <option value="<?php echo $categoria["id_categoria"]; ?>"  
                      id="<?php echo $categoria["id_categoria"] ?>"> <?php echo $categoria["nombre_categoria"]; ?> </option>
                      <?php

                    }
                  }
                  ?>
      </select>
  </td>
            <td>OPERACIONES</td>
          </tr>
        </thead>
        <?php

          //paginador
          $sql_totales = $link->query("SELECT COUNT(*) as total_registro FROM productos");
          $result_registros = mysqli_fetch_array($sql_totales);
          $total_registro = $result_registros['total_registro'];

          $por_pagina = 5;

          if(empty($_GET['pagina']))
          {
            $pagina = 1;
          }else{
            $pagina = $_GET['pagina'];
          }

          $desde = ($pagina-1) * $por_pagina;
          $total_paginas = ceil($total_registro / $por_pagina);


$consulta="SELECT * FROM productos ORDER BY id_producto ASC LIMIT $desde,$por_pagina";
$resultado = $link->query($consulta);

?>
        <tbody>
        <?php
        while($mostrar=$resultado->fetch_assoc()){

       
        ?>
          <tr>
            <td><?php echo $mostrar['id_producto'] ?></td>
            <td><?php echo $mostrar['nombre'] ?></td>
            <td><?php echo $mostrar['precio'] ?></td>
            <td><?php echo $mostrar['stock'] ?></td>
<td>
<?php $cat = $mostrar['cod_categoria'];
$var=mysqli_query($link,"SELECT * from categorias where id_categoria=$cat");
$ext = $var->fetch_array();

echo $cat . " - " . $ext['nombre_categoria'];

?>
</td>

            <td>
              <a href="editar.php?id_producto='<?php echo $mostrar['id_producto']?>'" class="btn btn-secondary">Editar</a>
              <a href="eliminar.php?id_producto='<?php echo $mostrar['id_producto']?>'" class="btn btn-danger btn-delete">Eliminar</a>
            </td>
          </tr>
        <?php
        }
        ?>

        </tbody>
      </table>

<div class="paginador">
        <ul>
        <?php 
            if($pagina !=1){

            
        ?>
          <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
          <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
            <?php 
            }
            for ($i=1; $i <= $total_paginas ; $i++){
              if($i == $pagina){
                echo '<li><a href="?pagina='.$i.'" class="pageSelected">'.$i.'</a></li>';
              }else{
              echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
              }
            }
            if($pagina!=$total_paginas)
            {
          ?>
         
          <li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
          <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
            <?php } ?>
        </ul>
</div>

                </div>
            </div>
        </div>

    </section>

<?php include("includes/footer.php"); 
unset($_SESSION["message"]);
?>
