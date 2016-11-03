<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
require('fpdf/fpdf.php');
require('fpdf/nal.php');

include("config.php");

define('EURO',chr(128));

$id_cliente = $_POST['cliente'];

if ($_REQUEST["id"] =='') die('NO HAY DATOS');

//$itemsarray = json_decode($_POST["items"]);
//$items = join(',',$itemsarray);

$items = $_REQUEST["id"];
$fecha = date("d/m/Y"); 
//print_r($items);

$iva[0] = 'Responsable Inscripto';
$iva[1] = 'Responsable Monotributo';
$iva[2] = 'Consumidor Final';
$iva[3] = 'Exento';

$resultcuenta = mysql_query("select * from cuenta where id = ".$items) or die(mysql_error()." 1");  
$rowcuenta = mysql_fetch_array($resultcuenta);
$id_cliente = $rowcuenta["id_cliente"];

if ($id_cliente!="0"){
$resultcli = mysql_query("select * from cliente where id = ".$id_cliente) or die(mysql_error()." 2");  
$rowcli = mysql_fetch_array($resultcli);
//cliente
$cliente_razon = $rowcli['nombre'];
$cliente_domicilio = $rowcli['domicilio'];
$cliente_cuit = $rowcli['cuit'];
$cliente_iva_id = (int)$rowcli['facturacion'];
$cliente_iva = $iva[$cliente_iva_id];

}else{

//cliente
$cliente_razon = "";
$cliente_domicilio = "";
$cliente_cuit = "";
$cliente_iva_id = 2;
$cliente_iva = $iva[$cliente_iva_id];

}

$titular = "FR REPARACIONES";
$razon = "Fernando Gabriel Ruiz";
$domicilio = 'Moreno 1117 - Laguna Paiva';
$cuit = '20-35290546-2';
$ingresos_brutos = '011-159976-5';
$fecha_inicio = '01/07/2013';
$iva = 'Responsable Monotributo';


$tipo_factura = 'R';

$nro_comp = $items;

$punto_venta = $p_venta;
$nro_factura = str_pad($nro_comp, 8, '0', STR_PAD_LEFT);
$condicion_venta = $f_pago;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);


$pdf->Cell(190/2,25,"",1,0,'L');
$pdf->Cell(190/2,25,"",1,0,'L');
$pdf->SetX(15); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,$titular,0,0,'L');

$pdf->SetX(115); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"Detalle de compra",0,0,'L');
$pdf->Ln(5);
$pdf->SetX(115);
$pdf->SetFont('Arial',$tipo_factura,8);
$pdf->Cell(40,10,"Fecha de emision: ".$fecha,0,0,'L');

$pdf->Ln(4);
$pdf->SetX(115);
$pdf->Cell(40,10,"CUIT: ".$cuit,0,0,'L');
$pdf->Ln(4);
$pdf->SetX(115);
$pdf->Cell(40,10,"Ingresos brutos: ".$ingresos_brutos,0,0,'L');
$pdf->Ln(4);
$pdf->SetX(115);
$pdf->Cell(40,10,"Fecha de inicio de actividades: ".$fecha_inicio,0,0,'L');

$pdf->Ln(0);
$pdf->SetY(15);
$pdf->SetX(15);
$pdf->Cell(50,10,"Razon social: ".$razon,0,0,'L');
$pdf->Ln(4);
$pdf->SetX(15);
$pdf->Cell(50,10,"Domicilio comercial: ".$domicilio,0,0,'L');
$pdf->Ln(4);
$pdf->SetX(15);
$pdf->Cell(50,10,"Condicion frente al IVA: ".$iva,0,0,'L');


$pdf->Ln(5);
$pdf->SetY(10);
$pdf->SetX(190/2+2);
$pdf->SetFont('Arial','B',24);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(15,15,"X",1,0,'C',true);
$pdf->Ln(25);
$pdf->Cell(190,20,"",1,0,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,5,"Razon Social: ".$cliente_razon,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(190,5,"Domicilio: ".$cliente_domicilio,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(190,5,"CUIT: ".$cliente_cuit,0,0,'L');
//$pdf->Ln(5);
//$pdf->Cell(190,5,"IVA: ".$cliente_iva,0,0,'L');

$pdf->Ln(5);


$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(30,5,'CANTIDAD ',1,0,'C',true);
$pdf->Cell(130,5,'DETALLE',1,0,'C',true);
//$pdf->Cell(30,5,'PRECIO U.',1,0,'C',true);
$pdf->Cell(30,5,'SUBTOTAL',1,0,'C',true);

$result2 = mysql_query("select * from cuenta where id in (".$items.")") or die(mysql_error()." 3");  
$total = (float)0;
while ($row2 = mysql_fetch_array($result2))

{
//$row2['monto'] = -$row2['monto'];
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30,5,$row2['cantidad'],1,0,'C');
$pdf->Cell(130,5,$row2['descripcion'],1,0,'');
//$pdf->Cell(30,5,'$'.$row2['monto'],1,0,'C');
$tot = ((float)$row2['cantidad']*(float)$row2['monto']);
$pdf->Cell(30,5,'$ '.$tot,1,0,'C');
$total = $total + $tot;
}

$pdf->Ln(5);
$pdf->Cell(190,10,'TOTAL: $ '.$total,1,0,'R');



$pdf->Output();
?>