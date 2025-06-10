<?php
    class almacenModel extends mainModel{
        function listar_metodopagos(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM metodopagos");
            return $unidades;
        }
        /*
            ======================================
                      Listar almacenes
            ======================================
        */
        function listar_almacenes(){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT * FROM vista_almacenes");
            return $almacenes;
        }
        /*
            ======================================
                Lista de almacenes por sucursal
            ======================================
        */
        function listar_almacenesXsucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("    SELECT a.* FROM almacen as a WHERE a.ID_SUCURSAL = '$p_id_sucursal'");
            return $almacenes;
        }
        /*
            ======================================
                        Buscar almacen
            ======================================
        */
        function buscar_almacen($p_id_almacen){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT * FROM `almacen` WHERE ID_ALMACEN = '$p_id_almacen'");
            return $almacenes;
        }
        /*
            ======================================
                Lista general de productos
            ======================================
        */
        function lista_productos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM vista_productos ");
            return $productos;
        }
        /*
            ======================================
                Agregar almacen
            ======================================
        */
        function agregar_almacen($p_id_almacen,$p_nombre,$p_direccion,$p_id_sucursal,$p_estado){
            $conexion = mainModel::conectar();
            $almacen = $conexion->query("INSERT INTO `almacen`(`ID_ALMACEN`, `NOMBRE`, `DIRECCION`, `ID_SUCURSAL`, `ESTADO`) VALUES('$p_id_almacen','$p_nombre','$p_direccion','$p_id_sucursal','$p_estado')");
            return $almacen;
        }
        /*
            ======================================
                  Lista de items por almacen
            ======================================
        */
        function lista_items_almacen($p_id_almacen){
            $conexion = mainModel::conectar();
            $productos = $conexion->query(" SELECT i.ID_ITEM,i.ID_PRODUCTO,SUM(i.CANTIDAD) AS 'STOCK',i.ID_ALMACEN, p.BARRA,p.ARTICULO,p.IMAGEN,p.COMPLEMENTO,um.UNIDAD,um.PREFIJO,pr.NOMBRE as 'PRESENTACION',l.LINEA,p.PRECIO_COSTO,p.PRECIO_VENTA_4,p.STOCK_MINIMO,p.STOCK_MEDIO,p.STOCK_MODERADO FROM items_lote AS i INNER JOIN producto as p ON p.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD WHERE i.ID_ALMACEN = '$p_id_almacen'   GROUP BY i.ID_PRODUCTO");
            return $productos;
        }
        /*
            ======================================
                Consultar item de almacen 
            ======================================
        */
        function consultar_item($item){
            $conexion = mainModel::conectar();
            $item = $conexion->query("SELECT i.*,p.BARRA, p.ARTICULO, p.ID_PRESENTACION, p.ID_LINEA, p.ID_UNIDAD, p.COMPLEMENTO, p.PRECIO_COSTO, p.PRECIO_VENTA_1, p.PRECIO_VENTA_2, p.PRECIO_VENTA_3, p.PRECIO_VENTA_4, p.STOCK_MINIMO, p.STOCK_MEDIO, p.STOCK_MODERADO, p.PERECEDERO, p.EXENTO, p.ESTADO, p.IMAGEN,l.LINEA,pr.NOMBRE,um.UNIDAD,um.PREFIJO FROM items_almacen as i INNER JOIN producto as p ON p.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD WHERE i.ID_ITEM = '$item'");
            return $item;
        }
        /*
            ======================================
                      Listar sucursales
            ======================================
        */
        function listar_sucursales(){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT * FROM vista_sucursales");
            return $almacenes;
        }
        /*
            ======================================
                  Lista de almacens x sucursal 
            ======================================
        */
        function listaralmacenes($id_sucursal){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT a.* FROM almacen as a WHERE a.ID_SUCURSAL = '$id_sucursal'");
          
            return $almacenes;
        }
        /*
            ======================================
                    Lista de presentaciones
            ======================================
        */
        function listar_presentacion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM vista_presentacion");
            return $presentacion;
        }
        /*
            ======================================
                    Lista de presentaciones
            ======================================
        */
        function lista_itemsxalmacenxpresentacion($almacen,$presentacion){
            $conexion = mainModel::conectar();
            $item = $conexion->query(" SELECT i.*,p.BARRA, p.ARTICULO, p.ID_PRESENTACION, p.ID_LINEA, p.ID_UNIDAD, p.COMPLEMENTO, p.PRECIO_COSTO, p.PRECIO_VENTA_1, p.PRECIO_VENTA_2, p.PRECIO_VENTA_3, p.PRECIO_VENTA_4, p.STOCK_MINIMO, p.STOCK_MEDIO, p.STOCK_MODERADO, p.PERECEDERO, p.EXENTO, p.ESTADO, p.IMAGEN,l.LINEA,pr.NOMBRE,um.UNIDAD,um.PREFIJO FROM items_almacen as i INNER JOIN producto as p ON p.ID_PRODUCTO = i.ID_PRODUCTO INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD WHERE i.ID_ALMACEN = '$almacen' AND p.ID_PRESENTACION = '$presentacion'");
            return $item ;
        }
        /*
            ======================================
                    Lista de presentaciones
            ======================================
        */
        function guardar_transferencia($id_transferencia,$fecha,$motivo,$almacen_origen,$almacen_destino,$usuario){
            $conexion = mainModel::conectar();
            $transferencia = $conexion->query(" INSERT INTO `transferencia_almacen`(`ID_TRANSFERENCIA`, `FECHA`, `MOTIVO`, `ID_ALMACEN_ORIGEN`, `ID_ALMACEN_DESTINO`, `ID_USUARIO`, `ESTADO`) VALUES('$id_transferencia','$fecha','$motivo','$almacen_origen','$almacen_destino','$usuario',1)");
            return $transferencia;
        }
        /*
            ======================================
                    Lista de presentaciones
            ======================================
        */
        function guardar_detalle_transferencia($p_id_detalle,$p_id_transferencia,$p_id_producto,$p_cantidad,$p_stock){
            $conexion = mainModel::conectar();
            $transferencia = $conexion->query("INSERT INTO `detalle_transferencia`(`ID_DETALLE`, `ID_TRANSFERENCIA`, `ID_PRODUCTO`, `CANTIDAD`, `STOCK`, `ESTADO`) VALUES('$p_id_detalle','$p_id_transferencia','$p_id_producto','$p_cantidad','$p_stock')");
            return $transferencia;
        }
        /*
            ======================================
                    Agregar stock item
            ======================================
        */
        function agregar_stock_item($p_producto,$p_almacen,$p_id_item,$p_cantidad){
            $conexion = mainModel::conectar();
            // $stock = $conexion->query("CALL sp_agregar_stock_item('$p_producto','$p_almacen','$p_id_item','$p_cantidad')");
            
         
             $stock = $conexion->query("UPDATE items_almacen SET STOCK= STOCK + '$p_cantidad' WHERE ID_PRODUCTO = '$p_producto' AND ID_ALMACEN = '$p_almacen'");
            
            return $stock;
        }
        /*
            ======================================
                    Restar stock item
            ======================================
        */
        function restar_stock($p_item,$p_cantidad){
            $conexion = mainModel::conectar();
            $stock = $conexion->query("UPDATE items_almacen SET STOCK= STOCK - '$p_cantidad' WHERE ID_ITEM= '$p_item'");
            return $stock;
        }
        /*
            ======================================
                    Lista de transferencias
            ======================================
        */
        function listastransferencias(){
            $conexion = mainModel::conectar();
            $transferencias = $conexion->query("SELECT * FROM vista_transferencias ");
            return $transferencias;
        }
        /*
            ======================================
                    Transferencias x almacén
            ======================================
        */
        function transferenciasxalmacen($p_id_almacen){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query(" SELECT t.*,ao.NOMBRE as 'ALMACEN_ORIGEN',ao.ID_SUCURSAL as 'SUCURSAL_ORIGEN',so.NOMBRE as 'SUCURSAL_NAME_ORIGEN',so.LOGO as 'LOGO_SUCURSAL_ORIGEN',ad.NOMBRE as 'ALMACEN_DESTINO', ad.ID_SUCURSAL as 'SUCURSAL_DESTINO',sd.NOMBRE as 'SUCURSAL_NAME_DESTINO',sd.LOGO as 'LOGO_SUCURSAL_DESTINO',p.NOMBRES as 'NOMBRE_PERSONA',p.PERFIL  FROM transferencia_almacen as t INNER JOIN almacen as ao ON t.ID_ALMACEN_ORIGEN = ao.ID_ALMACEN INNER JOIN almacen as ad ON t.ID_ALMACEN_DESTINO = ad.ID_ALMACEN INNER JOIN sucursal as so ON so.ID_SUCURSAL = ao.ID_SUCURSAL INNER JOIN sucursal as sd ON ad.ID_SUCURSAL = sd.ID_SUCURSAL INNER JOIN usuario as u ON t.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as p ON p.ID_PERSONA = u.ID_PERSONA WHERE t.ID_ALMACEN_ORIGEN = '$p_id_almacen' OR t.ID_ALMACEN_DESTINO = '$p_id_almacen'");
            return $almacenes;
        }

