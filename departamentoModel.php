<?php
    class departamentoModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                              Listas Documento                              */
/* -------------------------------------------------------------------------- */

        function listar_departamento(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM departamento");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                              Agregar Documento                             */
/* -------------------------------------------------------------------------- */

        function agregar_departamento($codigo,$departamento){
            $conexion = mainModel::conectar();
            $departamento = $conexion->query("INSERT INTO `departamento`(`ID_DEPARTAMENTO`, `DEPARTAMENTO`) VALUES('$codigo','$departamento')");
            return $departamento;
        }

/* -------------------------------------------------------------------------- */
/*                             Consulta Documento                             */
/* -------------------------------------------------------------------------- */

        function consulta_departamento($id){
            $conexion = mainModel::conectar();
            $departamento = $conexion->query("SELECT * FROM `departamento` WHERE `ID_DEPARTAMENTO` = '$id'");
            return $departamento;
        }

/* -------------------------------------------------------------------------- */
/*                            Actualizar departamento                            */
/* -------------------------------------------------------------------------- */

        function actualizar_departamento($p_id_departamento,$p_departamento){
            $conexion = mainModel::conectar();
            $departamento = $conexion->query("UPDATE `departamento` SET `departamento`= '$p_departamento' WHERE `ID_DEPARTAMENTO`= '$p_id_departamento'");
            return $departamento;
        }

        function eliminar_departamento($p_id_departamento){
            $conexion = mainModel::conectar();
            $departamento = $conexion->query("DELETE FROM `departamento` WHERE `ID_DEPARTAMENTO` = '$p_id_departamento'");
            return $departamento;
        }
    }