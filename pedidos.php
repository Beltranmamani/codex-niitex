<?php
    
    date_default_timezone_set(ZONEDATE);
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Consulta de pedidos  </title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?=SERVERURL;?>view/assets/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .card-header section > div:not(.collapsed) {
            color: #1b55e2;
            font-weight: 600;
        }
        .accordion-icons .accordion-icon {
            display: inline-block;
            margin-right: 10px;
        }
        .accordion-icons div:not(.collapsed) .accordion-icon svg {
            color: #1b55e2;
            fill: rgba(27, 85, 226, 0.23921568627450981);
        }
        .card-header section > div .icons {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            padding: 9px;
        }
        .mtable > thead > tr > th {
            border: 1px solid #7b7b7b5c;
        }
        .text_detalle {
            color: #54596f;
        }
        .dt-button-collection{
            margin-top:100px
        }
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
            <div class="layout-px-spacing" id="appVue">
            
                <div class="row layout-top-spacing justify-content-md-center">
                    <div class="col-12" >
                        <div class="page-header mb-3">
                            <div class="page-title">
                                <h3> Pedidos de traspasos Solicitados</h3>
                            </div>
                        </div>
                        <div class="statbox widget box box-shadow" id="card">
                            <div class="widget-content widget-content-area">
                                <div class="row" style="padding: 15px;">
                                    <div class="col-sm-4 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >PEDIDOS</span>
                                            </div>
                                           <select name="id" v-model="pedido" class="form-control form-control-sm" id="">
                                               <template v-for="p in lista">
                                                    <option :value="p">{{p.nro}} | {{p.fecha}}</option>
                                               </template>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >FECHA </span>
                                            </div>
                                            <input type="text" disabled :value="pedido.fecha" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >PEDIDO N° </span>
                                            </div>
                                            <input type="text" disabled :value="pedido.nro" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >RESPONSABLE </span>
                                            </div>
                                            <input type="text" disabled :value="pedido.responsable" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >SUCURSAL DESTINO</span>
                                            </div>
                                            <input type="text" disabled :value="pedido.sucursal" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-4 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >ALMACEN DESTINO  </span>
                                            </div>
                                            <input type="text" disabled :value="pedido.almacen" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-12 mb-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >MOTIVO </span>
                                            </div>
                                            <input type="text" disabled :value="pedido.motivo" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-12 text-center mt-3">
                                        <button class="btn btn-dark mb-2 w-100" id="btn_consultar" @click="entregaTotal" style="height: 45px;width: 45px;">
                                           ENTREGAR PEDIDO DE TRASPASO
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <div class="widget-content widget-content-area underline-content">
                                           <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>BARRA</th>
                                                                <th>ARTICULO</th>
                                                                <th>LINEA</th>
                                                                <th>ALMACEN</th>
                                                                <th>CANTIDAD PEDIDO</th>
                                                                <th>CANTIDAD ENTREGADA</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table">
                                                            <template v-for="item in pedido.items">
                                                                <tr :class="item.is_active==0 ? 'bg-light-danger' : ''">
                                                                    <td>{{item.BARRA}}</td>
                                                                    <td>{{item.ARTICULO}}</td>
                                                                    <td>{{item.LINEA}}</td>
                                                                    <td>{{item.almacen}}</td>
                                                                    <td><input type="text" class="form-control form-control-sm" :value="item.cantidad" readonly></td>
                                                                    <td><input type="text" class="form-control form-control-sm" v-model="item.cantidad_pedido"  :readonly="item.is_active==0"></td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-success btn-sm" @click="agregar(item)" v-if="item.is_active==1">ENTREGAR</button>
                                                                            <button class="btn btn-danger btn-sm" v-if="item.is_active==1" @click="quitar(item)">DESCARTAR</button>
                                                                        </div>    
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
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
                   
                        
                        <a href="#" class="btn btn-success" data-dismiss="modal">
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
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    <!-- Modals -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/app.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
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
    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/ui-accordions.js"></script>
       <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/assets/js/scrollspyNav.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/pdfmake.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.4/dist/vue.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        var app = new Vue({
            el: '#appVue',
            data: {
               
                lista:[],
                pedido:{
                    items:[]
                }
               
            },
            computed: {
            
            },
            methods: {
              
                listarPedidos() {
                    let self = this
                    $.post("<?= SERVERURL; ?>inventario/listar_pedidos_traspaso_pendientes_json/", {
                        token: ''
                    }, function(res) {
                        self.lista = JSON.parse(res)
                    })
                },
                async agregar(item){
                    try {
                        let data = {
                            item : item,
                            pedido:this.pedido
                        }
                        let res = await $.post("<?= SERVERURL; ?>inventario/entregar_pedido_traspaso_item/", data)
                        Snackbar.show({
                            text: 'Se ha entregado el item',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42',
                            pos: 'top-right'
                        });
                        this.pedido = JSON.parse(res)
                        
                    } catch (error) {
                        
                    }  
                },
                async quitar(item){
                    try {
                        let data = {
                            item : item,
                            pedido:this.pedido
                        }
                        let res = await $.post("<?= SERVERURL; ?>inventario/anular_pedido_traspaso_item/", data)
                        Snackbar.show({
                            text: 'Se ha entregado el item',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42',
                            pos: 'top-right'
                        });
                        this.pedido = JSON.parse(res)
                        
                    } catch (error) {
                        
                    }  
                },
              
                listar() {
                    this.listarPedidos()
               
                
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
                },
              
                async entregaTotal(){
                    try {
                        let data = {

                            pedido:this.pedido
                        }
                        let res = await $.post("<?= SERVERURL; ?>inventario/pedido_traspaso_entrega_total/", data)
                        Snackbar.show({
                            text: 'Se ha entregado totalmente el pedido',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42',
                            pos: 'top-right'
                        });
                        this.listarPedidos()
                        this.pedido = {
                            items:[]
                        }
                        $("#modal_comprobante").modal('show');
                        $("#formato_a4").attr("href",res)
                    } catch (error) {
                        
                    }  
                },
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