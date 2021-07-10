<?php 
session_start();
include("conexion.php");
$auth = $_SESSION['var'];
if ($auth == null || $auth == 'user' || $auth == ''){
    //echo 'Usted no tiene autorizacion';
    echo "<script> alert('No tienes autorizacion para este modulo'); 
    window.location.href='index.php';</script>";
    die();
}

$nombre= $_POST['nombre'];
$precio= $_POST['precio'];
$stock= $_POST['stock'];
$categoria = $_POST['cod_categoria'];
$marca = $_POST['cod_marca'];

$query = "INSERT INTO productos (nombre,precio,stock,cod_categoria, cod_marca) VALUES ('$nombre',$precio,$stock,$categoria,$marca)";

mysqli_query($link,$query);

    $_SESSION['message'] = "Su producto fue agregado correctamente!";
    $_SESSION['message_type'] = "success";
    header("Location: mostrar_productos.php");

?>