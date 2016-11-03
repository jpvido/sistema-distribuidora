<?php 
session_start();
$permisos = $_SESSION["XuserP"];
include("../config.php");
$result = mysql_query("select * from proveedores");  
$json_response = array();

while ($row = mysql_fetch_array($result)) {
    $editar = '
    <button type="button" class="btn btn-success" 
    onclick="editar_proveedor('.$row['id'].','."'".$row['razon']."'".','."'".$row['direccion']."'".','."'".$row['cuit']."'".','.$row['iva'].')">Editar</button>';
    $anular='<button type="button" class="btn btn-danger" onclick="eliminar_proveedor('.$row['id'].','."'".$row['descripcion']."'".')">Eliminar</button>
    <form action="" method="post" id="frmo'.$row['id'].'">
    <input type="hidden" name="anular" value="'.$row['id'].'"/> 
    </form>';

    $row_array['razon'] = $row['razon'];
    $row_array['direccion'] = $row['direccion'];
    $row_array['cuit'] = $row['cuit'];
    $row_array['operaciones'] = $editar." ".$anular;
    array_push($json_response,$row_array);
}
echo json_encode($json_response);
?>