<?php
    class preventaModel extends mainModel{
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
/*                              Listar documentos                             */
/* ========================================================================== */

        function lista_documentos(){
            $conexion = mainModel::conectar();
            $documentos = $conexion->query("SELECT * FROM vista_documento");
            return $documentos;
        }

/* ========================================================================== */
/*                          Funcion agregar preventa                          */
/* ========================================================================== */

        function agregar_preventa($p_id_preventa,$p_n_preventa,$p_id_sucursal,$p_id_usuario,$p_id_cliente,$p_sumas,$p_iva,$p_exento,$p_subtotal,$p_retenido,$p_descuento,$p_descuento_percent,$p_total,$p_prod_exentos,$p_precio_radio,$p_fecha_registro,$p_estado,$p_observacion,$p1,$p2,$p3,$p4,$p5,$p6){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("INSERT INTO `preventa`(`ID_PREVENTA`, `N_PREVENTA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_CLIENTE`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `PRECIO_RADIO`, `FECHA_REGISTRO`, `ESTADO`,`OBSERVACION`,`NRO_FACTURA`,`NOMBRE_PROMOTOR`, `DIRECCION_FISICA`, `L1`, `L2`, `DESTINO`) VALUES ('$p_id_preventa','$p_n_preventa','$p_id_sucursal','$p_id_usuario','$p_id_cliente','$p_sumas','$p_iva','$p_exento','$p_subtotal','$p_retenido','$p_descuento','$p_descuento_percent','$p_total','$p_prod_exentos','$p_precio_radio','$p_fecha_registro','$p_estado','$p_observacion','$p1','$p2','$p3','$p4','$p5','$p6')");
            return $preventa;
        }

/* ========================================================================== */
/*                           Funcion listar preventa                          */
/* ========================================================================== */

        function lista_preventa(){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT pre.*,per.NOMBRES,per.APELLIDOS,per.PERFIL,cl.RAZON,per.ID_PERSONA,doc.DOCUMENTO,cl.N_DOCUMENTO FROM preventa as pre INNER JOIN usuario AS u ON u.ID_USUARIO = pre.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN cliente as cl ON cl.ID_CLIENTE = pre.ID_CLIENTE INNER JOIN  documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO");
            return $preventa;
        }
        function lista_preventa_pendientes(){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT pre.*,per.NOMBRES,per.APELLIDOS,per.PERFIL,cl.RAZON,cl.DIRECCION,per.ID_PERSONA,doc.DOCUMENTO,cl.N_DOCUMENTO FROM preventa as pre INNER JOIN usuario AS u ON u.ID_USUARIO = pre.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN cliente as cl ON cl.ID_CLIENTE = pre.ID_CLIENTE INNER JOIN  documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO WHERE pre.ESTADO = 1");
            return $preventa;
        }
        function lista_detalle_preventa(){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN' FROM detalle_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE pre.ESTADO !=0  ");
            return $preventa;
        }
        function lista_detalle_devolucion_preventa(){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN' FROM detalle_devolucion_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD");
            return $preventa;
        }
        function lista_detalle_preventa_devolucion_2($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',SUM(dp.CANTIDAD) as 'CANTIDADES',SUM(dp.DESCUENTO) as 'DESCUENTOS',SUM(dp.SUBTOTAL) as 'SUBTOTALES',SUM(dp.TOTAL) as 'TOTALES' FROM detalle_devolucion_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE date(dp.FECHA_REGISTRO)>='$date_1' AND date(dp.FECHA_REGISTRO)<='$date_2' AND pre.ID_SUCURSAL='$sucursal' AND pre.ESTADO !=0    GROUP BY prod.ID_PRODUCTO,dp.PRECIO_1,dp.PRECIO_2,dp.PRECIO_3,dp.PRECIO_4,pre.PRECIO_RADIO");
            return $preventa;
        }
        function lista_detalle_preventa_2($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',SUM(dp.CANTIDAD) as 'CANTIDADES',SUM(dp.DESCUENTO) as 'DESCUENTOS',SUM(dp.SUBTOTAL) as 'SUBTOTALES',SUM(dp.TOTAL) as 'TOTALES' FROM detalle_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE date(dp.FECHA_REGISTRO)>='$date_1' AND date(dp.FECHA_REGISTRO)<='$date_2' AND pre.ID_SUCURSAL='$sucursal' AND pre.ESTADO !=0  GROUP BY prod.ID_PRODUCTO,dp.PRECIO_1,dp.PRECIO_2,dp.PRECIO_3,dp.PRECIO_4,pre.PRECIO_RADIO");
            return $preventa;
        }
        function lista_detalle_preventa_3($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',SUM(dp.CANTIDAD) as 'CANTIDADES',SUM(dp.DESCUENTO) as 'DESCUENTOS',SUM(dp.SUBTOTAL) as 'SUBTOTALES',SUM(dp.TOTAL) as 'TOTALES' FROM detalle_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE date(dp.FECHA_REGISTRO)>='$date_1' AND date(dp.FECHA_REGISTRO)<='$date_2' AND pre.ID_SUCURSAL='$sucursal'  AND pre.ESTADO !=0     GROUP BY prod.ID_PRODUCTO,dp.PRECIO_1,dp.PRECIO_2,dp.PRECIO_3,dp.PRECIO_4,pre.PRECIO_RADIO,per.ID_PERSONA");
            return $preventa;
        }
        function lista_detalle_preventa_devolucione_3($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',SUM(dp.CANTIDAD) as 'CANTIDADES',SUM(dp.DESCUENTO) as 'DESCUENTOS',SUM(dp.SUBTOTAL) as 'SUBTOTALES',SUM(dp.TOTAL) as 'TOTALES' FROM detalle_devolucion_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE date(dp.FECHA_REGISTRO)>='$date_1' AND date(dp.FECHA_REGISTRO)<='$date_2' AND pre.ID_SUCURSAL='$sucursal'  AND pre.ESTADO!=0  GROUP BY prod.ID_PRODUCTO,dp.PRECIO_1,dp.PRECIO_2,dp.PRECIO_3,dp.PRECIO_4,pre.PRECIO_RADIO,per.ID_PERSONA");
            return $preventa;
        }
        function lista_detalle_preventa_devolucoion_4($date_1,$date_2,$sucursal,$persona){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',SUM(dp.CANTIDAD) as 'CANTIDADES',SUM(dp.DESCUENTO) as 'DESCUENTOS',SUM(dp.SUBTOTAL) as 'SUBTOTALES',SUM(dp.TOTAL) as 'TOTALES' FROM detalle_devolucion_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE date(dp.FECHA_REGISTRO)>='$date_1' AND date(dp.FECHA_REGISTRO)<='$date_2' AND pre.ID_SUCURSAL='$sucursal' AND per.ID_PERSONA = '$persona' AND pre.ESTADO!=0   GROUP BY prod.ID_PRODUCTO,dp.PRECIO_1,dp.PRECIO_2,dp.PRECIO_3,dp.PRECIO_4,pre.PRECIO_RADIO");
            return $preventa;
        }
        function lista_detalle_preventa_4($date_1,$date_2,$sucursal,$persona){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',SUM(dp.CANTIDAD) as 'CANTIDADES',SUM(dp.DESCUENTO) as 'DESCUENTOS',SUM(dp.SUBTOTAL) as 'SUBTOTALES',SUM(dp.TOTAL) as 'TOTALES' FROM detalle_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE date(dp.FECHA_REGISTRO)>='$date_1' AND date(dp.FECHA_REGISTRO)<='$date_2' AND pre.ID_SUCURSAL='$sucursal' AND per.ID_PERSONA = '$persona'   AND pre.ESTADO!=0 GROUP BY prod.ID_PRODUCTO,dp.PRECIO_1,dp.PRECIO_2,dp.PRECIO_3,dp.PRECIO_4,pre.PRECIO_RADIO");
            return $preventa;
        }
        function lista_preventas_sucursal($sucusal){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT pre.*,per.NOMBRES,per.APELLIDOS,per.PERFIL,cl.RAZON,per.ID_PERSONA,doc.DOCUMENTO,cl.N_DOCUMENTO FROM preventa as pre INNER JOIN usuario AS u ON u.ID_USUARIO = pre.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN cliente as cl ON cl.ID_CLIENTE = pre.ID_CLIENTE INNER JOIN  documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO WHERE pre.ID_SUCURSAL = '$sucusal'");
            return $preventa;
        }
        function agregar_detalle_preventa($p_id_detalle,$p_id_preventa,$p_id_item,$p_id_producto,$p_precio_1,$p_precio_2,$p_precio_3,$p_precio_4,$p_cantidad,$p_percent_desc,$p_descuento,$p_subtotal,$p_total,$p_fecha_registro, $p_estado,$p_precio_5=0,$p_precio_6=0,$p_precio_7=0 ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("  INSERT INTO `detalle_preventa`(`ID_DETALLE`, `ID_PREVENTA`, `ID_ITEM`, `ID_PRODUCTO`, `PRECIO_1`, `PRECIO_2`, `PRECIO_3`, `PRECIO_4`, `CANTIDAD`, `PERCENT_DESC`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `FECHA_REGISTRO`, `ESTADO`, `PRECIO_5`, `PRECIO_6`, `PRECIO_7`) VALUES ('$p_id_detalle','$p_id_preventa','$p_id_item','$p_id_producto','$p_precio_1','$p_precio_2','$p_precio_3','$p_precio_4','$p_cantidad','$p_percent_desc','$p_descuento','$p_subtotal','$p_total','$p_fecha_registro', '$p_estado','$p_precio_5','$p_precio_6','$p_precio_7' )");
            $preventa->execute();
            $preventa = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD - '$p_cantidad' WHERE  `ID_ITEM`= '$p_id_item'");
            return $preventa;
        }
        function lista_personas(){
            $conexion = mainModel::conectar();
            $personas = $conexion->query("SELECT * FROM vista_personas");
            return $personas;
        }
        function lista_items_preventa($preventa){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,prod.MEDIDA_1,prod.MEDIDA_2,prod.MEDIDA_3,prod.MEDIDA_4,prod.MEDIDA_5,prod.MEDIDA_6,prod.MEDIDA_7,prod.STOCK_1,prod.STOCK_2,prod.STOCK_3,prod.STOCK_4,prod.STOCK_5,prod.STOCK_6,prod.STOCK_7,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN' FROM detalle_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE dp.ID_PREVENTA = '$preventa'");
            return $preventa;
        }
        function eliminar_detalle_preventa($id_detalle,$id_item,$cantidad){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("DELETE FROM `detalle_preventa` WHERE `ID_DETALLE` = '$id_detalle'");
            $preventa->execute();
            $preventa = $conexion->query("UPDATE items_lote SET CANTIDAD = CANTIDAD + '$cantidad' WHERE ID_ITEM ='$id_item'");
            
            return $preventa;
        }
        function agregar_stock_prevendido($p_id_detalle ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE `detalle_preventa` SET `PRECIO_1`= '$p_precio_1',`PRECIO_2`='$p_precio_2',`PRECIO_3`= '$p_precio_3',`PRECIO_4`='$p_precio_4',`CANTIDAD`= `CANTIDAD` + '$p_cantidad',`PERCENT_DESC`='$p_percent_desc',`DESCUENTO`='$p_descuento',`SUBTOTAL`='$p_subtotal',`TOTAL`='$p_total' WHERE `ID_PREVENTA`= '$p_id_detalle'  AND `ID_ITEM`= '$p_id_item'");
            $preventa->execute();
            $preventa = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD - '$p_cantidad' WHERE  `ID_ITEM`= '$p_id_item'");
            return $preventa;
        }

        function devolver_stock_prevendido($p_id_detalle ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE `detalle_preventa` SET `PRECIO_1`= '$p_precio_1',`PRECIO_2`='$p_precio_2',`PRECIO_3`= '$p_precio_3',`PRECIO_4`='$p_precio_4',`CANTIDAD`= `CANTIDAD` - '$p_cantidad',`PERCENT_DESC`='$p_percent_desc',`DESCUENTO`='$p_descuento',`SUBTOTAL`='$p_subtotal',`TOTAL`='$p_total' WHERE`ID_PREVENTA`= '$p_id_detalle'  AND `ID_ITEM`= '$p_id_item'");
            $preventa->execute();
            $preventa = $conexion->query("  UPDATE items_lote SET CANTIDAD = CANTIDAD + '$p_cantidad' WHERE ID_ITEM ='$p_id_item'");
            return $preventa;
        }
        function devolver_stock_prevendido_detalle($p_id_detalle,$id_preventa ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ,$p1,$p2,$p3,$p4){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("INSERT INTO detalle_devolucion_preventa (`ID_DETALLE`, `ID_PREVENTA`, `ID_ITEM`, `ID_PRODUCTO`, `PRECIO_1`, `PRECIO_2`, `PRECIO_3`, `PRECIO_4`, `CANTIDAD`, `PERCENT_DESC`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `FECHA_REGISTRO`,`DETALLE`,`ID_USUARIO`) VALUES ('$p_id_detalle' ,'$id_preventa','$p_id_item','$p2' ,'$p_precio_1' ,'$p_precio_2' ,'$p_precio_3' ,'$p_precio_4' ,'$p_cantidad' ,'$p_percent_desc' ,'$p_descuento' ,'$p_subtotal' ,'$p_total','$p1','$p3','$p4')");
            return $preventa;
        }
        function actualizar_stock_prevendido($p_id_detalle ,$p_id_item ,$p_precio_1 ,$p_precio_2 ,$p_precio_3 ,$p_precio_4 ,$p_cantidad ,$p_percent_desc ,$p_descuento ,$p_subtotal ,$p_total ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE `detalle_preventa` SET `PRECIO_1`= '$p_precio_1',`PRECIO_2`='$p_precio_2',`PRECIO_3`= '$p_precio_3',`PRECIO_4`='$p_precio_4',`PERCENT_DESC`='$p_percent_desc',`DESCUENTO`='$p_descuento',`SUBTOTAL`='$p_subtotal',`TOTAL`='$p_total' WHERE`ID_PREVENTA`= '$p_id_detalle'  AND `ID_ITEM`= '$p_id_item'");
            return $preventa;
        }
        function actualizar_preventa($p_id_preventa ,$p_sumas ,$p_iva ,$p_exento ,$p_subtotal ,$p_retenido ,$p_descuento ,$p_descuento_percent ,$p_total ,$p_prod_exentos ,$p_precio_radio ,$p_estado ){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE `preventa` SET `SUMAS`='$p_sumas',`IVA`='$p_iva',`EXENTO`='$p_exento',`SUBTOTAL`='$p_subtotal',`RETENIDO`='$p_retenido',`DESCUENTO`='$p_descuento',`DESCUENTO_PERCENT`='$p_descuento_percent',`TOTAL`='$p_total',`PROD_EXENTOS`='$p_prod_exentos',`PRECIO_RADIO`='$p_precio_radio',`ESTADO`='$p_estado' WHERE `ID_PREVENTA`='$p_id_preventa'");
            return $preventa;
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
        function guardar_venta($p_id_venta,$p_n_venta,$p_fecha_resolucion,$p_tipo_pago,$p_numero_comprobante,$p_id_comprobante,$p_sumas,$p_iva,$p_exento,$p_subtotal,$p_retenido,$p_descuento,$p_descuento_percent,$p_total,$p_prod_exentos,$p_pago_efectivo,$p_pago_tarjeta,$p_numero_tarjeta,$p_tarjeta_habitante,$p_cambio,$p_estado ,$p_id_cliente,$p_id_usuario,$p_id_sucursal,$id_caja,$observacion,$precio_radio,$p1,$p2){
            $conexion = mainModel::conectar();
            $venta = $conexion->query("INSERT INTO `ventas`(`ID_VENTA`, `N_VENTA`, `FECHA_RESOLUCION`, `TIPO_PAGO`, `NUMERO_COMPROBANTE`, `ID_COMPROBANTE`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `PAGO_EFECTIVO`, `PAGO_TARJETA`, `NUMERO_TARJETA`, `TARJETA_HABITANTE`, `CAMBIO`, `ESTADO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_SUCURSAL`,`ID_ARQUEO`,`OBSERVACION`,`PRECIO_RADIO`,`NRO_FACTURA`,`NOMBRE_PROMOTOR`) VALUES('$p_id_venta','$p_n_venta','$p_fecha_resolucion','$p_tipo_pago','$p_numero_comprobante','$p_id_comprobante','$p_sumas','$p_iva','$p_exento','$p_subtotal','$p_retenido','$p_descuento','$p_descuento_percent','$p_total','$p_prod_exentos','$p_pago_efectivo','$p_pago_tarjeta','$p_numero_tarjeta','$p_tarjeta_habitante','$p_cambio','$p_estado' ,'$p_id_cliente','$p_id_usuario','$p_id_sucursal','$id_caja','$observacion','$precio_radio','$p1','$p2')");
            $tiraje = $conexion->query(" UPDATE tiraje_comprobante SET DISPONIBLES = DISPONIBLES-1 WHERE ID_TIRAJE =  '$p_id_comprobante'");
            $tiraje->execute();
            if($p_estado==1){
                $ingreso = $conexion->query(" UPDATE `arqueocaja` SET `INGRESOS` = `INGRESOS`+'$p_total' WHERE `arqueocaja`.`ID_ARQUEO` = '$id_caja'");
                $ingreso->execute();
            }
            return $venta;
        }
        function lista_detalle_venta(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM vista_detalle_venta");
            return $creditos;
        }
        function Lista_de_kardex(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `entrada_salida`");
            return $creditos;
        }
        function agregar_detalle_venta($p_id_detalle,$p_id_item,$p_id_venta,$p_cantidad,$p_precio,$p_descuento,$p_subtotal,$p_total,$p_stock){
            $conexion = mainModel::conectar();
            $detalle  = $conexion->query("INSERT INTO `detalle_venta`(`ID_DETALLE`, `ID_ITEM`, `ID_VENTA`, `CANTIDAD`, `PRECIO`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `STOCK`) VALUES('$p_id_detalle','$p_id_item','$p_id_venta','$p_cantidad','$p_precio','$p_descuento','$p_subtotal','$p_total','$p_stock')");
            return $detalle;
        }
        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $busqueda = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $busqueda;
        }
        function lista_creditos_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM `vista_credito`  WHERE ID_SUCURSAL = '$sucursal'");
            return $creditos;
        }
        function lista_creditos(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT * FROM vista_credito");
            return $creditos;
        }
        function guardar_credito($p_id_credito,$p_id_venta ,$p_id_sucursal,$p_id_cliente,$p_id_usuario,$p_codigo_credito,$p_nombre_credito,$p_fecha_credito,$p_fecha_limite,$p_monto_credito,$p_monto_abonado,$p_monto_restante,$p_estado){
            $conexion = mainModel::conectar();
            $credito = $conexion->query(" INSERT INTO `credito` (`ID_CREDITO`, `ID_VENTA`, `ID_SUCURSAL`, `ID_CLIENTE`, `ID_USUARIO`, `CODIGO_CREDITO`, `NOMBRE_CREDITO`, `FECHA_CREDITO`, `FECHA_LIMITE`, `MONTO_CREDITO`, `MONTO_ABONADO`, `MONTO_RESTANTE`, `ESTADO`) VALUES ('$p_id_credito','$p_id_venta' ,'$p_id_sucursal','$p_id_cliente','$p_id_usuario','$p_codigo_credito','$p_nombre_credito','$p_fecha_credito','$p_fecha_limite','$p_monto_credito','$p_monto_abonado','$p_monto_restante','$p_estado')");
            return $credito;
        }
        function preventa_a_venta($preventa,$estado){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("UPDATE `preventa` SET `ESTADO`='$estado' WHERE `ID_PREVENTA`='$preventa'");
            return $preventa;
        }
        function buscar_preventa($p_id_preventa){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("SELECT pre.*,per.NOMBRES,per.APELLIDOS,per.PERFIL,cl.RAZON,per.ID_PERSONA,doc.DOCUMENTO,cl.N_DOCUMENTO FROM preventa as pre INNER JOIN usuario AS u ON u.ID_USUARIO = pre.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN cliente as cl ON cl.ID_CLIENTE = pre.ID_CLIENTE INNER JOIN  documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO WHERE pre.ID_PREVENTA = '$p_id_preventa'");
            return $preventa;
        }
        function anular_preventa($preventa){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE `preventa` SET `ESTADO` = 0 WHERE `ID_PREVENTA`= '$preventa'");
            return $preventa;
        }
        function devolver_cantidad_prevendida($id_item,$cantidad){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD + $cantidad WHERE ID_ITEM ='$id_item'");
            return $preventa;
        }
    }