<?php
    class kardex extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                        Vista de principal de compras                       */
/* ========================================================================== */

        function render(){
            $this->view->lista_productos = $this->lista_productos();
            $this->view->render('kardex/index');
        }
        function general(){
           
            $this->view->render('kardex/general');
        }
        function kardexGeneral(){
            $this->view->lista_productos = $this->lista_productos();
            $this->view->render('kardex/index2');
        }

/* ========================================================================== */
/*                             Lista de productos                             */
/* ========================================================================== */
        function lista_productos(){
            $productos = "";
            $lista_productos = $this->model->lista_productos();
            if($lista_productos){
                foreach($lista_productos as $producto){
                    $productos .= "
                        <option value='{$producto["ID_PRODUCTO"]}'>{$producto["BARRA"]} | {$producto["ARTICULO"]} | {$producto["LINEA"]} | {$producto["NOMBRE"]}</option>
                    "; 
                }
                return $productos;
            }
        }

/* ========================================================================== */
/*              Lista de entrada y salidas de stock por producto              */
/* ========================================================================== */
        function lista_entrada_salida_stock_producto(){
            if(isset($_POST["producto"])){
                $producto = $_POST["producto"];
                $sucursal = $_POST["sucursal"];
                $kardex = $this->model->lista_kardex_producto($producto,$sucursal);
                if($kardex){
                    $lista_kardex = "";
                    $n = 1;
                    foreach($kardex as $k){
                        $movimiento = $k["MOVIMIENTO"];
                        if($movimiento==1){
                            $movimiento = "<span class='badge badge-info'> SALIDA </span>";
                        }else{
                            $movimiento = "<span class='badge badge-success'> ENTRADA </span>";
                        }
                        $imagen = SERVERURL."archives/assets/productos/{$k["IMAGEN"]}";
                        $lista_kardex .= "
                            <tr>
                                <td>{$k["ID_KARDEX"]}</td>
                                <td>{$k["FECHA"]}</td>
                                <td style='color: #1b55e2;font-weight: 600;'>{$k["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>{$k["ARTICULO"]}</td>
                                <td>{$k["LOTE"]}</td>
                                <td class='text-center'>{$movimiento}</td>
                                <td class='text-center' style='color: #8dbf42;font-weight: 700;'>{$k["ENTRADAS"]}</td>
                                <td class='text-center' style='color: #e7515a;font-weight: 700;'>{$k["SALIDAS"]}</td>
                                <td class='text-center' >{$k["PRECIO_MOVIMIENTO"]}</td>
                                <td class='text-center'style='color: #1b55e2;font-weight: 700;'>{$k["STOCK_LOTE"]}</td>
                                <td class='text-center'style='color: #e2a03f;font-weight: 700;'>{$k["STOCK_GLOBAL"]}</td>
                                <td>{$k["DETALLE"]}</td>
                            </tr>
                        "; 
                        $n++;
                    }
                    echo $lista_kardex;
                }else{
                    echo 0;
                }
            }
        }
        function lista_entrada_salida_stock_producto_2(){
            if(isset($_POST["producto"])){
                $producto = $_POST["producto"];
                $sucursal = $_POST["sucursal"];
                $kardex = $this->model->lista_kardex_producto_ID($producto);
                if($producto=='all'){
                    $kardex = $this->model->lista_kardex_producto_all();

                }
                if($kardex){
                    $lista_kardex = "";
                    $n = 1;
                    foreach($kardex as $k){
                        
                       if($k['STOCK']>0){
                        $imagen = SERVERURL."archives/assets/productos/{$k["IMAGEN"]}";
                        $lista_kardex .= "
                            <tr>
                                <td>{$n}</td>
                                <td style='color: #1b55e2;font-weight: 600;'>{$k["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>{$k["ARTICULO"]}</td>
                                <td>{$k["LOTE"]}</td>
                               
                                <td class='text-center' >{$k["PRECIO_VENTA_4"]}</td>
                                <td class='text-center'style='color: #1b55e2;font-weight: 700;'>{$k["STOCK"]}</td>
                             
                                <td>{$k["ALMACEN"]}</td>
                                <td>{$k["SUCURSAL"]}</td>
                            </tr>
                        "; 
                        $n++;
                       }
                    }
                    echo $lista_kardex;
                }else{
                    echo 0;
                }
            }
        }
        function kardexvalorizado(){
            $this->view->lista_productos = $this->lista_productos();
            $this->view->render('kardex/kardexvalorizado');
        }
        function kardex_valorizado_producto(){
            if(isset($_POST["id_sucursal"])){
                $productos = $this->model->lista_kardex_valorizado_sucursal($_POST["id_sucursal"]);
                if($productos){
                    $n = 1;
                    $tabla = "";
                    if($productos->rowCount()>0){
                        foreach($productos as $rows){
                            if($rows["ID_ITEM"] != null){
                                $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                $precio_costo = floatval($rows["PRECIO_COSTO"]);
                                $precio_venta_4 = floatval($rows["PRECIO_VENTA_4"]);
                                $cantidad = floatval($rows["STOCK"]);
                                $total_venta = floatval($cantidad*$precio_venta_4);
                                $total_costo = floatval($cantidad*$precio_costo);
                                $ganancia =floatval($total_venta - $total_costo);
                                $tabla .="
                                     <tr>
                                        <td>{$n}</td>
                                        <td class='user-name' style='font-weight: 600;color: #ffa42a;'>{$rows["BARRA"]}</td>
                                        <td class='>
                                            <a class='profile-img' href='javascript: void(0);'>
                                                <img src='{$imagen}' alt='product' style='width: 80px;'>
                                            </a>
                                        </td>
                                        <td>{$rows["ARTICULO"]}</td>
                                        <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                        <td>{$rows["LINEA"]}</td>
                                        <td >{$rows["PRESENTACION"]}</td>
                                        <td style='font-weight: 600;color: #28a745;'>{$rows["LOTE"]}</td>
                                        <td>{$cantidad}</td>
                                        <td>{$rows["PRECIO_COSTO"]}</td>
                                        <td>{$rows["PRECIO_VENTA_4"]}</td>
                                        <td>{$rows["TOTAL_VENTA"]}</td>
                                        <td>{$rows["TOTAL_COMPRA"]}</td>
                                        <td>{$rows["GANANCIA"]}</td>
                                        
                                    </tr>
                                ";
                                $n++;
                            }
                        }
                        echo $tabla;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function valorizadoporfecha(){
            $this->view->lista_vendedores = $this->lista_personas_option();
            $this->view->render('kardex/valorizadoxfecha');
        }
        function lista_personas_option(){
            $personas = $this->model->lista_personas();
            if($personas){
                if($personas->rowCount()>0){
                    $option = "";
                    foreach($personas as $rows){
                        if($rows["ESTADO"] != 0){
                            $option .= "
                                    <option value='{$rows["ID_PERSONA"]}'>".strtoupper($rows["NOMBRES"])." ".strtoupper($rows["APELLIDOS"])." | {$rows["DOCUMENTO"]} {$rows["NUMERO"]}</option>
                                ";
                        }
                    }
                    return $option;
                }
            }
        }
        function kardex_valorizado_vendedor(){
            if(isset($_POST["vendedor"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                if($_POST['vendedor'] == "all"){
                    $lista_productos = $this->model->lista_kardex_valorizado_vendedor_fecha_all($_POST["vendedor"],$date_1,$date_2,$_POST["sucursal"]);
                }else{
                    $lista_productos = $this->model->lista_kardex_valorizado_vendedor_fecha($_POST["vendedor"],$date_1,$date_2,$_POST["sucursal"]);
                }
                if($lista_productos){
                    $n = 1;
                    $tabla = "";
                    if($lista_productos->rowCount()>0){
                        foreach($lista_productos as $rows){
                            if($rows["ID_ITEM"] != null){
                                $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                $precio_costo = $rows["PRECIO_COSTO_LOTE"];
                                $medida = $rows["MEDIDA"];
                                $stock_medida = 0;
                                if($medida == $rows["MEDIDA_1"]){
                                    $stock_medida = $rows["STOCK_1"];
                                }
                                if($medida == $rows["MEDIDA_2"]){
                                    $stock_medida = $rows["STOCK_2"];
                                }
                                if($medida == $rows["MEDIDA_3"]){
                                    $stock_medida = $rows["STOCK_3"];
                                }
                                if($medida == $rows["MEDIDA_4"]){
                                    $stock_medida = $rows["STOCK_4"];
                                }
                                $stock_medida = $stock_medida==0?1:$stock_medida;
                                $precio_venta_4 = $rows["PRECIO"];
                                $descuento = $rows["DESCUENTO_VENTA"];
                                $cantidad = floor($rows["VENTAS"]/$stock_medida);
                                $total_venta = (float)($cantidad*$precio_venta_4);
                                $total_costo = (float)($rows["VENTAS"]*$precio_costo);
                                $ganancia =(float)($total_venta - $total_costo-$descuento);
                                $tabla .="
                                     <tr>
                                        <td>{$n}</td>
                                        <td class='user-name' style='font-weight: 600;color: #ffa42a;'>{$rows["BARRA"]}</td>
                                        <td class='>
                                            <a class='profile-img' href='javascript: void(0);'>
                                                <img src='{$imagen}' alt='product' style='width: 80px;'>
                                            </a>
                                        </td>
                                        <td>{$rows["ARTICULO"]}</td>
                                        <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                        <td>{$rows["LINEA"]}</td>
                                        <td>{$rows["PRESENTACION"]}</td>
                                        <td>{$rows["LOTE"]}</td>
                                        <td>{$rows["STOCK_ACTUAL"]}</td>
                                        <td>{$cantidad} {$medida}</td>
                                        <td>{$precio_venta_4}</td>
                                        <td>{$total_venta}</td>
                                        <td>{$descuento}</td>
                                        <td>{$total_costo}</td>
                                        <td>{$ganancia}</td>
                                     
                                        <td>{$rows["VENDEDOR"]}</td>
                                    </tr>
                                ";
                                $n++;
                            }
                        }
                        echo $tabla;
                    }
                }
            }
        }
        function kardex_valorizado_general_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_productos = $this->model->lista_kardex_valorizado_general_fecha($date_1,$date_2,$_POST["sucursal"]);
                if($lista_productos){
                    $n = 1;
                    $tabla = "";
                    if($lista_productos->rowCount()>0){
                        foreach($lista_productos as $rows){
                            if($rows["ID_ITEM"] != null){
                                $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                $precio_costo = $rows["PRECIO_COSTO"];
                                $medida = $rows["MEDIDA"];
                                $stock_medida = 0;
                                if($medida == $rows["MEDIDA_1"]){
                                    $stock_medida = $rows["STOCK_1"];
                                }
                                if($medida == $rows["MEDIDA_2"]){
                                    $stock_medida = $rows["STOCK_2"];
                                }
                                if($medida == $rows["MEDIDA_3"]){
                                    $stock_medida = $rows["STOCK_3"];
                                }
                                if($medida == $rows["MEDIDA_4"]){
                                    $stock_medida = $rows["STOCK_4"];
                                }
                                $stock_medida = $stock_medida==0?1:$stock_medida;
                                $precio_venta_4 = $rows["PRECIO"];
                                $descuento = $rows["DESCUENTO_VENTA"];
                                $cantidad = floor($rows["VENTAS"]/$stock_medida);
                                $total_venta = (float)($cantidad*$precio_venta_4);
                                $total_costo = (float)($rows["VENTAS"]*$precio_costo);
                                $ganancia =(float)($total_venta - $total_costo-$descuento);
                                $tabla .="
                                     <tr>
                                        <td>{$n}</td>
                                        <td class='user-name' style='font-weight: 600;color: #ffa42a;'>{$rows["BARRA"]}</td>
                                        <td class='>
                                            <a class='profile-img' href='javascript: void(0);'>
                                                <img src='{$imagen}' alt='product' style='width: 80px;'>
                                            </a>
                                        </td>
                                        <td>{$rows["ARTICULO"]}</td>
                                        <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                        <td>{$rows["LINEA"]}</td>
                                        <td>{$rows["PRESENTACION"]}</td>
                                        <td>{$rows["LOTE"]}</td>
                                        <td>{$rows["STOCK_ACTUAL"]}</td>
                                        <td>{$cantidad} {$medida}</td>
                                        <td>{$rows["PRECIO"]}</td>
                                     
                                        <td>".number_format($total_venta,2)."</td>
                                      
                                        <td>{$rows["TOTAL_COMPRA"]}</td>
                                        <td>".number_format($ganancia,2)."</td>
                                     
                                        <td>{$rows["VENDEDOR"]}</td>
                                    </tr>
                                ";
                                $n++;
                            }
                        }
                        echo $tabla;
                    }
                }
            }
        }
        function kardex_general(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
  
                $lista_productos = $this->model->lista_kardex_valorizado_general($_POST["sucursal"]);
                if($lista_productos){
                    $n = 1;
                    $tabla = "";
                   
                    if($lista_productos->rowCount()>0){
                        foreach($lista_productos as $rows){
                            if($rows["ID_ITEM"] != null){
                                $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                            $precio_costo = $rows["PRECIO_COSTO"];
                            $medida = $rows["MEDIDA"];
                            $stock_medida = 0;
                            if($medida == $rows["MEDIDA_1"]){
                                $stock_medida = $rows["STOCK_1"];
                            }
                            if($medida == $rows["MEDIDA_2"]){
                                $stock_medida = $rows["STOCK_2"];
                            }
                            if($medida == $rows["MEDIDA_3"]){
                                $stock_medida = $rows["STOCK_3"];
                            }
                            if($medida == $rows["MEDIDA_4"]){
                                $stock_medida = $rows["STOCK_4"];
                            }
                            $stock_medida = $stock_medida==0?1:$stock_medida;
                            $precio_venta_4 = $rows["PRECIO"];
                            $descuento = $rows["DESCUENTO_VENTA"];
                            $cantidad = floor($rows["VENTAS"]/$stock_medida);
                            $total_venta = (float)($cantidad*$precio_venta_4);
                            $total_costo = (float)($rows["VENTAS"]*$precio_costo);
                            $ganancia =(float)($total_venta - $total_costo-$descuento);
                                $tabla .="
                                        <tr>
                                        <td>{$n}</td>
                                        <td class='user-name' style='font-weight: 600;color: #ffa42a;'>{$rows["BARRA"]}</td>
                                        <td class='>
                                            <a class='profile-img' href='javascript: void(0);'>
                                                <img src='{$imagen}' alt='product' style='width: 80px;'>
                                            </a>
                                        </td>
                                        <td>{$rows["ARTICULO"]}</td>
                                        <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                        <td>{$rows["LINEA"]}</td>
                                        <td>{$rows["PRESENTACION"]}</td>
                                        <td>{$rows["LOTE"]}</td>
                                        <td>{$rows["STOCK_ACTUAL"]}</td>
                                        <td>{$cantidad} {$medida}</td>
                                        <td>{$rows["PRECIO"]}</td>
                                        
                                        <td>".number_format($total_venta,2)."</td>
                                        
                                        <td>{$rows["TOTAL_COMPRA"]}</td>
                                        <td>".number_format($ganancia,2)."</td>
                                        
                                        <td>{$rows["VENDEDOR"]}</td>
                                    </tr>
                                ";
                                $n++;
                            }
                        }
                 
                    }
                    echo $tabla;
                    
                }
            }
        }

    }