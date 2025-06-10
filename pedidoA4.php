<?php

/* ------------------------- Requerir de la libreria ------------------------ */

    require 'view/assets/plugins/fpdf/pdf.php';

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
    $razon_cliente = $parametros_cliente["NOMBRE"];
    $documento_cliente = "NIT";
    $nro_documento_cliente = $parametros_cliente["N_DOCUMENTO"];
    // $direccion_cliente = $parametros_cliente["DIRECCION"];
    $telefono_cliente = $parametros_cliente["TELEFONO"];
    $correo_cliente = $parametros_cliente["CORREO"];

/* ----------------- llamar datos de la persona responsable ----------------- */
    // $parametros_persona = $this->parametros_persona;
    // $nombre_persona = $parametros_persona["NOMBRE"];
    // $apellidos_persona = $parametros_persona["APELLIDO"];
    // $documento_persona = $parametros_persona["DOCUMENTO"];
    // $nro_documento_persona = $parametros_persona["NUMERO"];

/* ----------------------- Llamar datos del comprobante---------------------- */
    $comprobante_tipo = "PEDIDO";
    // $id_venta = $this->id_venta;
    $parametros_venta = $this->parametros_venta;
    $res_array = explode("|",$parametros_venta);
    $fecha_venta = $res_array[0];
    $nro_pedido = $res_array[3];
    $subtotal_pedido = $res_array[4];
    $tarifa_pedido = $res_array[5];
    $total_pedido = $res_array[6];
    $tipo_pago_venta = $res_array[1];
    // $codigo_venta = $res_array[5];
    // $entrega_venta = $res_array[6];
    // $sumas_venta = $res_array[6];
    // $iva_venta = $res_array[7];
    // $subtotal_venta = $res_array[8];
    // $retencion_venta = $res_array[9];
    // $excento_venta = $res_array[10];
    // $descuento_venta = $res_array[12];
    // $importe_venta = $res_array[11];
    // $comprobante_venta = $res_array[13];
    // $nro_comprobante_venta = $res_array[14];
    // $metodo_pago_venta = $res_array[15];
    // $pago_efectivo = $res_array[16];
    // $cambio = $res_array[17];
    // $pago_tarjeta = $res_array[18];
    // $nro_tarjeta = $res_array[19];
    // $tarjeta_habitante = $res_array[20];
    // $observacion = $res_array[22];

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
    $pdf->RoundedRect(97, 14, 14, 12, '1.5', 'F');

/* ------------------ Bloque borde cuadro tipo transaccion ------------------ */

    $pdf->SetFillColor(229);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(97, 14, 14, 12, '1.5', '');

