<?php
    class proveedoresModel extends mainModel{
        /*
            ======================================
                    Lista de proveedores
            ======================================
        */
        function lista_proveedores(){
            $conexion = mainModel::conectar();
            $proveedores = $conexion->query("SELECT * FROM vista_proveedores");
            return $proveedores;
        }
        /*
            ======================================
                    Lista de documentos
            ======================================
        */
        function lista_documentos(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_documento");
            return $unidades;
        }
         /*
            ======================================
                Agregar nuevo proveedor
            ======================================
        */
        function agregar_proveedor($p_id_proveedor,$p_razon,$p_id_documento,$p_numero,$p_direccion,$p_telefono,$p_email,$p_cuenta,$p_vendedor,$p_v_telefono,$p_estado){
            $conexion = mainModel::conectar();
            $proveedor = $conexion->query("INSERT INTO `proveedor`(`ID_PROVEEDOR`, `RAZON`, `TIPO_DOCUMENTO`, `N_DOCUMENTO`, `DIRECCION`, `TELEFONO`, `CORREO`, `CUENTA`, `VENDEDOR`, `V_TELEFONO`, `ESTADO`) VALUES('$p_id_proveedor','$p_razon','$p_id_documento','$p_numero','$p_direccion','$p_telefono','$p_email','$p_cuenta','$p_vendedor','$p_v_telefono','$p_estado')");
            return $proveedor;
        }
        function consulta_proveedor($id){
            $conexion = mainModel::conectar();
            $proveedor = $conexion->query(" SELECT * FROM `vista_proveedores` WHERE `ID_PROVEEDOR`='$id'");
            return $proveedor;
        }
        function actualizar_proveedor($p_id_proveedor,$p_razon,$p_id_documento,$p_numero,$p_direccion,$p_telefono,$p_email,$p_cuenta,$p_vendedor,$p_v_telefono,$p_estado){
            $conexion = mainModel::conectar();
            $proveedor = $conexion->query("UPDATE `proveedor` SET `RAZON`= '$p_razon',`TIPO_DOCUMENTO`= '$p_id_documento',`N_DOCUMENTO`= '$p_numero',`DIRECCION`= '$p_direccion',`TELEFONO`= '$p_telefono',`CORREO`= '$p_email',`CUENTA`= '$p_cuenta',`VENDEDOR`= '$p_vendedor',`V_TELEFONO`= '$p_v_telefono',`ESTADO`= '$p_estado' WHERE  `ID_PROVEEDOR`= '$p_id_proveedor'");
            return $proveedor;
        }
    }