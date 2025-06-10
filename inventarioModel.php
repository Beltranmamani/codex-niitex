<?php
    class inventarioModel extends mainModel{

/* ========================================================================== */
/*                            Lista de perecederos                            */
/* ========================================================================== */
        function consultar_lote($lote,$almacen){
            $conexion = mainModel::conectar();
            $codigo_barra = $conexion->query("SELECT l.*,a.NOMBRE FROM lote as l INNER JOIN almacen as a ON a.ID_ALMACEN = l.ID_ALMACEN WHERE l.NOMBRE = '$lote'  AND l.ID_ALMACEN = '$almacen'");
            return $codigo_barra;
        }
        function detalle_seguimiento_traspaso($traspaso){
            $conexion = mainModel::conectar();
            $codigo_barra = $conexion->query("SELECT sg.*,il.CANTIDAD AS 'STOCK_ACTUAL' FROM seguimiento_traspaso as sg INNER JOIN items_lote as il ON il.ID_ITEM = sg.ID_LOTE COLLATE utf8_unicode_ci WHERE sg.ID_TRASPASO = '$traspaso'");
            return $codigo_barra;
        }
        
        function lista_percederos($sucursal){
            $conexion = mainModel::conectar();
            $percederos = $conexion->query(" SELECT p.*,pr.BARRA,pr.ARTICULO,pr.IMAGEN,l.LINEA,pre.NOMBRE as 'PRESENTACION',a.NOMBRE as 'ALMACEN',s.NOMBRE as 'SUCURSAL', i.CANTIDAD,lo.NOMBRE AS 'LOTE' FROM perecederos AS p INNER JOIN producto as pr ON p.ID_PRODUCTO = pr.ID_PRODUCTO INNER JOIN linea as l ON l.ID_LINEA = pr.ID_LINEA INNER JOIN presentacion as pre ON pr.ID_PRESENTACION = pre.ID_PRESENTACION INNER JOIN almacen as a ON a.ID_ALMACEN = p.ID_ALMACEN INNER JOIN sucursal as s ON s.ID_SUCURSAL = p.ID_SUCURSAL INNER JOIN items_lote as i ON i.ID_ITEM = p.ID_ITEM INNER JOIN lote as lo ON i.ID_LOTE = lo.ID_LOTE WHERE p.ID_SUCURSAL = '$sucursal' ");
            return $percederos;
        }
        function lista_seguimientos_traspaso($traspaso){
            $conexion = mainModel::conectar();
            $percederos = $conexion->query("SELECT * FROM `seguimiento_traspaso` WHERE ID_TRASPASO = '$traspaso'");
            return $percederos;
        }
        function eliminar_item_lote($item){
            $conexion = mainModel::conectar();
            $percederos = $conexion->query("DELETE FROM `items_lote` WHERE ID_ITEM = '$item'");
            return $percederos;
        }
        function eliminar_kardex($kardex){
            $conexion = mainModel::conectar();
            $percederos = $conexion->query("DELETE FROM `entrada_salida` WHERE `ID_KARDEX` = '$kardex'");
            return $percederos;
        }
        function sumar_cantidad_item_lote($item,$cant){
            $conexion = mainModel::conectar();
            $percederos = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD + $cant WHERE ID_ITEM ='$item'");
            return $percederos;
        }
        function listar_linea(){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("SELECT * FROM vista_lineas");
            return $linea;
        }
        function anular_traspaso($preventa){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("UPDATE `traspasos` SET `ESTADO`= 0 WHERE `ID_TRASPASO`= '$preventa'");
            return $preventa;
        }
        function agregar_seguimiento_traspaso($id_s,$tras,$cant,$item,$item_lote,$pere,$kardex_en,$kardex_sa){
            $conexion = mainModel::conectar();
            $preventa = $conexion->query("INSERT INTO `seguimiento_traspaso`(`ID_SEG`, `ID_TRASPASO`, `CANTIDAD`, `ID_ITEM`, `ID_LOTE`, `ID_PERECEDERO`, `ID_KARDEX_EN`, `ID_KARDEX_SA`) VALUES ('$id_s','$tras','$cant','$item','$item_lote','$pere','$kardex_en','$kardex_sa')");
            return $preventa;
        }

/* ========================================================================== */
/*                        Listar sucursales disponibles                       */
/* ========================================================================== */

        function listar_sucursales(){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT * FROM vista_sucursales");
            return $almacenes;
        }

/* ========================================================================== */
/*                      Listar presentaciones diponibles                      */
/* ========================================================================== */

        function listar_presentacion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM vista_presentacion");
            return $presentacion;
        }

