<?php
    session_name("B_POS");
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
    $nombre_pagina = "Dashboard";
    $tienda = $this->tienda;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE?>- Dashboard </title>
    <link rel="icon" type="image/x-icon" href="<?=SERVERURL?>view/assets/assets/img/favicon.ico"/>
    <link href="<?=SERVERURL?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL?>view/assets/assets/css/dashboard/dash_3.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/dashboard/widgets.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
       
    </style>
</head>
<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require_once 'view/components/cmp_navbar.php';?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php require_once 'view/components/cmp_topbar.php';?>
        <!--  END TOPBAR  -->
        
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">


                <div class="row layout-top-spacing">

                <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one p_1">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value" id="pe_1">3,192</span>
                                        <span class="w-numeric-title">Pedidos Pendientes</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total_pedido_1"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one p_2">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value" id="pe_2">3,192</span>
                                        <span class="w-numeric-title">Pedidos por enviar</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total_pedido_2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one p_3">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value" id="pe_3">3,192</span>
                                        <span class="w-numeric-title">Pedidos completados</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total_pedido_3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one p_4">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value" id="pe_4">3,192</span>
                                        <span class="w-numeric-title">Pedidos Anulados</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total_pedido_4"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class=""> Tienda</h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Mensuales</a></li>
                                </ul>
                            </div>

                            <div class="widget-content">
                                <div class="tabs tab-content">
                                    <div id="content_1" class="tabcontent"> 
                                        <div id="ingreso_mensual"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info global">
                                        <h6 class="value" id="valor_p1"></h6>
                                        <p class="global">Valor de pedidos activos</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon global">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-success " role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value" id="valor_p2"></h6>
                                        <p class="">Pedidos a tu cargo</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value" id="valor_p3"></h6>
                                        <p class="anulado">Tus Pedidos Anulados</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon anulado">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-down"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline><polyline points="17 18 23 18 23 12"></polyline></svg>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Pedidos por Presentacíon</h5>
                            </div>
                            <div class="widget-content">
                                <div id="ventas_presentacion_chart" class=""></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-activity-three">

                            <div class="widget-heading">
                                <h5 class="">Movimiento de Pedidos</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto ps ps--active-y">
                                    <div id="body_notificaciones" class="timeline-line">
                                        
                                                                         
                                    </div>                                    
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 325px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 232px;"></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>

               <?php 
                require_once 'view/components/cmp_footer.php';
               ?>

            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    <div class="modal fade" id="modal_no_sucursal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                   <img src="<?=SERVERURL;?>archives/assets/pos/sucursal.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <a href="<?=SERVERURL;?>sucursal/sucursales/" class="btn btn-primary mb-4">Abrir Sucursal</a>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $("#view_dashboard").addClass("active");
            App.init();
            let modal = "<?=$_SESSION["sucursal"]?>";
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            $('.mt-container').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });

        });
    </script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <!-- <script src="<?=SERVERURL;?>view/assets/assets/js/dashboard/dash_1.js"></script> -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function(){
            let sucursal = "<?=$_SESSION['sucursal']?>";
            $.post("<?=SERVERURL?>dashboard/bitacora_mensual/",{sucursal},function(respuesta){
                let json = JSON.parse(respuesta);
                let template = ` 
                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>                        </div>
                        <div class="w-browser-details">
                            <div class="w-browser-info">
                                <h6>`+json.navegador_1+`</h6>
                                <p class="browser-count">`+json.navegador_p1+`%</p>
                            </div>
                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: `+json.navegador_p1+`%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>                        </div>
                        <div class="w-browser-details">
                            
                            <div class="w-browser-info">
                                <h6>`+json.navegador_2+`</h6>
                                <p class="browser-count">`+json.navegador_p2+`%</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: `+json.navegador_p2+`%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        </div>
                        <div class="w-browser-details">
                            
                            <div class="w-browser-info">
                                <h6>`+json.navegador_3+`</h6>
                                <p class="browser-count">`+json.navegador_p3+`%</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: `+json.navegador_p3+`%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                `;
                $(".vistorsBrowser").html(template)
            });
            ventas_mesuales();
            ventas_presentacion_mensual();
            ventas_diarias();
            card_estado_pedido();
            valor_pedidos_usuario();
            lista_activadades_recientes();
        });
        let lista_activadades_recientes =() =>{
            let token = "<?=$_SESSION['sucursal']?>";
            $.post("<?=SERVERURL?>pedidostienda/lista_activadades_recientes/",{token},function(respuesta){
                $("#body_notificaciones").html(respuesta);
            });
        }
        function ventas_mesuales(){
            let sucursal = "<?=$_SESSION['sucursal']?>";
            $.post("<?=SERVERURL?>pedidostienda/consulta_pedido_mensual/",{sucursal},function(respuesta){
                let json = JSON.parse(respuesta);
                var options1 = {
                    chart: {
                        fontFamily: 'Nunito, sans-serif',
                        height: 365,
                        type: 'area',
                        zoom: {
                            enabled: false
                        },
                        dropShadow: {
                        enabled: true,
                        opacity: 0.3,
                        blur: 5,
                        left: -7,
                        top: 22
                        },
                        toolbar: {
                        show: false
                        },
                        events: {
                        mounted: function(ctx, config) {
                            const highest1 = ctx.getHighestValueInSeries(0);
                            const highest2 = ctx.getHighestValueInSeries(1);
    
                            ctx.addPointAnnotation({
                            x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                            y: highest1,
                            label: {
                                style: {
                                cssClass: 'd-none'
                                }
                            },
                            customSVG: {
                                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                cssClass: undefined,
                                offsetX: -8,
                                offsetY: 5
                            }
                            })
    
                            ctx.addPointAnnotation({
                            x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                            y: highest2,
                            label: {
                                style: {
                                cssClass: 'd-none'
                                }
                            },
                            customSVG: {
                                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                cssClass: undefined,
                                offsetX: -8,
                                offsetY: 5
                            }
                            })
                        },
                        }
                    },
                    colors: ['#1b55e2', '#e7515a'],
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        discrete: [{
                        seriesIndex: 0,
                        dataPointIndex: 7,
                        fillColor: '#000',
                        strokeColor: '#000',
                        size: 5
                    }, {
                        seriesIndex: 2,
                        dataPointIndex: 11,
                        fillColor: '#000',
                        strokeColor: '#000',
                        size: 4
                    }]
                    },
                    subtitle: {
                        text: 'Valor de Pedidos',
                        align: 'left',
                        margin: 0,
                        offsetX: -10,
                        offsetY: 35,
                        floating: false,
                        style: {
                        fontSize: '14px',
                        color:  '#888ea8'
                        }
                    },
                    title: {
                        text: 'Pedidos Finalizados',
                        align: 'left',
                        margin: 0,
                        offsetX: -10,
                        offsetY: 0,
                        floating: false,
                        style: {
                        fontSize: '25px',
                        color:  '#0e1726'
                        },
                    },
                    stroke: {
                        show: true,
                        curve: 'smooth',
                        width: 2,
                        lineCap: 'square'
                    },
                    series: [{
                        name: 'Pedidos',
                        data: [json.mes_1*1000, json.mes_2*1000, json.mes_3*1000, json.mes_4*1000,json.mes_5*1000, json.mes_6*1000, json.mes_7*1000, json.mes_8*1000, json.mes_9*1000, json.mes_10*1000, json.mes_11*1000,json.mes_12*1000]
                    }],
                    labels: ['Ene.', 'Feb.', 'Mar.', 'Abr.', 'May.', 'Jun.', 'Jul.', 'Ago.', 'Sep.', 'Oct.', 'Nov.', 'Dic.'],
                    xaxis: {
                        axisBorder: {
                        show: false
                        },
                        axisTicks: {
                        show: false
                        },
                        crosshairs: {
                        show: true
                        },
                        labels: {
                        offsetX: 0,
                        offsetY: 5,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Nunito, sans-serif',
                            cssClass: 'apexcharts-xaxis-title',
                        },
                        }
                    },
                    yaxis: {
                        labels: {
                        formatter: function(value, index) {
                            return (value / 1000) + "<?=$_SESSION['moneda']?>"
                        },
                        offsetX: -22,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Nunito, sans-serif',
                            cssClass: 'apexcharts-yaxis-title',
                        },
                        }
                    },
                    grid: {
                        borderColor: '#e0e6ed',
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },   
                        yaxis: {
                            lines: {
                                show: false,
                            }
                        },
                        padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: -10
                        }, 
                    }, 
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        offsetY: -50,
                        fontSize: '16px',
                        fontFamily: 'Nunito, sans-serif',
                        markers: {
                        width: 10,
                        height: 10,
                        strokeWidth: 0,
                        strokeColor: '#fff',
                        fillColors: undefined,
                        radius: 12,
                        onClick: undefined,
                        offsetX: 0,
                        offsetY: 0
                        },    
                        itemMargin: {
                        horizontal: 0,
                        vertical: 20
                        }
                    },
                    tooltip: {
                        theme: 'dark',
                        marker: {
                        show: true,
                        },
                        x: {
                        show: false,
                        }
                    },
                    fill: {
                        type:"gradient",
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: .28,
                            opacityTo: .05,
                            stops: [45, 100]
                        }
                    },
                    responsive: [{
                        breakpoint: 575,
                        options: {
                        legend: {
                            offsetY: -30,
                        },
                        },
                    }]
                }
                var chart1 = new ApexCharts(
                    document.querySelector("#ingreso_mensual"),
                    options1
                );
    
                chart1.render();
            });
        }
        function ventas_presentacion_mensual(){
            let sucursal = "<?=$_SESSION['sucursal']?>";
            $.post("<?=SERVERURL?>pedidostienda/consulta_pedido_presentacion_mensual/",{sucursal},function(respuesta){
                let json1 = JSON.parse(respuesta);
                var options = {
                    chart: {
                        type: 'donut',
                        width: 380
                    },
                    colors: ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'],
                    dataLabels: {
                    enabled: false
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontSize: '14px',
                        markers: {
                        width: 10,
                        height: 10,
                        },
                        itemMargin: {
                        horizontal: 0,
                        vertical: 8
                        }
                    },
                    plotOptions: {
                    pie: {
                        donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                            show: true,
                            fontSize: '23px',
                            fontFamily: 'Nunito, sans-serif',
                            color: undefined,
                            offsetY: -10
                            },
                            value: {
                            show: true,
                            fontSize: '20px',
                            fontFamily: 'Nunito, sans-serif',
                            color: '20',
                            offsetY: 16,
                            formatter: function (val) {
                                return val
                            }
                            },
                            total: {
                            show: true,
                            showAlways: true,
                            label: 'Total',
                            color: '#888ea8',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce( function(a, b) {
                                return a + b
                                }, 0)
                            }
                            }
                        }
                        }
                    }
                    },
                    stroke: {
                    show: true,
                    width: 25,
                    },
                    series: [json1.total_1*1, json1.total_2*1, json1.total_3*1],
                    labels: [json1.nombre_1, json1.nombre_2,json1.nombre_3],
                    responsive: [{
                        breakpoint: 1599,
                        options: {
                            chart: {
                                width: '350px',
                                height: '400px'
                            },
                            legend: {
                                position: 'bottom'
                            }
                        },

                        breakpoint: 1439,
                        options: {
                            chart: {
                                width: '250px',
                                height: '390px'
                            },
                            legend: {
                                position: 'bottom'
                            },
                            plotOptions: {
                            pie: {
                                donut: {
                                size: '65%',
                                }
                            }
                            }
                        },
                    }]
                }
                var chart = new ApexCharts(
                    document.querySelector("#ventas_presentacion_chart"),
                    options
                );

                chart.render();

            });
        }
        function ventas_diarias(){
            let sucursal = "<?=$_SESSION['sucursal']?>";
            $.post("<?=SERVERURL?>dashboard/consulta_venta_semanal/",{sucursal},function(respuesta){
                let json1 = JSON.parse(respuesta);
                var d_2options1 = {
                    chart: {
                            height: 160,
                            type: 'bar',
                            stacked: true,
                            stackType: '100%',
                            toolbar: {
                            show: false,
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            show: true,
                            width: 1,
                        },
                        colors: ['#e2a03f', '#e0e6ed'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                legend: {
                                    position: 'bottom',
                                    offsetX: -10,
                                    offsetY: 0
                                }
                            }
                        }],
                        series: [{
                            name: 'Esta Semana',
                            data: [json1.dia_8, json1.dia_9, json1.dia_10, json1.dia_11, json1.dia_12, json1.dia_13, json1.dia_14]
                        },{
                            name: 'Semana Pasada',
                            data: [json1.dia_1, json1.dia_2, json1.dia_3, json1.dia_4, json1.dia_5, json1.dia_6, json1.dia_7]
                        }],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            categories: ['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'],
                        },
                        yaxis: {
                            show: false
                        },
                        fill: {
                            opacity: 1
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                endingShape: 'rounded',
                                columnWidth: '25%',
                            }
                        },
                        legend: {
                            show: false,
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                            top: 10,
                            right: 0,
                            bottom: -40,
                            left: 0
                            }, 
                        },
                    }
                var d_2C_1 = new ApexCharts(document.querySelector("#ventas_diarias"), d_2options1);
                d_2C_1.render();
            });
        }
        /*
    =============================
        Total Orders | Options
    =============================
*/
        var d_2options2 = {
        chart: {
            id: 'sparkline1',
            group: 'sparklines',
            type: 'area',
            height: 280,
            sparkline: {
            enabled: true
            },
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            opacity: 1,
        },
        series: [{
            name: 'Pedidos',
            data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
        }],
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        yaxis: {
            min: 0
        },
        grid: {
            padding: {
            top: 125,
            right: 0,
            bottom: 36,
            left: 0
            }, 
        },
        fill: {
            type:"gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .40,
                opacityTo: .05,
                stops: [45, 100]
            }
        },
        tooltip: {
            x: {
            show: false,
            },
            theme: 'dark'
        },
        colors: ['#fff']
        }
        var templeate_1 = new ApexCharts(document.querySelector("#total_pedido_1"), d_2options2);
        var templeate_2 = new ApexCharts(document.querySelector("#total_pedido_2"), d_2options2);
        var templeate_3 = new ApexCharts(document.querySelector("#total_pedido_3"), d_2options2);
        var templeate_4 = new ApexCharts(document.querySelector("#total_pedido_4"), d_2options2);
        templeate_1.render();
        templeate_2.render();
        templeate_3.render();
        templeate_4.render();
        let card_estado_pedido =()=>{
            let sucursal = "<?=$_SESSION['sucursal']?>";
            $.post("<?=SERVERURL?>pedidostienda/total_estados_pedido_mensual/",{sucursal},function(respuesta){
                let res = respuesta.split('|');
                $("#pe_1").html(res[0]);
                $("#pe_2").html(res[1]);
                $("#pe_3").html(res[2]);
                $("#pe_4").html(res[3]);
            });
        }
        let valor_pedidos_usuario =()=>{
            let usuario = "<?=$_SESSION['usuario']?>";
            $.post("<?=SERVERURL?>pedidostienda/valor_pedidos_usuario/",{usuario},function(respuesta){
                let res = respuesta.split('|');
                $("#valor_p1").html("<?=$tienda['MONEDA']?> "+res[0]);
                $("#valor_p2").html("<?=$tienda['MONEDA']?> "+res[1]);
                $("#valor_p3").html("<?=$tienda['MONEDA']?> "+res[2]);
            });
        }
    </script>
</body>
</html>