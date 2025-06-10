<?php
    class ventasModel extends mainModel{
/* ========================================================================== */
/*                 Lista documentos disponibles en el sistema                 */
/* ========================================================================== */

                function listar_metodopagos(){
                    $conexion = mainModel::conectar();
                    $unidades = $conexion->query("SELECT * FROM metodopagos");
                    return $unidades;
                }

        function guardar_libro($id,$nro,$fecha_limite,$nro_auto,$llave,$fecha,$id_venta,$nro_factura,$total,$codigo,$id_s){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("INSERT INTO `libro_ventas`(`ID`, `NRO`, `FECHA_LIMITE`, `NRO_AUTORIZACION`, `LLAVE`, `FECHA_EMISION`, `ID_VENTA`, `NRO_FACTURA`, `TOTAL`, `CODIGO_CONTROL`, `ID_SUCURSAL`) VALUES ('$id','$nro','$fecha_limite','$nro_auto','$llave','$fecha','$id_venta','$nro_factura','$total','$codigo','$id_s')");
            return $libro;
        }
        function lista_libro_ventas(){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT lv.*,tc.NRO_RESOLUCION FROM libro_ventas as lv INNER JOIN ventas as ven ON ven.ID_VENTA = lv.ID_VENTA COLLATE utf8_unicode_ci INNER JOIN tiraje_comprobante as tc ON tc.ID_TIRAJE = ven.ID_COMPROBANTE");
            return $libro;
        }
        function buscar_libro($id){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT lv.*,tc.NRO_RESOLUCION FROM libro_ventas as lv INNER JOIN ventas as ven ON ven.ID_VENTA = lv.ID_VENTA COLLATE utf8_unicode_ci INNER JOIN tiraje_comprobante as tc ON tc.ID_TIRAJE = ven.ID_COMPROBANTE WHERE lv.ID_VENTA = '$id'");
            return $libro;
        }
        function lista_libro_ventas_sucursal($id){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT l.*,tc.NRO_RESOLUCION ,ven.ESTADO,cl.RAZON,cl.N_DOCUMENTO,ven.SUMAS,ven.SUBTOTAL,ven.IVA,ven.DESCUENTO,ven.EXENTO,ven.TOTAL AS 'TOTAL_VENTA' FROM libro_ventas as l INNER JOIN ventas as ven ON ven.ID_VENTA = l.ID_VENTA COLLATE utf8_unicode_ci INNER JOIN tiraje_comprobante as tc ON tc.ID_TIRAJE = ven.ID_COMPROBANTE INNER JOIN cliente as cl ON cl.ID_CLIENTE = ven.ID_CLIENTE WHERE l.ID_SUCURSAL = '$id'");
            return $libro;
        }
        function lista_libro_ventas_fecha_sucursal($id,$f1,$f2){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT l.*,tc.NRO_RESOLUCION ,ven.ESTADO,cl.RAZON,cl.N_DOCUMENTO,ven.SUMAS,ven.SUBTOTAL,ven.IVA,ven.DESCUENTO,ven.EXENTO,ven.TOTAL AS 'TOTAL_VENTA' FROM libro_ventas as l INNER JOIN ventas as ven ON ven.ID_VENTA = l.ID_VENTA COLLATE utf8_unicode_ci INNER JOIN cliente as cl ON cl.ID_CLIENTE = ven.ID_CLIENTE INNER JOIN tiraje_comprobante as tc ON tc.ID_TIRAJE = ven.ID_COMPROBANTE WHERE l.ID_SUCURSAL = '$id' AND date(ven.FECHA_RESOLUCION)>='$f1' AND date(ven.FECHA_RESOLUCION)<='$f2'");
            return $libro;
        }
        function lista_documentos(){
            $conexion = mainModel::conectar();
            $documentos = $conexion->query("SELECT * FROM vista_documento");
            return $documentos;
        }
        function consultar_dosificacion($id){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("SELECT * FROM `dosificacion` WHERE ID_SUCURSAL = '$id'");
            return $sucursal;
        }

/* ========================================================================== */
/*                              Lista de clientes                             */
/* ========================================================================== */

        function lista_comprobantes(){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query("SELECT * FROM vista_comprobante");
            return $comprobante;
        }

/* ========================================================================== */
/*                            Lista de comprobantes                           */
/* ========================================================================== */

        function listar_almacenesXsucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("    SELECT a.* FROM almacen as a WHERE a.ID_SUCURSAL = '$p_id_sucursal'");
            return $almacenes;
        }
        
/* ========================================================================== */
/*                              Lista items lote                              */
/* ========================================================================== */

        function listar_item_lote(){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT * FROM vista_items");
            return $items;
        }
        function listar_linea(){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("SELECT * FROM vista_lineas");
            return $linea;
        }

