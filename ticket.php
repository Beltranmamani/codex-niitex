<?php
require('view/assets/plugins/fpdf/pdf1.php');

$pdf = new PDF('P','mm',array(80,230));
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

/* ---------------------------- Datos del cliente --------------------------- */

$parametros_cliente = $this->parametros_cliente;
$CODIGO_cliente = $parametros_cliente["ID_CLIENTE"];

$razon_cliente = $parametros_cliente["RAZON"];
$documento_cliente = $parametros_cliente["DOCUMENTO"];
$nro_documento_cliente = $parametros_cliente["N_DOCUMENTO"];
$direccion_cliente = $parametros_cliente["DIRECCION"];
$telefono_cliente = $parametros_cliente["TELEFONO"];
$correo_cliente = $parametros_cliente["CORREO"];

/* ----------------- llamar datos de la persona responsable ----------------- */
$parametros_persona = $this->parametros_persona;
$nombre_persona = $parametros_persona["NOMBRE"];
$apellidos_persona = $parametros_persona["APELLIDO"];
$documento_persona = $parametros_persona["DOCUMENTO"];
$nro_documento_persona = $parametros_persona["NUMERO"];

/* ----------------------- Llamar datos del comprobante---------------------- */
$comprobante_tipo = "PREVENTA";
$id_venta = $this->id_venta;
$parametros_venta = $this->parametros_preventa;
$res_array = explode("|",$parametros_venta);
$fecha_venta = $res_array[0];
$tipo_pago_venta = $res_array[1];
$codigo_venta = $res_array[5];
$entrega_venta = $res_array[6];
$sumas_venta = $res_array[6];
$iva_venta = $res_array[7];
$subtotal_venta = $res_array[8];
$retencion_venta = $res_array[9];
$excento_venta = $res_array[10];
$descuento_venta = $res_array[12];
$importe_venta = $res_array[11];
$comprobante_venta = $res_array[13];
$nro_comprobante_venta = $res_array[14];
$metodo_pago_venta = $res_array[15];
$pago_efectivo = $res_array[16];







