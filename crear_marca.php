<?php 
session_start();
$auth = $_SESSION['var'];
if ($auth == null || $auth == 'user' || $auth == ''){
    //echo 'Usted no tiene autorizacion';
    echo "<script> alert('No tienes autorizacion para este modulo'); 
    window.location.href='index.php';</script>";
    die();
}


include("conexion.php");

$id_mar= $_POST['id_marca'];
$nom_mar= $_POST['nombre_marca'];


$query2 = "INSERT INTO marcas (id_marca, nombre_marca) VALUES ($id_mar,'$nom_mar')";
mysqli_query($link,$query2);

if($id_mar='' || $id_mar==null){
    $query = "INSERT INTO marcas (nombre_marca) VALUES ('$nom_mar')";
    mysqli_query($link,$query);
    }

    $_SESSION['message'] = "Marca creada correctamente";
    $_SESSION['message_type'] = "success";
    header("Location: marcas.php");

?>