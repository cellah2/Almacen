<?php
session_start();
$_SESSION['email'] = '';
$_SESSION['var'] = '';
session_unset();

session_destroy();

header('Location:index.php');



?>
