<?php
class dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

/* ========================================================================== */
/*                               Vista principal                              */
/* ========================================================================== */

    public function render()
    {
        $this->view->render('dashboard/index');
    }

/* ========================================================================== */
/*                        Consulta de ventas mensuales                        */
/* ========================================================================== */

    public function consulta_venta_mensual()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $year = date("Y");
            $total_ventas = $this->model->ventas_totales_mensuales($_POST["sucursal"], $year);
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
                        $mes_1 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 2) {
                        $mes_2 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 3) {
                        $mes_3 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 4) {
                        $mes_4 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 5) {
                        $mes_5 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 6) {
                        $mes_6 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 7) {
                        $mes_7 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 8) {
                        $mes_8 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 9) {
                        $mes_9 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 10) {
                        $mes_10 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 11) {
                        $mes_11 = $v["TOTAL_VENTAS"];
                    } else if ($v["MES"] == 12) {
                        $mes_12 = $v["TOTAL_VENTAS"];
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

/* ========================================================================== */
/*                        Consulta de compras mensuales                       */
/* ========================================================================== */

    public function consulta_compras_mensual()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $year = date("Y");
            $compras_mesuales = $this->model->compras_totales_mensuales($_POST["sucursal"], $year);
            if ($compras_mesuales) {
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
                foreach ($compras_mesuales as $c) {
                    if ($c["MES"] == 1) {
                        $mes_1 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 2) {
                        $mes_2 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 3) {
                        $mes_3 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 4) {
                        $mes_4 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 5) {
                        $mes_5 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 6) {
                        $mes_6 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 7) {
                        $mes_7 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 8) {
                        $mes_8 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 9) {
                        $mes_9 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 10) {
                        $mes_10 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 11) {
                        $mes_11 = $c["TOTAL_COMPRAS"];
                    } else if ($c["MES"] == 12) {
                        $mes_12 = $c["TOTAL_COMPRAS"];
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

/* ========================================================================== */
/*                     Consulta de ventas por presentacion                    */
/* ========================================================================== */

    public function ventas_recientes()
    {
        if (isset($_POST["sucursal"])) {
            
            $consulta = $this->model->ventas_recientes($_POST["sucursal"]);
            if ($consulta) {
               $table = "";
               foreach($consulta as $c){
                   $server = SERVERURL;
                   $perfil = $server."archives/avatars/{$c['PERFIL']}";
                   $badge="<span class='badge outline-badge-success'>Vigente</span>";
                   if($c['ESTADO']==0){
                        $badge="<span class='badge outline-badge-danger'>Anulado</span>";   
                   }
                    $table.="
                        <tr>
                            <td><div class='td-content customer-name'><img src='{$perfil}' alt='avatar'>{$c['NOMBRES']} {$c['APELLIDOS']}</div></td>
                            <td><div class='td-content'>{$c['N_VENTA']}</div></td>
                            <td><div class='td-content'>{$c['FECHA_RESOLUCION']}</div></td>
                            <td><div class='td-content'>{$c['TOTAL']}</div></td>
                            <td><div class='td-content'>{$badge}</div></td>
                        </tr>
                    ";
               }
            echo $table;
            }
        }
    }
    public function productos_mas_vendidos()
    {
        if (isset($_POST["sucursal"])) {
            
            $consulta = $this->model->productos_mas_vendidos($_POST["sucursal"]);
            if ($consulta) {
               $table = "";
               foreach($consulta as $c){
                   $server = SERVERURL;
                   $imagen = $server."archives/assets/productos/{$c['IMAGEN']}";
                   $badge="<span class='badge outline-badge-success'>Vigente</span>";

                    $table.="
                        <tr>
                            <td><div class='td-content product-name'><img src='{$imagen}' alt='avatar'>{$c['ARTICULO']}</div></td>
                            <td><div class='td-content'>{$c['LINEA']}</div></td>
                            <td><div class='td-content'>{$c['PRECIO_VENTA_4']}</div></td>
                            <td><div class='td-content'>{$c['CANTIDAD_VENDIDA']}</div></td>
                            <td><div class='td-content'>{$c['TOTAL_VENDIDO']}</div></td>
                        </tr>
                    ";
               }
            echo $table;
            }
        }
    }
    public function consulta_venta_presentacion_mensual()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $year = date("Y");
            $mes = date("m");
            $consulta = $this->model->consulta_venta_presentacion_mensual($_POST["sucursal"], $year, $mes);
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
    public function consulta_venta_semanal()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $diaInicio = "Sunday";
            $diaFin = "Saturday";
            $hoy = date("Y-m-d");
            $strHoy = strtotime($hoy);

            $fecha2Inicio = date("Y-m-d", strtotime('last ' . $diaInicio . " -7 days", $strHoy));
            $fecha2Fin = date("Y-m-d", strtotime('next ' . $diaFin . " -7 days", $strHoy));
            $fechaInicio = date("Y-m-d", strtotime('last ' . $diaInicio, $strHoy));
            $fechaFin = date("Y-m-d", strtotime('next ' . $diaFin, $strHoy));

            $consulta = $this->model->consulta_venta_semanal($_POST["sucursal"], $fecha2Inicio, $fechaFin);
            if ($consulta) {
                $dia_1 = 0;
                $dia_2 = 0;
                $dia_3 = 0;
                $dia_4 = 0;
                $dia_5 = 0;
                $dia_6 = 0;
                $dia_7 = 0;
                $dia_8 = 0;
                $dia_9 = 0;
                $dia_10 = 0;
                $dia_11 = 0;
                $dia_12 = 0;
                $dia_13 = 0;
                $dia_14 = 0;
                foreach ($consulta as $c) {
                    if ($c["DIA"] == $fecha2Inicio) {
                        $dia_1 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " -6 days", $strHoy))) {
                        $dia_2 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " -5 days", $strHoy))) {
                        $dia_3 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " -4 days", $strHoy))) {
                        $dia_4 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " -3 days", $strHoy))) {
                        $dia_5 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " -2 days", $strHoy))) {
                        $dia_6 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " -1 days", $strHoy))) {
                        $dia_7 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio, $strHoy))) {
                        $dia_8 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " +1 days", $strHoy))) {
                        $dia_9 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " +2 days", $strHoy))) {
                        $dia_10 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " +3 days", $strHoy))) {
                        $dia_11 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " +4 days", $strHoy))) {
                        $dia_12 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " +5 days", $strHoy))) {
                        $dia_13 = $c["CANTIDAD"];
                    } else if ($c["DIA"] == date("Y-m-d", strtotime('last ' . $diaInicio . " +6 days", $strHoy))) {
                        $dia_14 = $c["CANTIDAD"];
                    }
                }
                $array = array(
                    "dia_1" => number_format($dia_1),
                    "dia_2" => number_format($dia_2),
                    "dia_3" => number_format($dia_3),
                    "dia_4" => number_format($dia_4),
                    "dia_5" => number_format($dia_5),
                    "dia_6" => number_format($dia_6),
                    "dia_7" => number_format($dia_7),
                    "dia_8" => number_format($dia_8),
                    "dia_9" => number_format($dia_9),
                    "dia_10" => number_format($dia_10),
                    "dia_11" => number_format($dia_11),
                    "dia_12" => number_format($dia_12),
                    "dia_13" => number_format($dia_13),
                    "dia_14" => number_format($dia_14),
                );
                echo json_encode($array);
            }
        }
    }
    public function bitacora_mensual()
    {
        if(isset($_POST["sucursal"])){
            $bitacoras = $this->model->consulta_bitacora_mensual();
            if($bitacoras){
                $n_1 = "";
                $n_2 = "";
                $n_3 = "Otros";
                $nt_1 = 0;
                $nt_2 = 0;
                $nt_3 = 0;
                $n = 1;
                foreach($bitacoras as $b){
                    if($n==1){
                        $n_1 = $b["NAVEGADOR"];
                        $nt_1 = $b["TOTAL"];
                    }else if($n == 2){
                        $n_2 = $b["NAVEGADOR"];
                        $nt_2 = $b["TOTAL"];
                    }else{
                        $nt_3 += $b["TOTAL"];
                    }
                    $n++;
                }
                $cien = number_format(($nt_1+$nt_2+$nt_3),2);
                $p_1 = number_format(($nt_1*100)/$cien,2);
                $p_2 = number_format(($nt_2*100)/$cien,2);
                $p_3 = number_format(($nt_3*100)/$cien,2);

                $array = array(
                    "navegador_1" => $n_1,
                    "navegador_p1" => $p_1,
                    "navegador_2" => $n_2,
                    "navegador_p2" => $p_2,
                    "navegador_3" => $n_3,
                    "navegador_p3" => $p_3
                );
                echo json_encode($array);
            }
        }
    }
    public function total_tarjetas()
    {
        if(isset($_POST["sucursal"])){
            $ventas = $this->model->total_ventas($_POST["sucursal"]);
            if($ventas){
               $ventas = $ventas->fetchColumn(0);
            }
            $compras = $this->model->total_compras($_POST["sucursal"]);
            if($compras){
               $compras = $compras->fetchColumn(0);
            }
            $usuarios = $this->model->total_usuarios($_POST["sucursal"]);
            if($usuarios){
               $usuarios = $usuarios->fetchColumn(0);
            }
            $cliente = $this->model->total_cliente();
            if($cliente){
               $cliente = $cliente->fetchColumn(0);
            }
            echo "{$ventas}|{$compras}|{$usuarios}|{$cliente}|";
        }
    }
}
