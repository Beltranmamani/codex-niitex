<?php
    if (!isset($_SESSION["usuario"])) {
        echo '<script> window.location.href="' . SERVERURL . 'login/" ;</script>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Pedido Traspaso de productos </title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>
    <link href="<?=SERVERURL;?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/contacts2.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/pos.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets//plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">
    <!-- DATATABLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_miscellaneous.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .select2-container{
            z-index: 100000;
        }
        .almacen .select2-container{
            z-index: 1000;
        }
        .code-bar .btn{
            font-size: smaller;
        }
        .code-bar .btn svg {
            width: 14px;
            height: 17px;
            vertical-align: bottom;
        }
        .searchable-container .searchable-items.grid .items {
            margin-bottom: 30px;
            border-radius: 6px;
            width: 100%;
            color: #0e1726;
            transition: all 0.35s ease;
            width: 32%;
            -ms-flex: 0 0 5%;
            flex: 0 32%;
            max-width: 32%;
            position: relative;
            width: 100%;
            padding-right: 1px;
            padding-left: 15px;
        }
        .x_td:hover{
            background-color: #ff0000a8;
            color:#fff!important;
            transition: all 0.5s;
            cursor: pointer;
        }
        @media only screen and (max-width: 600px) {
             .searchable-container .searchable-items.grid .items {
                    margin-bottom: 30px;
                    border-radius: 6px;
                    width: 100%;
                    color: #0e1726;
                    transition: all 0.35s ease;
                    width: 32%;
                    -ms-flex: 0 0 5%;
                    flex: 0 50%;
                    max-width: 100%;
                    position: relative;
                    width: 100%;
                    padding-right: 1px;
                    padding-left: 15px;
                }
                td .bootstrap-touchspin-injected{
                    width: 100px;
                }
        }
    </style>
</head>
<body class="alt-menu sidebar-noneoverflow" id="precessing">
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
            <div id="appVue" class="layout-px-spacing">
                <div class="row layout-spacing layout-top-spacing mt-4" id="cancel-row" style="margin-top: 0;">
                    <div class="card-pos col-lg-7" id="table-card">
                        <!-- INPUT SEARCH -->
                        <div class="widget-content searchable-container grid">
                            <div class="row mt-2">
                                <div class="col-lg-7 col-md-7 col-sm-8 filtered-list-search  mt-2">
                                    <form autocomplete="off" class="" id="form-product-search" action="#">
                                        <div class="" style="width: -webkit-fill-available;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control" id="input-search" placeholder="Buscar los productos">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-4 text-sm-right text-center layout-spacing align-self-center mt-2">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-lg btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                Sucursal
                                            </button>
                                            <div class="dropdown-menu" >
                                               
                                                <template v-for="s in sucursales">
                                                    <a class="dropdown-item " @click="SeleccionarSucursal(s)" href="javascript:void(0);"  >{{s.name}}</a>
                                                </template>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" id="btndefault"  class="btn btn-lg btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                Almacen
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btndefault" >
                                                <template v-for="a in sucursal.almacenes">
                                                    <a class="dropdown-item " @click="SeleccionarAlmacen(a)" href="javascript:void(0);"  >{{a.name}}</a>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>
                        </div>
                        <!-- ITEMS -->
                        <div class="widget-content searchable-container mt-3 list">
                            <div class="searchable-items grid " id="items_widgets" style="height: 70vh;overflow-y: scroll;">
                               
                            <template v-for="item in inventario">
                            <div class='items new_items ' >
                                                            

                                                            <div class='item-content  p-4'>
                                                                
                                                                <div class='user-profile'>
                                                                
                                                                    <img :src="url('archives/assets/productos/'+item.IMAGEN)" alt='avatar' style='height: 100px;'>
                                                                    <div class='user-meta-info'>
                                                                        <p class='user-name'  style='font-size: 14px;'>{{item.ARTICULO}}</p>
                                                                        <p class='user-work' >{{item.LINEA}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class='code-bar'>
                                                                <button @click="AddList(item)" class='btn btn-outline-info btn-block'>
                                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                                                        {{item.BARRA}}
                                                                    </button>
                                                                </div>
                                                                <div class='user-email' style='margin-top: 10px;'>
                                                                    <span class='badge w-100 badge-info text-center'> {{item.ALMACEN}} </span></s>
                                                                </div>
                                                                <div class='user-email'>
                                                                    <p class='info-title'>Presentacion: </p>
                                                                    <p class='usr-email-addr'>{{item.PRESENTACION}}</p>
                                                                </div>
                                                                <div class='user-phone'>
                                                                    <p class='info-title'>UM: </p>
                                                                    <p class='usr-ph-no'>{{item.COMPLEMENTO}}{{item.PREFIJO}}</p>
                                                                </div>
                                                               
                                                                <div class='user-phone'  style='margin:auto' >
                                                                    <p class='info-title'>STOCK: </p>
                                                                    <p class='usr-ph-no'>{{item.CANTIDAD}}</p>
                                                                </div>
                                                                <span style='font-weight: 700;color: #3b3f5c;'>Precio</span>
                                                                <div class='user-location'>
                                                                    <div class="input-group input-group-sm ">
                                                                        <span class="input-group-btn input-group-prepend"><button  @click="item.PRECIO_VENTA_4=Number(item.PRECIO_VENTA_4)>1?Number(item.PRECIO_VENTA_4)-1:1" class="btn btn-primary m-0" type="button">-</button></span>
                                                                        <input type="text" class="form-control" v-model.number='item.PRECIO_VENTA_4'/>
                                                                        <span class="input-group-btn input-group-append"><button @click="item.PRECIO_VENTA_4=Number(item.PRECIO_VENTA_4)+1"  class="btn btn-primary m-0" type="button">+</button></span>
                                                                    </div>
                                                                </div>
                                                              
                                                                <button class='btn btn-success btn-block mt-2 btn_agregar' @click="AddList(item)" >
                                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                                    Agregar
                                                                </button>
                                                            </div>
                                                        </div>
                            </template>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-12 layout-spacing widget widget-card-four_2">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>

                                                <th>Total</th>
                                                <th>Almacen</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_productos">
                                           <template v-for="(item,i) in list">
                                            <tr class="items_tr">
                                                    <td>
                                                    {{item.ARTICULO}} |
                                                        <span style="color: #03a9f4; font-weight: 600">{{item.LINEA}}</span>
                                                    </td>
                                                    <td>
                                                        <div class="input-group input-group-sm ">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button @click="item.CANTIDAD_PEDIDO=item.CANTIDAD_PEDIDO>1?item.CANTIDAD_PEDIDO-1:1" class="btn btn-primary m-0" type="button">-</button>
                                                            </span>
                                                            <input type="text" class=" form-control" v-model.number='item.CANTIDAD_PEDIDO'/>
                                                            <span class="input-group-btn input-group-append">
                                                                <button @click="item.CANTIDAD_PEDIDO=item.CANTIDAD_PEDIDO+1"  class="btn btn-primary m-0" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group input-group-sm ">
                                                            <span class="input-group-btn input-group-prepend"><button  @click="item.PRECIO_VENTA_4=Number(item.PRECIO_VENTA_4)>1?Number(item.PRECIO_VENTA_4)-1:1" class="btn btn-primary m-0" type="button">-</button></span>
                                                            <input type="text" class="form-control" v-model.number='item.PRECIO_VENTA_4'/>
                                                            <span class="input-group-btn input-group-append"><button @click="item.PRECIO_VENTA_4=Number(item.PRECIO_VENTA_4)+1"  class="btn btn-primary m-0" type="button">+</button></span>
                                                        </div>

                                                    </td>
                                                 
                                                    <td >{{Number(Number(item.CANTIDAD_PEDIDO)*Number(item.PRECIO_VENTA_4)).toFixed(2)}}</td>
                                                    <td>{{item.ALMACEN}}</td>
                                                    <td
                                                        class="x_td"
                                                        @click="list.splice(i,1)"
                                                        style="
                                                            cursor: pointer;
                                                            transition: all 0.5s;
                                                            font-weight: bolder;
                                                            color: #1b55e2;
                                                            padding: 10px;
                                                            border-radius: 10px;
                                                        "
                                                        >
                                                        X
                                                    </td>
                                                </tr>

                                           </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row m-2">
                                    <div class="col-sm-12 col-md-4 ">
                                        <button class="btn btn-danger  mb-4 mr-2 btn-lg btn-block" @click="limpiar_venta()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                             Limpiar
                                        </button>
                                    </div>
                                    <div class="col-sm-12 col-md-8 ">
                                        <button class="btn btn-success mb-4 mr-2 btn-lg btn-block"  data-toggle="modal" data-target="#modal_procesar_traspaso">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                                            Procesar Traspaso
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal fade" id="modal_procesar_traspaso" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-body" id="traspasas_modal">
                                <div class="row">
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                                <label for="almacen">Mi Almacen Receptor</label>
                                                <select class="form-control  basic" id="almacen" v-model="mi_almacen">
                                                    <template v-for="a in almacenes">
                                                        <option :value="a.id">{{a.name}}</option>
                                                    </template>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-12 " id="cont_monto_a_pagar">
                                        <div class="form-group">
                                            <label for="motivo">Motivo(*)</label>
                                            <textarea name="motivo"  v-model="motivo" id="motivo" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    Cerrar</button>
                                <button type="button" class="btn btn-success" id='btntransferir' @click="ProcesarTraspaso">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-repeat"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                                    Transferir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_comprobante" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="<?=SERVERURL;?>archives/assets/pos/factura.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <div class="btn-group mb-4" role="group" aria-label="Basic example">
                       
                        <a id="formato_a4" href="#" target='_blank' class="btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            A4
                        </a>
                   
                        
                        <a href="<?=SERVERURL;?>inventario/listapedidotraspasos" class="btn btn-success"  >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-cw"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>                            
                            Continuar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php
                require_once 'view/components/cmp_footer.php';
            ?>
        </div>
        <!--  END CONTENT PART  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <!-- MODALS -->
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
    <!-- MODALS -->
   
    <!-- MODALS -->
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
    <!-- MODAL -->
    <div class="modal fade" id="modal_no_caja" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="<?=SERVERURL;?>archives/assets/pos/no_caja.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <a href="<?=SERVERURL;?>caja/arqueosporcaja/" class="btn btn-success mb-4">Abrir Caja</a>
                </div>
            </div>
        </div>
    </div>
  

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/app.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/blockui/jquery.blockUI.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/blockui/custom-blockui.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/assets/js/apps/contact.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_miscellaneous.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/scrollspyNav.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.4/dist/vue.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        var app = new Vue({
            el: '#appVue',
            data: {
               
                lineas: [],
                sucursales:[],
                inventario:[],
                sucursal:{
                    almacenes:[]
                },
                almacen:{},
                almacenes:[],
                mi_almacen:0,
                list:[],
                sucursal_id:'',
                motivo:""
               
            },
            computed: {
            
            },
            methods: {
                AddList(i){
                    let item = {...i}
                    item.CANTIDAD_PEDIDO = 1
                    if(this.sucursal_id!=""){
                        if(this.sucursal_id != item.ID_SUCURSAL){
                            Snackbar.show({
                                text: 'Este producto pertenece a otra sucursal',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            return false
                        }
                        
                    }
                    this.sucursal_id = item.ID_SUCURSAL
                    this.list.push(item)
                    Snackbar.show({
                        text: 'Se ha agregado a la lista',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                  

                },
                url(url){
                    return "<?=SERVERURL?>"+url
                },
                SeleccionarSucursal(a){
                    this.sucursal = a
                    Snackbar.show({
                        text: 'Se ha seleccionado la sucursal ['+a.name+']',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                },
               async SeleccionarAlmacen(a){
                    let self = this
                    this.almacen = a
                    Snackbar.show({
                        text: 'Se ha seleccionado el almacen ['+a.name+']',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                   await  $.post("<?= SERVERURL; ?>ventas/lista_productos_sucursal_traspaso_json/", {
                        id_almacen: a.id
                    }, function(res) {
                        self.inventario = JSON.parse(res)
                    })
                    

                },
                listarLinea() {
                    let self = this
                    $.post("<?= SERVERURL; ?>lineas/listar_lineas_json/", {
                        token: ''
                    }, function(res) {
                        self.lineas = JSON.parse(res)
                    })
                },
                listarAlmacens() {
                    let self = this
                    $.post("<?= SERVERURL; ?>inventario/listar_almacen_sucursal_json/", {
                        token: ''
                    }, function(res) {
                        self.almacenes = JSON.parse(res)
                    })
                },
                
                listarSucursales() {
                    let self = this
                    $.post("<?= SERVERURL; ?>inventario/listar_sucursales_json/", {
                            token: ''
                        }, function(res) {
                            self.sucursales = JSON.parse(res)
                        })
                },
                
              
                listar() {
                    this.listarLinea()
                    this.listarSucursales()
                    this.listarAlmacens()
                
                },
             
                GET_DATA(path) {
                    $.post('<?= SERVERURL; ?>' + path, {
                        token: '',
                        sucursal: ''
                    }, function(response) {
                        return JSON.parse(response)
                    });
                },
               reload(){
                    location.reload()
                },
                limpiar_venta(){
                    this.list = []
                }, 
                async ProcesarTraspaso(){
                   try{
                    let data = {
                        cart : this.list,
                        sucursal_id : this.sucursal_id,
                        motivo : this.motivo,
                        almacen_id : this.mi_almacen
                    }
                    let res = await $.post("<?= SERVERURL; ?>inventario/procesar_pedido_traspaso/", data)
                    console.log(res)
                    $("#modal_procesar_traspaso").modal('hide');
                    $("#modal_comprobante").modal('show');
                    $("#formato_a4").attr("href",res)
                    this.motivo = ""
                    this.cart = []
                    Snackbar.show({
                        text: 'Se ha procesado el pedido',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                   }catch(e){
                       console.log(e)
                   }
                }
             },
            mounted() {
                this.listar()
         
                let caja = "<?=$_SESSION["caja"]?>";
                if(caja == 0){
                    $("#modal_no_caja").modal('show');
                }

            }
        })
    </script>


</body>
</html>