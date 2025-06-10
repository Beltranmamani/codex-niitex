<?php
    class comprobanteModel extends mainModel{

/* ========================================================================== */
/*                            Lista de comprobantes                           */
/* ========================================================================== */
        function actualizar_estado_tiraje($id,$estado){
            $conexion = mainModel::conectar();
            $comprobantes = $conexion->query("UPDATE tiraje_comprobante SET ESTADO = '$estado' WHERE ID_TIRAJE = '$id'  ");
            return $comprobantes;
        }
        function lista_comprobantes(){
            $conexion = mainModel::conectar();
            $comprobantes = $conexion->query("SELECT * FROM vista_comprobante  ");
            return $comprobantes;
        }
/* ========================================================================== */
/*                      Funcion agregar nuevo comprobante                     */
/* ========================================================================== */
        function agregar_comprobante($codigo,$comprobante,$estado){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query("INSERT INTO `comprobante`(`ID_COMPROBANTE`, `COMPROBANTE`, `ESTADO`) VALUES('$codigo','$comprobante','$estado')");
            return $comprobante;
        }

/* ========================================================================== */
/*                              Lista de tirajes                              */
/* ========================================================================== */
        function lista_tirajes(){
            $conexion = mainModel::conectar();
            $tirajes = $conexion->query("SELECT * FROM vista_tirajes");
            return $tirajes;
        }

/* ========================================================================== */
/*                               Guardar tiraje                               */
/* ========================================================================== */
        function guardar_tiraje($p_id_tiraje,$p_fecha_resolucion,$p_nro_resolucion,$p_nro_resolucion_fac,$p_serie,$p_desde,$p_hasta,$p_id_comprobante,$p_id_sucursal,$p_disponibles){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query("INSERT INTO `tiraje_comprobante`(`ID_TIRAJE`, `FECHA_RESOLUCION`, `NRO_RESOLUCION`, `NRO_RESOLUCION_FAC`, `SERIE`, `DESDE`, `HASTA`, `ID_COMPROBANTE`, `ID_SUCURSAL`, `DISPONIBLES`) VALUES ('$p_id_tiraje','$p_fecha_resolucion','$p_nro_resolucion','$p_nro_resolucion_fac','$p_serie','$p_desde','$p_hasta','$p_id_comprobante','$p_id_sucursal','$p_disponibles')");
            return $comprobante;
        }

/* -------------------------------------------------------------------------- */
/*                            Consulta comprobante                            */
/* -------------------------------------------------------------------------- */
        function consulta_comprobante($id){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query(" SELECT * FROM `vista_comprobante` WHERE `ID_COMPROBANTE` = '$id'");
            return $comprobante;
        }
/* -------------------------------------------------------------------------- */
/*                           Actualizar Comprobante                           */
/* -------------------------------------------------------------------------- */

        function actualizar_comprobante($p_id_comprobante,$p_comprobante,$p_estado){
            $conexion = mainModel::conectar();
            $comprobante = $conexion->query("UPDATE `comprobante` SET `comprobante`= '$p_comprobante',`ESTADO`= '$p_estado' WHERE `ID_COMPROBANTE`= '$p_id_comprobante'");
            return $comprobante;
        }
        function consulta_tiraje($id){
            $conexion = mainModel::conectar();
            $tiraje = $conexion->query("SELECT * FROM `vista_tirajes` WHERE `ID_TIRAJE` = '$id'");
            return $tiraje;
        }
        function actualizar_tiraje($p_id_tiraje,$p_fecha_resolucion,$p_nro_resolucion,$p_nro_resolucion_fac,$p_serie,$p_desde,$p_hasta,$p_disponibles){
            $conexion = mainModel::conectar();
            $tiraje = $conexion->query(" UPDATE `tiraje_comprobante` SET `FECHA_RESOLUCION`= '$p_fecha_resolucion',`NRO_RESOLUCION`=  '$p_nro_resolucion',`NRO_RESOLUCION_FAC`=  '$p_nro_resolucion_fac',`SERIE`= '$p_serie',`DESDE`= '$p_desde',`HASTA`= '$p_hasta',`DISPONIBLES`= '$p_disponibles' WHERE `ID_TIRAJE`= '$p_id_tiraje'");
            return $tiraje;
        }
        function eliminar_tiraje($p_id_tiraje){
            $conexion = mainModel::conectar();
            $tiraje = $conexion->query("  DELETE FROM `tiraje_comprobante` WHERE `ID_TIRAJE` ='$p_id_tiraje'");
            return $tiraje;
        }
    }