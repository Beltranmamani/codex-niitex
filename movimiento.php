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



$movimiento = $this->parametros;

// CABECERA
$pdf->SetFont('Arial','B',12);
$pdf->SetX(3);
$pdf->Cell(64,4,'MOVIMIENTO DE CAJA',0,1,'C');

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

$pdf->Cell(34, 4, "FECHA-HORA:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode($movimiento->FECHAMOVIMIENTO), 0, 1, "R");


$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "VENDEDOR:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode("{$movimiento->VENDEDOR}"), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "NRO CAJA:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode("{$movimiento->NRO_CAJA}"), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(34, 4, "NOMBRE CAJA:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(24, 4,utf8_decode("{$movimiento->NOMBRE_CAJA}"), 0, 1, "R");

$pdf->Ln(2);
$pdf->SetX(3);
$pdf->Cell(64,0,'','T');
$pdf->Ln(2);


$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "MONTO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$moneda} ".number_format($movimiento->MONTOMOVIMIENTO,2), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "METODO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$this->tipomovimiento}", 0, 1, "R");
//Linea de membrete Nro 4
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "TIPO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(44, 4,"{$movimiento->TIPOMOVIMIENTO}", 0, 1, "R");
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(20, 4, "DETALLE:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->MultiCellText(44, 4,"{$movimiento->DESCRIPCIONMOVIMIENTO}", 0, 1, "R");
$pdf->Output();
?>