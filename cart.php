<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
    $cliente_1 = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?= SERVERURL ?>view/newtienda/img/logo.svg">
    <title>Grofar - Online Grocery Supermarket HTML Mobile Template</title>

    <link rel="stylesheet" type="text/css" href="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= SERVERURL ?>view/newtienda/vendor/slick/slick-theme.min.css" />

    <link href="<?= SERVERURL ?>view/newtienda/vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">

    <link href="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= SERVERURL ?>view/newtienda/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.css">

    <link href="<?= SERVERURL ?>view/newtienda/vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body class="fixed-bottom-padding">
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
        </label>
        <em>Enable Dark Mode!</em>
    </div>
    <div class="osahan-cart">
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="font-weight-bold m-0">Carrito</h5>
                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
        <div class="osahan-body" id="table_carrito">
           
        </div>
        <div class="p-3 mt-5">
            <a href="<?=SERVERURL?>tienda/checkout/" class="text-decoration-none">
                <div class="rounded shadow bg-success d-flex align-items-center p-3 text-white">
                    <div class="more">
                        <h6 class="m-0">Subtotal <span id="subtotal_carro"></span></h6>
                        <p class="small m-0">Proceder a checkout</p>
                    </div>
                    <div class="ml-auto"><i class="icofont-simple-right"></i></div>
                </div>
            </a>
        </div>

        <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
            <div class="row m-0">
            <a href="<?=SERVERURL?>tienda/grocery/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-grocery"></i></p>
               Tienda
            </a>
            <a href="javascript:void(0)" class="text-dark small col font-weight-bold text-decoration-none p-2 selected">
                <p class="h5 m-0"><i class="text-success  icofont-cart"></i></p>
                Carrito
            </a>
            <a href="<?=SERVERURL?>tienda/pedidos/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-bag"></i></p>
                Pedidos
            </a>
            <a href="<?=SERVERURL?>tienda/perfil/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-user"></i></p>
                Cuenta
            </a>
        </div>
            </div>
        </div>
       <nav id="main-nav">
        <ul class="second-nav">
    
            <li><a href="<?=SERVERURL?>tienda/grocery/"><i class="icofont-ui-home mr-2"></i> Tienda</a></li>
            <li><a href="<?=SERVERURL?>tienda/pedidos/"><i class="icofont-notification mr-2"></i> Pedidos</a></li>
            <li><a href="<?=SERVERURL?>tienda/direcciones/"><i class="icofont-location-pin mr-2"></i> Direcciones</a></li>
            <li><a href="<?=SERVERURL?>tienda/perfil/"><i class="icofont-list mr-2"></i> Perfil</a></li>
            <li>
                <a href="#"><i class="icofont-search-document mr-2 mr-2"></i> Secciones</a>
                <ul>
                    <?=$this->lista_secciones?>
                 </ul>
             </li>
           

        </ul>
        <ul class="bottom-nav">
            <li class="email">
                <a class="text-success" href="<?=SERVERURL?>tienda/grocery/">
                    <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                    Tienda
                </a>
            </li>
            <li class="github">
                <a href="<?=SERVERURL?>tienda/cart/">
                    <p class="h5 m-0"><i class="icofont-cart"></i></p>
                    Carrito
                </a>
            </li>
        </ul>
    </nav>

        <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js"></script>
        <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

        <script src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>
        <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

        <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="382db898c8a4fff0b736aad4-|49" defer=""></script>
