<?php
    class cotizacionModel extends mainModel{
        function guardar_libro($id,$nro,$fecha_limite,$nro_auto,$llave,$fecha,$id_venta,$nro_factura,$total,$codigo,$id_s){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("INSERT INTO `libro_ventas`(`ID`, `NRO`, `FECHA_LIMITE`, `NRO_AUTORIZACION`, `LLAVE`, `FECHA_EMISION`, `ID_VENTA`, `NRO_FACTURA`, `TOTAL`, `CODIGO_CONTROL`, `ID_SUCURSAL`) VALUES ('$id','$nro','$fecha_limite','$nro_auto','$llave','$fecha','$id_venta','$nro_factura','$total','$codigo','$id_s')");
            return $libro;
        }
        function lista_libro_ventas(){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT * FROM libro_ventas");
            return $libro;
        }
        function buscar_libro($id){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT lv.* FROM libro_ventas as lv WHERE lv.ID_VENTA = '$id'");
            return $libro;
        }
        function lista_libro_ventas_sucursal($id){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT l.*,ven.ESTADO,cl.RAZON,cl.N_DOCUMENTO,ven.SUMAS,ven.DESCUENTO,ven.EXENTO,ven.TOTAL AS 'TOTAL_VENTA' FROM libro_ventas as l INNER JOIN ventas as ven ON ven.ID_VENTA = l.ID_VENTA COLLATE utf8_unicode_ci INNER JOIN cliente as cl ON cl.ID_CLIENTE = ven.ID_CLIENTE WHERE l.ID_SUCURSAL = '$id'");
            return $libro;
        }
       
        function consultar_dosificacion($id){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("SELECT * FROM `dosificacion` WHERE ID_SUCURSAL = '$id'");
            return $sucursal;
        }

/* ========================================================================== */
/*                            Lista de cotizaciones                           */
/* ========================================================================== */
        function lista_documentos(){
            $conexion = mainModel::conectar();
            $documentos = $conexion->query("SELECT * FROM vista_documento");
            return $documentos;
        } 
        function lista_cotizaciones(){
            $conexion = mainModel::conectar();
            $cotizacion = $conexion->query("SELECT * FROM vista_cotizacion");
            return $cotizacion;
        }
       

/* ========================================================================== */
/*                     Lista de cotizaciones por sucursal                     */
/* ========================================================================== */

        function lista_cotizaciones_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $cotizacion = $conexion->query("SELECT `c`.`ID_COTIZACION` AS `ID_COTIZACION`, `c`.`CODIGO_COTIZACION` AS `CODIGO_COTIZACION`, `c`.`FECHA` AS `FECHA`, `c`.`TIPO_PAGO` AS `TIPO_PAGO`, `c`.`TIPO_ENTREGA` AS `TIPO_ENTREGA`, `c`.`SUMAS` AS `SUMAS`, `c`.`IVA` AS `IVA`, `c`.`EXENTO` AS `EXENTO`, `c`.`SUBTOTAL` AS `SUBTOTAL`, `c`.`RETENIDO` AS `RETENIDO`, `c`.`DESCUENTO` AS `DESCUENTO`, `c`.`DESCUENTO_PERCENT` AS `DESCUENTO_PERCENT`, `c`.`TOTAL` AS `TOTAL`, `c`.`PROD_EXENTOS` AS `PROD_EXENTOS`, `c`.`ESTADO` AS `ESTADO`, `c`.`ID_CLIENTE` AS `ID_CLIENTE`, `c`.`ID_USUARIO` AS `ID_USUARIO`, `c`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `c`.`PRECIO_RADIO` AS `PRECIO_RADIO`, `cl`.`RAZON` AS `RAZON`, `doc`.`DOCUMENTO` AS `DOCUMENTO`, `cl`.`N_DOCUMENTO` AS `N_DOCUMENTO`, `cl`.`TELEFONO` AS `TELEFONO`, `per`.`ID_PERSONA` AS `ID_PERSONA`, `per`.`NOMBRES` AS `NOMBRES`, `per`.`APELLIDOS` AS `APELLIDOS`, `per`.`PERFIL` AS `PERFIL` FROM ((((`cotizacion` `c` join `cliente` `cl` on((`cl`.`ID_CLIENTE` = `c`.`ID_CLIENTE`))) join `documento` `doc` on((`cl`.`TIPO_DOCUMENTO` = `doc`.`ID_DOCUMENTO`))) join `usuario` `u` on((`u`.`ID_USUARIO` = `c`.`ID_USUARIO`))) join `persona` `per` on((`per`.`ID_PERSONA` = `u`.`ID_PERSONA`))) WHERE `c`.`ID_SUCURSAL` = '$sucursal'");
            return $cotizacion;
        }