/* ========================================================================== */
/*                        Listar almacenes disponibles                        */
/* ========================================================================== */

        function listar_almacenesXsucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("    SELECT a.* FROM almacen as a WHERE a.ID_SUCURSAL = '$p_id_sucursal'");
            return $almacenes;
        }
        function listar_traspasos(){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("SELECT tra.*,alm.NOMBRE as 'ALMACEN', suc.NOMBRE as 'SUCURSAL' , suc.LOGO as 'LOGO_SUCURSAL',per.ID_PERSONA,per.NOMBRES,per.APELLIDOS,per.PERFIL,suc.ID_SUCURSAL as 'SUCURSAL_ENVIADO' FROM traspasos as tra INNER JOIN almacen as alm ON alm.ID_ALMACEN = tra.ID_ALMACEN INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = alm.ID_SUCURSAL INNER JOIN usuario as usu ON usu.ID_USUARIO = tra.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA");
            return $traspasos;
        }
        function listar_traspasosXsucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("   SELECT tra.*,alm.NOMBRE as 'ALMACEN', suc.NOMBRE as 'SUCURSAL' , suc.LOGO as 'LOGO_SUCURSAL',per.ID_PERSONA,per.NOMBRES,per.APELLIDOS,per.PERFIL,suc.ID_SUCURSAL as 'SUCURSAL_ENVIADO' FROM traspasos as tra INNER JOIN almacen as alm ON alm.ID_ALMACEN = tra.ID_ALMACEN INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = alm.ID_SUCURSAL INNER JOIN usuario as usu ON usu.ID_USUARIO = tra.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA  WHERE tra.ID_SUCURSAL = '$p_id_sucursal'");
            return $traspasos;
        }
        function agregar_traspaso($p_id_traspaso,$p_n_traspaso,$p_fecha_registro,$p_id_sucursal,$p_id_usuario,$p_id_almacen,$p_motivo,$p_estado){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("INSERT INTO `traspasos`(`ID_TRASPASO`, `N_TRASPASO`, `FECHA_REGISTRO`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ALMACEN`, `MOTIVO`, `ESTADO`)VALUES ('$p_id_traspaso','$p_n_traspaso','$p_fecha_registro','$p_id_sucursal','$p_id_usuario','$p_id_almacen','$p_motivo','$p_estado')");
            return $traspasos;
        }
        function agregar_detalle_traspaso($p_id_detalle,$p_id_item,$p_fecha_registro,$p_id_traspaso,$p_cantidad){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("INSERT INTO `detalle_traspasos`(`ID_DETALLE`, `ID_ITEM`, `FECHA_REGISTRO`, `ID_TRASPASO`, `CANTIDAD`) VALUES ('$p_id_detalle','$p_id_item','$p_fecha_registro','$p_id_traspaso','$p_cantidad')");
            $traspasos = $traspasos->execute();
            $traspasos = $conexion->query("UPDATE items_lote SET CANTIDAD = CANTIDAD - '$p_cantidad' WHERE ID_ITEM = '$p_id_item' ");
            return $traspasos;
        }
        function listar_detalle_traspasos(){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("SELECT d.*,p.ARTICULO,p.BARRA,l.LINEA,pre.NOMBRE as 'PRESENTACION',il.FECHA_VEN,p.IMAGEN FROM detalle_traspasos as d INNER JOIN items_lote as il ON il.ID_ITEM = d.ID_ITEM INNER JOIN producto as p ON il.ID_PRODUCTO = p.ID_PRODUCTO INNER JOIN linea as l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre on pre.ID_PRESENTACION = p.ID_PRESENTACION");
            return $traspasos;
        }
        function lista_lotes(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_lotes");
            return $lotes;
        }
        function lista_seguimientos(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM seguimiento_traspaso");
            return $lotes;
        }
        function lista_items_lotes(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_items ");
            return $lotes;
        }
        function agregar_lotes($p_id_lote,$p_nombre,$p_id_almacen,$p_fecha,$p_estado){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `lote`(`ID_LOTE`, `NOMBRE`, `ID_ALMACEN`, `FECHA_REGISTRO`, `ESTADO`) VALUES('$p_id_lote','$p_nombre','$p_id_almacen','$p_fecha','$p_estado')");
            return $lotes;
        }
        function agregar_productos_lotes($p_id_item,$p_id_almacen,$p_id_lote,$p_id_producto,$p_precio_costo,$p_precio_venta_1,$p_precio_venta_2,$p_precio_venta_3,$p_precio_venta_4,$p_cantidad,$p_perecedero,$fecha,$p_id_usuario){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("    INSERT INTO `items_lote`(`ID_ITEM`, `ID_ALMACEN`, `ID_LOTE`, `ID_PRODUCTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `CANTIDAD`, `PERECEDERO`, `FECHA_VEN`, `ID_USUARIO`) VALUES ('$p_id_item','$p_id_almacen','$p_id_lote','$p_id_producto','$p_precio_costo','$p_precio_venta_1','$p_precio_venta_2','$p_precio_venta_3','$p_precio_venta_4','$p_cantidad','$p_perecedero','$fecha','$p_id_usuario')");
            return $lotes;
        }
        
        function lista_perecederos(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_perecederos ");
            return $lotes;
        }
        function agregar_perecedero($p_id_perecedero,$p_id_item,$p_id_producto,$p_id_almacen,$p_id_sucursal,$p_fecha1,$p_fecha2,$p_fecha3,$p_fecha4){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `perecederos`(`ID_PERECEDERO`, `ID_ITEM`, `ID_PRODUCTO`, `ID_ALMACEN`, `ID_SUCURSAL`, `FECHA_1`, `FECHA_2`, `FECHA_3`, `FECHA_4`) VALUES('$p_id_perecedero','$p_id_item','$p_id_producto','$p_id_almacen','$p_id_sucursal','$p_fecha1','$p_fecha2','$p_fecha3','$p_fecha4')");
            return $lotes;
        }
        function Lista_de_kardex(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT es.*,pr.BARRA,pr.ARTICULO,li.LINEA,pre.NOMBRE as 'PRESENTACION',pr.IMAGEN,pr.ID_PRODUCTO FROM entrada_salida as es INNER JOIN items_lote as il ON es.ID_ITEM = il.ID_ITEM INNER JOIN producto as pr ON pr.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = pr.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pr.ID_PRESENTACION");
            return $kardex;
        }
        function Lista_de_ajustes(){
            $conexion = mainModel::conectar();
            $ajustes = $conexion->query("SELECT ai.*,suc.NOMBRE, per.NOMBRES, per.APELLIDOS, per.ID_PERSONA FROM ajuste_inventario as ai INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = ai.ID_SUCURSAL INNER JOIN  usuario as us ON us.ID_USUARIO = ai.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = us.ID_PERSONA");
            return $ajustes;
        }
        function lista_detalle_ajuste(){
            $conexion = mainModel::conectar();
            $ajustes = $conexion->query("SELECT d.*,pro.BARRA,pro.ARTICULO,pro.IMAGEN,li.LINEA,pre.NOMBRE as 'PRESENTACION',l.NOMBRE as 'LOTE' FROM detalle_ajuste as d INNER JOIN items_lote as il ON il.ID_ITEM = d.ID_ITEM INNER JOIN producto as pro ON il.ID_PRODUCTO = pro.ID_PRODUCTO INNER JOIN lote as l ON l.ID_LOTE = il.ID_LOTE INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION");
            return $ajustes;
        }
        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $agregar_kardex = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $agregar_kardex;
        }
        function buscar_traspaso($p_id_sucursal){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query(" SELECT tra.*,alm.NOMBRE as 'ALMACEN', suc.NOMBRE as 'SUCURSAL' , suc.LOGO as 'LOGO_SUCURSAL',per.ID_PERSONA,per.NOMBRES,per.APELLIDOS,per.PERFIL,suc.ID_SUCURSAL as 'SUCURSAL_ENVIADO' FROM traspasos as tra INNER JOIN almacen as alm ON alm.ID_ALMACEN = tra.ID_ALMACEN INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = alm.ID_SUCURSAL INNER JOIN usuario as usu ON usu.ID_USUARIO = tra.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA WHERE tra.ID_SUCURSAL = '$p_id_sucursal'");
            return $traspasos;
        }
        function buscar_traspaso_detalle($p_detalle){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("SELECT tra.*,alm.NOMBRE as 'ALMACEN', suc.NOMBRE as 'SUCURSAL' , suc.LOGO as 'LOGO_SUCURSAL',per.ID_PERSONA,per.NOMBRES,per.APELLIDOS,per.PERFIL,suc.ID_SUCURSAL as 'SUCURSAL_ENVIADO' FROM traspasos as tra INNER JOIN almacen as alm ON alm.ID_ALMACEN = tra.ID_ALMACEN INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = alm.ID_SUCURSAL INNER JOIN usuario as usu ON usu.ID_USUARIO = tra.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA  WHERE tra.ID_TRASPASO ='$p_detalle'");
            return $traspasos;
        }
        function buscar_traspaso_items($p_detalle){
            $conexion = mainModel::conectar();
            $traspasos = $conexion->query("SELECT d.*,p.ARTICULO,p.BARRA,l.LINEA,pre.NOMBRE as 'PRESENTACION',il.FECHA_VEN,p.IMAGEN FROM detalle_traspasos as d INNER JOIN items_lote as il ON il.ID_ITEM = d.ID_ITEM INNER JOIN producto as p ON il.ID_PRODUCTO = p.ID_PRODUCTO INNER JOIN linea as l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre on pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE d.ID_TRASPASO='$p_detalle'");
            return $traspasos;
        }
        function agregar_ajuste($p_id_ajuste,$p_id_sucursal,$p_fecha_registro,$p_id_usuario,$p_motivo){
            $conexion = mainModel::conectar();
            $agregar_ajuste = $conexion->query("INSERT INTO `ajuste_inventario`(`ID_AJUSTE`, `ID_SUCURSAL`, `FECHA_REGISTRO`, `ID_USUARIO`, `MOTIVO`) VALUES('$p_id_ajuste','$p_id_sucursal','$p_fecha_registro','$p_id_usuario','$p_motivo')");
            return $agregar_ajuste;
        }
        function agregar_detalle_ajuste($p_id_detalle,$p_id_ajuste,$p_id_item,$p_stock_a,$p_stock_n){
            $conexion = mainModel::conectar();
            $agregar_detalle = $conexion->query("INSERT INTO `detalle_ajuste`(`ID_DETALLE`, `ID_AJUSTE`, `ID_ITEM`, `STOCK_A`, `STOCK_N`) VALUES('$p_id_detalle','$p_id_ajuste','$p_id_item','$p_stock_a','$p_stock_n')");
            $agregar_detalle->execute();
            $agregar_detalle = $conexion->query(" UPDATE items_lote SET CANTIDAD = '$p_stock_n'  WHERE ID_ITEM = '$p_id_item' ");
            return $agregar_detalle;
        }

        function lista_productos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM `vista_productos`");
            return $productos;
        }

        function lista_movimiento_producto($producto,$sucursal){
            $conexion = mainModel::conectar();
            $movimiento = $conexion->query("SELECT * FROM `vista_consulta_items` WHERE `ID_PRODUCTO` = '$producto'   AND `ID_SUCURSAL` = '$sucursal'  ORDER BY `FECHA_VEN` ASC;");
            return $movimiento;
        }
        function lista_ajuste_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $ajuste = $conexion->query("SELECT ai.*,suc.NOMBRE, per.NOMBRES, per.APELLIDOS, per.ID_PERSONA FROM ajuste_inventario as ai INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = ai.ID_SUCURSAL INNER JOIN  usuario as us ON us.ID_USUARIO = ai.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = us.ID_PERSONA WHERE suc.ID_SUCURSAL = '$sucursal'");
            return $ajuste;
        }

        function buscar_ajuste_detalle($p_detalle){
            $conexion = mainModel::conectar();
            $ajuste = $conexion->query("SELECT ai.*,suc.NOMBRE, per.NOMBRES, per.APELLIDOS, per.ID_PERSONA FROM ajuste_inventario as ai INNER JOIN sucursal as suc ON suc.ID_SUCURSAL = ai.ID_SUCURSAL INNER JOIN  usuario as us ON us.ID_USUARIO = ai.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = us.ID_PERSONA WHERE ai.ID_AJUSTE = '$p_detalle'");
            return $ajuste;
        }
        function buscar_ajuste_items($p_detalle){
            $conexion = mainModel::conectar();
            $ajuste = $conexion->query("SELECT d.*,pro.BARRA,pro.ARTICULO,pro.IMAGEN,li.LINEA,pre.NOMBRE as 'PRESENTACION',l.NOMBRE as 'LOTE' FROM detalle_ajuste as d INNER JOIN items_lote as il ON il.ID_ITEM = d.ID_ITEM INNER JOIN producto as pro ON il.ID_PRODUCTO = pro.ID_PRODUCTO INNER JOIN lote as l ON l.ID_LOTE = il.ID_LOTE INNER JOIN linea as li ON li.ID_LINEA = pro.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pro.ID_PRESENTACION WHERE d.ID_AJUSTE = '$p_detalle' ");
            return $ajuste;
        }
        function buscar_ajuste($p_id_sucursal){
            $conexion = mainModel::conectar();
            $ajuste = $conexion->query("SELECT * FROM `vista_ajustes` WHERE `ID_SUCURSAL`='$p_id_sucursal'   ORDER BY `FECHA_REGISTRO` DESC");
            return $ajuste;
        }
        function listar_item_lote(){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT * FROM vista_items");
            return $items;
        }
        function listar_item_lote_2($id_sucursal){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT * FROM vista_items WHERE ID_SUCURSAL = '$id_sucursal' ");
            return $items;
        }
        function listar_pedido_traspaso_x_sucursal($id_sucursal){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT p.*,s.NOMBRE as 'sucursal', a.NOMBRE as 'almacen',per.NOMBRES as 'usuario' FROM pedido_traspasos as p INNER JOIN sucursal as s ON s.ID_SUCURSAL = p.sucursal_id INNER JOIN almacen as a ON p.almacen_id = a.ID_ALMACEN INNER JOIN usuario as u ON u.ID_USUARIO = p.user_id INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA  WHERE p.sucursal_id = '$id_sucursal' ");
            return $items;
        }
        function listar_pedidos_pendientes($id_sucursal){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT p.*,s.NOMBRE as 'sucursal', a.NOMBRE as 'almacen',per.NOMBRES as 'usuario' FROM pedido_traspasos as p INNER JOIN sucursal as s ON s.ID_SUCURSAL = p.sucursal_id INNER JOIN almacen as a ON p.almacen_id = a.ID_ALMACEN INNER JOIN usuario as u ON u.ID_USUARIO = p.user_id INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA  WHERE p.sucursal_destino_id = '$id_sucursal' AND p.is_entregado =0 ");
            return $items;
        }
        function buscar_pedido_traspaso($id){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT p.*,s.NOMBRE as 'sucursal',su.NOMBRE as 'sucursal_destino', a.NOMBRE as 'almacen',per.NOMBRES as 'usuario',per.ID_PERSONA as 'persona_id' FROM pedido_traspasos as p INNER JOIN sucursal as s ON s.ID_SUCURSAL = p.sucursal_id INNER JOIN sucursal as su ON su.ID_SUCURSAL = p.sucursal_destino_id INNER JOIN almacen as a ON p.almacen_id = a.ID_ALMACEN INNER JOIN usuario as u ON u.ID_USUARIO = p.user_id INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA  WHERE p.id = '$id' ");
            return $items;
        }
        function listar_pedido_traspaso_x_sucursal_fecha($id_sucursal,$f1,$f2){
            $conexion = mainModel::conectar();
            $items = $conexion->query("SELECT p.*,s.NOMBRE as 'sucursal', a.NOMBRE as 'almacen',per.NOMBRES as 'usuario' FROM pedido_traspasos as p INNER JOIN sucursal as s ON s.ID_SUCURSAL = p.sucursal_id INNER JOIN almacen as a ON p.almacen_id = a.ID_ALMACEN INNER JOIN usuario as u ON u.ID_USUARIO = p.user_id INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA  WHERE p.sucursal_id = '$id_sucursal' AND p.fecha >= '$f1' AND p.fecha <= '$f2' ");
            return $items;
        }
        function agregar_pedido_traspaso($nro,$sucursal_id,$sucursal_destino,$almacen,$user,$motivo,$fecha){
            try {
                $conexion = mainModel::conectar();
        
               
                $sql = "INSERT INTO pedido_traspasos (nro, sucursal_id, sucursal_destino_id, almacen_id, user_id, motivo, fecha)
                        VALUES (:nro, :sucursal_id, :sucursal_destino, :almacen, :user, :motivo, :fecha)";
                
                $stmt = $conexion->prepare($sql);
        
                $stmt->bindParam(':nro', $nro);
                $stmt->bindParam(':sucursal_id', $sucursal_id);
                $stmt->bindParam(':sucursal_destino', $sucursal_destino);
                $stmt->bindParam(':almacen', $almacen);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':motivo', $motivo);
                $stmt->bindParam(':fecha', $fecha);
        
            
                $stmt->execute();
        
                $id_generado = $conexion->lastInsertId();
        
                return $id_generado;
        
            } catch (PDOException $e) {
                // Manejar cualquier error
                return "Error: " . $e->getMessage();
            }
        }
        function agregar_item_pedido_traspaso($pedido_traspaso_id,$item_id,$cantidad,$cantidad_pedido,$stock,$almacen_id,$sucursal_id,$producto_id){
            try {
                $conexion = mainModel::conectar();
                $sql= "INSERT INTO pedido_traspaso_items (pedido_traspaso_id, item_id, cantidad, cantidad_pedido, stock, almacen_id, sucursal_id, producto_id)";
                $sql.= " VALUES (:pedido_traspaso_id, :item_id, :cantidad, :cantidad_pedido, :stock, :almacen_id, :sucursal_id, :producto_id)";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':pedido_traspaso_id', $pedido_traspaso_id);
                $stmt->bindParam(':item_id', $item_id);
                $stmt->bindParam(':cantidad', $cantidad);
                $stmt->bindParam(':cantidad_pedido', $cantidad_pedido);
                $stmt->bindParam(':stock', $stock);
                $stmt->bindParam(':almacen_id', $almacen_id);
                $stmt->bindParam(':sucursal_id', $sucursal_id);
                $stmt->bindParam(':producto_id', $producto_id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                // Manejar cualquier error
                return "Error: " . $e->getMessage();
            }
        }

        public function lista_items_pedido_traspaso_entregados($id){
            $conexion = mainModel::conectar();
            return $conexion->query("SELECT pt.*,p.ARTICULO,l.LINEA,p.BARRA,a.NOMBRE as 'almacen',pre.NOMBRE as 'PRESENTACION' FROM `pedido_traspaso_items` as pt INNER JOIN producto as p ON p.ID_PRODUCTO = pt.producto_id INNER JOIN linea as l ON l.ID_LINEA = p.ID_LINEA INNER JOIN almacen as a ON a.ID_ALMACEN = pt.almacen_id INNER JOIN presentacion as pre on pre.ID_PRESENTACION = p.ID_PRESENTACION WHERE pt.pedido_traspaso_id = '$id'");
        }
        public function lista_items_pedido_traspaso($id){
            $conexion = mainModel::conectar();
            return $conexion->query("SELECT pt.*,p.ARTICULO,l.LINEA,p.BARRA,a.NOMBRE as 'almacen' FROM `pedido_traspaso_items` as pt INNER JOIN producto as p ON p.ID_PRODUCTO = pt.producto_id INNER JOIN linea as l ON l.ID_LINEA = p.ID_LINEA INNER JOIN almacen as a ON a.ID_ALMACEN = pt.almacen_id WHERE pt.pedido_traspaso_id = '$id' AND pt.is_enviado = 0");
        }
       
        function buscar_items_lotes($id){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_items WHERE ID_ITEM = '$id'");
            return $lotes;
        }
        function entregar_item_pedido_traspaso($id,$cantidad_pedido){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("UPDATE pedido_traspaso_items SET cantidad_pedido = '$cantidad_pedido',is_enviado = 1 WHERE id = '$id'");
            return $lotes;
        }
        function anular_item_pedido_traspaso($id){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("UPDATE pedido_traspaso_items SET is_active = 0 WHERE id = '$id'");
            return $lotes;
        }
        function entregar_pedido_traspaso($id){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("UPDATE pedido_traspasos SET is_entregado = 1 WHERE id = '$id'");
            return $lotes;
        }
        function agregar_detalle_pedido_traspaso($p_id_item,$p_cantidad){
            $conexion = mainModel::conectar();
      
            $traspasos = $conexion->query("UPDATE items_lote SET CANTIDAD = CANTIDAD - '$p_cantidad' WHERE ID_ITEM = '$p_id_item' ");
            return $traspasos;
        }
    }