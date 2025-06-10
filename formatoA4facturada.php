<?php

/* ------------------------- Requerir de la libreria ------------------------ */

    require 'view/assets/plugins/fpdf/pdf.php';

/* ------------------------- Instanciar la libreria ------------------------- */

    $pdf = new PDF();
/* ---------------------- Llamar datos de la sucursal ----------------------- */
    $parametros_sucursal = $this->parametros_sucursal;
    $parametros_libro_compra = $this->parametros_libro_compra;
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

/* --------------------------- Datos del proveedor -------------------------- */
    $parametros_proveedor = $this->parametros_proveedor;
    $razon_proveedor = $parametros_proveedor["RAZON"];
    $documento_proveedor = $parametros_proveedor["DOCUMENTO"];
    $nro_documento_proveedor = $parametros_proveedor["N_DOCUMENTO"];
    $direccion_proveedor = $parametros_proveedor["DIRECCION"];
    $telefono_proveedor = $parametros_proveedor["TELEFONO"];
    $correo_proveedor = $parametros_proveedor["CORREO"];
    $vendedor_proveedor = $parametros_proveedor["VENDEDOR"];

/* ----------------- llamar datos de la persona responsable ----------------- */
    $parametros_persona = $this->parametros_persona;
    $nombre_persona = $parametros_persona["NOMBRE"];
    $apellidos_persona = $parametros_persona["APELLIDO"];
    $documento_persona = $parametros_persona["DOCUMENTO"];
    $nro_documento_persona = $parametros_persona["NUMERO"];
/* ----------------------- Llamar datos del comprobante---------------------- */
    $comprobante_tipo = utf8_decode("COMPRA");
    $id_compra = $this->id_compra;
    $parametros_compra = $this->parametros_compra;
    $res_array = explode("|",$parametros_compra);
    $fecha_compra = $res_array[3];
    $tipo_pago_compra = $res_array[4];
    $nr_comprobante_compra = $res_array[8];
    $Comprobante_compra = $res_array[9];
    $sumas_compra = $res_array[10];
    $iva_compra = $res_array[11];
    $subtotal_compra = $res_array[12];
    $retenido_compra = $res_array[13];
    $exentos_compra = $res_array[14];
    $total_compra = $res_array[15];
    $nro_compra = $res_array[16];

/* --------------------------- Agregar una pagina --------------------------- */

    $pdf->AddPage('P','A4');

/* ----------------------- Agregar detalle a la pagina ---------------------- */

/* ---------------------- Bloque del detalle del venta ---------------------- */

    $pdf->Image("archives/assets/sucursales/$logo_sucursal",11,11,18);
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 10, 190, 20, '1.5', '');

/* ------------------ Bloque cuadro color tipo transaccion ------------------ */

    $pdf->SetFillColor(229);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(98, 14, 12, 12, '1.5', 'F');

/* ------------------ Bloque borde cuadro tipo transaccion ------------------ */

    $pdf->SetFillColor(229);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(98, 14, 12, 12, '1.5', '');

