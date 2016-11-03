<?php 
include("../config.php");

$sql = "select sum(monto*cantidad) as total, sum(cantidad) as sum_art, max(id) as ultimo from venta";
$res = mysql_query($sql);
$total = mysql_fetch_array($res);
$tot = 0;
if (isset($total["total"])) $tot = $total["total"];
$tot = round($tot,2);
$sum_art = 0;
if (isset($total["sum_art"])) $sum_art = $total["sum_art"];

$sql = "select ifnull(max(venta),0)+1 as ventaact from ingreso";
$res = mysql_query($sql);
$vent = mysql_fetch_array($res);
$nro_venta = $vent["ventaact"];

$json_response = array();

    $row_array['total'] = $tot;
    $row_array['cantidad'] = $sum_art;
    $row_array['ultimo'] = $total["ultimo"];
    array_push($json_response,$row_array);

echo json_encode($json_response);
?>