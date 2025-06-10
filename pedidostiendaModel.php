<?php
    class pedidostiendaModel extends mainModel{
        function lista_pedidos(){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice as i INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO WHERE  i.ESTADO = 1");
            return $pedidos;
        }
        function lista_pedidos_2(){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice as i INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO");
            return $pedidos;
        }
        function lista_pedidos_estado_usuario($usuario,$estado){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice_usuario as ai INNER JOIN invoice as i ON ai.ID_INVOICE = i.ID_INVOICE INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO WHERE ai.ID_USUARIO = '$usuario' AND i.ESTADO = '$estado'");
            return $pedidos;
        }
        function lista_pedidos_estado_usuario_fecha($usuario,$estado,$date_1,$date_2){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice_usuario as ai INNER JOIN invoice as i ON ai.ID_INVOICE = i.ID_INVOICE INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO WHERE ai.ID_USUARIO = '$usuario' AND i.ESTADO = '$estado' AND date(i.FECHA) >= '$date_1' AND date(i.FECHA) <= '$date_2'");
            return $pedidos;
        }
        function invoice_usuario(){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT * FROM invoice_usuario");
            return $pedidos;
        }
        function restar_cantidad_item($item,$cant){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD - '$cant' WHERE  `ID_ITEM`= '$item'");
            return $pedidos;
        }
        function sumar_cantidad_item($item,$cant){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("UPDATE items_lote SET CANTIDAD = CANTIDAD + $cant WHERE ID_ITEM ='$item'");
            return $pedidos;
        }
        function eliminar_kardex($id){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("DELETE FROM `entrada_salida` WHERE ID_KARDEX = '$id'");
            return $pedidos;
        }
        function seguimiento_invoice(){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT * FROM seguimiento_invoice");
            return $pedidos;
        }
        function seguimiento_pedido_detalle($id){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT * FROM seguimiento_invoice WHERE ID_INVOICE = '$id'");
            return $pedidos;
        }
        function Lista_de_kardex(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT es.*,pr.BARRA,pr.ARTICULO,li.LINEA,pre.NOMBRE as 'PRESENTACION',pr.IMAGEN,pr.ID_PRODUCTO FROM entrada_salida as es INNER JOIN items_lote as il ON es.ID_ITEM = il.ID_ITEM INNER JOIN producto as pr ON pr.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = pr.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pr.ID_PRESENTACION");
            return $kardex;
        }
        function agregar_seguimiento_invoice($ID,$ID_INVOICE,$ID_ITEM,$ID_CANTIDAD,$ID_KARDEX){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("INSERT INTO `seguimiento_invoice`(`ID_SEG`, `ID_INVOICE`, `ID_ITEM`, `ID_CANTIDAD`, `ID_KARDEX`) VALUES ('$ID','$ID_INVOICE','$ID_ITEM','$ID_CANTIDAD','$ID_KARDEX')");
            return $pedidos;
        }
        function invoice_usuario_notificacion(){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT * FROM invoice_usuario_notificacion");
            return $pedidos;
        }
        function lista_pedidos_fecha($date_1,$date_2){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice as i INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO WHERE date(i.FECHA) >= '$date_1' AND date(i.FECHA) <= '$date_2' AND i.ESTADO = 1");
            return $pedidos;
        }
        function lista_pedidos_fecha_2($date_1,$date_2){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice as i INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO WHERE date(i.FECHA) >= '$date_1' AND date(i.FECHA) <= '$date_2' ");
            return $pedidos;
        }
        function busqueda_pedido($id){
            $conexion = mainModel::conectar();
            $pedidos = $conexion->query("SELECT i.*,tc.NOMBRE,dc.DIRECCION,pro.PROVINCIA,pro.PRECIO,dep.DEPARTAMENTO FROM invoice as i INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as pro ON i.ID_PROVINCIA = pro.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = pro.ID_DEPARTAMENTO WHERE i.ID_INVOICE = '$id'");
            return $pedidos;
        }
        function detalle_de_pedido($ID){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT ip.*,pro.ID_PRODUCTO,pro.ARTICULO,pro.BARRA,pro.IMAGEN,pro.PRECIO_VENTA_1,pro.PRECIO_VENTA_2,pro.PRECIO_VENTA_3,pro.PRECIO_VENTA_4,pro.MEDIDA_1,pro.MEDIDA_2,pro.MEDIDA_3,pro.MEDIDA_4,pro.STOCK_1,pro.STOCK_1,pro.STOCK_2,pro.STOCK_3,pro.STOCK_4 ,li.LINEA FROM invoice_producto as ip INNER JOIN items_tienda as it ON ip.ID_ITEM = it.ID_ITEM INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA=pro.ID_LINEA WHERE ip.ID_INVOICE='$ID'");
            return $productos;
        }
        function estado_productos_pedidos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT ip.*,pro.ID_PRODUCTO,pro.ARTICULO,pro.BARRA,pro.IMAGEN,li.LINEA,tc.NOMBRE,doc.DOCUMENTO,tc.N_DOCUMENTO,i.ESTADO,dc.DIRECCION,prov.PROVINCIA,dep.DEPARTAMENTO,i.FECHA FROM invoice_producto as ip INNER JOIN items_tienda as it ON ip.ID_ITEM = it.ID_ITEM INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA=pro.ID_LINEA INNER JOIN invoice as i ON i.ID_INVOICE = ip.ID_INVOICE INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN documento as doc ON tc.ID_DOCUMENTO = doc.ID_DOCUMENTO INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as prov ON prov.ID_PROVINCIA = i.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = prov.ID_DEPARTAMENTO WHERE i.ESTADO != 1 AND i.ESTADO != 5 AND i.ESTADO != 0");
            return $productos;
        }
        function estado_productos_pedidos_fecha($fecha1,$fecha2){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT ip.*,pro.ID_PRODUCTO,pro.ARTICULO,pro.BARRA,pro.IMAGEN,li.LINEA,tc.NOMBRE,doc.DOCUMENTO,tc.N_DOCUMENTO,i.ESTADO,dc.DIRECCION,prov.PROVINCIA,dep.DEPARTAMENTO,i.FECHA FROM invoice_producto as ip INNER JOIN items_tienda as it ON ip.ID_ITEM = it.ID_ITEM INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA=pro.ID_LINEA INNER JOIN invoice as i ON i.ID_INVOICE = ip.ID_INVOICE INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = i.ID_CLIENTE INNER JOIN documento as doc ON tc.ID_DOCUMENTO = doc.ID_DOCUMENTO INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as prov ON prov.ID_PROVINCIA = i.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = prov.ID_DEPARTAMENTO WHERE date(i.FECHA) >='$fecha1' AND date(i.FECHA) <='$fecha2'  AND i.ESTADO != 1 AND i.ESTADO != 5 AND i.ESTADO != 0");
            return $productos;
        }
        function actualizar_pedido_estado($pedido,$estado){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("UPDATE `invoice` SET `ESTADO`='$estado' WHERE `ID_INVOICE`= '$pedido'");
            return $productos;
        }
        function agregar_pedido_usuario($id,$pedido,$usuario,$fecha){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("INSERT INTO `invoice_usuario`(`ID_INVOICE_U`, `ID_INVOICE`, `ID_USUARIO`, `FECHA`) VALUES ('$id','$pedido','$usuario','$fecha')");
            return $productos;
        }
        function agregar_notificacion_pedido_usuario($id,$descripcion,$pedido,$usuario,$estado,$fecha){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("INSERT INTO `invoice_usuario_notificacion`(`ID_NOTIFICACION`, `DESCRIPCION`, `ID_INVOICE`, `ID_USUARIO`, `ESTADO`, `FECHA`) VALUES ('$id','$descripcion','$pedido','$usuario','$estado','$fecha')");
            return $productos;
        }
        function pedidos_totales_mensuales($year){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT SUM(com.TOTAL) AS TOTAL_PEDIDO, CONCAT(MONTH(com.FECHA),'-',YEAR(com.FECHA)) AS MES_YEAR,MONTH(com.FECHA) AS MES,YEAR(com.FECHA) AS YE FROM invoice as com WHERE YEAR(com.FECHA) = '$year' AND com.ESTADO != 0 GROUP BY MES_YEAR ORDER BY MONTH(com.FECHA) ASC");
            return $compras;
        }
        function pedidos_totales_mensuales_estado($year,$estado){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT COUNT(com.TOTAL) AS TOTAL, CONCAT(MONTH(com.FECHA),'-',YEAR(com.FECHA)) AS MES_YEAR,MONTH(com.FECHA) AS MES,YEAR(com.FECHA) AS YE FROM invoice as com WHERE YEAR(com.FECHA) = '$year' AND com.ESTADO = '$estado' GROUP BY MES_YEAR ORDER BY MONTH(com.FECHA) ASC");
            return $compras;
        }
        function consulta_pedido_presentacion_mensual($year, $mes){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT pro.ID_PRESENTACION,pre.NOMBRE as 'PRESENTACION', SUM(ip.CANTIDAD) as 'TOTAL',inv.FECHA FROM invoice_producto  as ip INNER JOIN items_lote as il ON il.ID_ITEM = ip.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN invoice as inv ON inv.ID_INVOICE = ip.ID_INVOICE WHERE YEAR(inv.FECHA) = '$year' AND MONTH(inv.FECHA) = '$mes' AND inv.ESTADO = 5 GROUP BY pro.ID_PRESENTACION ORDER BY TOTAL DESC");
            return $ventas;
        }
        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $agregar_kardex = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $agregar_kardex;
        }
        function pedidos_responsabilidad_mensual_estado_usuario($year,$mes,$usuario){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT SUM(com.TOTAL) AS TOTAL, CONCAT(MONTH(com.FECHA),'-',YEAR(com.FECHA)) AS MES_YEAR,MONTH(com.FECHA) AS MES,YEAR(com.FECHA) AS YE FROM invoice as com WHERE YEAR(com.FECHA) = '$year'  AND MONTH(com.FECHA) = '$mes' AND com.ESTADO = 2 GROUP BY MES_YEAR ORDER BY MONTH(com.FECHA) ASC");
            return $compras;
        }
        function total_pedidos_activos($year,$mes){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT SUM(com.TOTAL) AS TOTAL, CONCAT(MONTH(com.FECHA),'-',YEAR(com.FECHA)) AS MES_YEAR,MONTH(com.FECHA) AS MES,YEAR(com.FECHA) AS YE FROM invoice as com WHERE YEAR(com.FECHA) = '$year'  AND MONTH(com.FECHA) = '$mes' AND com.ESTADO >= 2 ");
            return $compras;
        }
        function total_pedidos_usuario_activos($year,$mes,$usuario){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT SUM(inv.TOTAL) as 'TOTAL' ,inv.ESTADO FROM invoice_usuario as iu INNER JOIN invoice as inv ON inv.ID_INVOICE = iu.ID_INVOICE  WHERE YEAR(inv.FECHA) = '$year'  AND MONTH(inv.FECHA) = '$mes' AND inv.ESTADO >= 2 AND iu.ID_USUARIO='$usuario'");
            return $compras;
        }
        function total_pedidos_usuario_anulados($year,$mes,$usuario){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT SUM(inv.TOTAL) as 'TOTAL' ,inv.ESTADO FROM invoice_usuario as iu INNER JOIN invoice as inv ON inv.ID_INVOICE = iu.ID_INVOICE  WHERE YEAR(inv.FECHA) = '$year'  AND MONTH(inv.FECHA) = '$mes' AND inv.ESTADO = 0 AND iu.ID_USUARIO = '$usuario'");
            return $compras;
        }
        function lista_ultimas_actividades(){
            $conexion = mainModel::conectar();
            $notificacion = $conexion->query("SELECT iu.*,CONCAT(per.NOMBRES,' ',per.APELLIDOS) AS 'VENDEDOR',inv.FECHA as 'FECHA_PEDIDO',tc.NOMBRE as 'CLIENTE',tc.CORREO,inv.TOTAL FROM invoice_usuario_notificacion as iu INNER JOIN usuario as u ON u.ID_USUARIO= iu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN invoice as inv ON inv.ID_INVOICE = iu.ID_INVOICE INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE = inv.ID_CLIENTE ORDER BY iu.FECHA DESC LIMIT 20");
            return $notificacion;
        }
    }