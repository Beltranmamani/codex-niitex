<?php
    class cajaModel extends mainModel{
/* ========================================================================== */
/*                              Lista de usuarios                             */
/* ========================================================================== */

        function lista_usuarios($id){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT us.*,per.NOMBRES,per.APELLIDOS FROM usuario_sucursal as us INNER JOIN usuario as usu ON usu.ID_USUARIO = us.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA WHERE us.ID_SUCURSAL = '$id'");
            return $usuarios;
        }

/* ========================================================================== */
/*                               Lista de cajas                               */
/* ========================================================================== */
function listar_metodopagos(){
    $conexion = mainModel::conectar();
    $unidades = $conexion->query("SELECT * FROM metodopagos");
    return $unidades;
}
function consulta_metodopago($id){
    $conexion = mainModel::conectar();
    $unidades = $conexion->query("SELECT * FROM metodopagos WHERE ID = '$id'");
    return $unidades;
}
        function lista_de_cajas(){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("SELECT c.*,p.NOMBRES,p.APELLIDOS,p.PERFIL FROM caja as c INNER JOIN usuario as u ON c.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as p ON u.ID_PERSONA = p.ID_PERSONA");
            return $cajas;
        }
       
        function venta_pago_pendiente_actualizar($id_venta,$pago,$recibido=0,$cambio=0,$medio=1){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("UPDATE `ventas` SET `PAGOS_A_VENTA` = `PAGOS_A_VENTA` +'$pago',`PAGO_EFECTIVO` = '$recibido',`CAMBIO` = '$cambio',`ID_METODOPAGO` = '$medio'  WHERE `ID_VENTA` = '$id_venta'");
            return $cajas;
        }
       

/* ========================================================================== */
/*                            Funcion agregar caja                            */
/* ========================================================================== */

        function guardar_caja($p_id_caja,$p_id_usuario,$p_nro_caja,$p_nombre_caja,$p_id_sucursal){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("INSERT INTO `caja`(`ID_CAJA`, `ID_USUARIO`, `NRO_CAJA`, `NOMBRE_CAJA`,`ID_SUCURSAL`) VALUES('$p_id_caja','$p_id_usuario','$p_nro_caja','$p_nombre_caja','$p_id_sucursal')");
            return $cajas;
        }

/* ========================================================================== */
/*                   Lista de cajas asignada en la sucursal                   */
/* ========================================================================== */

        function lista_cajas_asignadas($usuario,$sucursal){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query(" SELECT c.*,p.NOMBRES,p.APELLIDOS,p.PERFIL FROM caja as c INNER JOIN usuario as u ON c.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as p ON u.ID_PERSONA = p.ID_PERSONA WHERE c.ID_USUARIO = '$usuario'  AND c.ID_SUCURSAL = '$sucursal'");
            return $cajas;
        }
        
        function eliminar_caja($caja){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("DELETE FROM `caja` WHERE `ID_CAJA` = '$caja'");
            return $cajas;
        }
        
/* ========================================================================== */
/*                              Lista de arqueos                              */
/* ========================================================================== */

        function lista_de_arqueos(){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("SELECT a.*,c.ID_USUARIO,c.ID_SUCURSAL,c.NRO_CAJA,c.NOMBRE_CAJA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' FROM arqueocaja as a INNER JOIN caja as c ON a.ID_CAJA = c.ID_CAJA INNER JOIN usuario as usu ON usu.ID_USUARIO = c.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA");
            return $cajas;
        }
        function lista_de_arqueos_1($id){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("SELECT a.*,c.ID_USUARIO,c.ID_SUCURSAL,c.NRO_CAJA,c.NOMBRE_CAJA, per.NOMBRES as 'VENDEDOR' FROM arqueocaja as a INNER JOIN caja as c ON a.ID_CAJA = c.ID_CAJA INNER JOIN usuario as usu ON usu.ID_USUARIO = c.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA WHERE a.ID_ARQUEO = '$id'");
            return $cajas;
        }

/* ========================================================================== */
/*                     Funcion abrir caja(Agregar arqueo)                     */
/* ========================================================================== */

        function agregar_arqueo($p_id_arqueo,$p_id_caja,$p_montoinicial,$p_ingresos,$p_egresos,$p_creditos,$p_abonos,$p_dineroefectivo,$p_diferencia,$p_comentarios,$p_fechaapertura,$p_fechacierre,$p_statusarqueo){
            $conexion = mainModel::conectar();
            $arqueo = $conexion->query("INSERT INTO `arqueocaja`(`ID_ARQUEO`, `ID_CAJA`, `MONTOINICIAL`, `INGRESOS`, `EGRESOS`, `CREDITOS`, `ABONOS`, `DINEROEFECTIVO`, `DIFERENCIA`, `COMENTARIOS`, `FECHAAPERTURA`, `FECHACIERRE`, `STATUSARQUEO`) VALUES('$p_id_arqueo','$p_id_caja','$p_montoinicial','$p_ingresos','$p_egresos','$p_creditos','$p_abonos','$p_dineroefectivo','$p_diferencia','$p_comentarios','$p_fechaapertura','$p_fechacierre','$p_statusarqueo')");
            return $arqueo;
        }

/* ========================================================================== */
/*                         Funcion agregar_movimiento                         */
/* ========================================================================== */

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
            $movimientos = $conexion->query("SELECT m.*,c.ID_CAJA,c.NRO_CAJA,c.NOMBRE_CAJA,c.ID_SUCURSAL,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS)  as 'VENDEDOR',usu.ID_USUARIO FROM movimientoscajas as m INNER JOIN arqueocaja as a ON m.ID_ARQUEO = a.ID_ARQUEO INNER JOIN caja as c ON c.ID_CAJA = a.ID_CAJA INNER JOIN usuario as usu ON c.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA");
            return $movimientos;
        }
        function lista_de_arqueos_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT a.*,c.ID_USUARIO,c.ID_SUCURSAL,c.NRO_CAJA,c.NOMBRE_CAJA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' FROM arqueocaja as a INNER JOIN caja as c ON a.ID_CAJA = c.ID_CAJA INNER JOIN usuario as usu ON usu.ID_USUARIO = c.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA WHERE c.ID_SUCURSAL = '$sucursal'");
            return $movimientos;
        }
        function lista_de_movimiento_sucursal($sucursal){
            $conexion = mainModel::conectar();
            $movimientos = $conexion->query("SELECT m.*,c.ID_CAJA,c.NRO_CAJA,c.NOMBRE_CAJA,c.ID_SUCURSAL,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS)  as 'VENDEDOR',usu.ID_USUARIO FROM movimientoscajas as m INNER JOIN arqueocaja as a ON m.ID_ARQUEO = a.ID_ARQUEO INNER JOIN caja as c ON c.ID_CAJA = a.ID_CAJA INNER JOIN usuario as usu ON c.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA WHERE c.ID_SUCURSAL = '$sucursal' ");
            return $movimientos;
        }

        function consulta_movimiento($id){
            $conexion = mainModel::conectar();
            $movimiento = $conexion->query("SELECT m.*,c.ID_CAJA,c.NRO_CAJA,c.NOMBRE_CAJA,c.ID_SUCURSAL,per.ID_PERSONA, CONCAT(per.NOMBRES,' ',per.APELLIDOS)  as 'VENDEDOR',usu.ID_USUARIO FROM movimientoscajas as m INNER JOIN arqueocaja as a ON m.ID_ARQUEO = a.ID_ARQUEO INNER JOIN caja as c ON c.ID_CAJA = a.ID_CAJA INNER JOIN usuario as usu ON c.ID_USUARIO = usu.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA WHERE m.ID_MOVIMIENTO = '$id' ");
            return $movimiento;
        }
        function detalle_de_arqueos($arqueo){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("SELECT a.*,c.ID_USUARIO,c.ID_SUCURSAL,c.NRO_CAJA,c.NOMBRE_CAJA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' FROM arqueocaja as a INNER JOIN caja as c ON a.ID_CAJA = c.ID_CAJA INNER JOIN usuario as usu ON usu.ID_USUARIO = c.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA WHERE a.ID_ARQUEO = '$arqueo'");
            return $cajas;
        }
        function cerrar_cajar($arqueo,$efectivo,$diferencia,$comentarios,$cierre){
            $conexion = mainModel::conectar();
            $cajas = $conexion->query("UPDATE `arqueocaja` SET `DINEROEFECTIVO`= '$efectivo',`DIFERENCIA`= '$diferencia',`COMENTARIOS`= '$comentarios',`FECHACIERRE`= '$cierre',`STATUSARQUEO`= 0 WHERE `ID_ARQUEO`='$arqueo'");
            return $cajas;
        }

    }