<?php
    class metodopagoModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                              Listas metodopago                              */
/* -------------------------------------------------------------------------- */

        function listar_metodopagos(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM metodopagos");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                              Agregar metodopago                             */
/* -------------------------------------------------------------------------- */

        function agregar_metodopago($codigo,$metodopago,$estado){
            $conexion = mainModel::conectar();
            $metodopago = $conexion->query("INSERT INTO `metodopagos`(`ID`, `NAME`, `ESTADO`) VALUES('$codigo','$metodopago', '$estado')");
            return $metodopago;
        }

/* -------------------------------------------------------------------------- */
/*                             Consulta metodopago                             */
/* -------------------------------------------------------------------------- */

        function consulta_metodopago($id){
            $conexion = mainModel::conectar();
            $metodopago = $conexion->query(" SELECT * FROM `metodopagos` WHERE `ID` ='$id'");
            return $metodopago;
        }

/* -------------------------------------------------------------------------- */
/*                            Actualizar metodopago                            */
/* -------------------------------------------------------------------------- */

        function actualizar_metodopago($p_id_metodopago,$p_metodopago,$p_estado){
            $conexion = mainModel::conectar();
            $metodopago = $conexion->query("UPDATE `metodopagos` SET `NAME`= '$p_metodopago',`ESTADO`= '$p_estado' WHERE `ID`= '$p_id_metodopago'");
            return $metodopago;
        }
    }