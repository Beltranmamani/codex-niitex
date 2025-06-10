<?php
session_name('BOL_TIENDA');
session_start();
if (!isset($_SESSION["usuario"])) {
    echo '<script> window.location.href="' . SERVERURL . 'tienda/login/" ;</script>';
}
$cliente = mainModel::parametros_cliente_tienda($_SESSION["usuario"]);
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
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= SERVERURL ?>view/newtienda/vendor/slick/slick-theme.min.css" />

    <link href="<?= SERVERURL ?>view/newtienda/vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">

    <link href="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= SERVERURL ?>view/newtienda/css/style.css" rel="stylesheet">

    <link href="<?= SERVERURL ?>view/newtienda/vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body>
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
        </label>
        <em>Enable Dark Mode!</em>
    </div>
    <div class="osahan-profle">
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
                <a class="font-weight-bold text-success text-decoration-none" href="<?= SERVERURL ?>tienda/perfil/">
                    <i class="icofont-rounded-left back-page"></i></a>
                <h6 class="font-weight-bold m-0 ml-3">Editar Perfil</h6>
                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
    </div>
    <div id="edit_profile">
        <div class="p-4 profile text-center border-bottom">
            <img src="<?= SERVERURL ?>archives/avatars/sin_perfil.png" class="img-fluid rounded-pill">
            <h6 class="font-weight-bold m-0 mt-2"><?=$cliente["NOMBRE"]?></h6>
        </div>
        <div class="p-3">
            <form  id="enviar_datos" name='enviar_datos'>
                <div class="form-group">
                      <label>Nombre</label>
                      <input type="hidden"   value='<?=$cliente["ID_CLIENTE"]?>' name='id'>
                      <input class="form-control" type="text" placeholder="Por favor introduce tu nombre..." value='<?=$cliente["NOMBRE"]?>' name='nombre'>
                    </div>
                    <div class="form-group">
                          <label>Numero de telefono</label>
                          <input class="form-control" type="text" placeholder="Por favor introduce tu numero de telefono..." name='telefono' value='<?=$cliente["TELEFONO"]?>'>
                        </div>
                        <div class="form-group">
                          <label>Numero de telefono</label>
                          <input class="form-control" type="text" placeholder="Por favor introduce tu numero de telefono..." name='telefono' value='<?=$cliente["TELEFONO"]?>'>
                        </div>
                        <div class="form-group">
                          <label>Correo</label>
                          <input class="form-control" type="text" placeholder="Por favor introduce tu email..." value='<?=$cliente["CORREO"]?>' name='correo'>
                        </div>
                        <div class="form-group">
                          <label>Fecha de nacimiento</label>
                          <input class="form-control" type="text" placeholder="Por favor introduce tu fecha de cumpleaños..." value='<?=$cliente["FECHA"]?>' name='fecha'>
                        </div>
                        <div class="form-group">
                          <label>Genero</label>
                          <select class="form-control" name='genero'>
                            <?php
                              if($cliente["GENERO"]==1){
                            ?>
                                <option value="1" selected='selected'>Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3">Otro</option>
                            <?php
                              }else if($cliente["GENERO"]==2){
                            ?>
                                <option value="1">Masculino</option>
                                <option value="2" selected='selected'>Femenino</option>
                                <option value="3">Otro</option>
                            <?php
                              }else{
                            ?>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3" selected='selected'>Otro</option>
                            <?php
                              }
                            ?>

                            
                            
                          </select>
                        </div>
               
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-block btn-lg">Guardar</button>
                </div>
            </form>
        </div>

    </div>
    </div>
    <nav id="main-nav">
        <ul class="second-nav">
    
            <li><a href="<?=SERVERURL?>tienda/grocery/"><i class="icofont-ui-home mr-2"></i> Tienda</a></li>
            <li><a href="<?=SERVERURL?>tienda/pedidos/"><i class="icofont-notification mr-2"></i> Pedidos</a></li>
            <li><a href="<?=SERVERURL?>tienda/direcciones/"><i class="icofont-search-1 mr-2"></i> Direcciones</a></li>
            <li><a href="<?=SERVERURL?>tienda/perfil/"><i class="icofont-list mr-2"></i> Perfil</a></li>

           

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

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js"></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="1f9f1cf7df6fb3b54610bfba-|49" defer=""></script>
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
            nro_deseos();
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
                        <a href="product-default.html">${task.articulo}</a>
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
            $(".precio_carrito_mobile").html("<?=$this->moneda?>"+sub_total.toFixed(2));
            $("#cantidad_item_carrito").html(cantidad_items);
            $("#numero_items_carrito_mobile").html(cantidad_items);

            
        }
        let nro_deseos = () =>{
          let id_usuario = "<?=$_SESSION['usuario']?>";;
          $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
            $("#nro_deseos").html(res);
          });
        }
        $(document).on('submit','#enviar_datos',function(e){
          e.preventDefault();
          var Form = new FormData(document.forms.namedItem("enviar_datos"));
          $.ajax({
              url: "<?=SERVERURL;?>tienda/actualizar_datos_cliente/",
              type: "post",
              data : Form,
              processData: false,
              contentType: false,
              success: function(data)
              {
                if(data==1){
                  toastr["success"]("Tus datos se han actualizado correctamente");
                  card_cliente();
                }else{
                  toastr["error"]("No se ha guardado ningun cambio");
                }
              }
          }); 
        });
        $(document).on('submit','#enviar_documento',function(e){
          e.preventDefault();
          var Form = new FormData(document.forms.namedItem("enviar_documento"));
          $.ajax({
              url: "<?=SERVERURL;?>tienda/actualizar_documentos_cliente/",
              type: "post",
              data : Form,
              processData: false,
              contentType: false,
              success: function(data)
              {
                
                if(data==1){
                  toastr["success"]("Tus datos se han actualizado correctamente");
                }else{
                  toastr["error"]("No se ha guardado ningun cambio");
                }
              }
          }); 
        });
        $(document).on('submit','#enviar_password',function(e){
          e.preventDefault();
          let password = $("#password").val();
          let password_2 = $("#password_2").val();
          if(password.length<1 ||password_2.length<1){
            toastr["error"]("Complete los campos");
          }else{
            if(password == password_2){
              toastr["error"]("Las contraseñas no pueden ser iguales");
            }else{
              var Form = new FormData(document.forms.namedItem("enviar_password"));
              
              $.ajax({
                  url: "<?=SERVERURL;?>tienda/actualizar_password_cliente/",
                  type: "post",
                  data : Form,
                  processData: false,
                  contentType: false,
                  success: function(data)
                  {
                    // alert(data);
                    if(data==1){
                      toastr["success"]("Tus datos se han actualizado correctamente");
                    }else{
                      toastr["error"]("Contraseña incorrecta");
                    }
                  }
              }); 

            }

          }
        });
        $(document).on('submit','#enviar_pefil',function(e){
          e.preventDefault();
          
              var Form = new FormData(document.forms.namedItem("enviar_pefil"));
              
              $.ajax({
                  url: "<?=SERVERURL;?>tienda/actualizar_perfil_cliente/",
                  type: "post",
                  data : Form,
                  processData: false,
                  contentType: false,
                  success: function(data)
                  {
                    // alert(data);
                    if(data==1){
                      toastr["success"]("Tus perfil se han actualizado correctamente");
                      card_cliente();
                    }else{
                      toastr["error"]("No se pudo actualizar perfil");
                    }
                  }
              }); 

            
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
        let card_cliente = () =>{
          let id = "<?=$_SESSION['usuario']?>";
          $.post("<?=SERVERURL?>tienda/card_cliente/",{id},function(res){
            $("#card_cliente").html(res);
          });
        } 
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