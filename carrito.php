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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <title><?=SISTEMA_NOMBRE?> - Carrito de compras</title>
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
            <li><a href="<?=SERVERURL?>tienda/">Inicio</a></li>
            <li><a href="<?=SERVERURL?>tienda/online/">Tienda</a></li>
            <li>Carrito de compras</li>
          </ul>
        </div>
      </div>
      <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
          <div class="ps-section__header">
            <h1>Carrito de Compras</h1>
          </div>
          <div class="ps-section__content">
            <div class="table-responsive">
              <table class="table ps-table--shopping-cart">
                <thead>
                  <tr>
                    <th>Nombre de Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id='table_carrito'>

                </tbody>
              </table>
            </div>
            <div class="ps-section__cart-actions"><a class="ps-btn" href="<?=SERVERURL?>tienda/online/"><i class="icon-arrow-left"></i> Regresar a la tienda</a><a class="ps-btn ps-btn--outline" href="javascript:void(0)" id="btn_actualizar_carrito"><i class="icon-sync"></i> Actualizar carrito</a></div>
          </div>
          <div class="ps-section__footer">
            <div class="row">
                          
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
      require("view/tienda/components/footer.php");
    ?>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
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
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("./../../sw.js")
        .then(reg => console.log('Registro de SW exitoso', reg))
        .catch(err => console.warn('Error al tratar de registrar el sw', err))
    }
  </script>
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
        document.addEventListener("DOMContentLoaded", function () {
            if(localStorage.getItem('carrito')){
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            }
            lista_carrito();
            table_carrito();
            nro_deseos();
            $(".header__filter").hide();
        });
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
        let lista_carrito = () =>{
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
                        <a href="javascript:void(0)"><img src="${task.imagen}" alt=""></a>
                    </div>
                    <div class="ps-product__content">
                        <a class="ps-product__remove btn_eliminar_item_carrito" id_item="${task.id_item}">
                        <i class="icon-cross"></i>
                        </a>
                        <a href="javascript:void(0)">${task.articulo}</a>
                        <p><strong>Vendido por:</strong>  ${task.linea}</p>
                        <small> ${task.cantidad} x <?=$this->moneda?> ${task.precio}</small>
                    </div>
                    </div>
                    `
            });
            $('.ps-cart__items').html(template);
            $('#carrito_mobile_items').html(template);
            let cantidad_items = carrito.length;
            $("#subtotal_carro").html(sub_total.toFixed(2));
            $(".precio_carrito_mobile").html("<?=$this->moneda?> "+sub_total.toFixed(2));
            $("#cantidad_item_carrito").html(cantidad_items);
            $("#numero_items_carrito_mobile").html(cantidad_items);

        }
        let table_carrito = () =>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
                let cantidad = parseFloat(task.cantidad);
                let precio =  parseFloat(task.precio);
                sub_total = cantidad*precio;
                template += `
                    <tr id="tr_${task.id_item}" class='item' id_item="${task.id_item}" cantidad="${task.cantidad}"  stock="${task.stock}" linea="${task.linea}" imagen="${task.imagen}" precio="${task.precio}"  articulo="${task.articulo}">
                        <td>
                            <div class="ps-product--cart">
                                <div class="ps-product__thumbnail"><a href="#"><img src="${task.imagen}" alt=""></a></div>
                                <div class="ps-product__content"><a href="#">${task.articulo}</a>
                                <p>Vendidor por:<strong> ${task.linea}</strong></p>
                                </div>
                            </div>
                        </td>
                        <td class="price"><?=$this->moneda?> ${precio.toFixed(2)}</td>
                        <td>
                        <div class="form-group--number">
                            <button id_item="${task.id_item}" class="up btn_up">+</button>
                            <button id_item="${task.id_item}" class="down btn_down">-</button>
                            <input id="txt_${task.id_item}" id_item="${task.id_item}" class="form-control text_cantidad" type="text" placeholder="1" value="${task.cantidad}" onkeypress="return check(event)">
                        </div>
                        </td>
                        <td><?=$this->moneda?> <span id="subtotal_${task.id_item}" >${sub_total.toFixed(2)} </span></td>
                        <td><a href="javascript:void(0)" id_item="${task.id_item}" class='btn_eliminar'><i class="icon-cross"></i></a></td>
                    </tr>
                        `;
            });
            $('#table_carrito').html(template);
        }
        function check(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros y letras
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
        $(document).on('input','.text_cantidad',function(){
          let id_item = $(this).attr("id_item");
          alert(id_item);
        });
        $(document).on('click','.btn_up',function(){
          let id_item = $(this).attr("id_item");
          let cantidad = parseInt($("#txt_"+id_item).val());
          let tr_stock = parseInt($("#tr_"+id_item).attr('stock'));
          let tr_precio = parseFloat($("#tr_"+id_item).attr('precio'));
          if(cantidad>=tr_stock){
            return false;
          }else{
            cantidad++;
            let sub_total = tr_precio * cantidad;
            $("#txt_"+id_item).val(cantidad);
            $("#subtotal_"+id_item).html(sub_total.toFixed(2));
          }
        });
        $(document).on('click','.btn_eliminar',function(){
          let id_item = $(this).attr("id_item");
          $("#tr_"+id_item).remove();
        });
        $(document).on('click','.btn_down',function(){
          let id_item = $(this).attr("id_item");
          let cantidad = parseInt($("#txt_"+id_item).val());
          let tr_stock = parseInt($("#tr_"+id_item).attr('stock'));
          let tr_precio = parseFloat($("#tr_"+id_item).attr('precio'));
          if(cantidad<=1){
            return false;
          }else{
            cantidad--;
            let sub_total = tr_precio * cantidad;
            $("#txt_"+id_item).val(cantidad);
            $("#subtotal_"+id_item).html(sub_total.toFixed(2));
          }
        });
        $(document).on('click','#btn_actualizar_carrito',function(){
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
              var miProducto = { 
                'id_item': id_item, 
                'articulo': articulo, 
                'cantidad': parseInt(cantidad), 
                'stock': parseInt(stock), 
                'linea': linea,
                'precio': precio,
                'imagen': imagen
              };
              new_carro.push(miProducto);     
          };
          localStorage.setItem("carrito", JSON.stringify(new_carro));
          toastr["success"]("Carrito Actualizado correctamente");

          lista_carrito();
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