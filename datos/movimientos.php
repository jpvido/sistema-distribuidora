<?php 
include("../config.php");

if ($_REQUEST["fi"]==$_REQUEST["ff"])
$result = mysql_query("
select * from movimientos where fecha >='".$_REQUEST["fi"]."' ");  
else
{
$fecha = $_REQUEST["ff"];
$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
$_REQUEST["ff"] = $nuevafecha;

$result = mysql_query("
select * from movimientos where fecha >='".$_REQUEST["fi"]."' and fecha  <= '".$_REQUEST["ff"]."' ");  
}
$json_response = array();
$total = 0;
if ($_REQUEST["fi"]==$_REQUEST["ff"])
$restotal = mysql_query("
select sum(monto) as total from movimientos where fecha >='".$_REQUEST["fi"]."' ");  
else
$restotal = mysql_query("
select sum(monto) as total from movimientos where fecha >='".$_REQUEST["fi"]."' and fecha <= '".$_REQUEST["ff"]."' ");  
$rowt = mysql_fetch_array($restotal);
$total = $rowt['total'];
if ($total == "") $total = 0;
while ($row = mysql_fetch_array($result)) {
if ($row["tipo"]=='v')
    $anular=' <button type="button" class="btn btn-success" onclick="detalle_movimiento('.$row['id'].')">Detalle</button>';
else
    $anular = "";

    $row_array['descripcion'] = $row['descripcion'];

    $sq = 'SELECT IFNULL(max(cliente),0) AS id_cliente ,IFNULL(cli.nombre," ") as nom_cliente from cuenta c 
inner JOIN cliente cli on cli.id = cliente
where venta = '.$row['id'];
	$r = mysql_fetch_array(mysql_query($sq));
    $row_array['descripcion'] = $row['descripcion']." ".$r["nom_cliente"];

    $row_array['fecha'] = $row['fecha'];
    $row_array['monto'] = '$'.round($row['monto'],2);
  
    $row_array['operaciones'] = $anular;
    array_push($json_response,$row_array);
}

$row_array['descripcion'] = '<b>TOTAL</b>';
$row_array['fecha'] = '';
$row_array['monto'] = '<b>$'.round($total,2).'</b>';
$row_array['operaciones'] = '';

array_push($json_response,$row_array);


echo json_encode($json_response);
?>