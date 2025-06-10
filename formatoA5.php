<?php

/* ------------------------- Requerir de la libreria ------------------------ */

    require 'view/assets/plugins/fpdf/pdf.php';

/* ------------------------- Instanciar la libreria ------------------------- */

    $pdf = new PDF('L','mm',array(210,148));
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
    $parametros_preventa = $this->parametros_preventa;
    $res_array = explode("|",$parametros_preventa);
    $fecha_registro = $res_array[0];
    $tipo_pago_preventa = $res_array[1];
    $codigo_venta = $res_array[5];
    $entrega_preventa = $res_array[6];
    $sumas_preventa = $res_array[6];
    $iva_preventa = $res_array[7];
    $subtotal_preventa = $res_array[8];
    $retencion_preventa = $res_array[9];
    $excento_preventa = $res_array[10];
    $total = $res_array[11];
    $descuento_preventa = $res_array[12];
    $descuento_porcentaje = $res_array[12];
    $prod_exentos = $res_array[13];
    $precio_radio = $res_array[14];
    $observacion = $res_array[16];


/* --------------------------- Agregar una pagina --------------------------- */

    $pdf->AddPage('L','A5');

/* ----------------------- Agregar detalle a la pagina ---------------------- */

/* ---------------------- Bloque del detalle del venta ---------------------- */

    $pdf->Image("archives/assets/sucursales/$logo_sucursal",20,11,18);

    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 10, 190, 20, '1.5', '');

/* ------------------ Bloque cuadro color tipo transaccion ------------------ */

    $pdf->SetFillColor(229);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(97, 14, 15, 12, '1.5', 'F');

/* ------------------ Bloque borde cuadro tipo transaccion ------------------ */

    $pdf->SetFillColor(229);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(97, 14, 15, 12, '1.5', '');

/* --------------------- Letras cuadro tipo transaccion --------------------- */

    $pdf->SetFont('Arial','B',15);
    $pdf->SetXY(102, 16);
    $pdf->Cell(20, 5, 'P', 0 , 0);
    $pdf->SetFont('Arial','B',6);
    $pdf->SetXY(98, 20);
    $pdf->Cell(20, 5, utf8_decode("{$comprobante_tipo}"), 0, 0);