/* ========================================================================== */
/*                                 Buscar item                                */
/* ========================================================================== */

        function buscar_item($item){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query(" SELECT i.*,lo.NOMBRE as 'LOTE', prod.BARRA,prod.ARTICULO,prod.COMPLEMENTO,prod.EXENTO,prod.IMAGEN,prod.MEDIDA_1,prod.MEDIDA_2,prod.MEDIDA_3,prod.MEDIDA_4,prod.MEDIDA_5,prod.MEDIDA_6,prod.MEDIDA_7, prod.STOCK_1,prod.STOCK_2,prod.STOCK_3,prod.STOCK_4,prod.STOCK_5,prod.STOCK_6,prod.STOCK_7, pre.NOMBRE as 'PRESENTACION', l.LINEA, um.UNIDAD, um.PREFIJO,a.NOMBRE AS 'ALMACEN' FROM items_lote as i INNER JOIN producto as prod ON prod.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN linea as l ON l.ID_LINEA = prod.ID_LINEA INNER JOIN unidad_medida as um ON um.ID_UNIDAD = prod.ID_UNIDAD INNER JOIN lote as lo ON lo.ID_LOTE = i.ID_LOTE INNER JOIN almacen as a ON a.ID_ALMACEN = i.ID_ALMACEN WHERE i.ID_ITEM = '$item' ");
            return $almacenes;
        }
/* ========================================================================== */
/*                              Lista de tirajes                              */
/* ========================================================================== */
        function lista_tirajes(){
            $conexion = mainModel::conectar();
            $tirajes = $conexion->query("SELECT * FROM vista_tirajes");
            return $tirajes;
        }

/* ========================================================================== */
/*                           Lista de ventas totales                          */
/* ========================================================================== */

        function lista_ventas(){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT * FROM vista_ventas");
            return $ventas;
        }
        // ---- Pagos pendientes
        function lista_ventas_pagos_pendientes(){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT * FROM vista_ventas WHERE PAGO_INMEDIATO = 1 AND PAGOS_A_VENTA < TOTAL");
            return $ventas;
        }
        function lista_ventas_pagos_pendientes_usuario($usuario){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT * FROM vista_ventas WHERE ID_USUARIO = '$usuario' AND PAGO_INMEDIATO = 1 AND PAGOS_A_VENTA < TOTAL");
            return $ventas;
        }


        function lista_ventas_detail() {
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT vv.*, vdv.*, vc.RAZON as 'RAZON', dv.MEDIDA as 'MEDIDA', p.STOCK_1 as 'STOCK_1', p.STOCK_2 as 'STOCK_2', p.STOCK_3 as 'STOCK_3', p.STOCK_4 as 'STOCK_4', p.MEDIDA_1 as 'MEDIDA_1', p.MEDIDA_2 as 'MEDIDA_2', p.MEDIDA_3 as 'MEDIDA_3', p.MEDIDA_4 as 'MEDIDA_4' FROM vista_ventas as vv INNER JOIN vista_detalle_venta as vdv ON vv.ID_VENTA = vdv.ID_VENTA INNER JOIN vista_cliente as vc ON vc.ID_CLIENTE = vv.ID_CLIENTE INNER JOIN producto as p ON p.ID_PRODUCTO = vdv.ID_PRODUCTO INNER JOIN detalle_venta as dv ON dv.ID_DETALLE = vdv.ID_DETALLE");
            return $ventas;
        }
        function lista_ventas_usuario($usuario){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT * FROM vista_ventas WHERE ID_USUARIO = '$usuario'");
            return $ventas;
        }

/* ========================================================================== */
/*                          Lista de creditos totales                         */
/* ========================================================================== */

        function lista_creditos(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM vista_credito");
            return $creditos;
        }

/* ========================================================================== */
/*                       Lista de los detalle de ventas                       */
/* ========================================================================== */

        function lista_detalle_venta(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM vista_detalle_venta");
            return $creditos;
        }

/* ========================================================================== */
/*                              Lista de salidas                              */
/* ========================================================================== */

        function Lista_de_kardex(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `entrada_salida`");
            return $creditos;
        }

/* ========================================================================== */
/*                        Lista de ventas por sucursal                        */
/* ========================================================================== */

        function lista_ventas_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT v.*,c.COMPROBANTE,cl.RAZON,doc.DOCUMENTO,cl.N_DOCUMENTO,per.NOMBRES,per.PERFIL,su.NOMBRE as 'SUCURSAL',su.LOGO FROM ventas as v INNER JOIN tiraje_comprobante as tc ON tc.ID_TIRAJE = v.ID_COMPROBANTE INNER JOIN comprobante as c ON c.ID_COMPROBANTE = tc.ID_COMPROBANTE INNER JOIN cliente as cl ON cl.ID_CLIENTE = v.ID_CLIENTE INNER JOIN documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO INNER JOIN usuario as u ON u.ID_USUARIO = v.ID_USUARIO INNER JOIN persona as per ON u.ID_PERSONA = per.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = v.ID_SUCURSAL WHERE v.ID_SUCURSAL = '$sucursal'");
            return $ventas;
        }

