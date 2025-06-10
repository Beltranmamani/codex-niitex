<?php

/* ------------------------- Requerir de la libreria ------------------------ */

    require 'view/assets/plugins/fpdf/pdf.php';
     require 'view/assets/plugins/numeroastring/numero.php';

/* ------------------------- Instanciar la libreria ------------------------- */

    $pdf = new PDF();
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
    $nombre_cliente = $parametros_cliente["NOMBRE"];

/* ----------------- llamar datos de la persona responsable ----------------- */
    $parametros_persona = $this->parametros_persona;
    $nombre_persona = $parametros_persona["NOMBRE"];
    $apellidos_persona = $parametros_persona["APELLIDO"];
    $documento_persona = $parametros_persona["DOCUMENTO"];
    $nro_documento_persona = $parametros_persona["NUMERO"];

/* ----------------------- Llamar datos del comprobante---------------------- */
    $comprobante_tipo = "COTIZACIÓN";
    $id_cotizacion = $this->id_cotizacion;
    $p_cotizacion = mainModel::parametros_cotizacion($id_cotizacion);
    $parametros_cotizacion = $this->parametros_cotizacion;
    $res_array = explode("|",$parametros_cotizacion);
    $fecha_cotizacion = $res_array[0];
    $tipo_pago_cotizacion = $res_array[1];
    $codigo_cotizacion = $res_array[5];
    $entrega_cotizacion = $res_array[6];
    $sumas_cotizacion = $res_array[7];
    $iva_cotizacion = $res_array[8];
    $subtotal_cotizacion = $res_array[9];
    $retencion_cotizacion = $res_array[10];
    $excento_cotizacion = $res_array[11];
    $total_cotizacion = $res_array[12];
    $descuento_cotizacion = $res_array[13];

/* --------------------------- Agregar una pagina --------------------------- */

    $pdf->AddPage('P','A4');

/* ----------------------- Agregar detalle a la pagina ---------------------- */

/* ---------------------- Bloque del detalle del venta ---------------------- */



/* ------------------ Bloque cuadro color tipo transaccion ------------------ */



/* ------------------ Bloque borde cuadro tipo transaccion ------------------ */



