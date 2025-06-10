<?php
    class productosModel extends mainModel{
        function consulta_caracteristica($id){
            $conexion = mainModel::conectar();
            $producto = $conexion->query("SELECT * FROM producto_caracteristica WHERE ID_CARACTERISTICA = '$id'");
            return $producto;
        }
        function actualizar_caracteristica($p_id_caracteristica,$p_caracteristica){
            $conexion = mainModel::conectar();
            $documento = $conexion->query("UPDATE  producto_caracteristica SET CARACTERISTICA = '$p_caracteristica' WHERE ID_CARACTERISTICA = '$p_id_caracteristica'");
            return $documento;
        }

        function eliminar_caracteristica($p_id_caracteristica){
            $conexion = mainModel::conectar();
            $producto = $conexion->query("DELETE FROM producto_caracteristica  WHERE ID_CARACTERISTICA = '$p_id_caracteristica'");
            return $producto;
        }
        function agregar_imagen_producto($codigo_item,$id_producto,$imagen){
            $conexion = mainModel::conectar();
            $agregar_imagen = $conexion->query("INSERT INTO `producto_img`(`ID_IMG`, `ID_PRODUCTO`, `IMG`) VALUES ('$codigo_item','$id_producto','$imagen')");
            return $agregar_imagen;
        }
        function agregar_caracteristica_producto($codigo_item,$id_producto,$text){
            $conexion = mainModel::conectar();
            $agregar_imagen = $conexion->query("INSERT INTO `producto_caracteristica`(`ID_CARACTERISTICA`, `ID_PRODUCTO`, `CARACTERISTICA`) VALUES ('$codigo_item','$id_producto','$text')");
            return $agregar_imagen;
        }
        function eliminar_imagen($codigo_item){
            $conexion = mainModel::conectar();
            $agregar_imagen = $conexion->query("DELETE FROM `producto_img` WHERE `ID_IMG`='$codigo_item'");
            return $agregar_imagen;
        }
        function lista_img_productos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM producto_img");
            return $productos;
        }
        function lista_caracteristica_productos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM producto_caracteristica");
            return $productos;
        }
        function lista_img_productos_producto($id){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM producto_img WHERE ID_PRODUCTO = '$id'");
            return $productos;
        }
        function lista_caracteristicas_productos_producto($id){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM producto_caracteristica WHERE ID_PRODUCTO = '$id'");
            return $productos;
        }
        function listar_unidades(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_unidades_medida");
            return $unidades;
        }
        function lista_productos(){
            $conexion = mainModel::conectar();
            $productos = $conexion->query("SELECT * FROM vista_productos ");
            return $productos;
        }
        function listar_linea(){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("SELECT * FROM vista_lineas");
            return $linea;
        }
        function listar_presentacion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM vista_presentacion");
            return $presentacion;
        }
        function agregar_producto($codigo,$barra,$articulo,$presentacion,$linea,$unidad,$complemento,$precio_costo,$precio_venta1,$precio_venta2,$precio_venta3,$precio_venta4,$stockminimo,$stockmedio,$stockmoderado,$perecedero,$excento,$estado,$imagen   /**** AGREGADO POR REYNOLD ALVIN - JULIO - 2022 *****/ ,$medida_1="",$medida_2="",$medida_3="",$medida_4="",$stock_1="",$stock_2="",$stock_3="",$stock_4="",$precio_venta5=0,$precio_venta6=0,$precio_venta7=0,$medida5="",$medida6="",$medida7="",$stock5=0,$stock6=0,$stock7=0){
            $conexion = mainModel::conectar();
            $producto = $conexion->query(" INSERT INTO `producto`(`ID_PRODUCTO`, `BARRA`, `ARTICULO`, `ID_PRESENTACION`, `ID_LINEA`, `ID_UNIDAD`, `COMPLEMENTO`,  `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `STOCK_MINIMO`, `STOCK_MEDIO`, `STOCK_MODERADO`, `PERECEDERO`, `EXENTO`, `ESTADO`, `IMAGEN`, `MEDIDA_1`,`MEDIDA_2`,`MEDIDA_3`,`MEDIDA_4`,`STOCK_1`,`STOCK_2`,`STOCK_3`,`STOCK_4`,`PRECIO_VENTA_5`,`PRECIO_VENTA_6`,`PRECIO_VENTA_7`,`MEDIDA_5`,`MEDIDA_6`,`MEDIDA_7`,`STOCK_5`,`STOCK_6`,`STOCK_7`) VALUES('$codigo','$barra','$articulo','$presentacion','$linea','$unidad','$complemento','$precio_costo','$precio_venta1','$precio_venta2','$precio_venta3','$precio_venta4','$stockminimo','$stockmedio','$stockmoderado','$perecedero','$excento','$estado','$imagen' /**** AGREGADO POR REYNOLD ALVIN - JULIO - 2022 *****/ ,'$medida_1','$medida_2','$medida_3','$medida_4','$stock_1','$stock_2','$stock_3','$stock_4','$precio_venta5','$precio_venta6','$precio_venta7','$medida5','$medida6','$medida7','$stock5','$stock6','$stock7')");
            return $producto;
        }
        function buscar_codigo_barra($codigo){
            $conexion = mainModel::conectar();
            $codigo_barra = $conexion->query("SELECT p.*,l.LINEA,pr.NOMBRE,um.UNIDAD,um.PREFIJO FROM producto as p INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD WHERE p.BARRA = '$codigo'");
            return $codigo_barra;
        }
        /*
            ======================================
               Consultar producto para compra 
            ======================================
        */
        function consultar_producto($codigo){
            $conexion = mainModel::conectar();
            $codigo_barra = $conexion->query("SELECT p.*,l.LINEA,pr.NOMBRE,um.UNIDAD,um.PREFIJO FROM producto AS p INNER JOIN linea AS l ON l.ID_LINEA = p.ID_LINEA INNER JOIN presentacion AS pr ON pr.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD WHERE p.ID_PRODUCTO = '$codigo'");
            return $codigo_barra;
        }
        /*
            ======================================
               Consultar producto para compra 
            ======================================
        */
        function consultar_lote($lote,$almacen){
            $conexion = mainModel::conectar();
            $codigo_barra = $conexion->query("SELECT l.*,a.NOMBRE FROM lote as l INNER JOIN almacen as a ON a.ID_ALMACEN = l.ID_ALMACEN WHERE l.NOMBRE = '$lote'  AND l.ID_ALMACEN = '$almacen'");
            return $codigo_barra;
        }
        /*
            ======================================
                        Lista de lotes 
            ======================================
        */
        function lista_lotes(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_lotes");
            return $lotes;
        }
        /*
            ======================================
                    Lista de items x lotes 
            ======================================
        */
        function lista_items_lotes(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_items ");
            return $lotes;
        }
        /*
            ======================================
                    Lista de precederos
            ======================================
        */
        function lista_perecederos(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_perecederos ");
            return $lotes;
        }
        /*
            ======================================
                        Agregar de lotes 
            ======================================
        */
        function agregar_lotes($p_id_lote,$p_nombre,$p_id_almacen,$p_fecha,$p_estado){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `lote`(`ID_LOTE`, `NOMBRE`, `ID_ALMACEN`, `FECHA_REGISTRO`, `ESTADO`) VALUES('$p_id_lote','$p_nombre','$p_id_almacen','$p_fecha','$p_estado')");
            return $lotes;
        }
        /*
            ======================================
                    Agregar de productos al lotes 
            ======================================
        */
        function agregar_productos_lotes($p_id_item,$p_id_almacen,$p_id_lote,$p_id_producto,$p_precio_costo,$p_precio_venta_1,$p_precio_venta_2,$p_precio_venta_3,$p_precio_venta_4,$p_cantidad,$p_perecedero,$fecha,$p_id_usuario,$p_precio_venta_5=0,$p_precio_venta_6=0,$p_precio_venta_7=0){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `items_lote`(`ID_ITEM`, `ID_ALMACEN`, `ID_LOTE`, `ID_PRODUCTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `CANTIDAD`, `PERECEDERO`, `FECHA_VEN`, `ID_USUARIO`,`PRECIO_VENTA_5`, `PRECIO_VENTA_6`, `PRECIO_VENTA_7` ) VALUES('$p_id_item','$p_id_almacen','$p_id_lote','$p_id_producto','$p_precio_costo','$p_precio_venta_1','$p_precio_venta_2','$p_precio_venta_3','$p_precio_venta_4','$p_cantidad','$p_perecedero','$fecha','$p_id_usuario','$p_precio_venta_5','$p_precio_venta_6','$p_precio_venta_7')");
            return $lotes;
        }
       
        /*
            ======================================
                    Agregar de perecederos
            ======================================
        */
        function agregar_perecedero($p_id_perecedero,$p_id_item,$p_id_producto,$p_id_almacen,$p_id_sucursal,$p_fecha1,$p_fecha2,$p_fecha3,$p_fecha4){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `perecederos`(`ID_PERECEDERO`, `ID_ITEM`, `ID_PRODUCTO`, `ID_ALMACEN`, `ID_SUCURSAL`, `FECHA_1`, `FECHA_2`, `FECHA_3`, `FECHA_4`) VALUES('$p_id_perecedero','$p_id_item','$p_id_producto','$p_id_almacen','$p_id_sucursal','$p_fecha1','$p_fecha2','$p_fecha3','$p_fecha4')");
            return $lotes;
        }

/* -------------------------------------------------------------------------- */
/*                             Actualizar con Foto                            */
/* -------------------------------------------------------------------------- */
        function actualizar_producto_with_photo($codigo,$barra,$articulo,$presentacion,$linea,$unidad,$complemento,$precio_costo,$precio_venta1,$precio_venta2,$precio_venta3,$precio_venta4,$stockminimo,$stockmedio,$stockmoderado,$perecedero,$excento,$estado,$imagen /**** AGREGADO POR REYNOLD ALVIN - ABRIL - 2022 *****/ ,$medida_1,$medida_2,$medida_3,$medida_4,$stock_1,$stock_2,$stock_3,$stock_4 /** FINAL DEL AGREGADO POR REYNOLD ALVIN - ABRIL - 2022 ***/,$precio_venta5=0,$precio_venta6=0,$precio_venta7=0,$medida5="",$medida6="",$medida7="",$stock5=0,$stock6=0,$stock7=0){
        
            $conexion = mainModel::conectar();
            $producto = $conexion->query("  UPDATE `producto` SET `BARRA`= '$barra',`ARTICULO`= '$articulo',`ID_PRESENTACION`= '$presentacion',`ID_LINEA`= '$linea',`ID_UNIDAD`= '$unidad',`COMPLEMENTO`=  '$complemento',`PRECIO_COSTO`= '$precio_costo',`PRECIO_VENTA_1`= '$precio_venta1',`PRECIO_VENTA_2`= '$precio_venta2',`PRECIO_VENTA_3`= '$precio_venta3',`PRECIO_VENTA_4`= '$precio_venta4',`STOCK_MINIMO`= '$stockminimo',`STOCK_MEDIO`= '$stockmedio',`STOCK_MODERADO`= '$stockmoderado',`PERECEDERO`= '$perecedero',`EXENTO`= '$excento',`ESTADO`= '$estado',`IMAGEN`= '$imagen',`MEDIDA_1`= '$medida_1',`MEDIDA_2`= '$medida_2',`MEDIDA_3`= '$medida_3',`MEDIDA_4`= '$medida_4',`STOCK_1`= '$stock_1',`STOCK_2`= '$stock_2',`STOCK_3`= '$stock_3',`STOCK_4`= '$stock_4',`PRECIO_VENTA_5`= '$precio_venta5',`PRECIO_VENTA_6`= '$precio_venta6',`PRECIO_VENTA_7`= '$precio_venta7',`MEDIDA_5`= '$medida5',`MEDIDA_6`= '$medida6',`MEDIDA_7`= '$medida7',`STOCK_5`= '$stock5',`STOCK_6`= '$stock6',`STOCK_7`= '$stock7' WHERE `ID_PRODUCTO`= '$codigo'  ;            ");
            return $producto;
        }
        function actualizar_producto_without_photo($p_id_producto,$p_barra,$p_producto,$p_id_presentacion,$p_id_linea,$p_id_unidad,$p_complemento,$p_precio_costo,$p_precio_venta_1,$p_precio_venta_2,$p_precio_venta_3,$p_precio_venta_4,$p_stock_minimo,$p_stock_medio,$p_stock_moderado,$p_perecedero,$p_excento,$p_estado /**** AGREGADO POR REYNOLD ALVIN - ABRIL - 2022 *****/ ,$medida_1,$medida_2,$medida_3,$medida_4,$stock_1,$stock_2,$stock_3,$stock_4 /** FINAL DEL AGREGADO POR REYNOLD ALVIN - ABRIL - 2022 ***/,$precio_venta5=0,$precio_venta6=0,$precio_venta7=0,$medida5="",$medida6="",$medida7="",$stock5=0,$stock6=0,$stock7=0){
            $conexion = mainModel::conectar();
            $producto = $conexion->query(" UPDATE `producto` SET `BARRA`= '$p_barra',`ARTICULO`= '$p_producto',`ID_PRESENTACION`= '$p_id_presentacion',`ID_LINEA`= '$p_id_linea',`ID_UNIDAD`='$p_id_unidad',`COMPLEMENTO`='$p_complemento',`PRECIO_COSTO`='$p_precio_costo',`PRECIO_VENTA_1`= '$p_precio_venta_1',`PRECIO_VENTA_2`='$p_precio_venta_2',`PRECIO_VENTA_3`='$p_precio_venta_3',`PRECIO_VENTA_4`='$p_precio_venta_4',`STOCK_MINIMO`= '$p_stock_minimo',`STOCK_MEDIO`= '$p_stock_medio',`STOCK_MODERADO`= '$p_stock_moderado',`PERECEDERO`= '$p_perecedero',`EXENTO`= '$p_excento',`ESTADO`= '$p_estado', `MEDIDA_1`= '$medida_1',`MEDIDA_2`= '$medida_2',`MEDIDA_3`= '$medida_3',`MEDIDA_4`= '$medida_4',`STOCK_1`= '$stock_1',`STOCK_2`= '$stock_2',`STOCK_3`= '$stock_3',`STOCK_4`= '$stock_4',`PRECIO_VENTA_5`= '$precio_venta5',`PRECIO_VENTA_6`= '$precio_venta6',`PRECIO_VENTA_7`= '$precio_venta7',`MEDIDA_5`= '$medida5',`MEDIDA_6`= '$medida6',`MEDIDA_7`= '$medida7',`STOCK_5`= '$stock5',`STOCK_6`= '$stock6',`STOCK_7`= '$stock7' WHERE  `ID_PRODUCTO`= '$p_id_producto'              ");
            return $producto;
        }

/* -------------------------------------------------------------------------- */
/*                              Consulta Producto                             */
/* -------------------------------------------------------------------------- */

        function consulta_producto($id){
            $conexion = mainModel::conectar();
            $producto = $conexion->query("SELECT * FROM `vista_productos` WHERE `ID_PRODUCTO` = '$id'");
            return $producto;
        }

/* -------------------------------------------------------------------------- */
/*                              Eliminar Producto                             */
/* -------------------------------------------------------------------------- */

        function eliminar_producto($p_id_producto){
            $conexion = mainModel::conectar();
            $producto = $conexion->query(" DELETE FROM `producto` WHERE `ID_PRODUCTO` ='$p_id_producto'");
            return $producto;
        }
        function lista_kardex(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT es.*,pr.BARRA,pr.ARTICULO,li.LINEA,pre.NOMBRE as 'PRESENTACION',pr.IMAGEN,pr.ID_PRODUCTO FROM entrada_salida as es INNER JOIN items_lote as il ON es.ID_ITEM = il.ID_ITEM INNER JOIN producto as pr ON pr.ID_PRODUCTO = il.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = pr.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = pr.ID_PRESENTACION");
            return $kardex;
        }
        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $agregar_kardex = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $agregar_kardex;
        }
    }