/* ========================================================================== */
/*                       Lista de creditos por sucursal                       */
/* ========================================================================== */

        function lista_creditos_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `vista_credito`  WHERE ID_SUCURSAL ='$sucursal'");
            return $creditos;
        }
        function lista_creditos_cliente($sucursal,$cliente,$fecha1,$fecha2){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `vista_credito` WHERE ID_SUCURSAL = '$sucursal' AND ID_CLIENTE= '$cliente' AND date(FECHA_CREDITO)>='$fecha1' AND date(FECHA_CREDITO)<='$fecha2'");
            return $creditos;
        }

        function lista_creditos_fecha_sucursal($sucursal,$date1,$date2){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `vista_credito` WHERE ID_SUCURSAL='$sucursal' AND date(FECHA_CREDITO)>='$date1' AND date(FECHA_CREDITO)<='$date2'");
            return $creditos;
        }

/* ========================================================================== */
/*                        Lista de salidas por sucursal                       */
/* ========================================================================== */

        function lista_salidas_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $salida = $conexion->query("CALL sp_buscar_salida_sucursal('$sucursal')");
            return $salida;
        }

/* ========================================================================== */
/*                            Funcion buscar tiraje                           */
/* ========================================================================== */

        function busqueda_tiraje($tiraje){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query("SELECT * FROM tiraje_comprobante as ti WHERE ti.ID_TIRAJE ='$tiraje'");
            return $busqueda;
        }

/* ========================================================================== */
/*                            Funcion guardar venta                           */
/* ========================================================================== */

        function guardar_venta($p_id_venta,$p_n_venta,$p_fecha_resolucion,$p_tipo_pago,$p_numero_comprobante,$p_id_comprobante,$p_sumas,$p_iva,$p_exento,$p_subtotal,$p_retenido,$p_descuento,$p_descuento_percent,$p_total,$p_prod_exentos,$p_pago_efectivo,$p_pago_tarjeta,$p_numero_tarjeta,$p_tarjeta_habitante,$p_cambio,$p_estado ,$p_id_cliente,$p_id_usuario,$p_id_sucursal,$id_caja,$observacion,$precio_radio,$nrofactura,$nombre_promotor,$pago_pendiente_check=0,$pago_pendiente=0,$medio=1){
             $conexion = mainModel::conectar();
            $venta = $conexion->query("INSERT INTO `ventas`(`ID_VENTA`, `N_VENTA`, `FECHA_RESOLUCION`, `TIPO_PAGO`, `NUMERO_COMPROBANTE`, `ID_COMPROBANTE`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `PAGO_EFECTIVO`, `PAGO_TARJETA`, `NUMERO_TARJETA`, `TARJETA_HABITANTE`, `CAMBIO`, `ESTADO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_SUCURSAL`,`ID_ARQUEO`,`OBSERVACION`,`PRECIO_RADIO`,`NRO_FACTURA`,`NOMBRE_PROMOTOR`,`PAGO_INMEDIATO`,`PAGOS_A_VENTA`,`ID_METODOPAGO`) VALUES('$p_id_venta','$p_n_venta','$p_fecha_resolucion','$p_tipo_pago','$p_numero_comprobante','$p_id_comprobante','$p_sumas','$p_iva','$p_exento','$p_subtotal','$p_retenido','$p_descuento','$p_descuento_percent','$p_total','$p_prod_exentos','$p_pago_efectivo','$p_pago_tarjeta','$p_numero_tarjeta','$p_tarjeta_habitante','$p_cambio','$p_estado' ,'$p_id_cliente','$p_id_usuario','$p_id_sucursal','$id_caja','$observacion','$precio_radio','','','$pago_pendiente_check','$pago_pendiente','$medio')");
            $tiraje = $conexion->query(" UPDATE tiraje_comprobante SET DISPONIBLES = DISPONIBLES-1 WHERE ID_TIRAJE =  '$p_id_comprobante'");
            // $tiraje->execute();
            if($p_estado==1){
                $p_total = $pago_pendiente_check==1 ? 0 : $p_total;
                $ingreso = $conexion->query(" UPDATE `arqueocaja` SET `INGRESOS` = `INGRESOS`+'$p_total' WHERE `arqueocaja`.`ID_ARQUEO` = '$id_caja'");
             
            }
            return $venta;
        }

/* ========================================================================== */
/*                           Funcion guardar credito                          */
/* ========================================================================== */

        function guardar_credito($p_id_credito,$p_id_venta ,$p_id_sucursal,$p_id_cliente,$p_id_usuario,$p_codigo_credito,$p_nombre_credito,$p_fecha_credito,$p_fecha_limite,$p_monto_credito,$p_monto_abonado,$p_monto_restante,$p_estado){
            $conexion = mainModel::conectar();
            $credito = $conexion->query("INSERT INTO `credito` (`ID_CREDITO`, `ID_VENTA`, `ID_SUCURSAL`, `ID_CLIENTE`, `ID_USUARIO`, `CODIGO_CREDITO`, `NOMBRE_CREDITO`, `FECHA_CREDITO`, `FECHA_LIMITE`, `MONTO_CREDITO`, `MONTO_ABONADO`, `MONTO_RESTANTE`, `ESTADO`) VALUES ('$p_id_credito','$p_id_venta' ,'$p_id_sucursal','$p_id_cliente','$p_id_usuario','$p_codigo_credito','$p_nombre_credito','$p_fecha_credito','$p_fecha_limite','$p_monto_credito','$p_monto_abonado','$p_monto_restante','$p_estado')");
            return $credito;
        }