/* --------------------- Letras cuadro tipo transaccion --------------------- */

    $pdf->SetFont('Arial','B',15);
    $pdf->SetXY(101, 16);
    $pdf->Cell(20, 5, 'C', 0 , 0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(96, 20);
    $pdf->Cell(20, 5, utf8_decode('Cotización'), 0, 0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(10, 10);
    $pdf->Cell(20, 3, 'NRO DE FACTURA', 0, 1);
    $pdf->SetFont('Arial',"",8);
    $pdf->Cell(40, 3, "{$p_cotizacion['NRO_FACTURA']}", 0, 1);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20, 3, 'NOMBRE DE PROMOTOR', 0, 1);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(40, 3, "{$p_cotizacion['NOMBRE_PROMOTOR']}", 0, 1);

/* ---------------------- Bloque detalle de comprobante --------------------- */

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(124, 12);
    $pdf->Cell(34, 5, utf8_decode("N° DE {$comprobante_tipo}"), 0, 0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(158, 12);
    $pdf->CellFitSpace(40, 5,"{$codigo_cotizacion}", 0, 0, "R");

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(124, 17);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE {$comprobante_tipo} "), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 17);
    $pdf->Cell(40, 4,"{$fecha_cotizacion}", 0, 0, "R");

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
    $pdf->Cell(40, 4,utf8_decode("{$tipo_pago_cotizacion }"), 0, 0, "R");

/* ========================================================================== */
/*                          Bloque de datos sucursal                          */
/* ========================================================================== */

/* ----------------------- Bloque de datos de empresa ----------------------- */

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
    $pdf->Cell(24, 4, 'RAZON SOCIAL:', 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(40, 52);
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
    $pdf->Cell(24, 4, utf8_decode('NOMBRE:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 55);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$nombre_cliente} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 58);
    $pdf->Cell(24, 4, utf8_decode('DIRECCIÓN:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 58);
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

/* ========================================================================== */
/*                             Bloque de productos                            */
/* ========================================================================== */
 

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(10, 71);
    $pdf->SetTextColor(3,3,3);
    $pdf->SetFillColor(255, 255, 255); #Color Gris en la celda
     $pdf->Cell(20, 8,utf8_decode("CODIGO"), 0, 0, 'L', True);
    $pdf->Cell(25, 8,utf8_decode("FECHA VENC."), 0, 0, 'C', True);
    $pdf->Cell(30, 8,utf8_decode("LOTE"), 0, 0, 'C', True);
    $pdf->Cell(55, 8,utf8_decode("DESCRIPCIÓN DE PRODUCTO"), 0, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("CANT"), 0, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("P/UNIT"), 0, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("SUB TOTAL"), 0, 1, 'C', True);

/* --------------------------- Lista de productos --------------------------- */
    $cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    $pdf->SetWidths(array(20,25,30,55,20,20,20));
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
                $cantidad_productos += $row["CANTIDAD"];
                $fecha = $row['FECHA_VEN'];
                if($row['FECHA_VEN']=="0000-00-00"){
                    $fecha = "NO CADUCABLE";
                }
                $pdf->RowFacture2([
                    utf8_decode($row['BARRA']),
                    utf8_decode($fecha),
                    utf8_decode($row['LOTE']),
                    utf8_decode($row['ARTICULO']),
                    number_format($row['CANTIDAD']),
                    "{$moneda} ".number_format($row['PRECIO'],2, '.', ','),
                    "{$moneda} ".number_format($row['SUBTOTAL'],2, '.', ','),

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
    //             $pdf->Cell(8, 8,utf8_decode("{$n}"), 1, 0, 'C');
    //             $pdf->Cell(50, 8,substr(utf8_decode($row['ARTICULO']),0,30), 1, 0, 'C');
    //             $pdf->Cell(20, 8,substr(utf8_decode($row['LINEA']),0,10), 1, 0, 'C');
    //             $pdf->Cell(23, 8,substr(utf8_decode($row['PRESENTACION']),0,10), 1, 0, 'C');
    //             $pdf->Cell(9, 8,number_format($row['CANTIDAD']), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".number_format($row['PRECIO'],2), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".number_format($row['SUBTOTAL'],2), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".number_format($row['DESCUENTO'],2), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".number_format($row['TOTAL'],2), 1, 1, 'C');
    //             $n++;
    //         }
    //     }
    // }

/* ------------------------ Fin de lista de producto ------------------------ */

/* ========================================================================== */
/*                        Bloque informacion adicional                        */
/* ========================================================================== */
     $formatter = new NumeroALetras();
    $literal = $formatter->toMoney($total_cotizacion,2,'BOLIVIANOS','CENTAVOS');
    
    $pdf->SetXY(12, 240);
    $pdf->Cell(180, 4, "SON ".utf8_decode($literal), 0, 0, 'L');
  
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(12, 247);
    $pdf->Cell(105, 4, utf8_decode('INFORMACIÓN ADICIONAL'), 0, 0, 'C');

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 252);
    $pdf->Cell(32, 3, 'CANTIDAD PRODUCTOS:', 0, 0);
    $pdf->SetXY(46, 252);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(15, 3,utf8_decode("{$cantidad_productos}"), 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(59, 252);
    $pdf->Cell(28, 3, 'TIPO ENTREGA:', 0, 0);
    $pdf->SetXY(87, 252);
    $pdf->SetFont('Arial','',7.5);
    $pdf->Cell(30, 3,"{$entrega_cotizacion}", 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 256);
    $pdf->Cell(32, 3, utf8_decode("NOMBRE DE CAJERO: "), 0, 0);
    $pdf->SetXY(44, 256);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(73, 3,substr(utf8_decode("{$nombre_persona}"),0,40), 0, 0);

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 260);
    $pdf->Cell(32, 3, "TIPO DE PAGO:", 0, 0);
    $pdf->SetXY(44, 260);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(73, 3,utf8_decode("{$tipo_pago_cotizacion}"), 0, 0);

/* ========================================================================== */
/*                               Bloque totales                               */
/* ========================================================================== */
    //Bloque de Totales de factura
 

    //Linea de membrete Nro 1
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 246);
    $pdf->CellFitSpace(36, 5, 'SUMAS:', 0, 0);
    $pdf->SetXY(158, 246);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($sumas_cotizacion,2), 0, 0, "R");

    //Linea de membrete Nro 2
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 250);
    $pdf->CellFitSpace(36, 5, "IVA {$iva} %", 0, 0);
    $pdf->SetXY(158, 250);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($iva_cotizacion,2), 0, 0, "R");

    //Linea de membrete Nro 3
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 254);
    $pdf->CellFitSpace(36, 5, 'SUB TOTAL', 0, 0);
    $pdf->SetXY(158, 254);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($subtotal_cotizacion,2), 0, 0, "R");

    //Linea de membrete Nro 4
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 258);
    $pdf->CellFitSpace(36, 5,utf8_decode("RETENCIÓN - {$iva} %"), 0, 0);
    $pdf->SetXY(158, 258);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"-"." {$moneda} ".number_format($retencion_cotizacion,2), 0, 0, "R");

    //Linea de membrete Nro 5
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 262);
    $pdf->CellFitSpace(36, 5, "EXENTO:", 0, 0);
    $pdf->SetXY(158, 262);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($excento_cotizacion,2), 0, 0, "R");

    //Linea de membrete Nro 6
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 266);
    $pdf->CellFitSpace(36, 5, 'DESCUENTO:', 0, 0);
    $pdf->SetXY(158, 266);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($descuento_cotizacion,2), 0, 0, "R");

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 270);
    $pdf->CellFitSpace(36, 5, 'IMPORTE TOTAL:', 0, 0);
    $pdf->SetXY(158, 270);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($total_cotizacion,2), 0, 0, "R");
    
    $pdf->Output();
?>