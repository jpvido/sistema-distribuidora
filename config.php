<?php
//error_reporting(E_ALL ^ E_DEPRECATED);

//variables generales
date_default_timezone_set("America/Argentina/Buenos_Aires");
//conexion
$host = "localhost";
$user = "root";
$pass = "";
$db = "comercio";


//$host = "localhost";
//$user = "w1441008_perfu";
//$pass = "A1b2c3d4";
//$db = "w1441008_perfumeria";

$caja = 1;
//aplicacion
$titulo = "Emanuel Distribuidora";
$modulos = array("clientes","proveedores","articulos","facturacion","hojaruta");
$modulos_desc = array("Clientes","Proveedores","Articulos","facturacion","Hoja de Ruta");
$modulo_def = "clientes";
 
//conexion base de datos
//$link = mysql_connect($host, $user, $pass) or die('No se pudo conectar: ' . mysql_error());
//mysql_select_db($db) or die('No se pudo seleccionar la base de datos');


?>