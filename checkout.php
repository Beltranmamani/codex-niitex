<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
    $cliente = mainModel::parametros_cliente_tienda($_SESSION["usuario"]);
    $cliente_1 = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?=SISTEMA_NOMBRE?> - CheckOut </title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/owl-carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/css/style.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.css">
    <link rel="manifest" href="<?=SERVERURL;?>manifest.json">
  </head>
  <body>
    <?php
        require "view/tienda/components/navbar.php";
    ?>


    <div class="ps-page--simple">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="<?=SERVERURL?>tienda/online/">Inicio</a></li>
            <li>Verificar Pedido</li>
          </ul>
        </div>
      </div>
      <div class="ps-checkout ps-section--shopping">
        <div class="container">
          <div class="ps-section__header">
            <h1>Verficar Pedido</h1>
          </div>
          <div class="ps-section__content">
            <form class="ps-form--checkout" action="do_action" method="post">
              <div class="row">
                            <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12  ">
                              <div class="ps-form__billing-info">
                                <h3 class="ps-form__heading">Detalles de facturación</h3>
                                      <div class="form-group">
                                        <label>Nombre Completo <sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                          <input id="nombre_chek" class="form-control" disabled value='<?=$cliente["NOMBRE"]?>' type="text">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Correo Electronico<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                          <input id="correo_chek" class="form-control"disabled  value='<?=$cliente["CORREO"]?>' type="email">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Departamento<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                          <select name="departamento" id="departamento" class="form-control">
                                            <?=$this->lista_departamentos?>    
                                          </select>                                        
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Provincia<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                          <select name="provincia" id="provincia" disabled class="form-control">
                                             
                                          </select>                                        
                                                                                
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Dirección<sup>*</sup>
                                        </label>
                                        <select name="lista_direccion_option" id="lista_direccion_option"  class="form-control">
                                             
                                             </select> 
                                      </div>
                                      <div class="form-group">
                                        <label>Telefono<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                          <input id="telefono_chek" class="form-control" disabled value='<?=$cliente["TELEFONO"]?>' type="text">
                                        </div>
                                      </div>
                                      
                               
                                <h3 class="mt-40"> Información Adicional</h3>
                                <div class="form-group">
                                  
                                  <div class="form-group__content">
                                    <textarea class="form-control" rows="7" id="info_check" placeholder="Notas sobre su pedido, p. Ej. notas especiales para la entrega."></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12  ">
                              <div class="ps-form__total">
                                <h3 class="ps-form__heading">Tu Pedido</h3>
                                <div class="content">
                                  <div class="ps-block--checkout-total">
                                    <div class="ps-block__header">
                                      <p>Productos</p>
                                    </div>
                                    <div class="ps-block__content">
                                      <table class="table ps-block__products">
                                        <tbody id="tb_productos_pedido">
                                          
                                        </tbody>
                                      </table>
                                      <h4 class="ps-block__title">Subtotal <?=$this->moneda?> <span id="subtotal_pedido">0.00</span></h4>
                                      <hr>
                                      <input type="hidden" value="0" id="costo_tarifa">
                                      <input type="hidden" name="" id="id_provincia">
                                      <h4 class="ps-block__title">Costo de Envío <?=$this->moneda?> <span id="subtotal_envio">0.00</span></h4>
                                      <hr>
                                      <h3>Total <?=$this->moneda?> <span id="total_pedido">0.00</span></h3>
                                    </div>
                                  </div><a class="ps-btn ps-btn--fullwidth" id="btn_verificacion" href="javascript:void(0)">Procesar verificacíon</a>
                                </div>
                              </div>
                            </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--include ../../partials/sections/newsletter-->
    <!--include ../../shared/footers/footer-->
    
    
    <?php
      require("view/tienda/components/footer.php");
    ?>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/jquery.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/nouislider/nouislider.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/popper.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/masonry.pkgd.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/isotope.pkgd.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/jquery.matchHeight-min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/slick/slick/slick.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/slick-animation.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/select2/dist/js/select2.full.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>
    <!-- custom scripts-->
    <script src="<?=SERVERURL?>view/tienda/assets/js/main.js"></script>
    <script>    
        let carrito = {};
        let pedido_cliente = {};
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
        
        document.addEventListener("DOMContentLoaded", function () {
            if(localStorage.getItem('carrito')){
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            }
            lista_carrito();
            table_carrito();
            nro_deseos();
            direccion_lista();
            pedido_cliente_array();
            $(".header__filter").hide();

        });
         let lista_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
            let cantidad = parseFloat(task.cantidad);
            let precio =  parseFloat(task.precio);
            sub_total += cantidad*precio;
            template += `
                    <div class="ps-product--cart-mobile">
                    <div class="ps-product__thumbnail">
                        <a href="#"><img src="${task.imagen}" alt=""></a>
                    </div>
                    <div class="ps-product__content">
                        <a class="ps-product__remove btn_eliminar_item_carrito" id_item="${task.id_item}">
                        <i class="icon-cross"></i>
                        </a>
                        <a href="#">${task.articulo}</a>
                        <p><strong>Vendido por:</strong>  ${task.linea}</p>
                        <small> ${task.cantidad} x <?=$this->moneda?> ${task.precio}</small>
                    </div>
                    </div>
                    `
            });
            let costo = parseFloat($('#costo_tarifa').val());

            $('#subtotal_envio').html(costo.toFixed(2));
            $('.ps-cart__items').html(template);
            $('#carrito_mobile_items').html(template);
            let cantidad_items = carrito.length;
            $("#subtotal_carro").html(sub_total.toFixed(2));
            let total = sub_total+costo;
            $(".precio_carrito_mobile").html("<?=$this->moneda?>"+sub_total.toFixed(2));
            $("#total_pedido").html(total.toFixed(2));
            $("#cantidad_item_carrito").html(cantidad_items);
            $("#numero_items_carrito_mobile").html(cantidad_items);


            
        }
         let pedido_cliente_array = ()=>{
            pedido_cliente = JSON.parse(localStorage.getItem('cliente_pedido')|| "[]");
            $('#costo_tarifa').val(pedido_cliente.tarifa_chek);
            lista_carrito();
         }
         let table_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
            let cantidad = parseFloat(task.cantidad);
            let precio =  parseFloat(task.precio);
            sub_total += cantidad*precio;
            template += `
                    <tr>
                        <td><a href="#">${task.articulo} ×  ${task.cantidad}</a>
                            <p>Vendido por:<strong>${task.linea}</strong></p>
                        </td>
                        <td><?=$this->moneda?> ${task.precio}</td>
                    </tr>
        
                    `
            });
            $('#tb_productos_pedido').html(template);
            $("#subtotal_pedido").html(sub_total.toFixed(2));
            
        }
        let nro_deseos = () =>{
          let id_usuario = "<?=$cliente_1?>";
          if(id_usuario === "none"){
            $("#nro_deseos").html(0);
          }else{
            $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
              $("#nro_deseos").html(res);
            });
          }
        }
        let direccion_lista = () =>{
          let id_usuario = "<?=$cliente_1?>";
          if(id_usuario === "none"){
            $("#nro_deseos").html(0);
          }else{
            $.post("<?=SERVERURL?>tienda/lista_option_direccion/",{id_usuario},function(res){
              $("#lista_direccion_option").html(res);
            });
          }
        }
        $(document).on('click','#btn_verificacion',function(){
            let provincia = $("#provincia").val();
            let direccion = $("#lista_direccion_option").val();
            if(provincia==0||provincia==null){
              toastr["error"]("Seleccione una provincia");
            }else{
              if(direccion==0||direccion==null){
                toastr["error"]("Seleccione una direccion");
              }else{
                let direccion_text = $("#lista_direccion_option option:selected").html();
                let tarifa = $("#provincia option:selected").attr('tarifa');
                let nombre_chek = $("#nombre_chek").val();
                let correo_chek = $("#correo_chek").val();
                let direccion_chek = $("#lista_direccion_option").val();
                let telefono_chek = $("#telefono_chek").val();
                let info_check = $("#info_check").val();
                let pedido = {
                    'id_cliente' : "<?=$_SESSION["usuario"]?>",
                    'nombre_chek' :nombre_chek,
                    'correo_chek' :correo_chek,
                    'provincia_chek' :provincia,
                    'tarifa_chek' : tarifa,
                    'direccion_chek' :direccion_chek,
                    'direccion_text_chek' :direccion_text,
                    'telefono_chek' :telefono_chek,
                    'info_check' :info_check
                }
                localStorage.setItem("cliente_pedido", JSON.stringify(pedido));
                location.href = "<?=SERVERURL?>tienda/shipping/";
              }

            }
        });
        $(document).on('change','#departamento',function(){
            let id = $(this).val();
            $.post("<?=SERVERURL?>tienda/lista_provincias_departamento/",{id},function(res){
              $("#provincia").html(res);
              $("#provincia").prop('disabled', false);
            });
        });
        $(document).on('change','#provincia',function(){
            let tarifa = $("#provincia option:selected").attr('tarifa');
            $("#costo_tarifa").val(tarifa);
            lista_carrito();
        });
        $(document).on('input','.txtbuscar_producto',function(){
          let valor = $(this).val();
          let elementos = document.querySelectorAll('.nodos_productos_search .ps-product--search-result');
          if(elementos.length>0){
            for (let i = 1; i <= elementos.length; i++) {
              let articulo = $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').attr('articulo');
              let precio = $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').attr('precio');
              articulo = articulo.toLowerCase();
              valor = valor.toLowerCase();
              if(articulo.indexOf(valor)>-1 || precio.indexOf(valor)>-1){
                $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').show();

              }else{
                $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').hide();
              }

            }
          }
        });
         $(document).on('input','#txt_buscar',function(){
        let valor = $(this).val();
        let elementos = document.querySelectorAll('.navigation__content .ps-product--search-result');
        if(elementos.length>0){
          for (let i = 1; i <= elementos.length; i++) {
            let articulo = $('.navigation__content .ps-product--search-result:nth-child('+i+')').attr('articulo');
            let precio = $('.navigation__content .ps-product--search-result:nth-child('+i+')').attr('precio');
            articulo = articulo.toLowerCase();
            valor = valor.toLowerCase();
            if(articulo.indexOf(valor)>-1 || precio.indexOf(valor)>-1){
              $('.navigation__content .ps-product--search-result:nth-child('+i+')').show();

            }else{
              $('.navigation__content .ps-product--search-result:nth-child('+i+')').hide();
            }

          }
        }
      });
    </script>
  </body>
</html>