/* ========================================================================== */
/*                        Funcion agregar detalle venta                       */
/* ========================================================================== */

        function agregar_detalle_venta($p_id_detalle,$p_id_item,$p_id_venta,$p_cantidad,$p_precio,$p_descuento,$p_subtotal,$p_total,$p_stock,$medida=""){
            $conexion = mainModel::conectar();
            $detalle  = $conexion->query("INSERT INTO `detalle_venta`(`ID_DETALLE`, `ID_ITEM`, `ID_VENTA`, `CANTIDAD`, `PRECIO`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `STOCK`, `MEDIDA`) VALUES('$p_id_detalle','$p_id_item','$p_id_venta','$p_cantidad','$p_precio','$p_descuento','$p_subtotal','$p_total','$p_stock','$medida')");
            $detalle->execute();
            $detalle  = $conexion->query("UPDATE items_lote SET CANTIDAD = CANTIDAD - '$p_cantidad' WHERE ID_ITEM = '$p_id_item' ");
            return $detalle;
        }
        
    /* ========================================================================== */
    /*                     Funcion agregar salida de productos                    */
    /* ========================================================================== */
    
        function agregar_salida($p_id_salida,$p_codigo_salida,$p_detalle ,$p_fecha ,$p_id_item,$p_id_venta,$p_id_sucursal,$p_cantidad,$p_precio,$p_descuento,$p_subtotal,$p_total,$p_stock){
            $conexion = mainModel::conectar();
            $salida  = $conexion->query("CALL sp_agregar_salida('$p_id_salida','$p_codigo_salida','$p_detalle' ,'$p_fecha' ,'$p_id_item','$p_id_venta','$p_id_sucursal','$p_cantidad','$p_precio','$p_descuento','$p_subtotal','$p_total','$p_stock')");
            return $salida;
            
        }

/* ========================================================================== */
/*                          Funcion busqueda de venta                         */
/* ========================================================================== */

        function busqueda_venta($venta){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query(" SELECT vv.*,ca.NRO_CAJA,ca.NOMBRE_CAJA FROM vista_ventas AS vv INNER JOIN arqueocaja as ac ON ac.ID_ARQUEO = vv.ID_ARQUEO INNER JOIN caja as ca ON ca.ID_CAJA = ac.ID_CAJA WHERE vv.ID_VENTA = '$venta' ");
            return $busqueda;
        }

/* ========================================================================== */
/*                    Funcion busqueda de items de la venta                   */
/* ========================================================================== */

        static function busqueda_item_venta($venta){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query("SELECT*FROM vista_detalle_venta WHERE ID_VENTA ='$venta'");
            return $busqueda;
        }
        function busqueda_item_venta2($venta){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query("SELECT v.*,p.*,lo.NOMBRE as 'LOTE',il.FECHA_VEN FROM detalle_venta as v INNER JOIN items_lote as il On il.ID_ITEM = v.ID_ITEM INNER JOIN producto as p ON il.ID_PRODUCTO = p.ID_PRODUCTO inner join lote AS lo ON lo.ID_LOTE = il.ID_LOTE WHERE v.ID_VENTA = '$venta'");
            return $busqueda;
        }

/* ========================================================================== */
/*                         Funcion para agregar kardex                        */
/* ========================================================================== */

        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $busqueda;
        }