// CABECERA
$pdf->SetFont('Arial','B',12);
$pdf->SetX(3);
$pdf->Cell(77,4,'TICKET DE PREVENTA',0,1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->SetX(3);
$pdf->Cell(77,4,utf8_decode("{$nombre_sucursal} "),0,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->CellFitSpace(64, 4,utf8_decode("{$direccion_sucursal} "),0,1,'C');;

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(77, 4, utf8_decode("N° DE {$documento_sucursal} :")." ".utf8_decode("{$nro_documento_sucursal} "), 0, 1,'C');

$pdf->SetFont('Arial','',7);
$pdf->SetX(3);
$pdf->Cell(77, 4, utf8_decode("FECHA DE EMISIÓN").": ".utf8_decode(date("Y-d-m H:i:s") )  , 0, 1,'C');



$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(77,4,'------------------------------------------- CLIENTE -----------------------------------------',0,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetX(3);
$pdf->Cell(77, 4, utf8_decode("CODIGO ")." : ".utf8_decode("{$CODIGO_cliente} " )  , 0, 1,'C');
$pdf->SetX(3);
$pdf->Cell(77, 4, utf8_decode("{$documento_cliente} ")." : ".utf8_decode("{$nro_documento_cliente} " )  , 0, 1,'C');
$pdf->SetX(3);
$pdf->Cell(77, 4, "Direccion: {$direccion_cliente}"  , 0, 1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetX(3);
$pdf->Cell(77, 4, "Telefono: {$telefono_cliente}"  , 0, 1,'C');
$pdf->SetX(3);
$pdf->Cell(77, 4, "Correo: {$correo_cliente}"  , 0, 1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetX(3);
$pdf->CellFitSpace(77, 4,"Cliente: ".utf8_decode("{$razon_cliente} "),0,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);


$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(77,4,'---------------------------------------PRODUCTOS -------------------------------------',0,1,'C');


$pdf->SetX(3);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20, 4,utf8_decode("CANT"));
$pdf->SetFont('Arial','B',7);
$pdf->Cell(34, 4, utf8_decode(" PRODUCTO " ));
$pdf->SetFont('Arial','B',7);
$pdf->Cell(10, 4, utf8_decode("IVA" ));

$pdf->Ln(3);
$pdf->SetX(3);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(16, 4, utf8_decode("LINEA"));
$pdf->SetFont('Arial','B',7);
$pdf->Cell(16, 4, utf8_decode("P/UNIT " ));
$pdf->SetFont('Arial','B',7);
$pdf->Cell(16, 4,utf8_decode("DCTO" ));
$pdf->SetFont('Arial','B',7);
$pdf->Cell(16, 4,utf8_decode("TOTAL " ));


$pdf->Ln(5);
$pdf->SetX(3);
$pdf->Cell(74,0,'','T');
$pdf->Ln(0);

$pdf->SetFont('Arial','',7);
$cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
                $pr = $row['PRECIO_RADIO'];
                $precio_radio = $row['PRECIO_RADIO'];
                $cantidad_productos += $row["CANTIDAD"];
                $medida = $row["MEDIDA_{$precio_radio}"];
                $stock_cantidad = floatval($row["STOCK_{$precio_radio}"]);
                $stock = floatval($row["CANTIDAD"])/$stock_cantidad; 
                $pdf->Ln(2);
                $pdf->SetX(3);
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(20, 4,$stock_cantidad ."/$stock  ".utf8_decode($medida));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(34, 4, substr(utf8_decode($row['ARTICULO']),0,18));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(5, 4, "{$moneda} ".number_format($iva_venta,2));
                
                
                $pdf->Ln(4);
                $pdf->SetFont('Arial','',7);
                $pdf->SetX(3);
                $pdf->Cell(16, 4, substr(utf8_decode($row['LINEA']),0,10));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(16, 4, "{$moneda} ".number_format($row['PRECIO_'.$pr],2));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(16, 4,"{$moneda} ".number_format($row['DESCUENTO'],2));
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(16, 4,"{$moneda} ".number_format($row['TOTAL'],2));
                $pdf->Ln(4);

                $n++;
            }
        }
    }

$pdf->Ln(2);
$pdf->SetX(3);
$pdf->Cell(74,0,'','T');
$pdf->Ln(0);

$pdf->Ln(1);
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4, 'SUMAS:', 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"{$moneda} ".number_format($sumas_venta,2), 0, 1, "R");

//Linea de membrete Nro 2
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4, "IVA {$iva} %", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"{$moneda} ".number_format($iva_venta,2), 0, 1, "R");

//Linea de membrete Nro 3
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4, 'SUB TOTAL', 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"{$moneda} ".number_format($subtotal_venta,2), 0, 1, "R");

//Linea de membrete Nro 4
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4,utf8_decode("RETENCIÓN - {$iva} %"), 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"-"." {$moneda} ".number_format($retencion_venta,2), 0, 1, "R");

//Linea de membrete Nro 4
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4, "EXENTO:", 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"{$moneda} ".number_format($excento_venta,2), 0, 1, "R");

//Linea de membrete Nro 6
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4, 'DESCUENTO:', 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"{$moneda} ".number_format($descuento_venta,2), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(44, 4, 'IMPORTE TOTAL:', 0, 0,'R');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0, 4,"{$moneda} ".number_format($importe_venta,2), 0, 1, "R");




$pdf->Ln(1);
$pdf->SetFont('Arial','B',7);
$pdf->SetX(3);
$pdf->Cell(77,4,'----------------------------- INFORMACION ADICIONAL ----------------------------',0,1,'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','',7);
$pdf->SetX(3);
$pdf->CellFitSpace(77, 4,utf8_decode('CAJERO:')." ".utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 1,'C');




$pdf->Output();
?>