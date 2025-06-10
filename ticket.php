<?php
require('view/assets/plugins/fpdf/pdf.php');

$pdf = new PDF('P','mm',array(70,150));
$pdf->AddPage();
 
/* ---------------------- Llamar datos de la sucursal ----------------------- */
$parametros_sucursal = $this->parametros_sucursal;
$nombre_sucursal = $parametros_sucursal["NOMBRE"];
$logo_sucursal = $parametros_sucursal["LOGO"];
$documento_sucursal = $parametros_sucursal["DOCUMENTO"];
$direccion_sucursal = $parametros_sucursal["DIRECCION"];
$email_sucursal = $parametros_sucursal["EMAIL"];
$nro_documento_sucursal = $parametros_sucursal["NUMERO"];
$telefono_sucursal = $parametros_sucursal["TELEFONO"];
$responsable_sucursal = $parametros_sucursal["REPRESENTANTE"];
$moneda = $parametros_sucursal["MONEDA"];
$iva = $parametros_sucursal["IVA"];



/* ----------------------- Llamar datos del comprobante---------------------- */
$comprobante_tipo = "ARQUEOS";
$id_venta = $this->id_venta;
$parametros_venta = $this->parametros_venta;
$res_array = explode("|",$parametros_venta);
$fecha_arqueos = $res_array[0];
$fecha_cierre= $res_array[1] == '0000-00-00 00:00:00' ? 'CAJA ACTIVA' : $res_array[1] ;
$monto_inicial= $res_array[4];
$nro_caja = $res_array[2];
$nombre_caja = $res_array[3];
$ingresos = $res_array[6];
$egresos = $res_array[7];
$creditos= $res_array[8];
$abonos= $res_array[9];
$dinero_efectivo= $res_array[10];
$diferencia= $res_array[11];
$comentarios = $res_array[12];
$vendedor = $res_array[13];
$nro_caja = $res_array[14];
$nombre_caja = $res_array[15];
$total_caja= (((($monto_inicial+$ingresos)-$egresos)-$creditos)+$abonos)-$diferencia;

// CABECERA
$pdf->SetFont('Arial','B',12);
$pdf->SetX(3);
$pdf->Cell(64,4,'ARQUEO DE CAJA',0,1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->SetX(3);
$pdf->Cell(64,4,utf8_decode("{$nombre_sucursal} "),0,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->CellFitSpace(64, 4,utf8_decode("{$direccion_sucursal} "),0,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(64, 4, utf8_decode("N° DE {$documento_sucursal} :")." ".utf8_decode("{$nro_documento_sucursal} "), 0, 1,'C');


$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "HORA DE APERTURA:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode($fecha_arqueos), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "HORA DE CIERRE:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode($fecha_cierre), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "VENDEDOR:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode($vendedor), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "NRO CAJA:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode($nro_caja), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "NOMBRE CAJA:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode($nombre_caja), 0, 1, "R");

$pdf->Ln(2);
$pdf->SetX(3);
$pdf->Cell(64,0,'','T');
$pdf->Ln(2);


$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "MONTO INICIAL:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($monto_inicial,2), 0, 1, "R");
//Linea de membrete Nro 4
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "INGRESOS:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($ingresos,2), 0, 1, "R");

//Linea de membrete Nro 6
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, 'EGRESOS:', 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($egresos,2), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "CREDITOS:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($creditos,2), 0, 1, "R");


$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "ABONOS:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($abonos,2), 0, 1, "R");



$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "DIFERENCIA:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($diferencia,2), 0, 1, "R");
$pdf->SetX(3);

$pdf->Cell(64,0,'','T');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "TOTAL EN CAJA:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($total_caja,2), 0, 1, "R");
$pdf->SetX(3);

$pdf->Ln(3);
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(64,4,'---------------------------- COMENTARIOS----------------------------',0,1,'C');
$pdf->SetX(3);
$pdf->SetFont('Arial','',7);
$pdf->MultiCellText(64, 4,utf8_decode("{$comentarios}"),0,0);


$pdf->Output();
?>