/* ========================================================================== */
/*                       Lista de productos por sucursal                      */
/* ========================================================================== */

        function lista_productos_sucursal(){
            $conexion = mainModel::conectar();
            $lista = $conexion->query("SELECT `i`.`ID_ITEM` AS `ID_ITEM`, `i`.`ID_ALMACEN` AS `ID_ALMACEN`, `i`.`ID_LOTE` AS `ID_LOTE`, `i`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `i`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `i`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `i`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `i`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `i`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `i`.`PRECIO_VENTA_5` AS `PRECIO_VENTA_5`,`i`.`PRECIO_VENTA_6` AS `PRECIO_VENTA_6`,`i`.`PRECIO_VENTA_7` AS `PRECIO_VENTA_7`,`i`.`CANTIDAD` AS `CANTIDAD`, `i`.`PERECEDERO` AS `PERECEDERO`, `i`.`FECHA_VEN` AS `FECHA_VEN`, `i`.`ID_USUARIO` AS `ID_USUARIO`, `lo`.`NOMBRE` AS `LOTE`, `prod`.`BARRA` AS `BARRA`, `prod`.`ARTICULO` AS `ARTICULO`, `prod`.`STOCK_1` AS `STOCK_1`, `prod`.`STOCK_2` AS `STOCK_2`, `prod`.`STOCK_3` AS `STOCK_3`, `prod`.`STOCK_4` AS `STOCK_4`, `prod`.`STOCK_5` AS `STOCK_5`, `prod`.`STOCK_6` AS `STOCK_6`, `prod`.`STOCK_7` AS `STOCK_7`,  `prod`.`MEDIDA_1` AS `MEDIDA_1`,`prod`.`MEDIDA_2` AS `MEDIDA_2`,`prod`.`MEDIDA_3` AS `MEDIDA_3`,`prod`.`MEDIDA_4` AS `MEDIDA_4`, `prod`.`MEDIDA_5` AS `MEDIDA_5`, `prod`.`MEDIDA_6` AS `MEDIDA_6`, `prod`.`MEDIDA_7` AS `MEDIDA_7`, `prod`.`COMPLEMENTO` AS `COMPLEMENTO`, `prod`.`IMAGEN` AS `IMAGEN`, `prod`.`STOCK_MINIMO` AS `STOCK_MINIMO`, `prod`.`STOCK_MODERADO` AS `STOCK_MODERADO`, `prod`.`STOCK_MEDIO` AS `STOCK_MEDIO`, `prod`.`EXENTO` AS `EXENTO`, `pre`.`ID_PRESENTACION` AS `ID_PRESENTACION`, `pre`.`NOMBRE` AS `PRESENTACION`, `l`.`LINEA` AS `LINEA`, `l`.`ID_LINEA` AS `ID_LINEA`, `um`.`UNIDAD` AS `UNIDAD`, `um`.`PREFIJO` AS `PREFIJO`, `a`.`NOMBRE` AS `ALMACEN`, `a`.`ID_SUCURSAL` AS `ID_SUCURSAL` FROM ((((((`items_lote` `i` join `producto` `prod` on((`prod`.`ID_PRODUCTO` = `i`.`ID_PRODUCTO`))) join `presentacion` `pre` on((`pre`.`ID_PRESENTACION` = `prod`.`ID_PRESENTACION`))) join `linea` `l` on((`l`.`ID_LINEA` = `prod`.`ID_LINEA`))) join `unidad_medida` `um` on((`um`.`ID_UNIDAD` = `prod`.`ID_UNIDAD`))) join `lote` `lo` on((`lo`.`ID_LOTE` = `i`.`ID_LOTE`))) join `almacen` `a` on((`a`.`ID_ALMACEN` = `i`.`ID_ALMACEN`)))");
            return $lista;
        }

/* ========================================================================== */
/*                            Listar presentaciones                           */
/* ========================================================================== */

        function listar_presentacion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM vista_presentacion");
            return $presentacion;
        }

