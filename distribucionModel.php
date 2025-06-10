<?php
    class distribucionModel extends mainModel{
        /*
            ======================================
                      Listar almacenes
            ======================================
        */
        function listar_preventas(){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT * FROM preventa WHERE ESTADO = 1");
            return $almacenes;
        }


    }