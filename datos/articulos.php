<?php 
include("../config.php");
$result = mysql_query("select id,codigo,descripcion,cantidad,cantidad_minima,precio,detalle from articulos");  
$json_response = array();

while ($row = mysql_fetch_array($result)) {
    $row_array['codigo'] = $row['codigo'];
    $row_array['descripcion'] = $row['descripcion'];
    $row_array['cantidad'] = $row['cantidad'];
    $row_array['cantidad_minima'] = $row['cantidad_minima'];
    $row_array['precio'] = '$'.$row['precio'];
    $row_array['operaciones'] = '
<button type="button" class="btn btn-info" 
    onclick="verdetalle('."'".$row['detalle']."'".')">Detalle</button>
    <button type="button" class="btn btn-success" 
    onclick="editar_material('.$row['id'].','."'".$row['codigo']."'".','."'".base64_encode($row['descripcion'])."'".','.$row['cantidad'].','.$row['cantidad_minima'].','.$row['precio'].','."'".$row['detalle']."'".')">Editar</button>
    <button type="button" class="btn btn-danger" onclick="eliminar_material('.$row['id'].','."'".$row['descripcion']."'".')">Eliminar</button>
    <form action="" method="post" id="frmo'.$row['id'].'">
    <input type="hidden" name="anular" value="'.$row['id'].'"/>	
    </form>';
    array_push($json_response,$row_array);
}
echo json_encode($json_response);
?>