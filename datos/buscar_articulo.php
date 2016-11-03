<?php 
include("../config.php");
$q = "select * from articulos where codigo = '".$_REQUEST["codigo"]."' OR descripcion like '%".$_REQUEST["codigo"]."%' ";
$result = mysql_query($q) or die(mysql_error());  
$json_response = array();

while ($row = mysql_fetch_array($result)) {
	$row_array['id'] = $row['id'];
    $row_array['codigo'] = $row['codigo'];
    $row_array['cantidad'] = $row['cantidad'];
    $row_array['monto'] = $row['precio'];
    $row_array['descripcion'] = $row['descripcion'];
    if ($row['cantidad']>0)
    mysql_query('UPDATE articulos SET cantidad = cantidad -'.$_REQUEST["cantidad"].' where codigo = '.$_REQUEST["codigo"])  or die(mysql_error());
   
    array_push($json_response,$row_array);
}
echo json_encode($json_response);
?>