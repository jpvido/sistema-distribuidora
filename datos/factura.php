<?php 
include("../config.php");
 
$query = "select f.*,c.nombre as clinombre from factura f left join cliente c on f.id_cliente=c.id order by f.id desc";
$result = mysql_query($query) or die(mysql_error());  

$json_response = array();

while ($row = mysql_fetch_array($result)) {
    
    $nro_fac = $row['tipo'].'-'.str_pad($row['p_venta'], 4, '0', STR_PAD_LEFT).'-'.str_pad($row['nro'], 8, '0', STR_PAD_LEFT);
    $filepdf = "../pdf/".$nro_fac.".pdf";
    if (!file_exists($filepdf)) continue;
    $row_array['id'] = $row['id'];
    $row_array['f_pago'] = $row['f_pago'];
    $row_array['p_venta'] = $row['p_venta'];
    $row_array['id_cliente'] = $row['clinombre'];
    $row_array['nro'] = $nro_fac;
    $row_array['items'] = $row['items'];
    $row_array['fecha'] = $row['fecha'];
     
    $row_array['operaciones'] = '<button type="button" onclick="ver_factura('."'"."pdf/".$nro_fac.".pdf"."'".')" class="btn btn-primary">Ver Factura</button>
<form target="_blank" action="facturaver.php" method="post" id="frmo'.$row['id'].'">
    <input type="hidden" name="id" value="'.$row['id'].'"/> 
    </form>';

    array_push($json_response,$row_array);

   
}
echo json_encode($json_response);
?>