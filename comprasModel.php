<?php
    class comprasModel extends mainModel{
        /*
            ======================================
                      Lista comprobantes
            ======================================
        */
         function guardar_libro($id,$nro,$fecha_limite,$nro_auto,$llave,$fecha,$id_venta,$nro_factura,$total,$codigo,$id_s,$descuento_compra){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("INSERT INTO `libro_compras`(`ID`, `NRO`, `FECHA_LIMITE`, `NRO_AUTORIZACION`, `LLAVE`, `FECHA_EMISION`, `ID_COMPRA`, `NRO_FACTURA`, `TOTAL`, `CODIGO_CONTROL`, `ID_SUCURSAL`, `DESCUENTO`) VALUES ('$id','$nro','$fecha_limite','$nro_auto','$llave','$fecha','$id_venta','$nro_factura','$total','$codigo','$id_s','$descuento_compra')");
            return $libro;
        }
        function lista_libro_compra_fecha_sucursal($id,$f1,$f2){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT l.*,ven.ESTADO,cl.RAZON,cl.N_DOCUMENTO FROM libro_compras as l INNER JOIN compras as ven ON ven.ID_COMPRA = l.ID_COMPRA COLLATE utf8_unicode_ci INNER JOIN proveedor as cl ON cl.ID_PROVEEDOR = ven.ID_PROVEEDOR WHERE l.ID_SUCURSAL = '$id'  AND date(ven.FECHA_COMPRA)>='$f1' AND date(ven.FECHA_COMPRA)<='$f2'");
            return $libro;
        }
        function lista_libro_compra_sucursal($id){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT l.*,ven.ESTADO,cl.RAZON,cl.N_DOCUMENTO FROM libro_compras as l INNER JOIN compras as ven ON ven.ID_COMPRA = l.ID_COMPRA COLLATE utf8_unicode_ci INNER JOIN proveedor as cl ON cl.ID_PROVEEDOR = ven.ID_PROVEEDOR WHERE l.ID_SUCURSAL = '$id'");
            return $libro;
        }
        function lista_libro_compra(){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT l.*,ven.ESTADO,cl.RAZON,cl.N_DOCUMENTO FROM libro_compras as l INNER JOIN compras as ven ON ven.ID_COMPRA = l.ID_COMPRA COLLATE utf8_unicode_ci INNER JOIN proveedor as cl ON cl.ID_PROVEEDOR = ven.ID_PROVEEDOR ");
            return $libro;
        }
        
        function lista_comprobantes(){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query("SELECT * FROM vista_comprobante");
            return $comprobante;
        }
        function detalle_productos_compra($compra){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query("SELECT ic.*,il.CANTIDAD as 'STOCK_LOTE',ic.CANTIDAD as 'STOCK_COMPRA' FROM items_compra AS ic INNER JOIN items_lote as il ON il.ID_ITEM = ic.ID_ITEM WHERE ic.ID_COMPRA = '$compra'");
            return $comprobante;
        }
        /*
            ======================================
                      Lista almacenes
            ======================================
        */
        function listar_almacenesXsucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("    SELECT a.* FROM almacen as a WHERE a.ID_SUCURSAL = '$p_id_sucursal'");
            return $almacenes;
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
                    Lista proveedores
        ======================================
        */
        function listar_proveedores(){
            $conexion = mainModel::conectar();
            $proveedores = $conexion->query("SELECT*FROM vista_proveedores");
            return $proveedores;
        }
         /*
        ======================================
                    Lista lotes
        ======================================
        */
        function lista_lotes(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT l.*,a.NOMBRE as 'ALMACEN' FROM lote as l INNER JOIN almacen as a ON a.ID_ALMACEN = l.ID_ALMACEN");
            return $lotes;
        }
        /*
        ======================================
                    Lista compras
        ======================================
        */
        function listar_compras(){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT*FROM vista_compras ");
            return $compras;
        }

/* ========================================================================== */
/*                               Lista entradas                               */
/* ========================================================================== */

        function listar_entradas(){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT*FROM vista_entradas  ");
            return $compras;
        }

/* ========================================================================== */
/*                        Funcion para guardar compras                        */
/* ========================================================================== */

        function realizarcompra($p_id_compra,$p_fecha,$p_id_proveedor,$p_id_almacen,$p_tipo_pago,$p_id_comprobante,$p_n_comprobante,$p_fecha_comprobante,$p_sumas,$p_iva,$subtotal,$p_exento,$p_retenido,$p_total_exentos,$p_total,$p_id_usuario,$p_id_lote,$p_estado,$nro_compra,$id_caja){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("INSERT INTO `compras`(`ID_COMPRA`, `FECHA_COMPRA`, `ID_PROVEEDOR`, `ID_ALMACEN`, `TIPO_PAGO`, `ID_COMPROBANTE`, `N_COMPROBANTE`, `FECHA_COMPROBANTE`, `SUMAS`, `IVA`,`SUBTOTAL`, `EXENTO`, `RETENIDO`, `TOTAL_EXENTOS`, `TOTAL`, `ID_USUARIO`, `ID_LOTE`, `ESTADO`,`N_COMPRA`,`ID_ARQUEO`) VALUES('$p_id_compra','$p_fecha','$p_id_proveedor','$p_id_almacen','$p_tipo_pago','$p_id_comprobante','$p_n_comprobante','$p_fecha_comprobante','$p_sumas','$p_iva','$subtotal','$p_exento','$p_retenido','$p_total_exentos','$p_total','$p_id_usuario','$p_id_lote','$p_estado','$nro_compra','$id_caja')");
            return $compras;
        }

/* ========================================================================== */
/*                     Lista de lo todos los items en lote                    */
/* ========================================================================== */

        function lista_items_lotes(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_items ");
            return $lotes;
        }

/* ========================================================================== */
/*                             Lista de productos                             */
/* ========================================================================== */

        function lista_productos(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM `vista_productos`");
            return $lotes;
        }

/* ========================================================================== */
/*                        Agregar de productos al lotes                       */
/* ========================================================================== */

        function agregar_productos_lotes($p_id_item,$p_id_almacen,$p_id_lote,$p_id_producto,$p_precio_costo,$p_precio_venta_1,$p_precio_venta_2,$p_precio_venta_3,$p_precio_venta_4,$p_cantidad,$p_perecedero,$fecha,$p_id_usuario,$precio_5=0,$precio_6=0,$precio_7=0){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `items_lote`(`ID_ITEM`, `ID_ALMACEN`, `ID_LOTE`, `ID_PRODUCTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `CANTIDAD`, `PERECEDERO`, `FECHA_VEN`, `ID_USUARIO`, `PRECIO_VENTA_5`, `PRECIO_VENTA_6`, `PRECIO_VENTA_7`) VALUES('$p_id_item','$p_id_almacen','$p_id_lote','$p_id_producto','$p_precio_costo','$p_precio_venta_1','$p_precio_venta_2','$p_precio_venta_3','$p_precio_venta_4','$p_cantidad','$p_perecedero','$fecha','$p_id_usuario','$precio_5','$precio_6','$precio_7')");
            return $lotes;
        }

/* ========================================================================== */
/*                           Agregar de perecederos                           */
/* ========================================================================== */

        function agregar_perecedero($p_id_perecedero,$p_id_item,$p_id_producto,$p_id_almacen,$p_id_sucursal,$p_fecha1,$p_fecha2,$p_fecha3,$p_fecha4){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `perecederos`(`ID_PERECEDERO`, `ID_ITEM`, `ID_PRODUCTO`, `ID_ALMACEN`, `ID_SUCURSAL`, `FECHA_1`, `FECHA_2`, `FECHA_3`, `FECHA_4`) VALUES('$p_id_perecedero','$p_id_item','$p_id_producto','$p_id_almacen','$p_id_sucursal','$p_fecha1','$p_fecha2','$p_fecha3','$p_fecha4')");
            return $lotes;
        }

/* ========================================================================== */
/*                      Agregar de productos a la compra                      */
/* ========================================================================== */

        function agregar_productos_compra($p_id_item,$p_id_almacen,$p_id_lote,$p_id_producto,$p_precio_costo,$p_precio_venta_1,$p_precio_venta_2,$p_precio_venta_3,$p_precio_venta_4,$p_cantidad,$p_perecedero,$p_id_compra,$fecha_4,$precio_5=0,$precio_6=0,$precio_7=0){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("INSERT INTO `items_compra`(`ID_ITEM`, `ID_ALMACEN`, `ID_LOTE`, `ID_PRODUCTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `CANTIDAD`, `PERECEDERO`, `ID_COMPRA`,`FECHA_VENCIMIENTO`,`PRECIO_VENTA_5`,`PRECIO_VENTA_6`,`PRECIO_VENTA_7`) VALUES('$p_id_item','$p_id_almacen','$p_id_lote','$p_id_producto','$p_precio_costo','$p_precio_venta_1','$p_precio_venta_2','$p_precio_venta_3','$p_precio_venta_4','$p_cantidad','$p_perecedero','$p_id_compra','$fecha_4','$precio_5','$precio_6','$precio_7')");
            return $lotes;
        }

/* ========================================================================== */
/*                        Lista de productos precederos                       */
/* ========================================================================== */

        function lista_perecederos(){
            $conexion = mainModel::conectar();
            $lotes = $conexion->query("SELECT * FROM vista_perecederos ");
            return $lotes;
        }

/* ========================================================================== */
/*                               Agregar entrada                              */
/* ========================================================================== */

        function agregar_entrada($p_id_entrada,$p_mes,$p_fecha,$p_descripcion,$p_cantidad,$p_precio_costo,$p_precio_venta_1,$p_precio_venta_2,$p_precio_venta_3,$p_precio_venta_4,$p_id_producto,$p_id_compra){
            $conexion = mainModel::conectar();
            $entrada = $conexion->query("INSERT INTO `entrada`(`ID_ENTRADA`, `MES_INVENTARIO`, `FECHA`, `DESCRIPCION`, `CANTIDAD`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `ID_PRODUCTO`, `ID_COMPRA`) VALUES ('$p_id_entrada','$p_mes','$p_fecha','$p_descripcion','$p_cantidad','$p_precio_costo','$p_precio_venta_1','$p_precio_venta_2','$p_precio_venta_3','$p_precio_venta_4','$p_id_producto','$p_id_compra')");
            return $entrada;
        }

/* ========================================================================== */
/*                          Lista de compras totales                          */
/* ========================================================================== */

        function lista_compras(){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT * FROM vista_compras");
            return $compras;
        }
        function lista_compras_2($date_1,$date_2,$sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT * FROM vista_compras WHERE date(FECHA_COMPROBANTE) >= '$date_1' AND date(FECHA_COMPROBANTE) <= '$date_2' AND SUCURSAL = '$sucursal' ");
            return $compras;
        }

/* ========================================================================== */
/*                            Detalle de la compra                            */
/* ========================================================================== */
        function detalle_compra($compra){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("SELECT*FROM vista_compras WHERE ID_COMPRA = '$compra'");
            return $compra;
        }

/* ========================================================================== */
/*                               Items de compra                              */
/* ========================================================================== */

        function detalle_item_compra($compra){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("SELECT*FROM vista_items_compra WHERE ID_COMPRA = '$compra'");
            return $compra;
        }

/* ========================================================================== */
/*                        Lista de compras por sucursal                       */
/* ========================================================================== */

        function lista_compras_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $compras = $conexion->query("SELECT*FROM vista_compras WHERE SUCURSAL = '$sucursal' ");
            return $compras;
        }

