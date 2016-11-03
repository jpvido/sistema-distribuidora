<?php 
include("../config.php");
$total = 0;
$restotal = mysql_query("
select sum(monto) as total from ingreso where venta=".$_REQUEST["id"]);  
$rowt = mysql_fetch_array($restotal);
$total = $rowt['total'];

$result = mysql_query("
select * from ingreso where venta=".$_REQUEST["id"]);  
$json_response = array();
while ($row = mysql_fetch_array($result)) {

    $row_array['descripcion'] = $row['descripcion'];
    $row_array['monto'] = '$'.$row['monto'];
    array_push($json_response,$row_array);
}
$row_array['descripcion'] = '<b>TOTAL</b>';
$row_array['monto'] = '<b>$'.round($total,2).'</b>';
array_push($json_response,$row_array);

echo json_encode($json_response);
?>