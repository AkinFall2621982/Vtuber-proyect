<?php
// ><
$host = "localhost";
$user = "root";
$pass = "";
$DB = "veterinaria";

$conexion=@mysqli_connect($host, $user, $pass) or die ("Error en conexion: ".mysqli_connect_error());
mysqli_select_db($conexion,$DB) or die(mysqli_error($conexion));
?>