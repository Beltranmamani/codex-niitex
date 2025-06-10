<?php
    session_name('B_POS');
    session_start();
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
    <title><?=SISTEMA_NOMBRE;?> - Mapa de entregas </title>
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
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .select2-container{
            z-index: 100000;
        }
        .almacen .select2-container{
            z-index: 1000;
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
        .select2-container--open {
            z-index: 9999999
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
            <div class="layout-px-spacing mt-4">
                <div id="mapa" style="width: 100%; height: 100vh;">

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
    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>
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

    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/input-mask.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        let preventas = [];
        function lista_de_preventas(){
            let token = "Lista";
            $.post("<?=SERVERURL;?>distribucion/lista_distribucion/",{token},function(response){
                let preventa = JSON.parse(response);
                preventas.push(preventa);
                console.log(preventas[0]);
                var mymap = L.map('mapa').setView([-16.49948, -68.14477], 13);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                
                }).addTo(mymap);

               
                preventas[0].forEach(element => {
                    console.log(element);
                    if(element.lat != "SIN DATO" || element.log != "SIN DATO"){
                        L.marker([element.log,element.lat]).addTo(mymap)
                        .bindPopup(`<b>DESTINARIO: ${element.destinatario}</b> <br />Direccion:${element.direccion} <br />Preventa: ${element.preventa} <br />`).openPopup();
                        
                    }
                });
               

               

                mymap.locate({enableHighAccuracy: true})
                mymap.on('locationfound', (e) => {
                    var radius = e.accuracy / 1;
                    const coords = [e.latlng.lat, e.latlng.lng];
                    var LeafIcon = L.Icon.extend({
                        options: {
                            iconSize:     [100, 100],
                            shadowSize:   [50, 64],
                            iconAnchor:   [22, 94],
                            shadowAnchor: [4, 62],
                            popupAnchor:  [-3, -76]
                        }
                    });

                var greenIcon = new LeafIcon({iconUrl: "<?=SERVERURL;?>view/distribucion/camion.png"});
                    const newMarker = L.marker(coords, {icon: greenIcon});
                    L.circle(e.latlng, radius).addTo(mymap);
                    newMarker.bindPopup('Tu estas aca a '+radius+' metros desde este punto');
                    mymap.addLayer(newMarker);
                });
               
            });
        }
        lista_de_preventas();

    </script>


</body>
</html>