<?php
    class productostiendaModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                                Listar_lineas                               */
/* -------------------------------------------------------------------------- */

        function actualizar_cuenta_bancaria($nro,$banco,$titular,$telefono,$correo){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("UPDATE `cuenta_bancaria` SET `NRO_CUENTA`='$nro',`BANCO`='$banco',`TITULAR`='$titular',`TELEFONO`='$telefono',`CORREO`='$correo' WHERE 1");
            return $unidades;
        }
        function lista_sucursal(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_sucursales");
            return $unidades;
        }
        function lista_productos_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT it.*,il.CANTIDAD,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_4,li.LINEA,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE a.ID_SUCURSAL = '$sucursal'");
            return $unidades;
        }
        function lista_items_tienda(){
            $conexion = mainModel::conectar();
            $tienda = $conexion->query("SELECT * FROM items_tienda");
            return $tienda;
        }
        function establecer_tienda($id){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("UPDATE `tienda_sucursal` SET `ID_SUCURSAL`='$id' WHERE  `ID_TIENDA`= 'TIENDA01'");
            return $sucursal;
        }
        function agregar_item_tienda($id,$item){
            $conexion = mainModel::conectar();
            $tienda = $conexion->query("INSERT INTO `items_tienda`(`ID_ITEMS`, `ID_ITEM`) VALUES('$id','$item')");
            return $tienda;
        }
        function agregar_item_recomendado($id,$item,$desc){
            $conexion = mainModel::conectar();
            $tienda = $conexion->query("INSERT INTO `producto_recomendados`(`ID_RECOMENDADOS`, `ITEM`, `DESCUENTO`) VALUES('$id','$item','$desc')");
            return $tienda;
        }
        function eliminar_productorecomendado_tienda($id){
            $conexion = mainModel::conectar();
            $tienda = $conexion->query("DELETE FROM `producto_recomendados` WHERE `ID_RECOMENDADOS` = '$id'");
            return $tienda;
        }
        function eliminar_producto_tienda($id){
            $conexion = mainModel::conectar();
            $tienda = $conexion->query("DELETE FROM `items_tienda` WHERE `ID_ITEMS` = '$id'");
            return $tienda;
        }
        function busqueda_items($id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT it.*,il.CANTIDAD,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_4,li.LINEA,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE a.ID_SUCURSAL = '$id_sucursal' AND il.CANTIDAD>0");
            return $presentacion;
        }
        function lista_productos_recomendados($id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT pr.*,il.PRECIO_VENTA_4,pro.ARTICULO,il.CANTIDAD,li.LINEA,pre.NOMBRE AS 'PRESENTACION',pro.IMAGEN FROM producto_recomendados as pr INNER JOIN items_tienda as it ON it.ID_ITEMS = pr.ITEM INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN producto AS pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN almacen as al ON al.ID_ALMACEN = il.ID_ALMACEN  WHERE al.ID_SUCURSAL = '$id_sucursal' ");
            return $presentacion;
        }
    }