/* ========================================================================== */
/*                       Funcion para guardar cotizacion                      */
/* ========================================================================== */

        function guardar_cotizacion($p_id_cotizacion,$p_codigo_cotizacion,$p_fecha,$p_tipo_pago,$p_tipo_entrega,$p_sumas,$p_iva,$p_exento,$p_subtotal,$p_retenido,$p_descuento,$p_descuento_percent,$p_total,$p_prod_exentos,$p_estado,$p_id_cliente,$p_id_usuario,$p_id_sucursal,$precio_radio,$p1,$p2){
            $conexion = mainModel::conectar();
            $cotizacion = $conexion->query("INSERT INTO `cotizacion`(`ID_COTIZACION`, `CODIGO_COTIZACION`, `FECHA`, `TIPO_PAGO`, `TIPO_ENTREGA`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `ESTADO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_SUCURSAL`, `PRECIO_RADIO`, `NRO_FACTURA`, `NOMBRE_PROMOTOR`) VALUES ('$p_id_cotizacion','$p_codigo_cotizacion','$p_fecha','$p_tipo_pago','$p_tipo_entrega','$p_sumas','$p_iva','$p_exento','$p_subtotal','$p_retenido','$p_descuento','$p_descuento_percent','$p_total','$p_prod_exentos','$p_estado','$p_id_cliente','$p_id_usuario','$p_id_sucursal','$precio_radio','$p1','$p2')");
            return $cotizacion;
        }

/* ========================================================================== */
/*               Funcion para gurdar el detalle de la cotizacion              */
/* ========================================================================== */  

        function guardar_detalle_cotizacion($p_id_detalle,$p_id_item,$p_id_cotizacion,$p_cantidad,$p_precio,$p_descuento,$p_subtotal,$p_total,$descuento_percent,$p1,$p2,$p3,$p4,$medida,$precio_radio,$p5=0,$p6=0,$p7=0){
            $conexion = mainModel::conectar();  
            $detalle_cotizacion = $conexion->query("INSERT INTO `detalle_cotizacion`(`ID_DETALLE`, `ID_ITEM`, `ID_COTIZACION`, `CANTIDAD`, `PRECIO`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`,`PERCENT_DESC`,`PRECIO_1`,`PRECIO_2`,`PRECIO_3`,`PRECIO_4`,`MEDIDA`,`PRECIO_RADIO`,`PRECIO_5`,`PRECIO_6`,`PRECIO_7`) VALUES ('$p_id_detalle','$p_id_item','$p_id_cotizacion','$p_cantidad','$p_precio','$p_descuento','$p_subtotal','$p_total','$descuento_percent','$p1','$p2','$p3','$p4','$medida','$precio_radio','$p5','$p6','$p7')");
            return $detalle_cotizacion;
        }

