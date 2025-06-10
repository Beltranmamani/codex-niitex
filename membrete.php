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
    $comprobante_tipo = "PREVENTA";
    $id_venta = $this->id_venta;
    $p_preventa = mainModel::preventa_informacion($id_venta);
    $parametros_preventa = $this->parametros_preventa;
    $res_array = explode("|",$parametros_preventa);
    $fecha_registro = $res_array[0];
    $fecha_registro = date('d',strtotime($fecha_registro))."     ".date('m',strtotime($fecha_registro))."     ".date('y',strtotime($fecha_registro));
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
    $descuento_porcentaje = $res_array[14];
    $prod_exentos = $res_array[14];
    $precio_radio = $res_array[15];
    $observacion = $res_array[16];

    /* --------------------------- Agregar una pagina --------------------------- */
    
    $pdf->AddPage('P','A4');
    // $pdf->Image("archives/assets/sucursales/m1.png",-5,0,220);

/* ----------------------- Agregar detalle a la pagina ---------------------- */

/* ---------------------- Bloque del detalle del venta ---------------------- */

    

/* ------------------ Bloque cuadro color tipo transaccion ------------------ */

   
/* ------------------ Bloque borde cuadro tipo transaccion ------------------ */


/* --------------------- Letras cuadro tipo transaccion --------------------- */


 

    
    

/* ========================================================================== */
/*                          Bloque de datos sucursal                          */
/* ========================================================================== */

/* ----------------------- Bloque de datos de empresa ----------------------- */

    $pdf->SetFont('Arial','',12);
    $pdf->SetXY(72, 53);
    $pdf->Cell(40, 4,"{$fecha_registro}", 0, 0, "C");

 
   

/* ========================================================================== */
/*                             Bloque del  cliente                            */
/* ========================================================================== */

    $pdf->SetFont('Arial','',7);
  

    $pdf->SetXY(14, 78);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$razon_cliente} "), 0, 0,'L');
    $pdf->SetXY(137, 78);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$p_preventa['NRO_FACTURA']}"), 0, 0,'L');
    $pdf->SetXY(170, 78);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$codigo_venta}"), 0, 0,'L');
    $pdf->SetXY(170, 30);
    $pdf->CellFitSpace(66, 4,utf8_decode("PRECIO DE VENTA: {$precio_radio}"), 0, 0,'L');


    
    
    $pdf->SetXY(14, 69);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$nombre_cliente} "), 0, 0);
    $pdf->SetXY(105, 69);
    $pdf->Cell(28, 4,utf8_decode("{$telefono_cliente} "), 0, 0);
    $pdf->SetXY(152, 69);
    $pdf->Cell(186, 4, "{$CODIGO_cliente}", 0, 0);
    $pdf->SetXY(105, 78);
    $pdf->CellFitSpace(28, 4,utf8_decode("{$nro_documento_cliente} "), 0, 0);
    $pdf->SetXY(14, 87);
    $pdf->CellFitSpace(96, 4,utf8_decode("{$direccion_cliente} "), 0, 1);

    $pdf->SetXY(15, 227);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 0);

    $pdf->SetXY(60, 227);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$p_preventa['NOMBRE_PROMOTOR']} "), 0, 0);
  
    $pdf->SetXY(148, 225);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$moneda} ".number_format($total,2), 0, 0, "R");
    $pdf->SetXY(15, 243);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(42, 5,"{$observacion} ", 0, 0, "L");
    $pdf->SetXY(100, 243);
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitSpace(66, 4,utf8_decode("{$nombre_persona} {$apellidos_persona} "), 0, 0);
/* ========================================================================== */
/*                             Bloque de productos                            */
/* ========================================================================== */
   

  

/* --------------------------- Lista de productos --------------------------- */
$pdf->SetFont('Arial','',6);
    $cantidad_productos = 0;
    $lista_productos = $this->lista_items;
    $pdf->SetXY(14, 97);
    $pdf->SetWidths(array(18,18,18,75,18,18,18));
    if($lista_productos){
        $n = 1;
        if($lista_productos->rowCount()>0){
            foreach($lista_productos as $row){
               $cantidad_productos += $row["CANTIDAD"];
                $fecha = $row['FECHA_VEN'];
                if($row['FECHA_VEN']=="0000-00-00"){
                    $fecha = "NO CADUCABLE";
                }
                 $precio_radio = $row["PRECIO_RADIO"];
                 $medida = $row["MEDIDA_{$precio_radio}"];
                 $stock_cantidad = floatval($row["STOCK_{$precio_radio}"]);
                 $stock = floatval($row["CANTIDAD"])/$stock_cantidad; 
                 $pdf->SetX(14);
                $pdf->RowFacture2([
                    substr(utf8_decode($row['BARRA']),0,10),
                    substr(utf8_decode($fecha),0,10),
                    substr(utf8_decode($row['LOTE']),0,10),
                    utf8_decode($row['ARTICULO']),
                    $stock_cantidad ."/$stock  ".utf8_decode($medida),
                    "{$moneda} ".number_format($row['PRECIO_'.$precio_radio],2, '.', ','),
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
    //             $precio_radio = $row["PRECIO_RADIO"];
    //             $pdf->Cell(8, 8,utf8_decode("{$n}"), 1, 0, 'C');
    //             $pdf->Cell(50, 8,substr(utf8_decode($row['ARTICULO']),0,30), 1, 0, 'C');
    //             $pdf->Cell(20, 8,substr(utf8_decode($row['LINEA']),0,10), 1, 0, 'C');
    //             $pdf->Cell(23, 8,substr(utf8_decode($row['PRESENTACION']),0,10), 1, 0, 'C');
    //             $pdf->Cell(9, 8,number_format($row['CANTIDAD']), 1, 0, 'C');
    //             $pdf->Cell(20, 8,"{$moneda} ".number_format($row["PRECIO_{$precio_radio}"],2), 1, 0, 'C');
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
    $literal = $formatter->toMoney($total,2,'BOLIVIANOS','CENTAVOS');
    
    $pdf->SetXY(15, 235);
    $pdf->Cell(180, 4, "SON ".utf8_decode($literal), 0, 0, 'L');


    
    $pdf->Output();
?>