</body>
<script>
    let carrito = {};
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "3000",
          "timeOut": "5000",
          "extendedTimeOut": "3000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        ;
    document.addEventListener("DOMContentLoaded", function() {
        if (localStorage.getItem('carrito')) {
            carrito = JSON.parse(localStorage.getItem('carrito') || "[]");
        }
        table_carrito();
        $(".header__filter").hide();
    });
    let table_carrito = () => {
        carrito = JSON.parse(localStorage.getItem('carrito') || "[]");
        let template = '';
        let sub_total_global = 0;
        carrito.forEach((task,i) => {
            let cantidad = parseFloat(task.cantidad);
            let sub_total = 0;
            let select_1 = '';
            let precio = parseFloat(task.precio);
            if(task.PRECIO_ACTIVO == 1){
                select_1 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_1);
            }
            let select_2 = '';
            if(task.PRECIO_ACTIVO == 2){
                select_2 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_2);
    
            }
            let select_3 = '';
            if(task.PRECIO_ACTIVO == 3){
                select_3 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_3);
            }
            let select_4 = '';
            if(task.PRECIO_ACTIVO == 4){
                select_4 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_4);
            }
       
            sub_total = cantidad * precio;
            sub_total_global += cantidad * precio;
           

            template += `
                <div id="tr_${task.id_item}"  id_item="${task.id_item}" cantidad="${task.cantidad}"  stock="${task.stock}" linea="${task.linea}" imagen="${task.imagen}" precio="${precio}" precio_activo="${task.PRECIO_ACTIVO}" precio_venta_1="${task.PRECIO_VENTA_1}" precio_venta_4="${task.PRECIO_VENTA_4}" precio_venta_2="${task.PRECIO_VENTA_2}" precio_venta_3="${task.PRECIO_VENTA_3}" MEDIDA_1="${task.MEDIDA_1}" MEDIDA_2="${task.MEDIDA_2}" MEDIDA_3="${task.MEDIDA_3}" MEDIDA_4="${task.MEDIDA_4}" articulo="${task.articulo}" STOCK_1="${task.STOCK_1}" STOCK_2="${task.STOCK_2}" STOCK_3="${task.STOCK_3}" STOCK_4="${task.STOCK_4}" class="cart-items item bg-white position-relative border-bottom">
                     
                    <div class="d-flex  align-items-center p-3">
                        <a href="javascript:void(0)"><img  src="${task.imagen}" class="img-fluid"></a>
                        <a href="javascript:void(0)" class="ml-3 text-dark text-decoration-none w-100">
                            <h5 class="mb-1">${task.articulo}</h5>
                            <p class="text-muted mb-2">Precio unitario: <?=$this->moneda?> ${precio}</p>
                            <div class="d-flex align-items-center">
                                <p class="total_price font-weight-bold m-0"><?=$this->moneda?> <span id="subtotal_${task.id_item}" >${sub_total.toFixed(2)}</p>
                                <select class="form-control custom-control select_item" id_item="${task.id_item}" index="${i}"  >
                                    <option value="1" ${select_1}>${task.MEDIDA_1}</option>
                                    <option value="2" ${select_2}>${task.MEDIDA_2}</option>
                                    <option value="3" ${select_3}>${task.MEDIDA_3}</option>
                                    <option value="4" ${select_4}>${task.MEDIDA_4}</option>
                                </select>
                                <div class="input-group input-spinner ml-auto cart-items-number">
                                    <div class="input-group-prepend">
                                        <button id_item="${task.id_item}" class="btn btn-success btn-sm btn_up" type="button" id="button-plus"> + </button>
                                    </div>
                                    <input id_item="${task.id_item}"  id="txt_${task.id_item}" type="text" class="text_cantidad form-control" value="${task.cantidad}">
                                    <div class="input-group-append">
                                        <button id_item="${task.id_item}" class="btn btn-success btn-sm btn_down" type="button" id="button-minus"> − </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                        `;
        });
        $("#subtotal_carro").html("<?=$this->moneda?> " +sub_total_global.toFixed(2));
        $('#table_carrito').html(template);
    }
    let update_carrito =()=> {
          var items = $('#table_carrito .item').length;
          let new_carro = [];
          for (i = 1; i < items + 1; i++){
              // capturar el id del producto
              var id_item = $('#table_carrito .item:nth-child('+i+')').attr('id_item');
              var cantidad = $('#txt_'+id_item).val();
              var stock = $('#table_carrito .item:nth-child('+i+')').attr('stock');
              var linea = $('#table_carrito .item:nth-child('+i+')').attr('linea');
              var imagen = $('#table_carrito .item:nth-child('+i+')').attr('imagen');
              var precio = $('#table_carrito .item:nth-child('+i+')').attr('precio');
              var articulo = $('#table_carrito .item:nth-child('+i+')').attr('articulo');
              let PRECIO_ACTIVO = $('#table_carrito .item:nth-child('+i+')').attr('precio_activo');
                let PRECIO_VENTA_1 = $('#table_carrito .item:nth-child('+i+')').attr('precio_venta_1');
                let PRECIO_VENTA_2 = $('#table_carrito .item:nth-child('+i+')').attr('precio_venta_2');
                let PRECIO_VENTA_3 = $('#table_carrito .item:nth-child('+i+')').attr('precio_venta_3');
                let PRECIO_VENTA_4 = $('#table_carrito .item:nth-child('+i+')').attr('precio_venta_4');
                let MEDIDA_1 = $('#table_carrito .item:nth-child('+i+')').attr('medida_1');
                let MEDIDA_2 = $('#table_carrito .item:nth-child('+i+')').attr('medida_2');
                let MEDIDA_3 = $('#table_carrito .item:nth-child('+i+')').attr('medida_3');
                let MEDIDA_4 = $('#table_carrito .item:nth-child('+i+')').attr('medida_4');
                let STOCK_1 = $('#table_carrito .item:nth-child('+i+')').attr('stock_1');
                let STOCK_2 = $('#table_carrito .item:nth-child('+i+')').attr('stock_2');
                let STOCK_3 = $('#table_carrito .item:nth-child('+i+')').attr('stock_3');
                let STOCK_4 = $('#table_carrito .item:nth-child('+i+')').attr('stock_4');
     
                if(PRECIO_ACTIVO == 1){
            
                    precio = parseFloat(PRECIO_VENTA_1);
                }
                let select_2 = '';
                if(PRECIO_ACTIVO == 2){
              
                    precio = parseFloat(PRECIO_VENTA_2);
        
                }
                if(PRECIO_ACTIVO == 3){
         
                    precio = parseFloat(PRECIO_VENTA_3);
                }

                if(PRECIO_ACTIVO == 4){
                    precio = parseFloat(PRECIO_VENTA_4);
                }
        
                
              var miProducto = { 
                'id_item': id_item, 
                'articulo': articulo, 
                'cantidad': parseInt(cantidad), 
                'stock': parseInt(stock), 
                'linea': linea,
                'precio': precio,
                'imagen': imagen,
                'PRECIO_ACTIVO': PRECIO_ACTIVO,
                'PRECIO_VENTA_1': PRECIO_VENTA_1,
                'PRECIO_VENTA_2': PRECIO_VENTA_2,
                'PRECIO_VENTA_3': PRECIO_VENTA_3,
                'PRECIO_VENTA_4': PRECIO_VENTA_4,
                'MEDIDA_1': MEDIDA_1,
                'MEDIDA_2': MEDIDA_2,
                'MEDIDA_3': MEDIDA_3,
                'MEDIDA_4': MEDIDA_4,
                'STOCK_1': STOCK_1,
                'STOCK_2': STOCK_2,
                'STOCK_3': STOCK_3,
                'STOCK_4': STOCK_4,
                
              };
              new_carro.push(miProducto);     
          };
          localStorage.setItem("carrito", JSON.stringify(new_carro));
          toastr["success"]("Carrito Actualizado correctamente");

          table_carrito();
        };
    $(document).on('click','.btn_down',function(){
          let id_item = $(this).attr("id_item");
          let cantidad = parseInt($("#txt_"+id_item).val());
          let tr_stock = parseInt($("#tr_"+id_item).attr('stock'));
          let tr_precio = parseFloat($("#tr_"+id_item).attr('precio'));
          cantidad--;
          if(cantidad<1){
            $("#tr_"+id_item).remove();
            update_carrito();
            return false;
          }else{
            let sub_total = tr_precio * cantidad;
            $("#txt_"+id_item).val(cantidad);
            $("#subtotal_"+id_item).html(sub_total.toFixed(2));
          }
          update_carrito();
        });
        $(document).on('click','.btn_up',function(){
          let id_item = $(this).attr("id_item");
          let cantidad = parseInt($("#txt_"+id_item).val());
          let tr_stock = parseInt($("#tr_"+id_item).attr('stock'));
          let tr_precio = parseFloat($("#tr_"+id_item).attr('precio'));
          if(cantidad>=tr_stock){
            update_carrito();
            return false;
          }else{
            cantidad++;
            let sub_total = tr_precio * cantidad;
            $("#txt_"+id_item).val(cantidad);
            $("#subtotal_"+id_item).html(sub_total.toFixed(2));
            
          }
          update_carrito();
        });
        $(document).on('input','.text_cantidad',function(){
          let id_item = $(this).attr("id_item");
          alert(id_item);
        });
        $(document).on('change','.select_item',function(){
            let id_item = $(this).attr("id_item");
            let index = $(this).attr("index");
            let value = $(this).val();
            let tr = $("#tr_"+id_item).attr("precio_activo",value);
            // let carrito = JSON.parse(localStorage.getItem("carrito"));
            // carrito[index].PRECIO_ACTIVO = value;
            update_carrito();
        });

</script>

</html>