/* ========================================================================== */
/*                             Lista de historicos                            */
/* ========================================================================== */

        function lista_historicos(){
            $conexion = mainModel::conectar();
            $historicos = $conexion->query("SELECT * FROM `vista_historicos`");
            return $historicos;
        }

/* ========================================================================== */
/*                               Lista de kardex                              */
/* ========================================================================== */

        function Lista_de_kardex(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT * FROM `entrada_salida`");
            return $kardex;
        }

/* ========================================================================== */
/*                           Funcion agregar kardex                           */
/* ========================================================================== */

        function agregar_kardex($p_id_kardex,$p_id_caja,$p_id_sucursal,$p_id_usuario,$p_id_item,$p_precio_movimiento,$p_fecha,$p_movimiento,$p_entradas,$p_salidas,$p_stock_lote,$p_stock_global,$p_detalle,$p_id_venta){
            $conexion = mainModel::conectar();
            $agregar_kardex = $conexion->query(" INSERT INTO `entrada_salida`(`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES('$p_id_kardex','$p_id_caja','$p_id_sucursal','$p_id_usuario','$p_id_item','$p_precio_movimiento','$p_fecha','$p_movimiento','$p_entradas','$p_salidas','$p_stock_lote','$p_stock_global','$p_detalle','$p_id_venta')");
            return $agregar_kardex;
        }

