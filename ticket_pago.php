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
// $comprobante_tipo = "ARQUEOS";
// $id_venta = $this->id_venta;
$parametros_pago = $this->parametros_pago_credito;

// $fecha_arqueos = $res_array[0];
// $fecha_cierre= $res_array[1] == '0000-00-00 00:00:00' ? 'CAJA ACTIVA' : $res_array[1] ;
// $monto_inicial= $res_array[4];
// $nro_caja = $res_array[2];
// $nombre_caja = $res_array[3];
// $ingresos = $res_array[6];
// $egresos = $res_array[7];
// $creditos= $res_array[8];
// $abonos= $res_array[9];
// $dinero_efectivo= $res_array[10];
// $diferencia= $res_array[11];
// $comentarios = $res_array[12];
// $vendedor = $res_array[13];
// $nro_caja = $res_array[14];
// $nombre_caja = $res_array[15];


// CABECERA
$pdf->SetFont('Arial','B',12);
$pdf->SetX(3);
$pdf->Cell(64,4,'TICKET PAGO DE CREDITO',0,1,'C');

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
$pdf->Cell(34, 4, "", 0, 1,'R');
$pdf->SetX(3);
$pdf->Cell(24, 4, "FECHA DE PAGO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,utf8_decode($parametros_pago['FECHA_REGISTRO']), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "COMPRA:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,utf8_decode($parametros_pago['N_COMPRA']), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "CREDITO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,utf8_decode($parametros_pago['N_CREDITO']), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "PROVEEDOR:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,substr(utf8_decode($parametros_pago['PROVEEDOR']),0,20), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "DOCUMENTO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,utf8_decode($parametros_pago["DOC_PROVEE"]), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "DIRECCION:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,substr(utf8_decode($parametros_pago["DIRECCION"]),0,20), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->Ln(1);
$pdf->SetX(3);
$pdf->Cell(64,4,'--------------------------------- CAJA---------------------------------',0,1,'C');
$pdf->Ln(1);

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "NRO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,substr(utf8_decode($parametros_pago["NRO_CAJA"]),0,20), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "CAJA:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,substr(utf8_decode($parametros_pago["NOMBRE_CAJA"]),0,20), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(24, 4, "VENDEDOR:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(34, 4,substr(utf8_decode($parametros_pago["VENDEDOR"]),0,20), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->Ln(1);
$pdf->SetX(3);
$pdf->Cell(64,4,'-------------------------------- PAGO --------------------------------',0,1,'C');
$pdf->Ln(1);

$pdf->SetX(3);
$pdf->Cell(22, 4, "CREDITO TOTAL:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20, 4,"{$moneda} ".number_format($parametros_pago["TOTAL"],2), 0, 1, "L");
//Linea de membrete Nro 4
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(22, 4, "PENDIENTE:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20, 4,"{$moneda} ".number_format($parametros_pago["PAGADO_AC"],2), 0, 1, "L");

//Linea de membrete Nro 6
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(22, 4, 'PAGADO:', 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20, 4,"{$moneda} ".number_format($parametros_pago["PAGADO"],2), 0, 1, "L");

$pdf->Ln(1);

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(22, 4, "MONTO ABONO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20, 4,"{$moneda} ".number_format($parametros_pago["MONTO"],2), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(22, 4, "PAGO CON:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20, 4,"{$moneda} ".number_format($parametros_pago["PAGO_CON"],2), 0, 1, "L");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(22, 4, "CAMBIO:", 0, 0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20, 4,"{$moneda} ".number_format($parametros_pago["CAMBIO"],2), 0, 1, "L");





$pdf->Output();
?>