<?php
    class seccionesModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                                Listar_lineas                               */
/* -------------------------------------------------------------------------- */

        function listar_seccion(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_seccion");
            return $unidades;
        }
        function listar_seccion_presentacion(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT sp.*,p.NOMBRE as 'PRESENTACION' FROM seccion_presentacion as sp INNER JOIN presentacion as p ON p.ID_PRESENTACION = sp.ID_PRESENTACION");
            return $unidades;
        }

        function listar_presentacion(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM vista_presentacion");
            return $presentacion;
        }
        function listar_items(){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM `vista_items`");
            return $presentacion;
        }

/* -------------------------------------------------------------------------- */
/*                                Agregar_Seccion                             */
/* -------------------------------------------------------------------------- */

        function agregar_seccion($codigo,$linea,$estado){
            $conexion = mainModel::conectar();
            $linea = $conexion->query(" INSERT INTO `seccion`(`ID_SECCION`, `SECCION`, `ESTADO`) VALUES('$codigo','$linea','$estado')");
            return $linea;
        }
        function agregar_seccion_presentacion($id_pre,$id_seccion,$id_spresentacion){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("INSERT INTO `seccion_presentacion`(`ID_PRESENTACIONES`, `ID_SECCION`,`ID_PRESENTACION`) VALUES('$id_pre','$id_seccion','$id_spresentacion')");
            return $linea;
        }

/* -------------------------------------------------------------------------- */
/*                               Consulta_Linea                               */
/* -------------------------------------------------------------------------- */

        function consulta_seccion($id){
            $conexion = mainModel::conectar();
            $seccion = $conexion->query(" SELECT * FROM `vista_seccion` WHERE `ID_SECCION` ='$id'");
            return $seccion;
        }
        function consulta_seccion_presentacion($id_seccion){
            $conexion = mainModel::conectar();
            $seccion = $conexion->query("SELECT sp.*,p.NOMBRE as 'PRESENTACION' FROM seccion_presentacion as sp INNER JOIN presentacion as p ON p.ID_PRESENTACION = sp.ID_PRESENTACION WHERE sp.ID_SECCION = '$id_seccion'");
            return $seccion;
        }

/* -------------------------------------------------------------------------- */
/*                              Actualizar_Linea                              */
/* -------------------------------------------------------------------------- */

        function actualizar_seccion($p_id_seccion,$p_seccion,$p_estado){
            $conexion = mainModel::conectar();
            $seccion = $conexion->query("UPDATE `seccion` SET `seccion`= '$p_seccion',`ESTADO`= '$p_estado' WHERE `ID_SECCION`='$p_id_seccion'");
            return $seccion;
        }

        function eliminar_presentacion($p_id_presentaciones){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query(" DELETE FROM `seccion_presentacion` WHERE `ID_PRESENTACIONES`='$p_id_presentaciones'");
            return $presentacion;
        }
    }