<?php
    class tiendaModel extends mainModel{

        function listar_promociones(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM promociones");
            return $presentacion;
        }
        function listar_items_limit8($id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT um.PREFIJO, it.*,il.CANTIDAD,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_1,il.PRECIO_VENTA_2,il.PRECIO_VENTA_3,il.PRECIO_VENTA_4,li.LINEA,p.MEDIDA_1,p.MEDIDA_2,p.MEDIDA_3,p.MEDIDA_4,p.STOCK_1,p.STOCK_2,p.STOCK_3,p.STOCK_4,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON p.ID_UNIDAD = um.ID_UNIDAD WHERE a.ID_SUCURSAL = '$id_sucursal' LIMIT 8");
            return $presentacion;
        }
        function listar_items($id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT um.PREFIJO ,it.*,il.CANTIDAD,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_4,li.LINEA,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON p.ID_UNIDAD = um.ID_UNIDAD WHERE a.ID_SUCURSAL = '$id_sucursal' ");
            return $presentacion;
        }
        function lista_productos_recomendados($id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT  um.PREFIJO ,pr.*,it.ID_ITEM,il.PRECIO_VENTA_4,pro.ARTICULO,pro.ID_PRODUCTO,il.CANTIDAD,li.LINEA,pre.NOMBRE AS 'PRESENTACION',pro.IMAGEN FROM producto_recomendados as pr INNER JOIN items_tienda as it ON it.ID_ITEMS = pr.ITEM INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN producto AS pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION INNER JOIN almacen as al ON al.ID_ALMACEN = il.ID_ALMACEN  INNER JOIN unidad_medida as um ON pro.ID_UNIDAD = um.ID_UNIDAD WHERE al.ID_SUCURSAL = '$id_sucursal' ");
            return $presentacion;
        }
        function busqueda_items_categoria($id_sucursal,$producto,$categoria){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT it.*,il.CANTIDAD,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_4,li.LINEA,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE a.ID_SUCURSAL = '$id_sucursal' AND p.ARTICULO LIKE '%{$producto}%' OR li.LINEA LIKE '%{$producto}%' AND pre.NOMBRE = '{$categoria}'");
            return $presentacion;
        }
        function busqueda_items($id_sucursal,$producto){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT it.*,il.CANTIDAD,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_4,li.LINEA,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE a.ID_SUCURSAL = '$id_sucursal' AND p.ARTICULO LIKE '%{$producto}%' OR li.LINEA LIKE '%{$producto}%'");
            return $presentacion;
        }
        function listar_items_page_categoria($categoria,$id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT  um.PREFIJO ,it.*,il.CANTIDAD,a.ID_SUCURSAL,p.ID_PRODUCTO,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_1,il.PRECIO_VENTA_2,il.PRECIO_VENTA_3,il.PRECIO_VENTA_4,li.LINEA,p.MEDIDA_1,p.MEDIDA_2,p.MEDIDA_3,p.MEDIDA_4,p.STOCK_1,p.STOCK_2,p.STOCK_3,p.STOCK_4, pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON p.ID_UNIDAD = um.ID_UNIDAD WHERE a.ID_SUCURSAL = '$id_sucursal' AND pre.NOMBRE = '$categoria'");
            return $presentacion;
        }
        function lista_departamento(){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT * FROM departamento");
            return $usuarios;
        }
        function usuarios_tienda(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM `tienda_cliente`");
            return $presentacion;
        }
        function listar_items_page($start,$item,$id_sucursal){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT it.*,il.CANTIDAD,a.ID_SUCURSAL,p.ID_PRODUCTO,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_4,li.LINEA,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE a.ID_SUCURSAL = '$id_sucursal' ORDER BY il.CANTIDAD DESC LIMIT $start, $item");
            return $presentacion;
        }
        function listar_presentacion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM presentacion");
            return $presentacion;
        }
        function listar_presentacion_page($star,$n){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM presentacion  LIMIT $star, $n");
            return $presentacion;
        }
        function listar_secciones(){
            $conexion = mainModel::conectar();
            $secciones = $conexion->query("SELECT * FROM seccion");
            return $secciones;
        }
        function listar_documento(){
            $conexion = mainModel::conectar();
            $secciones = $conexion->query("SELECT * FROM documento");
            return $secciones;
        }
        function listar_secciones_presentacion($seccion){
            $conexion = mainModel::conectar();
            $secciones = $conexion->query("SELECT sp.*,p.NOMBRE FROM seccion_presentacion as sp INNER JOIN presentacion as p ON p.ID_PRESENTACION = sp.ID_PRESENTACION WHERE sp.ID_SECCION = '$seccion'");
            return $secciones;
        }
        function listar_lineas(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM vista_lineas");
            return $presentacion;
        }
        function lista_direccion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM direccion_cliente");
            return $presentacion;
        }
        function agregar_cliente_usuario($p_id_cliente,$p_id_documento,$p_n_documento,$p_nombre,$p_correo,$p_password,$p_perfil,$p_telefono,$p_fecha,$p_genero,$p_estado){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("INSERT INTO `tienda_cliente`(`ID_CLIENTE`, `ID_DOCUMENTO`, `N_DOCUMENTO`, `NOMBRE`, `CORREO`, `PASSWORD`, `PERFIL`, `TELEFONO`, `FECHA`, `GENERO`, `ESTADO`) VALUES ('$p_id_cliente','$p_id_documento','$p_n_documento','$p_nombre','$p_correo','$p_password','$p_perfil','$p_telefono','$p_fecha','$p_genero','$p_estado')");
            return $presentacion;
        }
        function actualizar_direccion_cliente($code,$direccion){
            $conexion = mainModel::conectar();
            $deseo = $conexion->query("UPDATE `direccion_cliente` SET `DIRECCION` = '$direccion' WHERE ID_DIRECCION = '$code'");
            return $deseo;
        }
        function agregar_direccion_cliente($CODE,$p_id_cliente,$direccion){
            $conexion = mainModel::conectar();
            $deseo = $conexion->query("INSERT INTO `direccion_cliente`(`ID_DIRECCION`, `ID_CLIENTE`, `DIRECCION`) VALUES ('$CODE','$p_id_cliente','$direccion')");
            return $deseo;
        }
        function lista_direcciones_clientes($p_id_cliente){
            $conexion = mainModel::conectar();
            $deseo = $conexion->query("SELECT*FROM `direccion_cliente` WHERE `ID_CLIENTE` = '$p_id_cliente'");
            return $deseo;
        }
        function detalle_direccion_cliente($id){
            $conexion = mainModel::conectar();
            $deseo = $conexion->query("SELECT*FROM `direccion_cliente` WHERE `ID_DIRECCION` = '$id'");
            return $deseo;
        }
        function invoice_lista_cliente($p_id_cliente){
            $conexion = mainModel::conectar();
            $deseo = $conexion->query("SELECT*FROM `invoice` WHERE `ID_CLIENTE` = '$p_id_cliente'");
            return $deseo;
        }
        function agregar_deseo_cliente($p_deseo,$p_item,$p_id_cliente){
            $conexion = mainModel::conectar();
            $deseo = $conexion->query("CALL sp_agregar_deseo_cliente('$p_deseo','$p_item','$p_id_cliente')");
            return $deseo;
        }
        function inicio_sesion_usuario($correo,$pass){
            $conexion = mainModel::conectar();
            $usuario = $conexion->query("SELECT tc.* FROM tienda_cliente as tc WHERE tc.CORREO = '$correo' AND tc.PASSWORD = '$pass' AND tc.ESTADO = '1'");
            return $usuario;
        }
        function lista_deseos(){
            $conexion = mainModel::conectar();
            $deseos = $conexion->query("SELECT * FROM lista_deseos");
            return $deseos;
        }
        function lista_invoices(){
            $conexion = mainModel::conectar();
            $deseos = $conexion->query("SELECT * FROM invoice");
            return $deseos;
        }
        function lista_deseos_cliente($cliente){
            $conexion = mainModel::conectar();
            $deseos = $conexion->query("SELECT ld.*, pr.ARTICULO,il.CANTIDAD,pr.PRECIO_VENTA_4,pr.ESTADO,pr.IMAGEN,l.LINEA FROM lista_deseos as ld INNER JOIN items_lote AS il ON il.ID_ITEM = ld.ID_ITEM INNER JOIN producto as pr ON pr.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as l ON l.ID_LINEA = pr.ID_LINEA WHERE ld.ID_CLIENTE = '$cliente'");
            return $deseos;
        }
        function eliminar_deseo($deseo){
            $conexion = mainModel::conectar();
            $deseos = $conexion->query("DELETE FROM `lista_deseos` WHERE `ID_DESEO` = '$deseo'");
            return $deseos;
        }
        function agregar_detalle_invoice($items,$item,$invoice,$cantidad,$precio,$p_a){
            $conexion = mainModel::conectar();
            $deseos = $conexion->query("INSERT INTO `invoice_producto`(`ID_ITEMS`, `ID_ITEM`, `ID_INVOICE`, `CANTIDAD`, `PRECIO`,`PRECIO_RADIO`) VALUES ('$items','$item','$invoice','$cantidad','$precio','$p_a')");
            return $deseos;
        }
        function agregar_invoice($p_id_invoice,$p_id_cliente,$p_id_provincia,$p_n_invoice,$p_id_direccion,$p_titulo,$p_fecha,$p_subtotal,$p_tarifa,$p_total,$p_adicional,$p_estado,$p_pago){
            $conexion = mainModel::conectar();
            $deseos = $conexion->query("INSERT INTO `invoice`(`ID_INVOICE`, `ID_CLIENTE`, `ID_PROVINCIA`, `N_INVOICE`, `ID_DIRECCION`, `TITULO`, `FECHA`, `SUBTOTAL`, `TARIFA`, `TOTAL`, `ADICIONAL`, `ESTADO`, `PAGO`) VALUES('$p_id_invoice','$p_id_cliente','$p_id_provincia','$p_n_invoice','$p_id_direccion','$p_titulo','$p_fecha','$p_subtotal','$p_tarifa','$p_total','$p_adicional','$p_estado','$p_pago')");
            return $deseos;
        }
        function detalle_item_producto($item){
            $conexion = mainModel::conectar();
            $item = $conexion->query("SELECT it.*,il.CANTIDAD,p.ID_PRODUCTO,a.ID_SUCURSAL,p.BARRA,p.ARTICULO,p.IMAGEN,il.PRECIO_COSTO,il.PRECIO_VENTA_1,il.PRECIO_VENTA_2,il.PRECIO_VENTA_3,il.PRECIO_VENTA_4,li.LINEA,p.MEDIDA_1,p.MEDIDA_2,p.MEDIDA_3,p.MEDIDA_4,p.STOCK_1,p.STOCK_2,p.STOCK_3,p.STOCK_4,pre.NOMBRE as 'PRESENTACION' FROM items_tienda as it INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN almacen as a ON a.ID_ALMACEN = il.ID_ALMACEN INNER JOIN producto as p ON p.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE it.ID_ITEM = '$item'");
            return $item;
        }
        
        function lista_img_productos_producto($id){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM producto_img WHERE ID_PRODUCTO = '$id'");
            return $productos;
        }
        function detalle_de_pedidos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM invoice_producto");
            return $productos;
        }
        function detalle_de_pedido($ID){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT ip.*,pro.ID_PRODUCTO,pro.BARRA,pro.ARTICULO,pro.IMAGEN,li.LINEA FROM invoice_producto as ip INNER JOIN items_tienda as it ON ip.ID_ITEM = it.ID_ITEM INNER JOIN items_lote as il ON il.ID_ITEM = it.ID_ITEM INNER JOIN producto as pro ON pro.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA=pro.ID_LINEA WHERE ip.ID_INVOICE='$ID'");
            return $productos;
        }
        function lista_caracteristicas_productos_producto($id){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM producto_caracteristica WHERE ID_PRODUCTO = '$id'");
            return $productos;
        }
        function datos_cliente_update($id,$nombre,$genero,$fecha,$telefono,$correo){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("UPDATE `tienda_cliente` SET `NOMBRE`= '$nombre',`CORREO`='$correo',`TELEFONO`='$telefono',`FECHA`='$fecha',`GENERO`='$genero' WHERE `ID_CLIENTE`= '$id'");
            return $cliente;
        }
        function documento_cliente_update($id,$documento,$nro){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("UPDATE `tienda_cliente` SET `ID_DOCUMENTO`='$documento',`N_DOCUMENTO`='$nro' WHERE `ID_CLIENTE`= '$id'");
            return $cliente;
        }
        function password_cliente_update($id,$pass,$pass_2){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("UPDATE `tienda_cliente` SET `PASSWORD`='$pass' WHERE `ID_CLIENTE`= '$id' AND `PASSWORD`='$pass_2'");
            return $cliente;
        }
        function perfil_cliente_update($id,$perfil){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("UPDATE `tienda_cliente` SET `PERFIL`='$perfil' WHERE `ID_CLIENTE`= '$id'");
            return $cliente;
        }
        function lista_provincias_departamento($id){
            $conexion = mainModel::conectar();
            $provincias = $conexion->query("SELECT * FROM `provincia` WHERE `ID_DEPARTAMENTO`= '$id'");
            return $provincias;
        }
        function lista_notificaciones_de_cliente($id){
            $conexion = mainModel::conectar();
            $provincias = $conexion->query("SELECT i.*,inv.ID_INVOICE,inv.TOTAL,inv.TITULO,inv.FECHA as 'FECHA_2' FROM invoice_usuario_notificacion as i INNER JOIN invoice as inv ON inv.ID_INVOICE = i.ID_INVOICE  WHERE inv.ID_CLIENTE= '$id'");
            return $provincias;
        }
    }