/* -------------------------------------------------------------------------- */
/*                              Consulta Almacen                              */
/* -------------------------------------------------------------------------- */

        function consulta_almacen($id){
            $conexion = mainModel::conectar();
            $almacen = $conexion->query("SELECT * FROM `vista_almacenes` WHERE `ID_ALMACEN` ='$id'");
            return $almacen;
        }

/* -------------------------------------------------------------------------- */
/*                             Actualizar Almacen                             */
/* -------------------------------------------------------------------------- */

        function actualizar_almacen($p_id_almacen,$p_nombre,$p_direccion,$p_estado){
            $conexion = mainModel::conectar();
            $almacen = $conexion->query("UPDATE `almacen` SET `NOMBRE`= '$p_nombre',`DIRECCION`= '$p_direccion',`ESTADO`= '$p_estado' WHERE `ID_ALMACEN`= '$p_id_almacen'");
            return $almacen;
        }

/* -------------------------------------------------------------------------- */
/*                              Eliminar Almacen                              */
/* -------------------------------------------------------------------------- */

        function eliminar_almacen($p_id_almacen){
            $conexion = mainModel::conectar();
            $almacen = $conexion->query(" DELETE FROM `almacen` WHERE `ID_ALMACEN` = '$p_id_almacen'");
            return $almacen;
        }

    }