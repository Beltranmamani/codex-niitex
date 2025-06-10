<?php
    class kardexModel extends mainModel{

/* ========================================================================== */
/*                             Lista de productos                             */
/* ========================================================================== */

        function lista_productos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM `vista_productos`");
            return $productos;
        }

/* ========================================================================== */
/*                               Lista de kardex                              */
/* ========================================================================== */
function lista_kardex_producto_ID($id){
    $conexion = mainModel::conectar();
    $kardex = $conexion->query("   SELECT i.ID_ITEM,i.ID_PRODUCTO,SUM(i.CANTIDAD) AS 'STOCK',i.ID_ALMACEN, p.BARRA,p.ARTICULO,p.IMAGEN,p.COMPLEMENTO,um.UNIDAD,um.PREFIJO,pr.NOMBRE as 'PRESENTACION',l.LINEA,p.PRECIO_COSTO,p.PRECIO_VENTA_4,p.STOCK_MINIMO,p.STOCK_MEDIO,p.STOCK_MODERADO, alm.NOMBRE as 'ALMACEN', suc.NOMBRE as 'SUCURSAL',lo.NOMBRE as 'LOTE' FROM items_lote AS i INNER JOIN lote as lo ON lo.ID_LOTE = i.ID_LOTE INNER JOIN producto as p ON p.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD INNER JOIN almacen as alm ON alm.ID_ALMACEN = i.ID_ALMACEN INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = alm.ID_SUCURSAL WHERE i.ID_PRODUCTO ='$id'   GROUP BY i.ID_PRODUCTO,lo.ID_LOTE,suc.ID_SUCURSAL,alm.ID_ALMACEN;");
    return $kardex;
}
 function lista_kardex_producto_all(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("   SELECT i.ID_ITEM,i.ID_PRODUCTO,SUM(i.CANTIDAD) AS 'STOCK',i.ID_ALMACEN, p.BARRA,p.ARTICULO,p.IMAGEN,p.COMPLEMENTO,um.UNIDAD,um.PREFIJO,pr.NOMBRE as 'PRESENTACION',l.LINEA,p.PRECIO_COSTO,p.PRECIO_VENTA_4,p.STOCK_MINIMO,p.STOCK_MEDIO,p.STOCK_MODERADO, alm.NOMBRE as 'ALMACEN', suc.NOMBRE as 'SUCURSAL',lo.NOMBRE as 'LOTE' FROM items_lote AS i INNER JOIN lote as lo ON lo.ID_LOTE = i.ID_LOTE INNER JOIN producto as p ON p.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD INNER JOIN almacen as alm ON alm.ID_ALMACEN = i.ID_ALMACEN INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = alm.ID_SUCURSAL  GROUP BY i.ID_PRODUCTO,lo.ID_LOTE,suc.ID_SUCURSAL,alm.ID_ALMACEN;");
            return $kardex;
        }
        function lista_kardex(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT * FROM `vista_kardex` ORDER BY `vista_kardex`.`FECHA` DESC");
            return $kardex;
        }
        function lista_kardex_producto($producto,$sucursal){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT es.*,lot.NOMBRE as 'LOTE',pr.BARRA,pr.ARTICULO,li.LINEA,pre.NOMBRE as 'PRESENTACION',pr.IMAGEN,pr.ID_PRODUCTO FROM entrada_salida as es INNER JOIN items_lote as il ON es.ID_ITEM = il.ID_ITEM INNER JOIN producto as pr ON pr.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = pr.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pr.ID_PRESENTACION INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE pr.ID_PRODUCTO = '$producto'   AND es.ID_SUCURSAL = '$sucursal'  ORDER BY es.ID_KARDEX DESC;");
            return $kardex;
        }
        function lista_kardex_valorizado_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT i.ID_ITEM,i.ID_PRODUCTO,SUM(i.CANTIDAD) AS 'STOCK',(i.CANTIDAD*i.PRECIO_COSTO) AS 'TOTAL_COMPRA',(i.CANTIDAD*i.PRECIO_VENTA_4) AS 'TOTAL_VENTA',((i.CANTIDAD*i.PRECIO_VENTA_4)-(i.CANTIDAD*i.PRECIO_COSTO))as 'GANANCIA',i.ID_ALMACEN, alm.ID_SUCURSAL, p.BARRA,p.ARTICULO,p.IMAGEN,p.COMPLEMENTO,um.UNIDAD,um.PREFIJO,pr.NOMBRE as 'PRESENTACION',l.LINEA,i.PRECIO_COSTO,p.STOCK_MINIMO,p.STOCK_MEDIO,p.STOCK_MODERADO,i.PRECIO_VENTA_1,i.PRECIO_VENTA_2,i.PRECIO_VENTA_3,i.PRECIO_VENTA_4,lot.NOMBRE as 'LOTE' FROM items_lote AS i INNER JOIN lote as lot ON lot.ID_LOTE = i.ID_LOTE INNER JOIN producto as p ON p.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = i.ID_ALMACEN INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD WHERE i.CANTIDAD>0 AND alm.ID_SUCURSAL = '$sucursal'  GROUP BY i.ID_PRODUCTO,i.ID_LOTE;            ");
            return $kardex;
        }
        function lista_kardex_valorizado_vendedor_fecha($id_persona,$fecha_1,$fecha_2,$id_sucursal){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT det.*,lot.NOMBRE as 'LOTE', il.CANTIDAD as 'STOCK_ACTUAL',SUM(det.CANTIDAD) AS 'VENTAS',SUM(det.DESCUENTO) AS 'DESCUENTO_VENTA',(SUM(det.CANTIDAD)*det.PRECIO) as 'TOTAL_VENTA',(SUM(det.CANTIDAD)*il.PRECIO_COSTO) as 'TOTAL_COMPRA',il.PRECIO_COSTO as 'PRECIO_COSTO_LOTE', (SUM(det.CANTIDAD)*det.PRECIO)-SUM(det.CANTIDAD)*il.PRECIO_COSTO AS 'GANANCIA',usu.ID_USUARIO,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR',ven.ID_SUCURSAL,ven.FECHA_RESOLUCION,pro.ID_PRODUCTO,pro.ARTICULO,pro.COMPLEMENTO,pro.PRECIO_COSTO,pro.BARRA,pro.IMAGEN,pro.MEDIDA_1,pro.MEDIDA_2,pro.MEDIDA_3,pro.MEDIDA_4,pro.STOCK_1,pro.STOCK_2,pro.STOCK_3,pro.STOCK_4,pro.PRECIO_VENTA_1,pro.PRECIO_VENTA_2,pro.PRECIO_VENTA_3,pro.PRECIO_VENTA_4,um.UNIDAD,um.PREFIJO,pre.NOMBRE as 'PRESENTACION', li.LINEA FROM detalle_venta as det INNER JOIN ventas as ven ON ven.ID_VENTA = det.ID_VENTA INNER JOIN usuario as usu ON ven.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN items_lote as il ON il.ID_ITEM = det.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN unidad_medida as um ON um.ID_UNIDAD = pro.ID_UNIDAD INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE DATE(ven.FECHA_RESOLUCION) >= '$fecha_1' AND DATE(ven.FECHA_RESOLUCION) <= '$fecha_2' AND per.ID_PERSONA = '$id_persona' AND ven.ID_SUCURSAL = '$id_sucursal' AND ven.ESTADO != 0 GROUP BY pro.ID_PRODUCTO,det.MEDIDA,il.PRECIO_COSTO");
            return $kardex;
        }
        function lista_kardex_valorizado_vendedor_fecha_all($id_persona,$fecha_1,$fecha_2,$id_sucursal){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT det.*,lot.NOMBRE as 'LOTE', il.CANTIDAD as 'STOCK_ACTUAL',SUM(det.CANTIDAD) AS 'VENTAS',SUM(det.DESCUENTO) AS 'DESCUENTO_VENTA',(SUM(det.CANTIDAD)*det.PRECIO) as 'TOTAL_VENTA',(SUM(det.CANTIDAD)*il.PRECIO_COSTO) as 'TOTAL_COMPRA',il.PRECIO_COSTO as 'PRECIO_COSTO_LOTE', (SUM(det.CANTIDAD)*det.PRECIO)-SUM(det.CANTIDAD)*il.PRECIO_COSTO AS 'GANANCIA',usu.ID_USUARIO,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR',ven.ID_SUCURSAL,ven.FECHA_RESOLUCION,pro.ID_PRODUCTO,pro.ARTICULO,pro.COMPLEMENTO,pro.PRECIO_COSTO,pro.BARRA,pro.IMAGEN,pro.MEDIDA_1,pro.MEDIDA_2,pro.MEDIDA_3,pro.MEDIDA_4,pro.STOCK_1,pro.STOCK_2,pro.STOCK_3,pro.STOCK_4,pro.PRECIO_VENTA_1,pro.PRECIO_VENTA_2,pro.PRECIO_VENTA_3,pro.PRECIO_VENTA_4,um.UNIDAD,um.PREFIJO,pre.NOMBRE as 'PRESENTACION', li.LINEA FROM detalle_venta as det INNER JOIN ventas as ven ON ven.ID_VENTA = det.ID_VENTA INNER JOIN usuario as usu ON ven.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN items_lote as il ON il.ID_ITEM = det.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN unidad_medida as um ON um.ID_UNIDAD = pro.ID_UNIDAD INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE DATE(ven.FECHA_RESOLUCION) >= '$fecha_1' AND DATE(ven.FECHA_RESOLUCION) <= '$fecha_2'  AND ven.ID_SUCURSAL = '$id_sucursal' AND ven.ESTADO != 0 GROUP BY pro.ID_PRODUCTO,det.MEDIDA,il.PRECIO_COSTO,per.ID_PERSONA");
            return $kardex;
        }
        function lista_kardex_valorizado_general($id_sucursal){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT det.*,lot.NOMBRE as 'LOTE', il.CANTIDAD as 'STOCK_ACTUAL',SUM(det.CANTIDAD) AS 'VENTAS',SUM(det.DESCUENTO) AS 'DESCUENTO_VENTA',(SUM(det.CANTIDAD)*det.PRECIO) as 'TOTAL_VENTA',(SUM(det.CANTIDAD)*il.PRECIO_COSTO) as 'TOTAL_COMPRA',il.PRECIO_COSTO as 'PRECIO_COSTO_LOTE', (SUM(det.CANTIDAD)*det.PRECIO)-SUM(det.CANTIDAD)*il.PRECIO_COSTO AS 'GANANCIA',usu.ID_USUARIO,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR',ven.ID_SUCURSAL,ven.FECHA_RESOLUCION,pro.ID_PRODUCTO,pro.ARTICULO,pro.COMPLEMENTO,pro.PRECIO_COSTO,pro.BARRA,pro.IMAGEN,pro.MEDIDA_1,pro.MEDIDA_2,pro.MEDIDA_3,pro.MEDIDA_4,pro.STOCK_1,pro.STOCK_2,pro.STOCK_3,pro.STOCK_4,pro.PRECIO_VENTA_1,pro.PRECIO_VENTA_2,pro.PRECIO_VENTA_3,pro.PRECIO_VENTA_4,um.UNIDAD,um.PREFIJO,pre.NOMBRE as 'PRESENTACION', li.LINEA FROM detalle_venta as det INNER JOIN ventas as ven ON ven.ID_VENTA = det.ID_VENTA INNER JOIN usuario as usu ON ven.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN items_lote as il ON il.ID_ITEM = det.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN unidad_medida as um ON um.ID_UNIDAD = pro.ID_UNIDAD INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE ven.ID_SUCURSAL = '$id_sucursal' AND ven.ESTADO != 0 GROUP BY pro.ID_PRODUCTO,det.PRECIO,il.PRECIO_COSTO,det.MEDIDA");
            return $kardex;
        }
        function lista_kardex_valorizado_general_fecha($fecha_1,$fecha_2,$id_sucursal){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT det.*,lot.NOMBRE as 'LOTE', il.CANTIDAD as 'STOCK_ACTUAL',SUM(det.CANTIDAD) AS 'VENTAS',SUM(det.DESCUENTO) AS 'DESCUENTO_VENTA',(SUM(det.CANTIDAD)*det.PRECIO) as 'TOTAL_VENTA',(SUM(det.CANTIDAD)*il.PRECIO_COSTO) as 'TOTAL_COMPRA',(SUM(det.CANTIDAD)*det.PRECIO)-SUM(det.CANTIDAD)*il.PRECIO_COSTO AS 'GANANCIA',usu.ID_USUARIO,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR',ven.ID_SUCURSAL,ven.FECHA_RESOLUCION,pro.ID_PRODUCTO,pro.ARTICULO,pro.COMPLEMENTO,pro.PRECIO_COSTO,pro.BARRA,pro.IMAGEN,pro.MEDIDA_1,pro.MEDIDA_2,pro.MEDIDA_3,pro.MEDIDA_4,pro.STOCK_1,pro.STOCK_2,pro.STOCK_3,pro.STOCK_4,pro.PRECIO_VENTA_1,pro.PRECIO_VENTA_2,pro.PRECIO_VENTA_3,pro.PRECIO_VENTA_4,um.UNIDAD,um.PREFIJO,pre.NOMBRE as 'PRESENTACION', li.LINEA FROM detalle_venta as det INNER JOIN ventas as ven ON ven.ID_VENTA = det.ID_VENTA INNER JOIN usuario as usu ON ven.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN items_lote as il ON il.ID_ITEM = det.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN unidad_medida as um ON um.ID_UNIDAD = pro.ID_UNIDAD INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN lote as lot ON lot.ID_LOTE = il.ID_LOTE WHERE DATE(ven.FECHA_RESOLUCION) >= '$fecha_1' AND DATE(ven.FECHA_RESOLUCION) <= '$fecha_2' AND ven.ID_SUCURSAL = '$id_sucursal' AND ven.ESTADO != 0 GROUP BY pro.ID_PRODUCTO,det.PRECIO,det.MEDIDA");
            return $kardex;
        }
        function lista_personas(){
            $conexion = mainModel::conectar();
            $personas = $conexion->query("SELECT * FROM vista_personas");
            return $personas;
        }
    }