/* ========================================================================== */
/*                         Lista de productos vendidos                        */
/* ========================================================================== */

        function productos_vendidos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM vista_productos_venta");
            return $productos;
        }
        function productos_vendidos_porfecha_sucursal($f1="",$f2="",$sucursal,$producto=""){
            $conexion = mainModel::conectar();
            if($producto == "")
                $productos = $conexion->query("SELECT dv.MEDIDA as 'MEDIDA', vc.RAZON as 'CLIENTE', SUM(dv.CANTIDAD) as 'VENTAS', pr.STOCK_MEDIO as 'STOCK_MEDIO', pr.MEDIDA_4 as 'MEDIDA_4', pr.MEDIDA_1 as 'MEDIDA_1', pr.MEDIDA_2 as 'MEDIDA_2', pr.MEDIDA_3 as 'MEDIDA_3', pr.MEDIDA_5 as 'MEDIDA_5', pr.MEDIDA_6 as 'MEDIDA_6', pr.MEDIDA_7 as 'MEDIDA_7', pr.STOCK_1 as 'STOCK_1', pr.STOCK_2 as 'STOCK_2', pr.STOCK_3 as 'STOCK_3', pr.STOCK_4 as 'STOCK_4', pr.STOCK_5 as 'STOCK_5', pr.STOCK_6 as 'STOCK_6', pr.STOCK_7 as 'STOCK_7', vv.N_VENTA as 'N_VENTA', vpv.*,lot.NOMBRE as 'LOTE',SUM(vpv.CANTIDAD)as 'CANT',SUM(vpv.TOTAL)as 'TOTALES',SUM(vpv.SUBTOTAL)as 'SUBTOTALES',SUM(vpv.DESCUENTO)as 'DESCUENTOS',il.ID_PRODUCTO FROM vista_productos_venta as vpv INNER JOIN items_lote as il ON il.ID_ITEM = vpv.ID_ITEM INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE INNER JOIN vista_ventas as vv ON vv.ID_VENTA = vpv.ID_VENTA INNER JOIN vista_detalle_venta as vdv ON vdv.ID_DETALLE = vpv.ID_DETALLE INNER JOIN producto as pr ON pr.ID_PRODUCTO = vdv.ID_PRODUCTO INNER JOIN vista_cliente as vc ON vc.ID_CLIENTE = vv.ID_CLIENTE INNER JOIN detalle_venta as dv ON dv.ID_DETALLE = vpv.ID_DETALLE WHERE DATE(vpv.FECHA_RESOLUCION) >= '$f1' AND DATE(vpv.FECHA_RESOLUCION) <= '$f2' AND vpv.ID_SUCURSAL = '$sucursal' AND vv.ESTADO != 0 GROUP BY il.ID_PRODUCTO, vpv.PRECIO");
            else {
                $productos = $conexion->query("SELECT dv.MEDIDA as 'MEDIDA', vc.RAZON as 'CLIENTE', SUM(dv.CANTIDAD) as 'VENTAS', pr.STOCK_MEDIO as 'STOCK_MEDIO', pr.MEDIDA_4 as 'MEDIDA_4', pr.MEDIDA_1 as 'MEDIDA_1', pr.MEDIDA_2 as 'MEDIDA_2', pr.MEDIDA_3 as 'MEDIDA_3', pr.MEDIDA_5 as 'MEDIDA_5', pr.MEDIDA_6 as 'MEDIDA_6', pr.MEDIDA_7 as 'MEDIDA_7', pr.STOCK_1 as 'STOCK_1', pr.STOCK_2 as 'STOCK_2', pr.STOCK_3 as 'STOCK_3', pr.STOCK_4 as 'STOCK_4', pr.STOCK_5 as 'STOCK_5', pr.STOCK_6 as 'STOCK_6', pr.STOCK_7 as 'STOCK_7', vv.N_VENTA as 'N_VENTA', vpv.*,lot.NOMBRE as 'LOTE',SUM(vpv.CANTIDAD)as 'CANT',SUM(vpv.TOTAL)as 'TOTALES',SUM(vpv.SUBTOTAL)as 'SUBTOTALES',SUM(vpv.DESCUENTO)as 'DESCUENTOS',il.ID_PRODUCTO FROM vista_productos_venta as vpv INNER JOIN items_lote as il ON il.ID_ITEM = vpv.ID_ITEM INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE INNER JOIN vista_ventas as vv ON vv.ID_VENTA = vpv.ID_VENTA INNER JOIN vista_detalle_venta as vdv ON vdv.ID_DETALLE = vpv.ID_DETALLE INNER JOIN producto as pr ON pr.ID_PRODUCTO = vdv.ID_PRODUCTO INNER JOIN vista_cliente as vc ON vc.ID_CLIENTE = vv.ID_CLIENTE INNER JOIN detalle_venta as dv ON dv.ID_DETALLE = vpv.ID_DETALLE WHERE DATE(vpv.FECHA_RESOLUCION) >= '$f1' AND DATE(vpv.FECHA_RESOLUCION) <= '$f2' AND pr.ID_PRODUCTO = '$producto' AND vpv.ID_SUCURSAL = '$sucursal' AND vv.ESTADO != 0 GROUP BY il.ID_PRODUCTO, vpv.PRECIO");
            }
            return $productos;
        }
        function productos_vendidos_vendedor_porfecha_sucursal($f1,$f2,$sucursal){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT vpv.*,lot.NOMBRE as 'LOTE',SUM(vpv.CANTIDAD)as 'CANT',SUM(vpv.TOTAL)as 'TOTALES',SUM(vpv.SUBTOTAL)as 'SUBTOTALES',SUM(vpv.DESCUENTO)as 'DESCUENTOS',il.ID_PRODUCTO,CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' FROM vista_productos_venta as vpv INNER JOIN items_lote as il ON il.ID_ITEM = vpv.ID_ITEM INNER JOIN ventas as ven ON ven.ID_VENTA = vpv.ID_VENTA INNER JOIN usuario as usu ON usu.ID_USUARIO = ven.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA  INNER JOIN lote as lot ON lot.ID_LOTE =  il.ID_LOTE WHERE DATE(vpv.FECHA_RESOLUCION) >= '$f1' AND DATE(vpv.FECHA_RESOLUCION) <= '$f2' AND vpv.ID_SUCURSAL = '$sucursal' AND ven.ESTADO!=0  GROUP BY il.ID_PRODUCTO,vpv.PRECIO, ven.ID_USUARIO");
            return $productos;
        }

        function anular_venta($id_venta){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("UPDATE `ventas` SET `ESTADO`= 0  WHERE `ID_VENTA`= '$id_venta'");
            return $venta;
        }
        function sumar_item_lote($p_id_item,$p_cantidad){
            $conexion = mainModel::conectar();
            $venta = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD + $p_cantidad WHERE ID_ITEM ='$p_id_item'");
            return $venta;
        }
        function actualizar_arqueo($arqueo,$total){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("UPDATE `arqueocaja` SET `INGRESOS`=`INGRESOS`- '$total' WHERE `ID_ARQUEO`= '$arqueo'");
            return $venta;
        }
        function anular_creditos($venta){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("UPDATE `credito` SET `ESTADO`= 0 WHERE `ID_VENTA`= '$venta'" );
            return $venta;
        }

        function lista_clientes(){
            $conexion = mainModel::conectar();
            $clientes = $conexion->query("SELECT * FROM vista_cliente");
            return $clientes;
        }
        function informacion_credito($id_credito){
            $conexion = mainModel::conectar();
            $credito = $conexion->query("SELECT * FROM `vista_credito` WHERE ID_CREDITO = '$id_credito'");
            return $credito;
        }
        function cambiar_estado_venta($venta){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("UPDATE `ventas` SET `ESTADO` = 1 WHERE `ID_VENTA`= '$venta'");
            return $venta;
        }
        function cambiar_estado_venta_credito($venta){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("UPDATE `ventas` SET `ESTADO` = 4 WHERE `ID_VENTA`= '$venta'");
            return $venta;
        }
        function lista_pagos_credito(){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT pc.*,cc.N_COTIZACION as 'N_CREDITO', cc.TOTAL,cc.PAGADO,cc.PENDIENTE,com.N_COMPRA, com.ESTADO as 'ESTADO_COMPRA',CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' , pro.RAZON AS 'PROVEEDOR' FROM pagos_credito as pc INNER JOIN creditos_compra as cc ON cc.ID_CREDITO = pc.ID_CREDITO INNER JOIN compras as com ON com.ID_COMPRA = cc.ID_COMPRA INNER JOIN usuario as usu ON usu.ID_USUARIO = pc.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN proveedor as pro ON pro.ID_PROVEEDOR = com.ID_PROVEEDOR");
            return $movimientos;
        }
        //agregar funcion
        function lista_pagos_credito_count(){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT * FROM `cobros_credito`");
            return $movimientos;
        }
        function abono_credito_de_venta($id_credito,$pagado,$pendiente,$estado){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("UPDATE `credito` SET `MONTO_ABONADO`= '$pagado',`MONTO_RESTANTE`= '$pendiente',`ESTADO`= '$estado' WHERE `ID_CREDITO`= '$id_credito'");
            return $compra;
        }
        function agregar_cobro_credito_de_venta($p_id_pago,$p_id_credito,$p_id_caja,$p_id_usuario,$p_id_sucursal,$p_monto,$p_pago_con,$p_cambio,$p_fecha_registro,$p_estado,$pendiente){
            $conexion = mainModel::conectar();
            $cobro = $conexion->query("INSERT INTO `cobros_credito`(`ID_COBRO`, `ID_CREDITO`, `ID_CAJA`, `ID_USUARIO`, `ID_SUCURSAL`, `MONTO`, `PAGO_CON`, `CAMBIO`, `FECHA_REGISTRO`, `ESTADO`,`PENDIENTE_AC`) VALUES ('$p_id_pago','$p_id_credito','$p_id_caja','$p_id_usuario','$p_id_sucursal','$p_monto','$p_pago_con','$p_cambio','$p_fecha_registro','$p_estado','$pendiente')");
            return $cobro;
        }
        function lista_de_movimientos(){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT m.*,c.ID_CAJA,c.NRO_CAJA,c.NOMBRE_CAJA,c.ID_SUCURSAL,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS)  as 'VENDEDOR',usu.ID_USUARIO FROM movimientoscajas as m INNER JOIN arqueocaja as a ON m.ID_ARQUEO = a.ID_ARQUEO INNER JOIN caja as c ON c.ID_CAJA = a.ID_CAJA INNER JOIN usuario as usu ON c.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA");
            return $movimientos;
        }
        function agregar_movimiento($p_id_movimiento,$p_id_arqueo,$p_tipomovimiento,$p_descripcionmovimiento,$p_montomovimiento,$p_codmediopago,$p_fechamovimiento){
            $conexion = mainModel::conectar();
            $sql = "INSERT INTO `movimientoscajas`(`ID_MOVIMIENTO`, `ID_ARQUEO`, `TIPOMOVIMIENTO`, `DESCRIPCIONMOVIMIENTO`, `MONTOMOVIMIENTO`, `CODMEDIOPAGO`, `FECHAMOVIMIENTO`) VALUES ('$p_id_movimiento','$p_id_arqueo','$p_tipomovimiento','$p_descripcionmovimiento','$p_montomovimiento','$p_codmediopago','$p_fechamovimiento')";
            $sql = $conexion->query($sql);
            $sql->execute();
            $movimiento = "";
            if ($p_tipomovimiento == 'INGRESO') {
                $movimiento = $conexion->query("UPDATE `arqueocaja` SET `INGRESOS` = `INGRESOS`+'$p_montomovimiento' WHERE `arqueocaja`.`ID_ARQUEO` = '$p_id_arqueo'");
            }elseif( $p_tipomovimiento == 'EGRESO' ){
                $movimiento = $conexion->query("UPDATE `arqueocaja` SET `EGRESOS` = `EGRESOS`+'$p_montomovimiento' WHERE `arqueocaja`.`ID_ARQUEO` = '$p_id_arqueo'");
                
            }elseif ($p_tipomovimiento == 'CREDITO') {
                $movimiento = $conexion->query("UPDATE `arqueocaja` SET `CREDITOS` = `CREDITOS`+'$p_montomovimiento' WHERE `arqueocaja`.`ID_ARQUEO` = '$p_id_arqueo'");
                
            }else{
                $movimiento = $conexion->query("UPDATE `arqueocaja` SET `ABONOS` = `ABONOS`+'$p_montomovimiento' WHERE `arqueocaja`.`ID_ARQUEO` = '$p_id_arqueo'");
               
            }
            return $movimiento;
        }
        function lista_cobros_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $cobros = $conexion->query("SELECT cc.*,vn.N_VENTA,vn.ID_VENTA,cr.CODIGO_CREDITO,cr.MONTO_CREDITO,cr.MONTO_ABONADO,cr.MONTO_RESTANTE,cr.NOMBRE_CREDITO,cl.RAZON,doc.DOCUMENTO,cl.N_DOCUMENTO,cl.ID_CLIENTE, vn.ESTADO as 'ESTADO_VENTA', cr.ESTADO as 'ESTADO_CREDITO', CONCAT(per.NOMBRES,' ',per.APELLIDOS ) as 'VENDEDOR' FROM cobros_credito AS cc INNER JOIN credito AS cr ON cr.ID_CREDITO = cc.ID_CREDITO INNER JOIN ventas as vn ON vn.ID_VENTA = cr.ID_VENTA INNER JOIN cliente as cl ON cl.ID_CLIENTE = cr.ID_CLIENTE INNER JOIN documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO INNER JOIN usuario as us ON us.ID_USUARIO = cc.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = us.ID_PERSONA  WHERE cc.ID_SUCURSAL = '$sucursal'");
            return $cobros;
        }
         function lista_personas(){
            $conexion = mainModel::conectar();
            $personas = $conexion->query("SELECT * FROM vista_personas");
            return $personas;
        }
        function historial_creditos_cliente($sucursal,$cliente){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `vista_credito` WHERE ID_SUCURSAL = '$sucursal' AND ID_CLIENTE= '$cliente' ORDER BY FECHA_CREDITO ASC ");
            return $creditos;
        }

        function productos_vendidos_v2() {
            $conexion = mainModel::conectar();
            $productos = $conexion->query("CALL sp_buscar_productos_ventas");
            return $productos;
        }

        function productos_by_name($nombre) {
            $conexion = mainModel::conectar();
            $productos = $conexion->query("CALL sp_buscar_productos_ventas_by_producto('$nombre')");
            return $productos;
        }

        function lista_productos() {
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM `vista_productos`");
            return $productos;
        }
        function lista_productos_sucursal_almacen_2($id){
            $conexion = mainModel::conectar();
            $lista = $conexion->query("SELECT `i`.`ID_ITEM` AS `ID_ITEM`, `i`.`ID_ALMACEN` AS `ID_ALMACEN`, `i`.`ID_LOTE` AS `ID_LOTE`, `i`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `i`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `i`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `i`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `i`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `i`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `i`.`CANTIDAD` AS `CANTIDAD`, `i`.`PERECEDERO` AS `PERECEDERO`, `i`.`FECHA_VEN` AS `FECHA_VEN`, `i`.`ID_USUARIO` AS `ID_USUARIO`, `lo`.`NOMBRE` AS `LOTE`, `prod`.`BARRA` AS `BARRA`, `prod`.`ARTICULO` AS `ARTICULO`, `prod`.`STOCK_1` AS `STOCK_1`, `prod`.`STOCK_2` AS `STOCK_2`, `prod`.`STOCK_3` AS `STOCK_3`, `prod`.`STOCK_4` AS `STOCK_4`,  `prod`.`MEDIDA_1` AS `MEDIDA_1`,`prod`.`MEDIDA_2` AS `MEDIDA_2`,`prod`.`MEDIDA_3` AS `MEDIDA_3`,`prod`.`MEDIDA_4` AS `MEDIDA_4`, `prod`.`COMPLEMENTO` AS `COMPLEMENTO`, `prod`.`IMAGEN` AS `IMAGEN`, `prod`.`STOCK_MINIMO` AS `STOCK_MINIMO`, `prod`.`STOCK_MODERADO` AS `STOCK_MODERADO`, `prod`.`STOCK_MEDIO` AS `STOCK_MEDIO`, `prod`.`EXENTO` AS `EXENTO`, `pre`.`ID_PRESENTACION` AS `ID_PRESENTACION`, `pre`.`NOMBRE` AS `PRESENTACION`, `l`.`LINEA` AS `LINEA`, `l`.`ID_LINEA` AS `ID_LINEA`, `um`.`UNIDAD` AS `UNIDAD`, `um`.`PREFIJO` AS `PREFIJO`, `a`.`NOMBRE` AS `ALMACEN`, `a`.`ID_SUCURSAL` AS `ID_SUCURSAL` FROM ((((((`items_lote` `i` join `producto` `prod` on((`prod`.`ID_PRODUCTO` = `i`.`ID_PRODUCTO`))) join `presentacion` `pre` on((`pre`.`ID_PRESENTACION` = `prod`.`ID_PRESENTACION`))) join `linea` `l` on((`l`.`ID_LINEA` = `prod`.`ID_LINEA`))) join `unidad_medida` `um` on((`um`.`ID_UNIDAD` = `prod`.`ID_UNIDAD`))) join `lote` `lo` on((`lo`.`ID_LOTE` = `i`.`ID_LOTE`))) join `almacen` `a` on((`a`.`ID_ALMACEN` = `i`.`ID_ALMACEN`))) WHERE `a`.`ID_ALMACEN` = '$id' AND `i`.`CANTIDAD` > 0" );
            return $lista;
        }
    }