/* ========================================================================== */
/*                          Lista de items por compra                         */
/* ========================================================================== */

        function lista_items_compra(){
            $conexion = mainModel::conectar();
            $kardex = $conexion->query("SELECT * FROM vista_items_compra");
            return $kardex;
        }

/* ========================================================================== */
/*                         Lista de creditos de compra                        */
/* ========================================================================== */

        function lista_creditos_de_compra(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT c.*,cm.FECHA_COMPROBANTE,cm.N_COMPRA,a.ID_SUCURSAL,p.ID_PROVEEDOR,p.RAZON,per.NOMBRES,per.PERFIL,cm.ESTADO AS 'ESTADO_COMPRA' FROM creditos_compra as c INNER JOIN compras as cm ON cm.ID_COMPRA = c.ID_COMPRA INNER JOIN almacen as a ON cm.ID_ALMACEN = a.ID_ALMACEN INNER JOIN proveedor as p ON p.ID_PROVEEDOR = cm.ID_PROVEEDOR INNER JOIN usuario as us ON us.ID_USUARIO = cm.ID_USUARIO INNER JOIN persona as per ON us.ID_PERSONA = per.ID_PERSONA;");
            return $creditos;
        }

/* ========================================================================== */
/*                  Lista de pagos de los creditos de compras                 */
/* ========================================================================== */

        function lista_de_pagos_credito(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT pc.*,cc.N_COTIZACION as 'N_CREDITO', cc.TOTAL,cc.PAGADO,cc.PENDIENTE,com.N_COMPRA, com.ESTADO as 'ESTADO_COMPRA',CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' , pro.RAZON AS 'PROVEEDOR' FROM pagos_credito as pc INNER JOIN creditos_compra as cc ON cc.ID_CREDITO = pc.ID_CREDITO INNER JOIN compras as com ON com.ID_COMPRA = cc.ID_COMPRA INNER JOIN usuario as usu ON usu.ID_USUARIO = pc.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN proveedor as pro ON pro.ID_PROVEEDOR = com.ID_PROVEEDOR");
            return $creditos;
        }