/* --------------------- Letras cuadro tipo transaccion --------------------- */

    $pdf->SetFont('Arial','B',15);
    $pdf->SetXY(101, 16);
    $pdf->Cell(20, 5, 'C', 0 , 0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(98, 20);
    $pdf->Cell(20, 5, 'Compra', 0, 0);

/* ---------------------- Bloque detalle de comprobante --------------------- */

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(124, 12);
    $pdf->Cell(34, 5, utf8_decode("N° DE {$comprobante_tipo}"), 0, 0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(158, 12);
    $pdf->CellFitSpace(40, 5,"{$id_compra}", 0, 0, "R");

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(124, 17);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE {$comprobante_tipo} "), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 17);
    $pdf->Cell(40, 4,"{$fecha_compra}", 0, 0, "R");

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(124, 21);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE EMISIÓN"), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 21);
    $pdf->Cell(40, 4,utf8_decode(date("Y-d-m H:i:s")), 0, 0, "R");
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(124, 25);
    $pdf->Cell(34, 4, 'TIPO DE PAGO', 0, 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(158, 25);
    $pdf->Cell(40, 4,utf8_decode("{$tipo_pago_compra }"), 0, 0, "R");

/* ========================================================================== */
/*                          Bloque de datos sucursal                          */
/* ========================================================================== */

/* ----------------------- Bloque de datos de empresa ----------------------- */

    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 32, 190, 48, '1.5', '');

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
/*                         Bloque de datos Proveedor                          */
/* ========================================================================== */

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 48);
    $pdf->Cell(186, 4, 'DATOS DE PROVEEDOR ', 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 52);
    $pdf->Cell(24, 4, 'NOMBRE COMERCIAL:', 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(50, 52);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$razon_proveedor} "), 0, 0,'L');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(102, 52);
    $pdf->CellFitSpace(22, 4,utf8_decode("N° DE {$documento_proveedor} "), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(120, 52);
    $pdf->CellFitSpace(28, 4,utf8_decode("{$nro_documento_proveedor} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(145, 52);
    $pdf->Cell(18, 4, utf8_decode('N° DE TELEFONO:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(170, 52);
    $pdf->Cell(28, 4,utf8_decode("{$telefono_proveedor} "), 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 55);
    $pdf->Cell(24, 4, utf8_decode('DIRECCIÓN:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 55);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$direccion_proveedor} "), 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(132, 55);
    $pdf->Cell(12, 4, utf8_decode('EMAIL:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(144, 55);
    $pdf->Cell(54, 4,utf8_decode("{$correo_proveedor} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 58);
    $pdf->Cell(24, 4, utf8_decode('VENDEDOR:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 58);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$vendedor_proveedor} "), 0, 0);
    
    
/* ========================================================================== */
/*                       Bloque de datos del responsable                      */
/* ========================================================================== */

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 63);
    $pdf->Cell(186, 4, 'DATOS DEL RESPONSABLE ', 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 67);
    $pdf->Cell(24, 4, utf8_decode('NOMBRE:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 67);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(102, 67);
    $pdf->Cell(24, 4, utf8_decode("N° DE {$documento_persona} "), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(120, 67);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nro_documento_persona} "), 0, 0);
    
    
    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 71);
    $pdf->Cell(186, 4, 'DATOS DE LA FACTURA ', 0, 1);
    $pdf->SetFont('Arial','B',7);
    $pdf->SetX(12);
    $pdf->Cell(30, 4, utf8_decode("CODIGO DE CONTROL :"), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(38, 4, utf8_decode("{$parametros_libro_compra['CODIGO_CONTROL']}"), 0, 0);
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(30, 4, utf8_decode("No AUTORIZACION :"), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(36, 4, utf8_decode("{$parametros_libro_compra['NRO_AUTORIZACION']}"), 0, 0);
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(22, 4, utf8_decode("No FACTURA :"), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(36, 4, utf8_decode("{$parametros_libro_compra['NRO_FACTURA']}"), 0, 0);

/* ========================================================================== */
/*                             Bloque de productos                            */
/* ========================================================================== */
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 80, 190, 173, '0', '');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(10, 80);
    $pdf->SetTextColor(3,3,3);
    $pdf->SetFillColor(229, 229, 229); #Color Gris en la celda
    $pdf->Cell(8, 8,utf8_decode("N°"), 1, 0, 'C', True);
    $pdf->Cell(52, 8,utf8_decode("DESCRIPCIÓN DE PRODUCTO"), 1, 0, 'C', True);
    $pdf->Cell(25, 8,utf8_decode("LINEA"), 1, 0, 'C', True);
    $pdf->Cell(35, 8,utf8_decode("PRESENTACION"), 1, 0, 'C', True);
    $pdf->Cell(10, 8,utf8_decode("CANT"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("P/UNIT"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("VENCIMIENTO"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("V/NETO "), 1, 1, 'C', True);

/* --------------------------- Lista de productos --------------------------- */
    $cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    $pdf->SetWidths(array(8,52,25,35,10,20,20,20));
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
                $cantidad_productos += $row["CANTIDAD"];
                $fecha_vencimiento = $row["FECHA_VENCIMIENTO"];
                if($fecha_vencimiento == "0000-00-00"){
                    $fecha_vencimiento = "No caducable";
                }
                $importe = number_format($row['CANTIDAD']*$row['PRECIO_COSTO'],2,'.', ',');
                $pdf->RowFacture([
                    "{$n}",
                    utf8_decode($row['ARTICULO']),
                    utf8_decode($row['LINEA']),
                    utf8_decode($row['PRESENTACION']),
                    number_format($row['CANTIDAD']),
                    "{$moneda} ".number_format($row['PRECIO_COSTO'],2, '.', ','),
                    utf8_decode("{$fecha_vencimiento}"),
                    "{$moneda} ".utf8_decode("{$importe}")
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
    //             $fecha_vencimiento = $row["FECHA_VENCIMIENTO"];
    //             if($fecha_vencimiento == "0000-00-00"){
    //                 $fecha_vencimiento = "No caducable";
    //             }
    //             $cantidad_productos += $row['CANTIDAD'];
    //             $importe = number_format($row['CANTIDAD']*$row['PRECIO_COSTO'],2);
    //             $pdf->Cell(8, 8,utf8_decode("{$n}"), 1, 0, 'C');
    //             $pdf->Cell(52, 8,substr(utf8_decode("{$row['ARTICULO']} "),0,30), 1, 0, 'C');
    //             $pdf->Cell(25, 8,substr(utf8_decode("{$row['LINEA']} "),0,15), 1, 0, 'C');
    //             $pdf->Cell(35, 8,substr(utf8_decode("{$row['PRESENTACION']} "),0,15), 1, 0, 'C');
    //             $pdf->Cell(10, 8,utf8_decode("{$row['CANTIDAD']}"), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".utf8_decode("{$row['PRECIO_COSTO']}"), 1, 0, 'C');
    //             $pdf->Cell(20, 8,utf8_decode("{$fecha_vencimiento}"), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".utf8_decode("{$importe}"), 1, 1, 'C');
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
    $pdf->RoundedRect(10, 250, 105, 26, '1.5', '');

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(12, 252);
    $pdf->Cell(105, 4, utf8_decode('INFORMACIÓN ADICIONAL'), 0, 0, 'C');

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 256);
    $pdf->Cell(32, 3, 'CANTIDAD PRODUCTOS:', 0, 0);
    $pdf->SetXY(46, 256);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(15, 3,utf8_decode("{$cantidad_productos} "), 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(59, 256);
    $pdf->Cell(30, 3, 'TIPO DOCUMENTO:', 0, 0);
    $pdf->SetXY(90, 256);
    $pdf->SetFont('Arial','',7.5);
    $pdf->Cell(30, 3,"{$Comprobante_compra}", 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 260);
    $pdf->Cell(32, 3, utf8_decode("N° DE {$Comprobante_compra} :"), 0, 0);
    $pdf->SetXY(44, 260);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(73, 3,utf8_decode("{$nr_comprobante_compra}"), 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 264);
    $pdf->Cell(32, 3, "NOMBRE DE CAJERO:", 0, 0);
    $pdf->SetXY(44, 264);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(73, 3,utf8_decode("----"), 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 268);
    $pdf->Cell(32, 3, 'TIPO DE PAGO:', 0, 0);
    $pdf->SetXY(44, 268);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(18, 3,utf8_decode("{$tipo_pago_compra} "), 0, 0);

/* ========================================================================== */
/*                               Bloque totales                               */
/* ========================================================================== */
    //Bloque de Totales de factura
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(120, 250, 80, 26, '1.5', '');

    //Linea de membrete Nro 1
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 250);
    $pdf->CellFitSpace(36, 5, 'SUMAS:', 0, 0);
    $pdf->SetXY(158, 250);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($sumas_compra,2)." {$moneda}", 0, 0, "R");

    //Linea de membrete Nro 2
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 254);
    $pdf->CellFitSpace(36, 5, "IVA {$iva} %", 0, 0);
    $pdf->SetXY(158, 254);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($iva_compra,2), 0, 0, "R");

    //Linea de membrete Nro 3
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 258);
    $pdf->CellFitSpace(36, 5, 'SUB TOTAL', 0, 0);
    $pdf->SetXY(158, 258);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($subtotal_compra,2), 0, 0, "R");

    //Linea de membrete Nro 4
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 262);
    $pdf->CellFitSpace(36, 5,utf8_decode("RETENCIÓN - {$iva} %"), 0, 0);
    $pdf->SetXY(158, 262);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"-"." {$moneda} ".number_format($retenido_compra,2), 0, 0, "R");

    //Linea de membrete Nro 5
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 266);
    $pdf->CellFitSpace(36, 5, "EXENTO:", 0, 0);
    $pdf->SetXY(158, 266);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,number_format($exentos_compra,2), 0, 0, "R");

    //Linea de membrete Nro 6
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 270);
    $pdf->CellFitSpace(36, 5, 'IMPORTE TOTAL:', 0, 0);
    $pdf->SetXY(158, 270);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($total_compra,2), 0, 0, "R");
    
    $pdf->Output();
?>