/* ========================================================================== */
/*                     Lista de detalles de la cotizacion                     */
/* ========================================================================== */

        function lista_detalle_cotizacion(){
            $conexion = mainModel::conectar();
            $detalle = $conexion->query("SELECT * FROM vista_detalle_cotizacion ");
            return $detalle;
        }
        function lista_detalle_cotizacion_2($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $detalle = $conexion->query("SELECT dc.*,lot.NOMBRE as 'LOTE',cot.PRECIO_RADIO,cot.FECHA,prod.ID_PRODUCTO,prod.BARRA,prod.ARTICULO,prod.IMAGEN,lin.LINEA,pre.NOMBRE as 'PRESENTACION',SUM(dc.CANTIDAD) as 'CANTIDADES',SUM(dc.SUBTOTAL) as 'SUBTOTALES',SUM(dc.DESCUENTO) as 'DESCUENTOS',SUM(dc.TOTAL) as 'TOTALES' FROM detalle_cotizacion as dc INNER JOIN cotizacion as cot on cot.ID_COTIZACION=dc.ID_COTIZACION INNER JOIN items_lote as il ON il.ID_ITEM= dc.ID_ITEM INNER JOIN producto as prod ON prod.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as lin On lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion AS pre ON pre.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE date(cot.FECHA)>='$date_1' AND date(cot.FECHA)<='$date_2' AND cot.ID_SUCURSAL='$sucursal' AND cot.ESTADO = 1 GROUP BY prod.ID_PRODUCTO,dc.PRECIO");
            return $detalle;
        }
        function lista_detalle_cotizacion_3($date_1,$date_2,$sucursal,$persona){
            $conexion = mainModel::conectar();
            $detalle = $conexion->query("SELECT dc.*,lot.NOMBRE as 'LOTE',cot.PRECIO_RADIO,cot.FECHA,prod.ID_PRODUCTO,prod.BARRA,prod.ARTICULO,prod.IMAGEN,lin.LINEA,pre.NOMBRE as 'PRESENTACION',SUM(dc.CANTIDAD) as 'CANTIDADES',SUM(dc.SUBTOTAL) as 'SUBTOTALES',SUM(dc.DESCUENTO) as 'DESCUENTOS',SUM(dc.TOTAL) as 'TOTALES',pers.ID_PERSONA FROM detalle_cotizacion as dc INNER JOIN cotizacion as cot on cot.ID_COTIZACION=dc.ID_COTIZACION INNER JOIN items_lote as il ON il.ID_ITEM= dc.ID_ITEM INNER JOIN producto as prod ON prod.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as lin On lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion AS pre ON pre.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN usuario as usu ON usu.ID_USUARIO = cot.ID_USUARIO INNER JOIN persona as pers ON pers.ID_PERSONA = usu.ID_PERSONA INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE date(cot.FECHA)>='$date_1' AND date(cot.FECHA)<='$date_2' AND cot.ID_SUCURSAL='$sucursal' AND pers.ID_PERSONA = '$persona' AND cot.ESTADO = 1  GROUP BY prod.ID_PRODUCTO,dc.PRECIO,pers.ID_PERSONA");
            return $detalle;
        }
        function lista_detalle_cotizacion_4($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $detalle = $conexion->query("SELECT dc.*,lot.NOMBRE as 'LOTE',SUM(il.CANTIDAD) as 'STOCK_ACTUAL',cot.PRECIO_RADIO,prod.ID_PRODUCTO,prod.BARRA,prod.ARTICULO,prod.IMAGEN,lin.LINEA,pre.NOMBRE as 'PRESENTACION',SUM(dc.CANTIDAD) as 'CANTIDADES',SUM(dc.SUBTOTAL) as 'SUBTOTALES',SUM(dc.DESCUENTO) as 'DESCUENTOS',SUM(dc.TOTAL) as 'TOTALES',pers.ID_PERSONA,CONCAT(pers.NOMBRES,' ',pers.APELLIDOS) AS 'VENDEDOR' FROM detalle_cotizacion as dc INNER JOIN cotizacion as cot on cot.ID_COTIZACION=dc.ID_COTIZACION INNER JOIN items_lote as il ON il.ID_ITEM= dc.ID_ITEM INNER JOIN producto as prod ON prod.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as lin On lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion AS pre ON pre.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN usuario as usu ON usu.ID_USUARIO = cot.ID_USUARIO INNER JOIN persona as pers ON pers.ID_PERSONA = usu.ID_PERSONA INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE date(cot.FECHA)>='$date_1' AND date(cot.FECHA)<='$date_2' AND cot.ID_SUCURSAL='$sucursal' AND cot.ESTADO = 1   GROUP BY  prod.ID_PRODUCTO,dc.PRECIO,pers.ID_PERSONA");
            return $detalle;
        }

