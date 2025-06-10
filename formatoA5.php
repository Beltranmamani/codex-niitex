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

/* ----------------- llamar datos de la persona responsable ----------------- */
    $parametros_persona = $this->parametros_persona;
    $nombre_persona = $parametros_persona["NOMBRE"];
    $apellidos_persona = $parametros_persona["APELLIDO"];
    $documento_persona = $parametros_persona["DOCUMENTO"];
    $nro_documento_persona = $parametros_persona["NUMERO"];

/* ----------------------- Llamar datos del comprobante---------------------- */
    $comprobante_tipo = "TRASPASO";
    $id_traspaso = $this->id_traspaso;
    $parametros_traspaso = $this->parametros_traspaso;
    $res_array = explode("|",$parametros_traspaso);
    $ID_TRASPASO = $res_array[0];
    $codigo_traspaso = $res_array[1];
    $fecha_registro = $res_array[2];
    $almacen = $res_array[3];
    $sucursal_des = $res_array[4];
    $motivo = $res_array[5];
   

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
    $pdf->RoundedRect(96, 14, 15, 12, '1.5', 'F');

/* ------------------ Bloque borde cuadro tipo transaccion ------------------ */

    $pdf->SetFillColor(229);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(96, 14, 15, 12, '1.5', '');

/* --------------------- Letras cuadro tipo transaccion --------------------- */

    $pdf->SetFont('Arial','B',15);
    $pdf->SetXY(101, 16);
    $pdf->Cell(20, 5, 'T', 0 , 0);
    $pdf->SetFont('Arial','B',6);
    $pdf->SetXY(97, 20);
    $pdf->Cell(20, 5, utf8_decode("{$comprobante_tipo}"), 0, 0);

/* ---------------------- Bloque detalle de comprobante --------------------- */

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(124, 14);
    $pdf->Cell(34, 5, utf8_decode("N° DE {$comprobante_tipo}"), 0, 0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(158, 14);
    $pdf->CellFitSpace(40, 5,"{$codigo_traspaso}", 0, 0, "R");

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
    $pdf->Cell(40, 4,utf8_decode(date("Y-m-d h:i:s")), 0, 0, "R");
    
    

/* ========================================================================== */
/*                          Bloque de datos sucursal                          */
/* ========================================================================== */

/* ----------------------- Bloque de datos de empresa ----------------------- */

    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 32, 190, 35, '1.5', '');

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
/*                       Bloque de datos del responsable                      */
/* ========================================================================== */

    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 48);
    $pdf->Cell(186, 4, 'DATOS DEL RESPONSABLE ', 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 52);
    $pdf->Cell(24, 4, utf8_decode('NOMBRE:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 52);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 0);
    
    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(102, 52);
    $pdf->Cell(24, 4, utf8_decode("N° DE {$documento_persona} "), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(120, 52);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nro_documento_persona} "), 0, 0);
    
    $pdf->SetFont('Arial','B',9);
    $pdf->SetXY(12, 57);
    $pdf->Cell(186, 4, 'SUCURSAL DESTINO: ', 0, 0);

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(12, 61);
    $pdf->Cell(24, 4, utf8_decode('ALMACEN:'), 0, 0);
    $pdf->SetXY(70, 61);
    $pdf->Cell(24, 4, utf8_decode('SUCURSAL:'), 0, 0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(36, 61);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$almacen} "), 0, 0);
    $pdf->SetXY(90, 61);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$sucursal_des} "), 0, 0);

/* ========================================================================== */
/*                             Bloque de productos                            */
/* ========================================================================== */
    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 72, 190, 30, '0', '');

    $pdf->SetFont('Arial','B',7);
    $pdf->SetXY(10, 72);
    $pdf->SetTextColor(3,3,3);
    $pdf->SetFillColor(229, 229, 229); #Color Gris en la celda
    $pdf->Cell(8, 8,utf8_decode("N°"), 1, 0, 'C', True);
    $pdf->Cell(55, 8,utf8_decode("DESCRIPCIÓN DE PRODUCTO"), 1, 0, 'C', True);
    $pdf->Cell(22, 8,utf8_decode("LINEA"), 1, 0, 'C', True);
    $pdf->Cell(33, 8,utf8_decode("PRESENTACION"), 1, 0, 'C', True);
    $pdf->Cell(11, 8,utf8_decode("CANT"), 1, 0, 'C', True);
    $pdf->Cell(61, 8,utf8_decode("VENCIMIENTO"), 1, 1, 'C', True);
   

/* --------------------------- Lista de productos --------------------------- */
    $cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    $pdf->SetWidths(array(8,55,22,33,11,61));
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
                $fecha_vencimiento = $row["FECHA_VEN"];
                if($fecha_vencimiento == "0000-00-00"){
                    $fecha_vencimiento = "NO CADUCABLE";
                }
                $cantidad_productos += $row["CANTIDAD"];
                $pdf->RowFacture([
                    "{$n}",
                    utf8_decode($row['ARTICULO']),
                    utf8_decode($row['LINEA']),
                    utf8_decode($row['PRESENTACION']),
                    number_format($row['CANTIDAD']),
                    utf8_decode("{$fecha_vencimiento}")
                    ]);
                $n++;
               
                // $cantidad_productos += $row["CANTIDAD"];
                // $pdf->Cell(8, 8,utf8_decode("{$n}"), 1, 0, 'C');
                // $pdf->Cell(55, 8,substr(utf8_decode($row['ARTICULO']),0,30), 1, 0, 'C');
                // $pdf->Cell(22, 8,substr(utf8_decode($row['LINEA']),0,10), 1, 0, 'C');
                // $pdf->Cell(33, 8,substr(utf8_decode($row['PRESENTACION']),0,10), 1, 0, 'C');
                // $pdf->Cell(11, 8,utf8_decode($row['CANTIDAD']), 1, 0, 'C');
                // $pdf->Cell(61, 8,utf8_decode("{$fecha_vencimiento}"), 1, 1, 'C');
                // $n++;
            }
        }
    }

/* ------------------------ Fin de lista de producto ------------------------ */

/* ========================================================================== */
/*                        Bloque informacion adicional                        */
/* ========================================================================== */

    $pdf->SetFillColor(192);
    $pdf->SetDrawColor(3,3,3);
    $pdf->SetLineWidth(.1);
    $pdf->RoundedRect(10, 104, 105, 30, '1.5', '');

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(12, 106);
    $pdf->Cell(105, 4, utf8_decode('INFORMACIÓN ADICIONAL'), 0, 0, 'C');

    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 109);
    $pdf->Cell(32, 3, 'CANTIDAD PRODUCTOS:', 0, 0);
    $pdf->SetXY(46, 109);
    $pdf->SetFont('Arial','',7.5);
    $pdf->CellFitSpace(15, 3,utf8_decode("{$cantidad_productos}"), 0, 0);


    $pdf->SetFont('Arial','B',7.5);
    $pdf->SetXY(12, 112);
    $pdf->Cell(32, 3, utf8_decode("MOTIVO: "), 0, 0);
    $pdf->SetXY(40, 112);
    $pdf->SetFont('Arial','',7.5);
    $pdf->MultiCellText(73, 3,utf8_decode("{$motivo}"), 0, 0);

    $pdf->Output();
?>