/* ========================================================================== */
/*                          Agregar credito sucursal                          */
/* ========================================================================== */

        function agregar_credito($p_id_credito,$p_id_compra,$p_total,$p_pagado,$p_pendiente,$p_fecha_pago,$p_estado,$p_n_cotizacion){
            $conexion = mainModel::conectar();
            $agregar_credito = $conexion->query("INSERT INTO `creditos_compra`(`ID_CREDITO`, `ID_COMPRA`, `TOTAL`, `PAGADO`, `PENDIENTE`, `FECHA_PAGO`, `ESTADO`,`N_COTIZACION`) VALUES('$p_id_credito','$p_id_compra','$p_total','$p_pagado','$p_pendiente','$p_fecha_pago','$p_estado','$p_n_cotizacion')");
            return $agregar_credito;
        }

/* ========================================================================== */
/*                      Compras creditos credito sucursal                     */
/* ========================================================================== */

        function compras_creditos_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query(" SELECT c.*,cm.FECHA_COMPROBANTE,cm.N_COMPRA,a.ID_SUCURSAL,p.ID_PROVEEDOR,p.RAZON,per.NOMBRES,per.PERFIL,cm.ESTADO AS 'ESTADO_COMPRA' FROM creditos_compra as c INNER JOIN compras as cm ON cm.ID_COMPRA = c.ID_COMPRA INNER JOIN almacen as a ON cm.ID_ALMACEN = a.ID_ALMACEN INNER JOIN proveedor as p ON p.ID_PROVEEDOR = cm.ID_PROVEEDOR INNER JOIN usuario as us ON us.ID_USUARIO = cm.ID_USUARIO INNER JOIN persona as per ON us.ID_PERSONA = per.ID_PERSONA  WHERE a.ID_SUCURSAL = '$sucursal'");
            return $creditos;
        }
        function compras_creditos(){
            $conexion = mainModel::conectar();
            $creditos = $conexion->query("SELECT c.*,cm.FECHA_COMPROBANTE,cm.N_COMPRA,a.ID_SUCURSAL,p.ID_PROVEEDOR,p.RAZON,per.NOMBRES,per.PERFIL,cm.ESTADO AS 'ESTADO_COMPRA' FROM creditos_compra as c INNER JOIN compras as cm ON cm.ID_COMPRA = c.ID_COMPRA INNER JOIN almacen as a ON cm.ID_ALMACEN = a.ID_ALMACEN INNER JOIN proveedor as p ON p.ID_PROVEEDOR = cm.ID_PROVEEDOR INNER JOIN usuario as us ON us.ID_USUARIO = cm.ID_USUARIO INNER JOIN persona as per ON us.ID_PERSONA = per.ID_PERSONA ");
            return $creditos;
        }
        function anular_compra($id_compra){
            $conexion = mainModel::conectar();
            $compra = $conexion->query(" UPDATE `compras` SET `ESTADO` = 0 WHERE `ID_COMPRA`= '$id_compra'");
            return $compra;
        }
        function devolver_producto_compra($id_item,$p_cantidad){
            $conexion = mainModel::conectar();

            $cantidad = 0;
            $buscarcantidada = $conexion->query("SELECT CANTIDAD FROM items_lote WHERE ID_ITEM = '$id_item' ");
            foreach ($buscarcantidada->fetchAll() as $rows) {
                $cantidad = $rows["CANTIDAD"];
            }
            $compra = "";
            if($cantidad <= 0){
                $compra = $conexion->query(" UPDATE items_lote SET CANTIDAD = 0 WHERE ID_ITEM = '$id_item' ");
            }elseif($cantidad>=$p_cantidad){
                $compra = $conexion->query(" UPDATE items_lote SET CANTIDAD = CANTIDAD - '$p_cantidad' WHERE ID_ITEM = '$id_item'");
            }
            return $compra;
        }
        function buscar_credito_de_compra($id_credito){
            $conexion = mainModel::conectar();
            $compra = $conexion->query(" SELECT c.*,cm.FECHA_COMPROBANTE,cm.N_COMPRA,a.ID_SUCURSAL,p.ID_PROVEEDOR,p.RAZON,per.NOMBRES,per.PERFIL,cm.ESTADO AS 'ESTADO_COMPRA' FROM creditos_compra as c INNER JOIN compras as cm ON cm.ID_COMPRA = c.ID_COMPRA INNER JOIN almacen as a ON cm.ID_ALMACEN = a.ID_ALMACEN INNER JOIN proveedor as p ON p.ID_PROVEEDOR = cm.ID_PROVEEDOR INNER JOIN usuario as us ON us.ID_USUARIO = cm.ID_USUARIO INNER JOIN persona as per ON us.ID_PERSONA = per.ID_PERSONA WHERE c.ID_CREDITO = '$id_credito'");
            return $compra;
        }
        function abono_credito_de_compra($id_credito,$pagado,$pendiente,$estado){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("UPDATE `creditos_compra` SET `PAGADO`= '$pagado',`PENDIENTE`= '$pendiente',`ESTADO`= '$estado' WHERE `ID_CREDITO`= '$id_credito'");
            return $compra;
        }
        function agregar_pago_credito($p_id_pago,$p_id_credito,$p_id_caja,$p_id_usuario,$p_id_sucursal,$p_monto,$p_pago_con,$p_cambio,$p_fecha_registro,$p_estado,$pagado){
            $conexion = mainModel::conectar();
            $pago = $conexion->query("INSERT INTO `pagos_credito`(`ID_PAGO`, `ID_CREDITO`, `ID_CAJA`, `ID_USUARIO`, `ID_SUCURSAL`, `MONTO`, `PAGO_CON`, `CAMBIO`, `FECHA_REGISTRO`, `ESTADO`,`PAGADO_AC`) VALUES ('$p_id_pago','$p_id_credito','$p_id_caja','$p_id_usuario','$p_id_sucursal','$p_monto','$p_pago_con','$p_cambio','$p_fecha_registro','$p_estado','$pagado')");
            return $pago;
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
        function lista_de_movimientos(){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT * FROM `vista_movimientos`");
            return $movimientos;
        }
        function lista_pagos_credito(){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT pc.*,cc.N_COTIZACION as 'N_CREDITO', cc.TOTAL,cc.PAGADO,cc.PENDIENTE,com.N_COMPRA, com.TIPO_PAGO  as 'ESTADO_COMPRA',CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' , pro.RAZON AS 'PROVEEDOR' FROM pagos_credito as pc INNER JOIN creditos_compra as cc ON cc.ID_CREDITO = pc.ID_CREDITO INNER JOIN compras as com ON com.ID_COMPRA = cc.ID_COMPRA INNER JOIN usuario as usu ON usu.ID_USUARIO = pc.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN proveedor as pro ON pro.ID_PROVEEDOR = com.ID_PROVEEDOR");
            return $movimientos;
        }
        function cambiar_estado_compra($compra){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("UPDATE `compras` SET `TIPO_PAGO` = 1 WHERE `ID_COMPRA`= '$compra'");
            return $compra;
        }
        function cambiar_estado_compra_pagado($compra){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("UPDATE `compras` SET `TIPO_PAGO` = 4 WHERE `ID_COMPRA`= '$compra'");
            return $compra;
        }
        function devolver_dinero_compra($arqueo, $total){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("UPDATE `arqueocaja` SET `EGRESOS` = `EGRESOS` - '$total'  WHERE  `ID_ARQUEO`= '$arqueo'");
            return $compra;
        }
        function agregar_movimiento_devolucion_compra($p_id_movimiento,$p_id_arqueo,$p_tipomovimiento,$p_descripcionmovimiento,$p_montomovimiento,$p_codmediopago,$p_fechamovimiento){
            $conexion = mainModel::conectar();
            $compra = $conexion->query("INSERT INTO `movimientoscajas`(`ID_MOVIMIENTO`, `ID_ARQUEO`, `TIPOMOVIMIENTO`, `DESCRIPCIONMOVIMIENTO`, `MONTOMOVIMIENTO`, `CODMEDIOPAGO`, `FECHAMOVIMIENTO`) VALUES ('$p_id_movimiento','$p_id_arqueo','$p_tipomovimiento','$p_descripcionmovimiento','$p_montomovimiento','$p_codmediopago','$p_fechamovimiento')");
            return $compra;
        }
    }