/* ========================================================================== */
/*                        Funcion detalle de cotizacion                       */
/* ========================================================================== */

        function detalle_cotizacion($cotizacion){
            $conexion = mainModel::conectar();
            $cotizacion = $conexion->query("SELECT*FROM vista_cotizacion WHERE ID_COTIZACION ='$cotizacion'");
            return $cotizacion;
        }

/* ========================================================================== */
/*                       Lista de items de la cotizacion                      */
/* ========================================================================== */

/* ---------------------------------- NUEVO --------------------------------- */

        function detalle_items_cotizacion($cotizacion){
            $conexion = mainModel::conectar();
            $cotizacion = $conexion->query("SELECT d.*,cot.PRECIO_RADIO AS 'PR',p.*,l.CANTIDAD as 'STOCK_ACTUAL',p.BARRA,li.LINEA,pre.NOMBRE as 'PRESENTACION' ,l.ID_PRODUCTO,l.FECHA_VEN,l.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',l.PRECIO_VENTA_1,l.PRECIO_VENTA_2,l.PRECIO_VENTA_3,l.PRECIO_VENTA_4,p.MEDIDA_1,p.MEDIDA_2,p.MEDIDA_3,p.MEDIDA_4,p.STOCK_1,p.STOCK_2,p.STOCK_3,p.STOCK_4,p.PERECEDERO,p.EXENTO,p.COMPLEMENTO,um.UNIDAD,um.PREFIJO, cot.ID_SUCURSAL,cot.FECHA,lot.NOMBRE as 'LOTE',per.NOMBRES,per.APELLIDOS FROM detalle_cotizacion as d INNER JOIN items_lote as l ON l.ID_ITEM = d.ID_ITEM INNER JOIN producto as p ON l.ID_PRODUCTO = p.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN cotizacion as cot ON cot.ID_COTIZACION = d.ID_COTIZACION INNER JOIN lote as lot ON l.ID_LOTE = lot.ID_LOTE INNER JOIN usuario as u ON u.ID_USUARIO = cot.ID_USUARIO INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD INNER JOIN almacen as alm ON alm.ID_ALMACEN = l.ID_ALMACEN INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA WHERE d.ID_COTIZACION = '$cotizacion'");
            return $cotizacion;
        }
        function actualizar_cotizacion($p_id_cotizacion ,$p_sumas ,$p_iva ,$p_exento ,$p_subtotal ,$p_retenido ,$p_descuento ,$p_descuento_percent ,$p_total ,$p_prod_exentos ,$p_precio_radio ,$p_estado ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE `cotizacion` SET `SUMAS`='$p_sumas',`IVA`='$p_iva',`EXENTO`='$p_exento',`SUBTOTAL`='$p_subtotal',`RETENIDO`='$p_retenido',`DESCUENTO`='$p_descuento',`DESCUENTO_PERCENT`='$p_descuento_percent',`TOTAL`='$p_total',`PROD_EXENTOS`='$p_prod_exentos',`PRECIO_RADIO`='$p_precio_radio',`ESTADO`='$p_estado' WHERE `ID_COTIZACION`='$p_id_cotizacion'");
            return $preventa;
        }
        function agregar_stock_cotizado($p_id_detalle ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("UPDATE `detalle_cotizacion` SET `PRECIO_1`= '$p_precio_1',`PRECIO_2`='$p_precio_2',`PRECIO_3`= '$p_precio_3',`PRECIO_4`='$p_precio_4',`CANTIDAD`= `CANTIDAD` + '$p_cantidad',`PERCENT_DESC`='$p_percent_desc',`DESCUENTO`='$p_descuento',`SUBTOTAL`='$p_subtotal',`TOTAL`='$p_total' WHERE `ID_COTIZACION`= '$p_id_detalle'  AND `ID_ITEM`= '$p_id_item'");
            return $preventa;
        }

        function devolver_stock_cotizado($p_id_detalle ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("UPDATE `detalle_cotizacion` SET `PRECIO_1`= '$p_precio_1',`PRECIO_2`='$p_precio_2',`PRECIO_3`= '$p_precio_3',`PRECIO_4`='$p_precio_4',`CANTIDAD`= `CANTIDAD` - '$p_cantidad',`PERCENT_DESC`='$p_percent_desc',`DESCUENTO`='$p_descuento',`SUBTOTAL`='$p_subtotal',`TOTAL`='$p_total' WHERE `ID_COTIZACION`= '$p_id_detalle'  AND `ID_ITEM`= '$p_id_item'");
            return $preventa;
        }
        function actualizar_stock_cotizado($p_id_detalle ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("UPDATE `detalle_cotizacion` SET `PRECIO_1`= '$p_precio_1',`CANTIDAD`= '$p_cantidad',`PRECIO_2`='$p_precio_2',`PRECIO_3`= '$p_precio_3',`PRECIO_4`='$p_precio_4',`PERCENT_DESC`='$p_percent_desc',`DESCUENTO`='$p_descuento',`SUBTOTAL`='$p_subtotal',`TOTAL`='$p_total' WHERE `ID_COTIZACION`= '$p_id_detalle'  AND `ID_ITEM`= '$p_id_item'");
            return $preventa;
        }
        function lista_creditos(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM vista_credito");
            return $creditos;
        }
        function lista_ventas(){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT * FROM vista_ventas");
            return $ventas;
        }
        function lista_ventas_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT v.*,c.COMPROBANTE,cl.RAZON,doc.DOCUMENTO,cl.N_DOCUMENTO,per.NOMBRES,per.PERFIL,su.NOMBRE as 'SUCURSAL',su.LOGO FROM ventas as v INNER JOIN tiraje_comprobante as tc ON tc.ID_TIRAJE = v.ID_COMPROBANTE INNER JOIN comprobante as c ON c.ID_COMPROBANTE = tc.ID_COMPROBANTE INNER JOIN cliente as cl ON cl.ID_CLIENTE = v.ID_CLIENTE INNER JOIN documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO INNER JOIN usuario as u ON u.ID_USUARIO = v.ID_USUARIO INNER JOIN persona as per ON u.ID_PERSONA = per.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = v.ID_SUCURSAL WHERE v.ID_SUCURSAL = '$sucursal'");
            return $ventas;
        }
        function busqueda_tiraje($tiraje){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query("SELECT * FROM tiraje_comprobante as ti WHERE ti.ID_TIRAJE ='$tiraje'");
            return $busqueda;
        }
        function lista_creditos_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `vista_credito`  WHERE ID_SUCURSAL ='$sucursal'");
            return $creditos;
        }
        function Lista_de_kardex(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `entrada_salida`");
            return $creditos;
        }
        function lista_detalle_venta(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM vista_detalle_venta");
            return $creditos;
        }
        function cotizacion_a_venta($cotizacion,$estado){
            $conexion = mainModel::conectar();
            $cotizacion = $conexion->query("UPDATE `cotizacion` SET `ESTADO`='$estado' WHERE `ID_COTIZACION`='$cotizacion'");
            return $cotizacion;
        }
        function agregar_detalle_venta($p_id_detalle,$p_id_item,$p_id_venta,$p_cantidad,$p_precio,$p_descuento,$p_subtotal,$p_total,$p_stock,$medida){
            $conexion = mainModel::conectar();
            $detalle  = $conexion->query("INSERT INTO `detalle_venta`(`ID_DETALLE`, `ID_ITEM`, `ID_VENTA`, `CANTIDAD`, `PRECIO`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `STOCK`, `MEDIDA`) VALUES ('$p_id_detalle','$p_id_item','$p_id_venta','$p_cantidad','$p_precio','$p_descuento','$p_subtotal','$p_total','$p_stock','$medida')");
            return $detalle;
        }
        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $busqueda;
        }
        function guardar_credito($p_id_credito,$p_id_venta ,$p_id_sucursal,$p_id_cliente,$p_id_usuario,$p_codigo_credito,$p_nombre_credito,$p_fecha_credito,$p_fecha_limite,$p_monto_credito,$p_monto_abonado,$p_monto_restante,$p_estado){
            $conexion = mainModel::conectar();
            $credito = $conexion->query("INSERT INTO `credito` (`ID_CREDITO`, `ID_VENTA`, `ID_SUCURSAL`, `ID_CLIENTE`, `ID_USUARIO`, `CODIGO_CREDITO`, `NOMBRE_CREDITO`, `FECHA_CREDITO`, `FECHA_LIMITE`, `MONTO_CREDITO`, `MONTO_ABONADO`, `MONTO_RESTANTE`, `ESTADO`) VALUES ('$p_id_credito','$p_id_venta' ,'$p_id_sucursal','$p_id_cliente','$p_id_usuario','$p_codigo_credito','$p_nombre_credito','$p_fecha_credito','$p_fecha_limite','$p_monto_credito','$p_monto_abonado','$p_monto_restante','$p_estado')");
            return $credito;
        }
        function guardar_venta($p_id_venta,$p_n_venta,$p_fecha_resolucion,$p_tipo_pago,$p_numero_comprobante,$p_id_comprobante,$p_sumas,$p_iva,$p_exento,$p_subtotal,$p_retenido,$p_descuento,$p_descuento_percent,$p_total,$p_prod_exentos,$p_pago_efectivo,$p_pago_tarjeta,$p_numero_tarjeta,$p_tarjeta_habitante,$p_cambio,$p_estado ,$p_id_cliente,$p_id_usuario,$p_id_sucursal,$id_caja,$observacion,$precio_radio,$p1,$p2){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("INSERT INTO `ventas`(`ID_VENTA`, `N_VENTA`, `FECHA_RESOLUCION`, `TIPO_PAGO`, `NUMERO_COMPROBANTE`, `ID_COMPROBANTE`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `PAGO_EFECTIVO`, `PAGO_TARJETA`, `NUMERO_TARJETA`, `TARJETA_HABITANTE`, `CAMBIO`, `ESTADO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_SUCURSAL`,`ID_ARQUEO`,`OBSERVACION`,`PRECIO_RADIO`,`NRO_FACTURA`,`NOMBRE_PROMOTOR`) VALUES('$p_id_venta','$p_n_venta','$p_fecha_resolucion','$p_tipo_pago','$p_numero_comprobante','$p_id_comprobante','$p_sumas','$p_iva','$p_exento','$p_subtotal','$p_retenido','$p_descuento','$p_descuento_percent','$p_total','$p_prod_exentos','$p_pago_efectivo','$p_pago_tarjeta','$p_numero_tarjeta','$p_tarjeta_habitante','$p_cambio','$p_estado' ,'$p_id_cliente','$p_id_usuario','$p_id_sucursal','$id_caja','$observacion','$precio_radio','$p1','$p2')");
            $tiraje = $conexion->query(" UPDATE tiraje_comprobante SET DISPONIBLES = DISPONIBLES-1 WHERE ID_TIRAJE =  '$p_id_comprobante'");
            $tiraje->execute();
            if($p_estado==1){
                $ingreso = $conexion->query(" UPDATE `arqueocaja` SET `INGRESOS` = `INGRESOS`+$p_total WHERE `ID_ARQUEO` = '$id_caja'");
                $ingreso->execute();
            }
            return $venta;
        }
        function actualizar_catidad_lote($item,$cant){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("UPDATE `items_lote` SET `CANTIDAD`='$cant' WHERE `ID_ITEM`= '$item'");
            return $venta;
        }
        function eliminar_detalle_cotizacion($id_detalle){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("DELETE FROM `detalle_cotizacion` WHERE `ID_DETALLE` = '$id_detalle'");
            return $preventa;
        }
/* --------------------------------- NUEVOOO -------------------------------- */

/* ========================================================================== */
/*                       Lista de personas en el sistema                      */
/* ========================================================================== */

        function lista_personas(){
            $conexion = mainModel::conectar();
            $personas = $conexion->query("SELECT * FROM vista_personas");
            return $personas;
        }
    }