/* --------------------- Letras cuadro tipo transaccion --------------------- */

    $pdf->SetFont('Arial','B',15);
    $pdf->SetXY(101, 16);
    $pdf->Cell(20, 5, 'P', 0 , 0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(98, 20);
    $pdf->Cell(20, 5, utf8_decode("{$comprobante_tipo}"), 0, 0);

/* ---------------------- Bloque detalle de comprobante --------------------- */

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(124, 12);
    $pdf->Cell(34, 5, utf8_decode("N° DE {$comprobante_tipo}"), 0, 0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(158, 12);
    $pdf->CellFitSpace(40, 5,"{$nro_pedido}", 0, 0, "R");

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(124, 17);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE {$comprobante_tipo} "), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 17);
    $pdf->Cell(40, 4,"{$fecha_venta}", 0, 0, "R");

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(124, 21);
    $pdf->Cell(34, 4, utf8_decode("FECHA DE EMISIÓN"), 0, 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(158, 21);
    $pdf->Cell(40, 4,utf8_decode(date("Y-d-m H:i:s")), 0, 0, "R");
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(124, 25);
    $pdf->Cell(34, 4, 'ESTADO PEDIDO', 0, 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(158, 25);
    $pdf->Cell(40, 4,utf8_decode("{$tipo_pago_venta }"), 0, 0, "R");

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
    $pdf->Cell(186, 4, "DATOS DEL CLIENTE", 0, 0);

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
    $pdf->Cell(24, 4, utf8_decode('EMAIL:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 55);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$correo_cliente} "), 0, 0);

   
     
// /* ========================================================================== */
// /*                       Bloque de datos del responsable                      */
// /* ========================================================================== */

//     $pdf->SetFont('Arial','B',9);
//     $pdf->SetXY(12, 60);
//     $pdf->Cell(186, 4, 'DATOS DEL RESPONSABLE ', 0, 0);
    
//     $pdf->SetFont('Arial','B',7);
//     $pdf->SetXY(12, 64);
//     $pdf->Cell(24, 4, utf8_decode('NOMBRE:'), 0, 0);
//     $pdf->SetFont('Arial','',7);
//     $pdf->SetXY(36, 64);
//     $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 0);
    
//     $pdf->SetFont('Arial','B',7);
//     $pdf->SetXY(102, 64);
//     $pdf->Cell(24, 4, utf8_decode("N° DE {$documento_persona} "), 0, 0);
//     $pdf->SetFont('Arial','',7);
//     $pdf->SetXY(120, 64);
//     $pdf->CellFitSpace(66, 4,utf8_decode("{$nro_documento_persona} "), 0, 0);

// /* ========================================================================== */
// /*                             Bloque de productos                            */
// /* ========================================================================== */
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 71, 190, 163, '0', '');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(10, 71);
    $pdf->SetTextColor(3,3,3);
    $pdf->SetFillColor(229, 229, 229); #Color Gris en la celda
    $pdf->Cell(8, 8,utf8_decode("N°"), 1, 0, 'C', True);
    $pdf->Cell(70, 8,utf8_decode("DESCRIPCIÓN DE PRODUCTO"), 1, 0, 'C', True);
    $pdf->Cell(30, 8,utf8_decode("LINEA"), 1, 0, 'C', True);
    $pdf->Cell(23, 8,utf8_decode("COD/BARRA"), 1, 0, 'C', True);
    $pdf->Cell(19, 8,utf8_decode("CANT"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("P/UNIT"), 1, 0, 'C', True);
    $pdf->Cell(20, 8,utf8_decode("SUB TOTAL"), 1, 1, 'C', True);

// /* --------------------------- Lista de productos --------------------------- */
     $cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    $pdf->SetWidths(array(8,70,30,23,19,20,20,20,20));
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
              
                $p_activo = $row["PRECIO_RADIO"]; 
    
                $stock_medida = 1;
                $medida = "";
                
                if($p_activo==1 ){
                    $stock_medida = $row["STOCK_1"];
                    $medida = $row["MEDIDA_1"];
                }
                if($p_activo==2){
                    $stock_medida = $row["STOCK_2"];
                    $medida = $row["MEDIDA_2"];
                }
                if($p_activo==3){
                    $stock_medida = $row["STOCK_3"];
                    $medida = $row["MEDIDA_3"];
                }
                if($p_activo==4){
                    $stock_medida = $row["STOCK_4"];
                    $medida = $row["MEDIDA_4"];
                }

                $stock = $row["CANTIDAD"]; 
                $stock_total = $stock/$stock_medida;
                $subtotal = $row["PRECIO"]*$stock_total;
                $cantidad_productos += $row["CANTIDAD"];
                $pdf->RowFacture([
                    "{$n}",
                    utf8_decode($row['ARTICULO']),
                    utf8_decode($row['LINEA']),
                    utf8_decode($row['BARRA']),
                    number_format($stock_total)." $medida",
                    "{$moneda} ".number_format($row['PRECIO'],2, '.', ','),
                    "{$moneda} ".number_format($subtotal,2, '.', ','),
                    ]);
                $n++;
            }
        }
    }

// /* ------------------------ Fin de lista de producto ------------------------ */

// /* ========================================================================== */
// /*                        Bloque informacion adicional                        */
// /* ========================================================================== */

//     $pdf->SetFillColor(192);
//     $pdf->SetDrawColor(3,3,3);
//     $pdf->SetLineWidth(.1);
//     $pdf->RoundedRect(10, 236, 105, 40, '1.5', '');

//     $pdf->SetFont('Arial','B',8);
//     $pdf->SetXY(12, 238);
//     $pdf->Cell(105, 4, utf8_decode('INFORMACIÓN ADICIONAL'), 0, 0, 'C');

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 242);
//     $pdf->Cell(32, 3, 'CANTIDAD PRODUCTOS:', 0, 0);
//     $pdf->SetXY(46, 242);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(15, 3,utf8_decode("{$cantidad_productos}"), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(55, 242);
//     $pdf->Cell(28, 3, 'TIPO DE COMPROBANTE:', 0, 0);
//     $pdf->SetXY(89, 242);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->Cell(30, 3,"{$comprobante_venta}", 0, 0,'L');

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 246);
//     $pdf->Cell(32, 3, utf8_decode("N° de {$comprobante_venta}:"), 0, 0);
//     $pdf->SetXY(46, 246);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(15, 3,utf8_decode("{$nro_comprobante_venta} "), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 250);
//     $pdf->Cell(32, 3, utf8_decode("NOMBRE DE CAJERO: "), 0, 0);
//     $pdf->SetXY(44, 250);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(73, 3,utf8_decode("-------"), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 254);
//     $pdf->Cell(32, 3, "METODO DE PAGO:", 0, 0);
//     $pdf->SetXY(44, 254);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(73, 3,utf8_decode("{$metodo_pago_venta}"), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 258);
//     $pdf->Cell(32, 3, "EFECTIVO DE PAGO:", 0, 0);
//     $pdf->SetXY(44, 258);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(73, 3,"{$moneda} ".number_format($pago_efectivo,2), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 262);
//     $pdf->Cell(32, 3, "TARJETA DE PAGO:", 0, 0);
//     $pdf->SetXY(44, 262);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(73, 3,"{$moneda} ".number_format($pago_tarjeta,2), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 266);
//     $pdf->Cell(32, 3, utf8_decode("N° DE TARJETA:"), 0, 0);
//     $pdf->SetXY(44, 266);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(73, 3,utf8_decode("{$nro_tarjeta} "), 0, 0);

//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(55, 266);
//     $pdf->Cell(32, 3, "TARJETA HABITANTE:", 0, 0);
//     $pdf->SetXY(85, 266);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->CellFitSpace(73, 3,substr(utf8_decode(" {$tarjeta_habitante} "),0,20), 0, 0);
    
//     $pdf->SetFont('Arial','B',7.5);
//     $pdf->SetXY(12, 270);
//     $pdf->Cell(32, 3, "OBSERVACION: ", 0, 0);
//     $pdf->SetXY(33, 270);
//     $pdf->SetFont('Arial','',7.5);
//     $pdf->Cell(80, 3,substr(utf8_decode("{$observacion} "),0,48), 0, 0);

// /* ========================================================================== */
// /*                               Bloque totales                               */
// /* ========================================================================== */
    //Bloque de Totales de factura
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(120, 236, 80, 40, '1.5', '');

    //Linea de membrete Nro 1
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 238);
    $pdf->CellFitSpace(36, 5, 'SUMAS:', 0, 0);
    $pdf->SetXY(158, 238);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($subtotal_pedido,2), 0, 0, "R");

    //Linea de membrete Nro 2
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 242);
    $pdf->CellFitSpace(36, 5, "ENVIO", 0, 0);
    $pdf->SetXY(158, 242);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($tarifa_pedido,2), 0, 0, "R");

    //Linea de membrete Nro 3
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(122, 246);
    $pdf->CellFitSpace(36, 5, 'TOTAL', 0, 0);
    $pdf->SetXY(158, 246);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($total_pedido,2), 0, 0, "R");

    $pdf->Output();
?>