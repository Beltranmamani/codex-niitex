<?php
    class pedidostienda extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        // View tienda
        function render(){
            $this->view->render('pedidostienda/index');
        }
        function pedidoA4($param = null){
            $id = $param[0];
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_pedido($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago==1){
                                $tipo_pago = "PAGO PENDIENTE";
                            }else if($tipo_pago==2){
                                $tipo_pago = "PAGO COMPLETADO";
                            }else if($tipo_pago==3){
                                $tipo_pago = "ENVIO PENDIENTE";
                            }else if($tipo_pago==4){
                                $tipo_pago = "EN ENVIO";
                            }else if($tipo_pago==5){
                                $tipo_pago = "ENVIO COMPLETADO";
                            }else if($tipo_pago==0){
                                $tipo_pago = "CANCELADO";                          
                            }
                            $response .= "{$row["FECHA"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["N_INVOICE"]}|{$row["SUBTOTAL"]}|{$row["TARIFA"]}|{$row["TOTAL"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente_tienda($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($id_sucursal);
                // $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->detalle_de_pedido($id);
                $this->view->render("pedidostienda/pedidoA4");
            }else{
                $this->view->render("error/404");
            }

        }
        function pedidos(){
            if(isset($_POST["token"])){
                $lista_pedidos = $this->model->lista_pedidos();
                if($lista_pedidos){
                    $table='';
                    foreach($lista_pedidos as $l){
                        $id_encryptado = mainModel::encryption($l["ID_INVOICE"]);

                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "<span class='badge badge-primary'>PAGO PENDIENTE </span>";
                        }else if($l['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>PAGO COMPLETADO </span>";
                        }else if($l['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($l['ESTADO']==4){
                            $estado = "<span class='badge badge-warning'>EN ENVIO </span>";
                        }else if($l['ESTADO']==5){
                            $estado = "<span class='badge badge-success'>ENVIO COMPLETADO </span>";
                        }else if($l['ESTADO']==0){
                            $estado = "<span class='badge badge-danger'>CANCELADO </span>";
                        }
                        $table .="
                            <tr>
                                <td>{$l['ID_INVOICE']}</td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA']}</td>
                                <td>{$l['TOTAL']}</td>
                                <td>{$l['TARIFA']}</td>
                                <td>{$l['NOMBRE']}</td>
                                <td>{$l['DIRECCION']}</td>
                                <td>{$l['PROVINCIA']}</td>
                                <td>{$l['DEPARTAMENTO']}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Pedido
                                            </a>
                                            <a class='dropdown-item btn_estado' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-clock'><circle cx='12' cy='12' r='10'></circle><polyline points='12 6 12 12 16 14'></polyline></svg>
                                                Estado Pedido
                                            </a>
                                            <a class='dropdown-item ' href='".SERVERURL."pedidostienda/pedidoA4/{$id_encryptado}' id_pedido='{$l['ID_INVOICE']}'  >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Pedido (A4)
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                    echo $table;
                }

            }
        }
        function reportepedidos(){
            if(isset($_POST["token"])){
                $lista_pedidos = $this->model->lista_pedidos_2();
                if($lista_pedidos){
                    $table='';
                    foreach($lista_pedidos as $l){
                          $id_encryptado = mainModel::encryption($l["ID_INVOICE"]);
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "<span class='badge badge-primary'>PAGO PENDIENTE </span>";
                        }else if($l['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>PAGO COMPLETADO </span>";
                        }else if($l['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($l['ESTADO']==4){
                            $estado = "<span class='badge badge-warning'>EN ENVIO </span>";
                        }else if($l['ESTADO']==5){
                            $estado = "<span class='badge badge-success'>ENVIO COMPLETADO </span>";
                        }else if($l['ESTADO']==0){
                            $estado = "<span class='badge badge-danger'>CANCELADO </span>";
                        }
                        $table .="
                            <tr>
                                <td>{$l['ID_INVOICE']}</td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA']}</td>
                                <td>{$l['TOTAL']}</td>
                                <td>{$l['TARIFA']}</td>
                                <td>{$l['NOMBRE']}</td>
                                <td>{$l['DIRECCION']}</td>
                                <td>{$l['PROVINCIA']}</td>
                                <td>{$l['DEPARTAMENTO']}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Pedido
                                            </a>
                                            <a class='dropdown-item ' href='".SERVERURL."pedidostienda/pedidoA4/{$id_encryptado}'id_pedido='{$l['ID_INVOICE']}'  >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Pedido (A4)
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                    echo $table;
                }

            }
        }
        function pedidosestadousuario(){
            if(isset($_POST["token"])){
                date_default_timezone_set(ZONEDATE);
                $year = date("Y");
                $mes = date("m");
                $lista_pedidos = $this->model->lista_pedidos_estado_usuario($_POST["usuario"],$_POST["estado"]);
                if($lista_pedidos){
                    $table='';
                    foreach($lista_pedidos as $l){
                          $id_encryptado = mainModel::encryption($l["ID_INVOICE"]);
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "<span class='badge badge-primary'>PAGO PENDIENTE </span>";
                        }else if($l['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>PAGO COMPLETADO </span>";
                        }else if($l['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($l['ESTADO']==4){
                            $estado = "<span class='badge badge-warning'>EN ENVIO </span>";
                        }else if($l['ESTADO']==5){
                            $estado = "<span class='badge badge-success'>ENVIO COMPLETADO </span>";
                        }else if($l['ESTADO']==0){
                            $estado = "<span class='badge badge-danger'>CANCELADO </span>";
                        }
                        $table .="
                            <tr>
                                <td>{$l['ID_INVOICE']}</td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA']}</td>
                                <td>{$l['TOTAL']}</td>
                                <td>{$l['TARIFA']}</td>
                                <td>{$l['NOMBRE']}</td>
                                <td>{$l['DIRECCION']}</td>
                                <td>{$l['PROVINCIA']}</td>
                                <td>{$l['DEPARTAMENTO']}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Pedido
                                            </a>
                                            <a class='dropdown-item btn_estado' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-clock'><circle cx='12' cy='12' r='10'></circle><polyline points='12 6 12 12 16 14'></polyline></svg>
                                                Estado Pedido
                                            </a>
                                        <a class='dropdown-item ' target='_blank' href='".SERVERURL."pedidostienda/pedidoA4/{$id_encryptado}' >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Pedido (A4)
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                    echo $table;
                }else{
                    echo 1;
                }

            }
        }
        function pedidosestadousuario_fecha(){
            if(isset($_POST["fecha_1"])){
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_pedidos = $this->model->lista_pedidos_estado_usuario_fecha($_POST["usuario"],$_POST["estado"],$date_1,$date_2);
                if($lista_pedidos){
                    $table='';
                    foreach($lista_pedidos as $l){
                          $id_encryptado = mainModel::encryption($l["ID_INVOICE"]);
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "<span class='badge badge-primary'>PAGO PENDIENTE </span>";
                        }else if($l['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>PAGO COMPLETADO </span>";
                        }else if($l['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($l['ESTADO']==4){
                            $estado = "<span class='badge badge-warning'>EN ENVIO </span>";
                        }else if($l['ESTADO']==5){
                            $estado = "<span class='badge badge-success'>ENVIO COMPLETADO </span>";
                        }else if($l['ESTADO']==0){
                            $estado = "<span class='badge badge-danger'>CANCELADO </span>";
                        } 
                        
                        $table .="
                            <tr>
                                <td>{$l['ID_INVOICE']}</td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA']}</td>
                                <td>{$l['TOTAL']}</td>
                                <td>{$l['TARIFA']}</td>
                                <td>{$l['NOMBRE']}</td>
                                <td>{$l['DIRECCION']}</td>
                                <td>{$l['PROVINCIA']}</td>
                                <td>{$l['DEPARTAMENTO']}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Pedido
                                            </a>
                                            <a class='dropdown-item btn_estado' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-clock'><circle cx='12' cy='12' r='10'></circle><polyline points='12 6 12 12 16 14'></polyline></svg>
                                                Estado Pedido
                                            </a>
                                        <a  class='dropdown-item ' target='_blank' href='".SERVERURL."pedidostienda/pedidoA4/{$id_encryptado}'  >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Pedido (A4)
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                    echo $table;
                }else{
                    echo 1;
                }

            }
        }
        function pedidos_fecha(){
            if(isset($_POST["fecha_1"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_pedidos = $this->model->lista_pedidos_fecha($date_1,$date_2);
                if($lista_pedidos){
                    $table='';
                    foreach($lista_pedidos as $l){
                          $id_encryptado = mainModel::encryption($l["ID_INVOICE"]);
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "<span class='badge badge-primary'>PAGO PENDIENTE </span>";
                        }else if($l['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>PAGO COMPLETADO </span>";
                        }else if($l['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($l['ESTADO']==4){
                            $estado = "<span class='badge badge-warning'>EN ENVIO </span>";
                        }else if($l['ESTADO']==5){
                            $estado = "<span class='badge badge-success'>ENVIO COMPLETADO </span>";
                        }else if($l['ESTADO']==0){
                            $estado = "<span class='badge badge-danger'>CANCELADO </span>";
                        }
                        $table .="
                            <tr>
                                <td>{$l['ID_INVOICE']}</td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA']}</td>
                                <td>{$l['TOTAL']}</td>
                                <td>{$l['TARIFA']}</td>
                                <td>{$l['NOMBRE']}</td>
                                <td>{$l['DIRECCION']}</td>
                                <td>{$l['PROVINCIA']}</td>
                                <td>{$l['DEPARTAMENTO']}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle'  href='#' id_pedido='{$l['ID_INVOICE']}' >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Pedido
                                            </a>
                                             <a class='dropdown-item btn_estado' id_pedido='{$l['ID_INVOICE']}' target='_blank'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-clock'><circle cx='12' cy='12' r='10'></circle><polyline points='12 6 12 12 16 14'></polyline></svg>
                                                Estado Pedido
                                            </a>
                                            <a class='dropdown-item ' target='_blank' href='".SERVERURL."pedidostienda/pedidoA4/{$id_encryptado}' id_pedido='{$l['ID_INVOICE']}' >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Pedido (A4)
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                    echo $table;
                }

            }
        }
        function reportepedidos_fecha(){
            if(isset($_POST["fecha_1"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_pedidos = $this->model->lista_pedidos_fecha_2($date_1,$date_2);
                if($lista_pedidos){
                    $table='';
                    foreach($lista_pedidos as $l){
                          $id_encryptado = mainModel::encryption($l["ID_INVOICE"]);
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "<span class='badge badge-primary'>PAGO PENDIENTE </span>";
                        }else if($l['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>PAGO COMPLETADO </span>";
                        }else if($l['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($l['ESTADO']==4){
                            $estado = "<span class='badge badge-warning'>EN ENVIO </span>";
                        }else if($l['ESTADO']==5){
                            $estado = "<span class='badge badge-success'>ENVIO COMPLETADO </span>";
                        }else if($l['ESTADO']==0){
                            $estado = "<span class='badge badge-danger'>CANCELADO </span>";
                        }
                        $table .="
                            <tr>
                                <td>{$l['ID_INVOICE']}</td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA']}</td>
                                <td>{$l['TOTAL']}</td>
                                <td>{$l['TARIFA']}</td>
                                <td>{$l['NOMBRE']}</td>
                                <td>{$l['DIRECCION']}</td>
                                <td>{$l['PROVINCIA']}</td>
                                <td>{$l['DEPARTAMENTO']}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle'  href='#' id_pedido='{$l['ID_INVOICE']}' >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Pedido
                                            </a>
                                        <a  class='dropdown-item ' href='".SERVERURL."pedidostienda/pedidoA4/{$id_encryptado}' target='_blank' id_pedido='{$l['ID_INVOICE']}'  href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Pedido (A4)
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                    echo $table;
                }

            }
        }
        function detalle_pedido(){
            if(isset($_POST['id_pedido'])){
                $busqueda = $this->model->busqueda_pedido($_POST["id_pedido"]);
                if($busqueda){
                    $response  = "";
                    if($busqueda->rowCount()>0){
                        foreach($busqueda as $row){
                            $estado = "";
                                if($row['ESTADO']==1){
                                    $estado = "PAGO PENDIENTE";
                                }else if($row['ESTADO']==2){
                                    $estado = "PAGO COMPLETADO";
                                }else if($row['ESTADO']==3){
                                    $estado = "ENVIO PENDIENTE";
                                }else if($row['ESTADO']==4){
                                    $estado = "EN ENVIO";
                                }else if($row['ESTADO']==5){
                                    $estado = "ENVIO COMPLETADO";
                                }else if($row['ESTADO']==0){
                                    $estado = "CANCELADO";
                                }
                                $precio = number_format($row["TARIFA"],2);
                            $response .= "{$row["ID_INVOICE"]}|{$row["FECHA"]}|{$estado}|{$row["NOMBRE"]}|{$row["TOTAL"]}|{$row["DIRECCION"]}|{$row["PROVINCIA"]}|{$row["DEPARTAMENTO"]}|{$precio}"; 
                        }
                        echo "1|$response";
                    }
                }else{
                    echo 0;
                }
            }
        }
        function items_pedido_modal(){
            if(isset($_POST["id_pedido"])){
                $lista_pedido = $this->model->detalle_de_pedido($_POST["id_pedido"]);
                if($lista_pedido){
                    $table = "";
                    foreach($lista_pedido as $p){
                        $subtotal = floatval($p["PRECIO"]) * floatval($p["CANTIDAD"]);
                        $table.= "<tr>
                                    <td>{$p["BARRA"]}</td>
                                    <td>{$p["ARTICULO"]}</td>
                                    <td>{$p["LINEA"]}</td>
                                    <td>{$p["PRECIO"]}</td>
                                    <td>{$p["CANTIDAD"]}</td>
                                    <td>".number_format($subtotal,2)."</td>
                                </tr>
                                ";
                    }
                    echo $table;
                }
            }
        }
        function estado_pedido(){
            if(isset($_POST["id_pedido"])){
                $busqueda = $this->model->busqueda_pedido($_POST["id_pedido"]);
                if($busqueda){
                    $option = "";
                    foreach($busqueda as $p){
                        $estado = "";
                        if($p['ESTADO']==1){
                            $option = "
                                <option value='1'>PAGO PENDIENTE</option>
                                <option value='2'>PAGO COMPLETADO</option>
                                <option value='3' disabled>ENVIO PENDIENTE</option>
                                <option value='4' disabled>EN ENVIO</option>
                                <option value='5' disabled>ENVIO COMPLETADO</option>
                                <option value='0' disabled>CANCELADO</option>
                            ";
                        }else if($p['ESTADO']==2){
                            $option = "
                                <option value='1' disabled>PAGO PENDIENTE</option>
                                <option value='2'>PAGO COMPLETADO</option>
                                <option value='3' >ENVIO PENDIENTE</option>
                                <option value='4' disabled>EN ENVIO</option>
                                <option value='5' disabled>ENVIO COMPLETADO</option>
                                <option value='0' disabled>CANCELADO</option>
                            ";
                        }else if($p['ESTADO']==3){
                            $option = "
                                <option value='1' disabled>PAGO PENDIENTE</option>
                                <option value='2' disabled>PAGO COMPLETADO</option>
                                <option value='3' >ENVIO PENDIENTE</option>
                                <option value='4' >EN ENVIO</option>
                                <option value='5' disabled>ENVIO COMPLETADO</option>
                                <option value='0'>CANCELADO</option>
                            ";
                        }else if($p['ESTADO']==4){
                            $option = "
                                <option value='1' disabled>PAGO PENDIENTE</option>
                                <option value='2' disabled>PAGO COMPLETADO</option>
                                <option value='3' disabled>ENVIO PENDIENTE</option>
                                <option value='4' >EN ENVIO</option>
                                <option value='5' >ENVIO COMPLETADO</option>
                                <option value='0' >CANCELADO</option>
                            ";
                        }else if($p['ESTADO']==5){
                            $option = "
                                <option value='1' disabled>PAGO PENDIENTE</option>
                                <option value='2' disabled>PAGO COMPLETADO</option>
                                <option value='3' disabled>ENVIO PENDIENTE</option>
                                <option value='4' disabled>EN ENVIO</option>
                                <option value='5' >ENVIO COMPLETADO</option>
                                <option value='0' >CANCELADO</option>
                            ";
                        }else if($p['ESTADO']==0){
                            $option = "
                                <option value='1' disabled>PAGO PENDIENTE</option>
                                <option value='2' disabled>PAGO COMPLETADO</option>
                                <option value='3' disabled>ENVIO PENDIENTE</option>
                                <option value='4' disabled>EN ENVIO</option>
                                <option value='5' disabled>ENVIO COMPLETADO</option>
                                <option value='0' disabled selected='selected'>CANCELADO</option>
                            ";
                        }
                    }
                    echo $option;
                }
            }
        }
        function generar_codigo_seguimiento_invoice(){
            $cn = mainModel::conectar();
            $numero = $this->model->seguimiento_invoice();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('SEG',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
        function generar_codigo_entradas(){
            $numero = $this->model->Lista_de_kardex();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('KARDEX',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
        
        function cambiar_estado_pedido(){
            if(isset($_POST["id_pedido"])){
                date_default_timezone_set(ZONEDATE);
                $date = date('Y-m-d H:i:s');
                $actualizar = $this->model->actualizar_pedido_estado($_POST["id_pedido"],$_POST["estado"]);
                if($actualizar){
                    if($_POST["estado"]==2){
                        $id = $this->generar_codigo_invoice_usuario();
                        $agregar = $this->model->agregar_pedido_usuario($id,$_POST["id_pedido"],$_POST["usuario"],$date);
                        if($agregar){
                            $lista_producto = $this->model->detalle_de_pedido($_POST["id_pedido"]);
                            if($lista_producto){
                                foreach($lista_producto as $l){
                                    $id = $this->generar_codigo_seguimiento_invoice();
                                    $quitar_stock = $this->model->restar_cantidad_item($l['ID_ITEM'],$l['CANTIDAD']);
                                    if($quitar_stock){
                                        $parametros_items_lote = mainModel::parametros_item_lote($l['ID_ITEM']);
                                        $id_producto = $parametros_items_lote["ID_PRODUCTO"];
                                        $precio_costo = $parametros_items_lote["PRECIO_VENTA_4"];
                                        $stock = $parametros_items_lote["CANTIDAD"];
                                        $tienda = mainModel::parametros_tienda();
                                        $id_sucursal = $tienda["ID_SUCURSAL"];
                                        $stock_global_entrada = mainModel::stock_global_producto($id_producto,$id_sucursal);
                                        
                                        $p_id_entrada = $this->generar_codigo_entradas();
                                        $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$id_sucursal,$_POST["usuario"],$l['ID_ITEM'],$l['CANTIDAD']*$precio_costo,$date,1,0,$l['CANTIDAD'],$stock,$stock_global_entrada,"POR PEDIDO #{$_POST['id_pedido']}",NULL);
                                        if(!$guardar_kardex_entrada){
                                            echo 5;
                                        }
                                        $agregar_invoice = $this->model->agregar_seguimiento_invoice($id,$_POST["id_pedido"],$l['ID_ITEM'],$l['CANTIDAD'],$p_id_entrada);
                                    }else{
                                        echo 0;
                                    }

                                }
                                echo 1;
                            }
                        }else{
                            echo 0;
                        }
                    }else if($_POST["estado"]==0){
                        $seguimiento = $this->model->seguimiento_pedido_detalle($_POST["id_pedido"]);
                        if($seguimiento){
                            if($seguimiento->rowCount()>0){
                                foreach($seguimiento as $seg){
                                    $sumar = $this->model->sumar_cantidad_item($seg["ID_ITEM"],$seg["ID_CANTIDAD"]);
                                    if($sumar){
                                        $kardex_entrada = $this->model->eliminar_kardex($seg["ID_KARDEX"]);
                                    }
                                }
                            }
                            echo 1;
                        }
                    }else{
                        echo 1;
                    }
                    $id_notificar = $this->generar_codigo_invoice_usuario_notificacion();
                    $agregar_notificacion = $this->model->agregar_notificacion_pedido_usuario($id_notificar,'ha actualizado el estado de su pedido  ',$_POST["id_pedido"],$_POST["usuario"],$_POST["estado"],$date);
                    
                }else{
                    echo 0;
                }
            }
        }
        function generar_codigo_invoice_usuario(){
            $cn = mainModel::conectar();
            $numero = $this->model->invoice_usuario();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('INV',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
        function generar_codigo_invoice_usuario_notificacion(){
            $cn = mainModel::conectar();
            $numero = $this->model->invoice_usuario_notificacion();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('NOTI',6,$numero);
                $numero = $numero+1;
                return $numero;
            }else{
                return 0;
            }
        }
        function dashboard(){
            $this->view->tienda = mainModel::parametros_tienda();
            $this->view->render('pedidostienda/dashboard');
        }
        public function consulta_pedido_mensual()
        {
            if (isset($_POST["sucursal"])) {
                date_default_timezone_set(ZONEDATE);
                $year = date("Y");
                $total_ventas = $this->model->pedidos_totales_mensuales($year);
                if ($total_ventas) {
                    $mes_1 = 0;
                    $mes_2 = 0;
                    $mes_3 = 0;
                    $mes_4 = 0;
                    $mes_5 = 0;
                    $mes_6 = 0;
                    $mes_7 = 0;
                    $mes_8 = 0;
                    $mes_9 = 0;
                    $mes_10 = 0;
                    $mes_11 = 0;
                    $mes_12 = 0;
                    foreach ($total_ventas as $v) {
                        if ($v["MES"] == 1) {
                            $mes_1 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 2) {
                            $mes_2 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 3) {
                            $mes_3 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 4) {
                            $mes_4 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 5) {
                            $mes_5 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 6) {
                            $mes_6 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 7) {
                            $mes_7 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 8) {
                            $mes_8 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 9) {
                            $mes_9 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 10) {
                            $mes_10 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 11) {
                            $mes_11 = $v["TOTAL_PEDIDO"];
                        } else if ($v["MES"] == 12) {
                            $mes_12 = $v["TOTAL_PEDIDO"];
                        }
                    }
                    $array = array(
                        "mes_1" => (int)$mes_1,
                        "mes_2" => (int)$mes_2,
                        "mes_3" => (int)$mes_3,
                        "mes_4" => (int)$mes_4,
                        "mes_5" => (int)$mes_5,
                        "mes_6" => (int)$mes_6,
                        "mes_7" => (int)$mes_7,
                        "mes_8" => (int)$mes_8,
                        "mes_9" => (int)$mes_9,
                        "mes_10" => (int)$mes_10,
                        "mes_11" => (int)$mes_11,
                        "mes_12" => (int)$mes_12
                    );
                    echo json_encode($array);
                }
            }
        }
        public function total_estados_pedido_mensual()
        {
            if (isset($_POST["sucursal"])) {
                date_default_timezone_set(ZONEDATE);
                $year = date("Y");
                $pedido_pendiente = $this->model->pedidos_totales_mensuales_estado($year,1);
                $pedido_pendiente = $pedido_pendiente->rowCount()>0 ? $pedido_pendiente->fetchColumn() : 0;
                $pedido_envio_pendiente = $this->model->pedidos_totales_mensuales_estado($year,3);
                $pedido_envio_pendiente = $pedido_envio_pendiente->rowCount()>0 ? $pedido_envio_pendiente->fetchColumn() : 0;
                $pedido_completado = $this->model->pedidos_totales_mensuales_estado($year,5);
                $pedido_completado = $pedido_completado->rowCount()>0 ? $pedido_completado->fetchColumn() : 0;
                $pedido_anulado = $this->model->pedidos_totales_mensuales_estado($year,0);
                $pedido_anulado = $pedido_anulado->rowCount()>0 ? $pedido_anulado->fetchColumn() : 0;
                echo $pedido_pendiente."|".$pedido_envio_pendiente."|".$pedido_completado."|".$pedido_anulado;
            }
        }
        function pedidosconpagoscompletados(){
            $this->view->render('pedidostienda/pagoscompletados');
        }
        function pedidosenviospendientes(){
            $this->view->render('pedidostienda/enviospendientes');
        }
        function pedidosenenvio(){
            $this->view->render('pedidostienda/enenvio');
        }
        function pedidosenviados(){
            $this->view->render('pedidostienda/enviocompletado');
        }
        function pedidosanulados(){
            $this->view->render('pedidostienda/pedidosanulados');
        }
        function estado_productos(){
            $this->view->render('pedidostienda/estado_productos');
        }
        function reporte_pedidos(){
            $this->view->render('pedidostienda/reporte_pedidos');
        }
        public function consulta_pedido_presentacion_mensual()
        {
            if (isset($_POST["sucursal"])) {
                date_default_timezone_set(ZONEDATE);
                $year = date("Y");
                $mes = date("m");
                
                $consulta = $this->model->consulta_pedido_presentacion_mensual($year, $mes);
                if ($consulta) {
                    $n = 1;
                    $pre_1 = 0;
                    $pre_1_name = "PRESENTACION 1";
                    $pre_2 = 0;
                    $pre_2_name = "PRESENTACION 2";
                    $pre_3 = 0;
                    $pre_3_name = "OTROS";
                    foreach ($consulta as $c) {
                        if ($n == 1) {
                            $pre_1 = $c["TOTAL"];
                            $pre_1_name = $c["PRESENTACION"];
                        } else if ($n == 2) {
                            $pre_2 = $c["TOTAL"];
                            $pre_2_name = $c["PRESENTACION"];
                        } else {
                            $pre_3 += $c["TOTAL"];
                        }
                        $n++;
                    }
                    $array = array(
                        "total_1" => number_format($pre_1),
                        "nombre_1" => $pre_1_name,
                        "total_2" => number_format($pre_2),
                        "nombre_2" => $pre_2_name,
                        "total_3" => number_format($pre_3),
                        "nombre_3" => $pre_3_name,
                    );
                    echo json_encode($array);
                }
            }
        }
        function estado_productos_pedido(){
            if(isset($_POST["token"])){
                $productos = $this->model->estado_productos_pedidos();
                if($productos){
                    $tabla = "";
                    foreach($productos as $rows){
                        $estado = "";
                        if($rows['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>APARTADO </span>";
                        }else if($rows['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($rows['ESTADO']==4){
                            $estado = "<span class='badge badge-secondary'>EN ENVIO </span>";
                        }
                        $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                        $tabla .="
                             <tr>
                                <td>{$rows["FECHA"]}</td>
                                <td class='user-name'>{$rows["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>{$rows["ARTICULO"]}</td>
                                <td>{$rows["LINEA"]}</td>
                                <td>{$rows["CANTIDAD"]}</td>
                                <td>{$rows["ID_INVOICE"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["PROVINCIA"]}, {$rows["DEPARTAMENTO"]}</td>
                                <td>{$rows["NOMBRE"]}</td>
                                <td>{$rows["DOCUMENTO"]}: {$rows["N_DOCUMENTO"]}</td>
                                <td>{$estado}</td>
                                
                            </tr>
                        ";  
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }
        function estado_productos_pedido_fecha(){
            if(isset($_POST["fecha_1"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $productos = $this->model->estado_productos_pedidos_fecha($date_1,$date_2);
                if($productos){
                    $tabla = "";
                    foreach($productos as $rows){
                        $estado = "";
                        if($rows['ESTADO']==2){
                            $estado = "<span class='badge badge-info'>APARTADO </span>";
                        }else if($rows['ESTADO']==3){
                            $estado = "<span class='badge badge-warning'>ENVIO PENDIENTE </span>";
                        }else if($rows['ESTADO']==4){
                            $estado = "<span class='badge badge-secondary'>EN ENVIO </span>";
                        }
                        $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                        $tabla .="
                             <tr>
                                <td>{$rows["FECHA"]}</td>
                                <td class='user-name'>{$rows["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>{$rows["ARTICULO"]}</td>
                                <td>{$rows["LINEA"]}</td>
                                <td>{$rows["CANTIDAD"]}</td>
                                <td>{$rows["ID_INVOICE"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["PROVINCIA"]}, {$rows["DEPARTAMENTO"]}</td>
                                <td>{$rows["NOMBRE"]}</td>
                                <td>{$rows["DOCUMENTO"]}: {$rows["N_DOCUMENTO"]}</td>
                                <td>{$estado}</td>
                                
                            </tr>
                        ";  
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }
        function valor_pedidos_usuario(){
            if(isset($_POST["usuario"])){
                date_default_timezone_set(ZONEDATE);
                $year = date("Y"); 
                $mes = date("m");
                $v_p_a = 0;
                $valor_pedidos_activos = $this->model->total_pedidos_activos($year,$mes);
                if($valor_pedidos_activos){
                    if($valor_pedidos_activos->rowCount()>0){
                        foreach($valor_pedidos_activos as $v){
                            $v_p_a = $v["TOTAL"];
                        }
                    }
                }
                $v_p_u = 0;
                $valor_pedidos_usuario = $this->model->total_pedidos_usuario_activos($year,$mes,$_POST["usuario"]); 
                if($valor_pedidos_usuario){
                    if($valor_pedidos_usuario->rowCount()>0){
                        foreach($valor_pedidos_usuario as $v){
                            $v_p_u = $v["TOTAL"];
                        }
                    }
                }
                $v_p_anulados = 0;
                $valor_pedidos_usuario_anulados = $this->model->total_pedidos_usuario_anulados($year,$mes,$_POST["usuario"]); 
                if($valor_pedidos_usuario_anulados){
                    if($valor_pedidos_usuario_anulados->rowCount()>0){
                        foreach($valor_pedidos_usuario_anulados as $v){
                            $v_p_anulados = $v["TOTAL"];
                        }
                    }
                }
                if(empty($v_p_anulados)){
                    $v_p_anulados = 0;
                }
                if(empty($v_p_u)){
                    $v_p_u = 0;
                }
                if(empty($v_p_a)){
                    $v_p_a = 0;
                }
                echo "{$v_p_a}|{$v_p_u}|{$v_p_anulados}";
            }
        }
        function lista_activadades_recientes(){
            if(isset($_POST["token"])){
               $actividades = $this->model->lista_ultimas_actividades();
               if($actividades){
                $lista = "";
                foreach($actividades as $a){
                    $estado = "";
                        if($a['ESTADO']==1){
                            $estado = array(
                                "estado" => $a['ESTADO'],
                                "detalle" => "PEDIDO EN PAGO PENDIENTE ",
                                "color" => 'dark',
                                "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg>"
                            );
                        }else if($a['ESTADO']==2){
                            $estado = array(
                                "estado" => $a['ESTADO'],
                                "detalle" => "PEDIDO CON PAGO COMPLETADO ",
                                "color" => 'primary',
                                "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg>"
                            );
                        }else if($a['ESTADO']==3){
                            $estado = array(
                                "estado" => $a['ESTADO'],
                                "detalle" => "PEDIDO EN ENVIO PENDIENTE ",
                                "color" => 'warning',
                                "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-truck'><rect x='1' y='3' width='15' height='13'></rect><polygon points='16 8 20 8 23 11 23 16 16 16 16 8'></polygon><circle cx='5.5' cy='18.5' r='2.5'></circle><circle cx='18.5' cy='18.5' r='2.5'></circle></svg>"
                            );
                        }else if($a['ESTADO']==4){
                            $estado = array(
                                "estado" => $a['ESTADO'],
                                "detalle" => "PEDIDO EN ENVIO ",
                                "color" => 'envio',
                                "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-truck'><rect x='1' y='3' width='15' height='13'></rect><polygon points='16 8 20 8 23 11 23 16 16 16 16 8'></polygon><circle cx='5.5' cy='18.5' r='2.5'></circle><circle cx='18.5' cy='18.5' r='2.5'></circle></svg>"
                            );
                        }else if($a['ESTADO']==5){
                            $estado = array(
                                "estado" => $a['ESTADO'],
                                "detalle" => "PEDIDO CON ENVIO COMPLETADO ",
                                "color" => 'success',
                                "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-truck'><rect x='1' y='3' width='15' height='13'></rect><polygon points='16 8 20 8 23 11 23 16 16 16 16 8'></polygon><circle cx='5.5' cy='18.5' r='2.5'></circle><circle cx='18.5' cy='18.5' r='2.5'></circle></svg>"
                            );
                        }else if($a['ESTADO']==0){
                            $estado = array(
                                "estado" => $a['ESTADO'],
                                "detalle" => "PEDIDO ANULADO ",
                                "color" => 'danger',
                                "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>"
                            );
                        }
                        setlocale(LC_TIME, 'es_ES');
                        date_default_timezone_set(ZONEDATE);
                        $nro_mes = date("m",strtotime($a['FECHA']));
                        $nro_year = date("Y",strtotime($a['FECHA']));
                        $nro_dia = date("d",strtotime($a['FECHA']));
                        $hora = date("H:i:s",strtotime($a['FECHA']));
                        $fecha = DateTime::createFromFormat('!m', $nro_mes);
                        $mes = strftime("%B", $fecha->getTimestamp());
                    $lista .= "
                    <div class='item-timeline timeline-new'>
                        <div class='t-dot' data-original-title='' title=''>
                            <div class='t-{$estado['color']}'>
                                {$estado['icon']}
                            </div>
                        </div>
                        <div class='t-content'>
                            <div class='t-uppercontent'>
                                <h5>{$estado['detalle']}</h5>
                                <span class=''>{$nro_dia} ".ucwords($mes).", {$nro_year} {$hora}</span>
                            </div>
                            <p><span>El usuario {$a['VENDEDOR']}</span> actualizo el estado del {$a['ID_INVOICE']}</p>
                            <div class='tags'>
                                <div class='badge badge-primary'>CLIENTE :{$a['CLIENTE']}</div>
                                <div class='badge badge-success'>FECHA :{$a['FECHA_PEDIDO']}</div>
                                <div class='badge badge-warning'>TOTAL :{$a['TOTAL']}</div>
                            </div>
                        </div>
                    </div>";
                }
                echo $lista;
               }
            }
        }
    }