/* ---------------------- Bloque detalle de comprobante --------------------- */

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(124, 14);
    $pdf->Cell(34, 5, utf8_decode("N° DE {$comprobante_tipo}"), 0, 0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(158, 14);
    $pdf->CellFitSpace(40, 5,"{$codigo_venta}", 0, 0, "R");

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(124, 19);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE {$comprobante_tipo} "), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 19);
    $pdf->Cell(40, 4,"{$fecha_registro}", 0, 0, "R");

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(124, 23);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE EMISIÓN"), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 23);
    $pdf->Cell(40, 4,utf8_decode(date("Y-d-m H:i:s")), 0, 0, "R");
    
    

/* ========================================================================== */
/*                          Bloque de datos sucursal                          */
/* ========================================================================== */

/* ----------------------- Bloque de datos de empresa ----------------------- */

    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 32, 190, 37, '1.5', '');

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 33);
    $pdf->Cell(186, 4, 'DATOS DE SUCURSAL ', 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 37);
    $pdf->Cell(24, 4, 'NOMBRE COMERCIAL:', 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(50, 37);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_sucursal} "), 0, 0,'L');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(102, 37);
    $pdf->CellFitSpace(22, 4,utf8_decode("N° DE {$documento_sucursal}"), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(120, 37);
    $pdf->CellFitSpace(28, 4,utf8_decode("{$nro_documento_sucursal} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(145, 37);
    $pdf->Cell(18, 4, utf8_decode('N° DE TELEFONO:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(170, 37);
    $pdf->Cell(28, 4,utf8_decode("{$telefono_sucursal} "), 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 40);
    $pdf->Cell(24, 4, utf8_decode('DIRECCIÓN:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 40);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$direccion_sucursal} "), 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(132, 40);
    $pdf->Cell(12, 4, utf8_decode('EMAIL:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(144, 40);
    $pdf->Cell(54, 4,utf8_decode("{$email_sucursal} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 43);
    $pdf->Cell(24, 4, utf8_decode('RESPONSABLE:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 43);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$responsable_sucursal} "), 0, 0);

/* ========================================================================== */
/*                             Bloque del  cliente                            */
/* ========================================================================== */

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 48);
    $pdf->Cell(186, 4, "DATOS DEL CLIENTE {$CODIGO_cliente}", 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 52);
    $pdf->Cell(24, 4, 'NOMBRE COMERCIAL:', 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(50, 52);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$razon_cliente} "), 0, 0,'L');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(102, 52);
    $pdf->CellFitSpace(22, 4,utf8_decode("N° DE {$documento_cliente} "), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(120, 52);
    $pdf->CellFitSpace(28, 4,utf8_decode("{$nro_documento_cliente} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(145, 52);
    $pdf->Cell(18, 4, utf8_decode('N° DE TELEFONO:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(170, 52);
    $pdf->Cell(28, 4,utf8_decode("{$telefono_cliente} "), 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 55);
    $pdf->Cell(24, 4, utf8_decode('DIRECCIÓN:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 55);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$direccion_cliente} "), 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(132, 55);
    $pdf->Cell(12, 4, utf8_decode('EMAIL:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(144, 55);
    $pdf->Cell(54, 4,utf8_decode("{$correo_cliente} "), 0, 0);
     
/* ========================================================================== */
/*                       Bloque de datos del responsable                      */
/* ========================================================================== */

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 60);
    $pdf->Cell(186, 4, 'DATOS DEL RESPONSABLE ', 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 64);
    $pdf->Cell(24, 4, utf8_decode('NOMBRE:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 64);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(102, 64);
    $pdf->Cell(24, 4, utf8_decode("N° DE {$documento_persona} "), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(120, 64);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nro_documento_persona} "), 0, 0);

/* ========================================================================== */
/*                             Bloque de productos                            */
/* ========================================================================== */
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 71, 190, 30, '0', '');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(10, 71);
    $pdf->SetTextColor(3,3,3);
    $pdf->SetFillColor(229, 229, 229); #Color Gris en la celda
    $pdf->Cell(8, 8,utf8_decode("N°"), 1, 0, 'C', True);
    $pdf->Cell(50, 8,utf8_decode("DESCRIPCIÓN DE PRODUCTO"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("LINEA"), 1, 0, 'C', True);
    $pdf->Cell(31, 8,utf8_decode("CANT"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("P/UNIT"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("SUB TOTAL"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("DESCUENTO"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("V/NETO "), 1, 1, 'C', True);

/* --------------------------- Lista de productos --------------------------- */
    $cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    $pdf->SetWidths(array(8,50,20,31,20,20,20,20));
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
                $cantidad_productos += $row["CANTIDAD"];
                $precio_radio = $row["PRECIO_RADIO"];
                $medida = $row["MEDIDA_{$precio_radio}"];
                $stock_cantidad = floatval($row["STOCK_{$precio_radio}"]);
                $stock = floatval($row["CANTIDAD"])/$stock_cantidad; 
                $pdf->RowFacture([
                    "{$n}",
                    utf8_decode($row['ARTICULO']),
                    utf8_decode($row['LINEA']),
                    $stock_cantidad ."/$stock  ".utf8_decode($medida),
                    "{$moneda} ".number_format($row['PRECIO_'.$precio_radio],2, '.', ','),
                    "{$moneda} ".number_format($row['SUBTOTAL'],2, '.', ','),
                    "{$moneda} ".number_format($row['DESCUENTO'],2, '.', ','),
                    "{$moneda} ".number_format($row['TOTAL'],2, '.', ','),
                    ]);
                $n++;
            }
        }
    }
    // $lista_productos = $this->lista_items;
    // if($lista_productos){
    //     $n = 1;
    //     if($lista_productos->rowCount()>0){
    //         foreach($lista_productos as $row){
    //             $cantidad_productos += $row["CANTIDAD"];
    //             $precio_radio = $row["PRECIO_RADIO"];
    //             $pdf->Cell(8, 5,utf8_decode("{$n}"), 1, 0, 'C');
    //             $pdf->Cell(50, 5,substr(utf8_decode($row['ARTICULO']),0,30), 1, 0, 'C');
    //             $pdf->Cell(20, 5,substr(utf8_decode($row['LINEA']),0,10), 1, 0, 'C');
    //             $pdf->Cell(23, 5,substr(utf8_decode($row['PRESENTACION']),0,10), 1, 0, 'C');
    //             $pdf->Cell(9, 5,number_format($row['CANTIDAD']), 1, 0, 'C');
    //             $pdf->Cell(20, 5,"{$moneda} ".number_format($row["PRECIO_{$precio_radio}"],2), 1, 0, 'C');
    //             $pdf->Cell(20, 5,"{$moneda} ".number_format($row['SUBTOTAL'],2), 1, 0, 'C');
    //             $pdf->Cell(20, 5,"{$moneda} ".number_format($row['DESCUENTO'],2), 1, 0, 'C');
    //             $pdf->Cell(20, 5,"{$moneda} ".number_format($row['TOTAL'],2), 1, 1, 'C');
    //             $n++;
    //         }
    //     }
    // }

/* ------------------------ Fin de lista de producto ------------------------ */

/* ========================================================================== */
/*                        Bloque informacion adicional                        */
/* ========================================================================== */

    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 102, 105, 30, '1.5', '');

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(12, 104);
    $pdf->Cell(105, 4, utf8_decode('INFORMACIÓN ADICIONAL'), 0, 0, 'C');

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 107);
    $pdf->Cell(32, 3, 'CANTIDAD PRODUCTOS:', 0, 0);
    $pdf->SetXY(46, 107);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(15, 3,utf8_decode("{$cantidad_productos}"), 0, 0);


    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 110);
    $pdf->Cell(32, 3, utf8_decode("OBSERVACION: "), 0, 0);
    $pdf->SetXY(40, 110);
    $pdf->SetFont('Arial','',7.5);
    $pdf->MultiCellText(73, 3,utf8_decode("{$observacion}"), 0, 0);
    

   
/* ========================================================================== */
/*                               Bloque totales                               */
/* ========================================================================== */
    //Bloque de Totales de factura
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(120, 102, 80, 30, '1.5', '');

    //Linea de membrete Nro 1
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 104);
    $pdf->CellFitSpace(36, 5, 'SUMAS:', 0, 0);
    $pdf->SetXY(158, 104);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($sumas_preventa,2), 0, 0, "R");

    //Linea de membrete Nro 2
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 107);
    $pdf->CellFitSpace(36, 5, "IVA {$iva} %", 0, 0);
    $pdf->SetXY(158, 107);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($iva_preventa,2), 0, 0, "R");

    //Linea de membrete Nro 3
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 110);
    $pdf->CellFitSpace(36, 5, 'SUB TOTAL', 0, 0);
    $pdf->SetXY(158, 110);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($subtotal_preventa,2), 0, 0, "R");

    //Linea de membrete Nro 4
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 113);
    $pdf->CellFitSpace(36, 5,utf8_decode("RETENCIÓN - {$iva} %"), 0, 0);
    $pdf->SetXY(158, 113);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"-"." {$moneda} ".number_format($retencion_preventa,2), 0, 0, "R");

    //Linea de membrete Nro 5
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 116);
    $pdf->CellFitSpace(36, 5, "EXENTO:", 0, 0);
    $pdf->SetXY(158, 116);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($excento_preventa,2), 0, 0, "R");

    //Linea de membrete Nro 6
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 119);
    $pdf->CellFitSpace(36, 5, 'DESCUENTO:', 0, 0);
    $pdf->SetXY(158, 119);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($descuento_preventa,2), 0, 0, "R");  

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 122);
    $pdf->CellFitSpace(36, 5, 'TOTAL:', 0, 0);
    $pdf->SetXY(158, 122);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($total,2), 0, 0, "R");
    
    $pdf->Output();
?>