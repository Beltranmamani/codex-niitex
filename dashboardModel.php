<?php
    class dashboardModel extends mainModel{
        function ventas_totales_mensuales($sucursal,$year){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT ven.ID_VENTA,ven.ID_SUCURSAL, SUM(ven.TOTAL) AS TOTAL_VENTAS,CONCAT(MONTH(ven.FECHA_RESOLUCION),'-',YEAR(ven.FECHA_RESOLUCION)) AS MES_YEAR,MONTH(ven.FECHA_RESOLUCION) AS MES,YEAR(ven.FECHA_RESOLUCION) AS YE FROM ventas AS ven WHERE YEAR(ven.FECHA_RESOLUCION) = '$year' AND ven.ID_SUCURSAL = '$sucursal' AND ven.ESTADO = 1 GROUP BY MES_YEAR ORDER BY MONTH(ven.FECHA_RESOLUCION) ASC");
            return $ventas;
        }
        function compras_totales_mensuales($sucursal,$year){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT alm.ID_SUCURSAL,SUM(com.TOTAL) AS TOTAL_COMPRAS, CONCAT(MONTH(com.FECHA_COMPRA),'-',YEAR(com.FECHA_COMPRA)) AS MES_YEAR,MONTH(com.FECHA_COMPRA) AS MES,YEAR(com.FECHA_COMPRA) AS YE FROM compras as com INNER JOIN almacen as alm ON alm.ID_ALMACEN = com.ID_ALMACEN WHERE YEAR(com.FECHA_COMPRA) = '$year' AND alm.ID_SUCURSAL = '$sucursal' AND com.ESTADO = 1 GROUP BY MES_YEAR ORDER BY MONTH(com.FECHA_COMPRA) ASC");
            return $compras;
        }
        function productos_mas_vendidos($sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT dv.*,pro.ARTICULO,SUM(dv.TOTAL) as 'TOTAL_VENDIDO', SUM(dv.CANTIDAD) as 'CANTIDAD_VENDIDA',pro.PRECIO_VENTA_4,pro.IMAGEN,lin.LINEA,ven.ID_SUCURSAL FROM detalle_venta as dv INNER JOIN items_lote as il ON il.ID_ITEM = dv.ID_ITEM INNER JOIN producto as pro ON il.ID_PRODUCTO = pro.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = pro.ID_LINEA INNER JOIN ventas as ven ON ven.ID_VENTA = dv.ID_VENTA WHERE ven.ID_SUCURSAL='$sucursal' GROUP BY pro.ID_PRODUCTO ORDER BY CANTIDAD_VENDIDA DESC LIMIT 10");
            return $compras;
        }
        function ventas_recientes($sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT v.*,per.NOMBRES,per.APELLIDOS,per.PERFIL FROM ventas as v INNER JOIN usuario as u ON u.ID_USUARIO = v.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA WHERE v.ID_SUCURSAL= '$sucursal' ORDER BY v.FECHA_RESOLUCION DESC LIMIT 10");
            return $compras;
        }
        function total_ventas($sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT COUNT(ID_VENTA)AS 'TOTAL' FROM ventas WHERE ID_SUCURSAL= '$sucursal'");
            return $compras;
        }
        function total_usuarios($sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT COUNT(ID_PERMISO)AS 'TOTAL' FROM usuario_sucursal WHERE ID_SUCURSAL= '$sucursal'");
            return $compras;
        }
        function total_cliente(){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT COUNT(ID_CLIENTE)AS 'TOTAL' FROM cliente");
            return $compras;
        }
        function total_compras($sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT COUNT(c.ID_COMPRA) as 'TOTAL' FROM compras AS c INNER JOIN almacen as al ON al.ID_ALMACEN = c.ID_ALMACEN WHERE al.ID_SUCURSAL= '$sucursal'");
            return $compras;
        }
        function consulta_venta_presentacion_mensual($sucursal,$year, $mes){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT dv.ID_ITEM,dv.ID_VENTA,SUM(dv.CANTIDAD) AS 'TOTAL',v.FECHA_RESOLUCION,v.ID_SUCURSAL,il.ID_PRODUCTO,pro.ARTICULO,pro.ID_PRESENTACION,pre.NOMBRE as 'PRESENTACION' FROM detalle_venta as dv INNER JOIN ventas as v ON v.ID_VENTA = dv.ID_VENTA INNER JOIN items_lote AS il ON il.ID_ITEM = dv.ID_ITEM INNER JOIN producto as pro ON il.ID_PRODUCTO = pro.ID_PRODUCTO INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION WHERE v.ID_SUCURSAL = '$sucursal' AND YEAR(v.FECHA_RESOLUCION) = '$year' AND MONTH(v.FECHA_RESOLUCION) = '$mes' AND v.ESTADO = 1 GROUP BY pro.ID_PRESENTACION ORDER BY TOTAL DESC");
            return $ventas;
        }
        function consulta_venta_semanal($sucursal,$fecha1, $fecha2){
            $conexion = mainModel::conectar();
            $ventas = $conexion->query("SELECT v.FECHA_RESOLUCION,v.ID_SUCURSAL,COUNT(v.TOTAL) AS 'CANTIDAD' ,v.ESTADO, DATE( v.FECHA_RESOLUCION) AS 'DIA' FROM ventas as v WHERE  v.ID_SUCURSAL = '$sucursal' AND DATE(v.FECHA_RESOLUCION) >= '$fecha1' AND DATE(v.FECHA_RESOLUCION) <= '$fecha2' AND v.ESTADO = 1 GROUP BY DIA");
            return $ventas;
        }
        function consulta_bitacora_mensual(){
            $conexion = mainModel::conectar();
            $bitacora = $conexion->query("SELECT COUNT(bi.NAVEGADOR) AS 'TOTAL', bi.*,u.EMAIL,CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'PERSONA',su.NOMBRE as 'SUCURSAL' FROM bitacora as bi INNER JOIN usuario as u ON bi.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = bi.ID_SUCURSAL GROUP BY bi.NAVEGADOR ORDER BY TOTAL DESC");
            return $bitacora;
        }
    }