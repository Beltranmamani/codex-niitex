<?php
    class lineasModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                                Listar_lineas                               */
/* -------------------------------------------------------------------------- */

        function listar_lineas(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_lineas");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                                Agregar_Linea                               */
/* -------------------------------------------------------------------------- */

        function agregar_linea($codigo,$linea,$estado){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("INSERT INTO `linea`(`ID_LINEA`, `LINEA`, `ESTADO`) VALUES ('$codigo','$linea','$estado')");
            return $linea;
        }

/* -------------------------------------------------------------------------- */
/*                               Consulta_Linea                               */
/* -------------------------------------------------------------------------- */

        function consulta_linea($id){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("SELECT * FROM `vista_lineas` WHERE `ID_LINEA` = '$id'");
            return $linea;
        }

/* -------------------------------------------------------------------------- */
/*                              Actualizar_Linea                              */
/* -------------------------------------------------------------------------- */

        function actualizar_linea($p_id_linea,$p_linea,$p_estado){
            $conexion = mainModel::conectar();
            $linea = $conexion->query("UPDATE `linea` SET `LINEA`= '$p_linea' ,`ESTADO`= '$p_estado' WHERE `ID_LINEA`= '$p_id_linea'");
            return $linea;
        }
    }