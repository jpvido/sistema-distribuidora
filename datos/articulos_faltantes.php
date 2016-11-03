<?php 
include("../config.php");
$result = mysql_query("select id,codigo,descripcion,cantidad,cantidad_minima from articulos where cantidad <= cantidad_minima");  
$json_response = array();

while ($row = mysql_fetch_array($result)) {
    $row_array['codigo'] = $row['codigo'];
    $row_array['categoria'] = $row['categoria'];
    $row_array['descripcion'] = $row['descripcion'];
    $row_array['cantidad'] = $row['cantidad'];
    $row_array['cantidad_minima'] = $row['cantidad_minima'];
    
    array_push($json_response,$row_array);
}
echo json_encode($json_response);
?>