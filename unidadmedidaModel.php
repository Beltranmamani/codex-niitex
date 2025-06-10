<?php
    class unidadmedidaModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                               Listar_Unidades                              */
/* -------------------------------------------------------------------------- */

        function listar_unidades(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_unidades_medida");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                               Agregar_Unidad                               */
/* -------------------------------------------------------------------------- */

        function agregar_unidad($codigo,$unidad,$prefijo,$estado){
            $conexion = mainModel::conectar();
            $unidad = $conexion->query("INSERT INTO `unidad_medida`(`ID_UNIDAD`, `UNIDAD`, `PREFIJO`, `ESTADO`) VALUES('$codigo','$unidad','$prefijo','$estado')");
            return $unidad;
        }

/* -------------------------------------------------------------------------- */
/*                               Consulta_unidad                              */
/* -------------------------------------------------------------------------- */

        function consulta_unidad($id){
            $conexion = mainModel::conectar();
            $unidad = $conexion->query("SELECT * FROM `vista_unidades_medida` WHERE `ID_UNIDAD` ='$id'");
            return $unidad;
        }

/* -------------------------------------------------------------------------- */
/*                              Actualizar_Unidad                             */
/* -------------------------------------------------------------------------- */

        function actualizar_unidad($p_id_unidad,$p_unidad,$p_prefijo,$p_estado){
            $conexion = mainModel::conectar();
            $unidad = $conexion->query("UPDATE `unidad_medida` SET `UNIDAD`= '$p_unidad'  ,`PREFIJO`= '$p_prefijo'  ,`ESTADO`= '$p_estado' WHERE `ID_UNIDAD`= '$p_id_unidad'");
            return $unidad;
        }
    }