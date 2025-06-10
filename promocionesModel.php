<?php
    class promocionesModel extends mainModel{
        function lista(){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("SELECT * FROM promociones");
            return $libro;
        }
        function agregar_promo($id,$foto){
            $conexion = mainModel::conectar();
            $libro = $conexion->query("INSERT INTO `promociones`(`ID`, `IMAGEN`) VALUES ('$id','$foto')");
            return $libro;
        }
        function eliminar_imagen($id){
            $conexion = mainModel::conectar();
            $agregar_imagen = $conexion->query("DELETE FROM `promociones` WHERE `ID`='$id'");
            return $agregar_imagen;
        }
    }   