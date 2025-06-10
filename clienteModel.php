<?php
    class clienteModel extends mainModel{

/* ========================================================================== */
/*                              Lista de clientes                             */
/* ========================================================================== */
        function lista_clientes(){
            $conexion = mainModel::conectar();
            $clientes = $conexion->query("SELECT c.*,d.DOCUMENTO FROM cliente as c INNER JOIN documento as d ON c.TIPO_DOCUMENTO = d.ID_DOCUMENTO");
            return $clientes;
        }
/* ========================================================================== */
/*                 Lista documentos disponibles en el sistema                 */
/* ========================================================================== */
        function lista_documentos(){
            $conexion = mainModel::conectar();
            $documentos = $conexion->query("SELECT * FROM vista_documento");
            return $documentos;
        }

/* ========================================================================== */
/*                               Guardar cliente                              */
/* ========================================================================== */
        function guardar_cliente($p_id_cliente,$p_razon,$p_tipo_documento,$p_n_documento,$p_limite_crediticio,$p_n_credito,$p_direccion,$p_telefono,$p_correo,$p_estado,$p1){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("INSERT INTO `cliente`(`ID_CLIENTE`, `RAZON`, `TIPO_DOCUMENTO`, `N_DOCUMENTO`, `LIMITE_CREDITICIO`, `N_CREDITO`, `DIRECCION`, `TELEFONO`, `CORREO`, `ESTADO`, `NOMBRE`) VALUES('$p_id_cliente','$p_razon','$p_tipo_documento','$p_n_documento','$p_limite_crediticio','$p_n_credito','$p_direccion','$p_telefono','$p_correo','$p_estado','$p1')");
            return $cliente;
        }

/* ========================================================================== */
/*                    Buscar clientes con creditos activos                    */
/* ========================================================================== */
        function buscar_cliente_credito_activo($id_cliente){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("SELECT COUNT(cr.ESTADO) as 'CREDITOS',cl.RAZON,cl.ID_CLIENTE,cl.LIMITE_CREDITICIO,cl.N_CREDITO FROM credito as cr INNER JOIN cliente as cl ON cl.ID_CLIENTE = cr.ID_CLIENTE WHERE cr.ESTADO = 1 AND cr.ID_CLIENTE = '$id_cliente'");
            return $cliente;
        }

/* ========================================================================== */
/*                            Consulta de clientes                            */
/* ========================================================================== */

        function consulta_cliente($id){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("SELECT cl.*,doc.DOCUMENTO FROM cliente as cl INNER JOIN documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO  WHERE cl.ID_CLIENTE ='$id'");
            return $cliente;
        }

/* ========================================================================== */
/*                             Actualizar clientes                            */
/* ========================================================================== */

        function actualizar_cliente($id,$razon,$tipo_documento,$n_documento,$limite,$creditos,$direccion,$telefono,$correo,$estado,$p1){
            $conexion = mainModel::conectar();
            $cliente = $conexion->query("UPDATE `cliente` SET `RAZON`= '$razon',`TIPO_DOCUMENTO`= '$tipo_documento',`N_DOCUMENTO`= '$n_documento',`LIMITE_CREDITICIO`= '$limite',`N_CREDITO`= '$creditos',`DIRECCION`= '$direccion',`TELEFONO`= '$telefono',`CORREO`= '$correo',`ESTADO`= '$estado',`NOMBRE`= '$p1' WHERE  `ID_CLIENTE`= '$id' ");
            return $cliente;
        }
        
    }