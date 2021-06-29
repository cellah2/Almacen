<?php



$email=$_POST['email'];
$clave=$_POST['clave'];
//conectar a la base de datos
$conn=mysqli_connect("localhost","root","","almacenkeka");


$consulta="SELECT * FROM usuarios WHERE email='$email' or nombre='$email' and password='$clave'";
$resultado = mysqli_query($conn,$consulta);
$fila['priv'] = '';

$filas=mysqli_num_rows($resultado);
if($filas>0){
    session_start();
    $fila = $resultado->fetch_assoc();
    echo $fila['priv'];
    if ($fila['priv'] == 'admin'){
        $_SESSION['email'] = $email;
        $_SESSION['var'] = $fila['priv'];
        header("location:dashboard.php");
    }else{
        $_SESSION['email'] = $email;
        $_SESSION['var'] = $fila['priv'];
        //header("location:dashboard.php");
        header("location:ventas.php");
    } 



}else {
    echo "<script> alert('Este usuario no existe, intente denuevo'); 
    window.location.href='index.php';</script>";
}

mysqli_free_result($resultado);
mysqli_close($conn);


?>
