<?php 
include("../config.php");
$result = mysql_query("select * from reparaciones order by id desc");  
$json_response = array();

while ($row = mysql_fetch_array($result)) {
    $row_array['id'] = $row['id'];
    $row_array['fecha'] = $row['fecha'];
    $row_array['nombre'] = $row['nombre'];
    $row_array['direccion'] = $row['direccion'];
    $row_array['equipo'] = $row['equipo'];
    $row_array['telefono'] = $row['telefono'];
    $row_array['fallas'] = $row['fallas'];
    $row_array['observaciones'] = $row['observaciones'];
    $row_array['operaciones'] = '
<button type="button" class="btn btn-info" 
    onclick="imprimir_orden('.$row['id'].')">Imprimir</button>
    <button type="button" class="btn btn-danger" onclick="eliminar_material('.$row['id'].','."'".$row['descripcion']."'".')">Eliminar</button>
    <form action="" method="post" id="frmo'.$row['id'].'">
    <input type="hidden" name="anular" value="'.$row['id'].'"/>	
    </form>';
    array_push($json_response,$row_array);
}
echo json_encode($json_response);
?>