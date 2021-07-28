<?php include("../partials/verify-session.php");
require_once dirname(dirname(__DIR__)) . "/dao/ProductDao.php";
require_once dirname(dirname(__DIR__)) . "/dao/MaterialDao.php";
require_once dirname(dirname(__DIR__)) . "/dao/TabProductDao.php";
require_once dirname(dirname(__DIR__)) . "/dao/FactorDao.php";
require_once dirname(dirname(__DIR__)) . "/dao/CantidadDao.php";

$productDao = new ProductDao();

if (!isset($_GET["id"])) {
  header("Location: /admin/products");
}

$product = $productDao->findById($_GET["id"]);
$products = $productDao->findAll();
$cantidad = $product->getCantidad();
$tabProductDao = new TabProductDao();
$indexField = 1;
$indexMeasurement = 1;
$indexMaterial = 1;
$indexCantidad = 1;
$indexFactor = 1;

$materialDao = new MaterialDao();
$materials = $materialDao->findMaterials();
$tabs = $tabProductDao->findByProduct($product);

$nameAdditional = "";
$routeDownloadFileExample = "";

switch ($product->getCotizador()) {
  case 1:
    $nameAdditional = "Ventana";
    $routeDownloadFileExample = "/Catalogos/FormatMeasurements.xlsx";
    break;
  case 2:
    $nameAdditional = "Piezas por Pliego";
    $routeDownloadFileExample = "/Catalogos/FormatMeasurementsBoxes.xlsx";
    break;
}
?>
<!-- author: Teenus SAS, github: Teenus SAS -->
<!doctype html>
<html lang="es">

<head>
  <title>Actualizar Producto | <?= $product->getName() ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" href="/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type='text/css' />
  <link rel="stylesheet" href="/css/nice-select.css">
  <link rel="stylesheet" href="/vendor/dropzone/dropzone.css">

  <!-- Include JS file. -->
  <script type="text/javascript" src="/vendor/froala_editor.pkgd.min.js"></script>
  <style>
    div.imagen {
      width: auto;
      height: 200px;
      background-size: cover;
      margin: 0 auto;
      padding: 2px 2px;
    }

    div.info {
      position: absolute;
      overflow: hidden;
      background-color: rgba(31, 31, 31, 0.9);
      opacity: 0;
      transition: opacity 0.3s;
    }

    div.imagen:hover div.info {
      opacity: 0.8;
    }

    p.descripcion {
      font-size: 1rem;
      text-align: center;
      margin-top: 200px;
      transition: margin-top 0.4s;
    }

    div.imagen:hover p.descripcion {
      margin-top: 75px;
    }

    @media (min-width: 768px) {
      .carousel-multi-item-2 .col-md-3 {
        float: left;
        width: 25%;
        max-width: 100%;
      }
    }

    .carousel-multi-item-2 .card img {
      border-radius: 2px;
    }
  </style>
  <style>
    .alert-minimalist {
      background-color: rgb(241, 242, 240);
      border-color: rgba(149, 149, 149, 0.3);
      border-radius: 3px;
      color: rgb(149, 149, 149);
      padding: 10px;
    }

    .alert-minimalist>[data-notify="icon"] {
      height: 50px;
      margin-right: 12px;
    }

    .alert-minimalist>[data-notify="title"] {
      color: rgb(51, 51, 51);
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .alert-minimalist>[data-notify="message"] {
      font-size: 80%;
    }

    .alert-minimalist-warning {
      background-color: #ff9e0f;
      border-color: rgba(149, 149, 149, 0.3);
      border-radius: 3px;
      color: rgb(149, 149, 149);
      padding: 10px;
    }

    .alert-minimalist-warning>[data-notify="icon"] {
      height: 50px;
      margin-right: 12px;
    }

    .alert-minimalist-warning>[data-notify="title"] {
      color: rgb(51, 51, 51);
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .alert-minimalist-warning>[data-notify="message"] {
      font-size: 80%;
    }
  </style>
  <?php if ($product->getCategory()->getId() == 6) {
    echo "<style>
      .length,.window{
        display: none;
      }
      </style>";
  } ?>
</head>

<body class="white-edition" id="body">
  <div class="wrapper ">
    <?php include("../partials/sidebar.php") ?>
    <div id="main-panel">
      <div class="main-panel" id="main-panel-child">
        <!-- Navbar -->
        <?php include("../partials/navbar.php"); ?>

        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/admin/">Dashboard</a>
              </li>
              <li class="breadcrumb-item "><a href="/admin/products">Productos</a></li>
              <li class="breadcrumb-item active">Actualizar Producto | <?= $product->getName() ?></li>
            </ol>

            <div class="nombreProducto ml-3">
              <label for="ref">Referencia:</label>
              <label for="title">Nombre del producto:</label>
              <input type="text" placeholder="Ej. LV-12" id="ref" class="form-control" value="<?= $product->getRef(); ?>">
              <input type="text" placeholder="Ej. bolsa de manija" id="title" class="form-control" value="<?= $product->getName(); ?>">
            </div>

            <br>
            <div class="form-group ml-3">
              <label for="content">descripción:</label>
              <br>
              <textarea name="content" id="content"></textarea>
            </div>
            <div class="mt-5 mb-5" style="text-align: center;"><b>Imagenes del producto</b></div>
            <!--Carousel Wrapper-->
            <div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2 ml-3 mr-3" data-ride="carousel">
              <h5>Imagenes del Producto</h5>
              <!--Controls-->
              <div class="controls-top text-center">
                <a class="black-text" href="#multi-item-example" data-slide="prev"><i class="fas fa-angle-left fa-3x pr-3"></i></a>
                <a class="black-text" href="#multi-item-example" data-slide="next"><i class="fas fa-angle-right fa-3x pl-3"></i></a>
              </div>
              <!--/.Controls-->

              <!--Slides-->
              <div class="carousel-inner" role="listbox">
                <!--First slide-->
                <div class="carousel-item active">
                  <?php $counter = 0;
                  foreach ($product->getImages() as $image) {
                    if ($counter % 4 == 0 && $counter != 0) {
                      echo "</div>";
                      echo "<div class='carousel-item'>";
                    } ?>
                    <div class="col-md-3 mb-3">
                      <div class="card">
                        <div class="imagen" style="background-image: url(<?= $image->getUrl(); ?>);">
                          <div class="info">
                            <p class="descripcion"><button class="btn btn-danger" onclick="deleteImage(<?= $image->getId(); ?>,'<?= $image->getUrl(); ?>')">Eliminar</button></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                    $counter++;
                  }
                  if ($counter % 4 != 0) {
                    echo "</div>";
                  } ?>

                </div>
              </div>
            </div>
            <div class="form-group ml-3 mr-3">
              <label for="myId">Sube las imagenes del producto:</label>
              <div id="myId" class="dropzone"></div>
            </div>
            <hr style="width: 96%;">

            <div class="mt-4 mb-5" style="text-align: center;"><b>Categoria</b></div>

            <!-- Categoria -->
            <div class="ml-5" id="categories">
              <div class="recta mb-3">
                <label for="category">Categoría:</label>
                <select id="category" class="form-control" style="width: 40%;">
                </select>
              </div>

              <!-- subcategoria -->

              <div class="recta mb-3">
                <label for="category">Subcategoría:</label>
                <select id="subcategory" class="form-control" style="width: 40%;">
                </select>
              </div>

              <hr style="width: 96%;">

              <div class="mt-4 mb-5" style="text-align: center;"><b>Cotizador</b></div>

              <?php
              require_once $_SERVER["DOCUMENT_ROOT"] . "/dao/CotizadorDao.php";
              $cotizadorDao = new CotizadorDao();
              $cotizadores = $cotizadorDao->findAll(); ?>

              <div class="recta mb-5">
                <label for="cotizador">Cotizador:</label>
                <select id="cotizador" class="form-control" style="width: 40%;">
                  <option disabled>Selecciona una cotizador</option>
                  <?php foreach ($cotizadores as $cotizador) { ?>
                    <option value="<?= $cotizador->getId(); ?>" <?= $product->getCotizador() == $cotizador->getId() ? "selected" : ""; ?>><?= $cotizador->getName(); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <hr style="width: 96%;">

            <div class="ml-5" id="usos">
              <div class="mt-4 mb-4" style="text-align: center;"><b>Usos</b></div>
              <div class="form-group">
                <div class="container">
                  <div class="row" id="fields">
                    <?php
                    if (is_array($product->getUses()) || is_object($product->getUses())) {
                      foreach ($product->getUses() as $use) { ?>
                        <div class="col-sm-4">
                          Uso <?= $indexField; ?>:<input type="text" id="field<?= $indexField; ?>" class="form-control" value="<?= $use; ?>">
                        </div>
                    <?php $indexField++;
                      }
                    } ?>
                  </div>
                </div>
                <button class="btn btn-primary" onclick="addField()" title="Agregar un uso"><i class="fas fa-plus"></i></button>
              </div>
            </div>

            <hr>

            <div class="ml-5" id="medidas">
              <div class="mt-4 mb-3" style="text-align: center;"><b>Medidas</b></div>
              <div class="form-group" id="measurement-container">
                <button class="btn btn-primary" id="hideMeasurements">Ver Medidas</button>
                <ul class="list-unstyled" id="measurements">
                  <?php foreach ($product->getMeasurements() as $measurement) { ?>
                    <li>Medida <?= $indexMeasurement ?>:
                      <div class="row">
                        <div class="row">
                          <div class="col codigo"> <label for="codigo<?= $indexMeasurement ?>" style="margin-left:15px">Codigo:</label><input type="text" id="codigo<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getcodigo(); ?>" style="margin-left:15px" readonly></div>
                          <div class="col"><label for="width<?= $indexMeasurement ?>">Ancho:</label><input type="number" id="width<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getWidth(); ?>" readonly></div>
                          <div class="col height"><label for="height<?= $indexMeasurement ?>">Alto:</label><input type="number" id="height<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getHeight(); ?>" readonly></div>
                          <div class="col length"><label for="length<?= $indexMeasurement ?>">Largo:</label><input type="number" id="length<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getLength(); ?>" readonly></div>
                          <div class="col largo-util"><label for="">Largo Útil</label><input type="number" id="largoUtil<?= $indexMeasurement ?>" value="<?= $measurement->getLargoUtil(); ?>" class="form-control" value="0" readonly></div>
                        </div>

                        <div class="row">
                          <div class="col-2 ml-4 ancho-total"><label for="">Ancho Total</label><input type="number" id="anchoTotal<?= $indexMeasurement ?>" value="<?= $measurement->getAnchoTotal(); ?>" class="form-control" value="0" readonly></div>
                          <?php if ($product->getCotizador() == 2) { ?>
                            <div class="col-2 ml-4 pliego"><label for="pliego<?= $indexMeasurement ?>"> Piezas por Pliego</label><input type="number" id="pliego<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getPliego(); ?>" readonly></div>
                          <?php } ?>
                          <div class="col-2 venta-minima-impresa"><label for="">Vta Min Impresa</label><input type="number" id="VentaMinimaImpresa<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getVentaMinimaImpresa(); ?>" readonly></div>
                          <div class="col-2 venta-minima-generica"><label for="">Vta Min Genérica</label><input type="number" id="VentaMinimaGenerica<?= $indexMeasurement ?>" class="form-control" value="<?= $measurement->getVentaMinimaGenerica(); ?>" readonly></div>
                          <div class="col-1 mr-3" style="margin-top: 1rem;"><button class="btn btn-danger" onclick="deleteMeasurement(<?= $product->getId() ?>,<?= $measurement->getId() ?>)"><i class="fas fa-trash-alt"></i></button></div>
                          <div class="col-1" style="margin-top: 1rem;"><button value="Modificar" class="btn btn-warning" onclick="updateMeasurement(<?= $product->getId() ?>,<?= $measurement->getId() ?>,<?= $indexMeasurement ?>,this)"><i class="fas fa-pencil-alt"></i></button></div>

                        </div>
                      </div>
                    </li>
                  <?php $indexMeasurement++;
                  } ?>
                </ul>
              </div>
              <button class="btn btn-primary" onclick="addEvaluateMeasurement()" title="Agregar una medida"><i class="fas fa-plus"></i></button>
              <button id="btnUploadExcel" class="btn btn-primary" title="Cargar Medidas"><i class="fas fa-cloud-upload-alt"></i></button>
              <div id="uploadExcel">
                <div style="display: flex;margin-top: 30px;justify-content: center;">
                  <label class="mb-5">Importar Medidas</label>
                </div>
                <div id="uploadExcel" style="display: flex;justify-content: center;">
                  <input class="form-control" type="file" id="cargarMedidas" accept=".xls,.xlsx" style="width: 500px;">
                  <button class="btn btn-primary" id="btnImportarMedidas" onclick="importarMedidas(<?= $_GET["id"] ?>);">Importar</button>
                </div>
              </div>
            </div>

            <hr>
            <div class="ml-5 mr-5" id="materiaPrima">
              <div class="mt-4 mb-5" style="text-align: center;"><b>Materia prima y Factores de precio</b></div>
              <div class="form-gruop">
                <label class="col-2" for="campo1" style="margin-right: 240px;">Materia Prima:</label>
                <label for="FactorE1<?= $indexMaterial ?>" class="col-md-2">E1</label>
                <label for="FactorE2<?= $indexMaterial ?>" class="col-md-2">E2</label>
                <label for="FactorE3<?= $indexMaterial ?>" class="col-md-2">E3</label>
              </div>
              <div class="ml-3" id="materials">
                <?php foreach ($product->getMaterials() as $materialProduct) { ?>
                  <div class="row">
                    <select class="form-control" style="margin-bottom: 10px; width:30%" id="material<?= $indexMaterial; ?>">
                      <option>Seleccione un material</option>
                      <?php
                      foreach ($materials as  $material) {
                        $materialSelected = $materialProduct->getId() == $material->getId() ? $material : $materialSelected ?>
                        <option value="<?= $material->getId(); ?>" <?= $materialProduct->getId() == $material->getId() ? "selected" : "" ?>><?= $material->getName(); ?></option>
                      <?php } ?>
                    </select>

                    <input class="col md-4 form-control ml-3 mr-5" id="e1<?= $indexMaterial ?>" value="<?= $materialProduct->getE1(); ?>" type="number" style="width: 100px; text-align:center">
                    <input class="col md-4 form-control mr-3" id="e2<?= $indexMaterial ?>" value="<?= $materialProduct->getE2() ?>" type="number" style="width: 100px; text-align:center">
                    <input class="col md-4 form-control mr-3" id="e3<?= $indexMaterial ?>" value="<?= $materialProduct->getE3() ?>" type="number" style="width: 100px; text-align:center">

                    <div>
                      <button class="btn btn-danger" onclick="deleteMaterial(<?= $product->getId() ?>,<?= $materialSelected->getId() ?>)"><i class="fas fa-trash-alt"></i></button>
                      <!-- <button class="btn btn-warning" id="btnUpdateMaterial<?= $indexMaterial ?>" value='Modifica2' onclick="updateMaterial(<?= $product->getId() ?>,<?= $materialSelected->getId() ?>,<?= $indexMaterial ?>)"><i class="fas fa-pencil-alt"></i></button> -->
                    </div>

                  </div>
                <?php $indexMaterial++;
                  $indexFactor++;
                } ?>
              </div>
              <button class="btn btn-primary ml-3" onclick="FactorMaterial()" title="Agregar un material"><i class="fas fa-plus"></i></button>
            </div>

            <hr style="width: 96%;">

            <div class="ml-5 mr-5">
              <div class="mb-5" style="text-align: center;"><b>Pestañas del producto</b></div>

              <?php
              if (count($tabs) > 0) {
                foreach ($tabs as $tab) {
              ?>
                  <div class="row align-center">
                    <div class="col-sm-6 "><?= $tab->getTitle() ?></div>
                    <div class="col-sm-3 text-center"><a class="text-center" href="update-tab-product.php?id=<?= $tab->getId() ?>">Editar <i class="fas fa-pen"></i></a></div>
                    <div class="col-sm-3 text-center"><a class="text-center" href="javascript:deleteTab(`<?= $tab->getId() ?>`)">Borrar <i class="fas fa-trash-alt"></i></a></div>
                  </div>
                  <hr>
              <?php }
              } ?>
              <a href="new-tab-product.php?id=<?= $product->getId() ?>" class="btn btn-primary"><i class="fas fa-plus"> Crear</i></a>
            </div>

            <hr style="width: 96%;">

            <div class="ml-5 mr-5">
              <div class="mt-5 mb-5" style="text-align: center;"><b>Cantidades Mínimas para Venta</b></div>
              <div class="tituloCantidades">
                <label style="text-align: center;" class="col-md-3">E1</label>
                <label style="text-align: center;" class="col-md-3">E2</label>
                <label style="text-align: center;" class="col-md-3">E3</label>
              </div>
              <?php
              if (isset($cantidad)) {
              ?>
                <div class="cantidades" id="cantidad">
                  <label for=" e1_min" class="col-md-1 alg-mar">Mínimo</label>
                  <input id="e1_min" name=" e1_min" class="form-control md-1 e1_min" value="<?= $product->getCantidad()->getE1min() ?>" type="number" style="width: 100px; text-align:center"></input>
                  <label for="e2_min " class="col-md-1 alg-mar">Mínimo</label>
                  <input id="e2_min" name="e2_min" class="form-control md-1 e2_min" value="<?= $product->getCantidad()->getE2min() ?>" type="number" style="width: 100px; text-align:center"></input>
                  <label for="e3_min" class="col-md-1 alg-mar">Mínimo</label>
                  <input id="e3_min" name="e3_min" class="form-control md-1" value="<?= $product->getCantidad()->getE3min() ?>" type="number" style="width: 100px; text-align:center"></input>
                  <label for="e1_max" class="col-md-1 alg-mar">Máximo</label>
                  <input id="e1_max" name="e1_max" class="form-control md-1" value="<?= $product->getCantidad()->getE1max() ?>" type="number" style="width: 100px; text-align:center"></input>
                  <label for="e2_max" class="col-md-1 alg-mar">Máximo</label>
                  <input id="e2_max" name="e2_max" class="form-control md-1" value="<?= $product->getCantidad()->getE2max() ?>" type="number" style="width: 100px; text-align:center"></input>
                  <label for="e3_max " class="col-md-1 alg-mar">Máximo</label>
                  <input id="e3_max" name="e3_max" class="form-control md-1" value="<?= $product->getCantidad()->getE3max() ?>" type="number" style="width: 100px; text-align:center"></input>
                </div>
              <?php }
              ?>
              <hr style="width: 96%;">

              <div class="mt-4 mb-5" style="text-align: center;"><b>Productos relacionados</b></div>
              <div class="form-gruop">
                <label class="col-2" for="campo1" style="margin-right: 240px;">Productos</label>
              </div>
              <div class="ml-5" id="productsAssoc">

                <div>
                  <select class="form-control" style="margin-bottom: 10px; width:50%" id="productoAssoc1"></select>
                </div>

              </div>
              <button class="btn btn-primary ml-3" id="addProductAssoc" title="Adicione un subproducto"><i class="fas fa-plus"></i></button>
              <!-- onclick="FactorMaterial()" -->
            </div>
            <hr style="width: 96%;">


            <div class="row" style="margin-bottom: 20px; margin-top: 60px;">
              <div class="ml-5"><a href="/admin/products" class="btn btn-danger btn-lg"><i class="fas fa-arrow-left"></i></a></div>
              <div class="col text-center"><button id="submitEditor" class="btn btn-primary btn-lg"><i class="fas fa-sync"></i> Guardar</button></div>
              <div class="col"></div>
            </div>
          </div>
          <?php include("../partials/footer.html"); ?>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->

  <!-- <script src="../assets/js/core/jquery.min.js"></script> -->
  <script src="/js/jquery-1.11.0.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="/js/jquery.nice-select.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <!-- <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
  <!-- <script src="../assets/demo/demo.js"></script> -->
  <script src="../assets/js/script.js"></script>
  <script src="/js/es.js"></script>
  <script src="/vendor/dropzone/dropzone.js"></script>
  <script src="../js/rangoCantidades.js"></script>
  <script src="../js/factores.js"></script>
  <script src="../js/imagenes.js"></script>
  <script src="../js/materiaPrima.js"></script>
  <script src="../js/medidas.js"></script>
  <script src="../js/excel.js"></script>
  <script src="../js/productos_asociados.js"></script>
  <script src="../js/categorias_productos.js"></script>
  <script src="../js/tab.js"></script>
  <script src="js/update_product.js"></script>

  <script>
    /* document.addEventListener('wheel', function(e) {
    e.preventDefault();
}, { passive: false });
/*  */

    

    function reloadPage() {
      $('#main-panel').html('')
      $('#main-panel').load('update_product.php?id=<?= $product->getId(); ?> #main-panel-child', (response, status, xhr) => {
        if (status == 'error') {
          alert('error')
        } else {
          initialize()
        }
      })
    }
  </script>

  <script>
    let editor
    let myDropzone
    let flagImage = false
    let text = `<?= $product->getDescription(); ?>`
    $('#measurements').fadeOut()

    function initialize() {
      $('.sidebar div.sidebar-wrapper ul.nav li:first').removeClass('active')
      $('#product-item').addClass('active')
      $('.imagen').height($('.imagen').parent().height())
      $('.imagen').width($('.imagen').parent().width())
      $('.imagen .info').height($('.imagen').parent().height())
      $('.imagen div.info').width($('.imagen').parent().width())
      /* $('select').niceSelect() */
      if (parseInt($('#category').val()) == 6) {
        $('.height').children('label').text('Largo:')
      }
      $('#title').val(`<?= $product->getName(); ?>`)
      Dropzone.autoDiscover = false;
      editor = new FroalaEditor('#content', {
        language: 'es',
        height: 300,
        imageUploadParam: 'photo',
        imageUploadURL: '/admin/upload.php',
        imageUploadMethod: 'POST',
        videoUploadParam: 'video',
        videoUploadURL: 'upload-video.php',
        imageUploadMethod: 'POST',
        fileUploadParam: 'file',
        fileUploadURL: '/admin/upload-file.php',
        fileUploadMethod: 'POST',
        events: {
          'image.removed': function($img) {
            img = $img[0]
            $.post('/admin/image_delete.php', {
              src: $img.attr('src')
            }, (data, status) => {
              if (status != "success") {
                alert("error")
              }
            })
          },
          'file.removed': function($file) {
            file = $file[0]
            $.post('/admin/file_delete.php', {
              src: $file.attr('src')
            }, (data, status) => {
              if (status != "success") {
                alert("error")
              }
            })
          },
          'keyup': function(keyupEvent) {
            if (document.domain != 'localhost') {
              $('.fr-wrapper>div:first-child').css('visibility', 'hidden')
            }
          }
        }
      }, () => {
        editor.html.set(text)
        if (document.domain != 'localhost') {
          $('.fr-wrapper>div:first-child').css('visibility', 'hidden')
        }
      })
      myDropzone = new Dropzone("div#myId", {
        url: "/admin/upload.php",
        method: 'post',
        paramName: 'photo',
        acceptedFiles: "image/*",
        dictDefaultMessage: 'Sube tus archivos, arrastralos o haz click para buscarlos',
        dictMaxFilesExceeded: 'Carga solo una imagen',
        dictInvalidFileType: 'Carga solo imagenes'
      })

      $('button#submitEditor').click(() => {
        if ($('#title').val() != '' && editor.html.get() != '') {
          let responses = []
          let uses = []
          let materials = []
          let measurements = []
          let materialFactor = []
          let cantidades = []

          limit = $('#fields').children().length;
          for (let index = 0; index < $('#fields').children().length; index++) {
            if (typeof($('#field' + (index + 1)).val()) != 'undefined' && $('#field' + (index + 1)).val() !== "") {
              uses.push($('#field' + (index + 1)).val())
            }
          }
          $('select').niceSelect('update')

          limit = $('#materials').children().length;

          for (let index = 0; index < $('#materials').children().length; index++) {
            let value = $('#material' + (index + 1)).val()
            let e1 = $('#e1' + (index + 1)).val()
            let e2 = $('#e2' + (index + 1)).val()
            let e3 = $('#e3' + (index + 1)).val()

            if (value != '' && typeof(value) != 'undefined' && value != null &&
              e1 != '' && typeof(e1) != 'undefined' && e1 != null &&
              e2 != '' && typeof(e2) != 'undefined' && e2 != null &&
              e3 != '' && typeof(e3) != 'undefined' && e3 != null) {

              const factor = {};
              factor.material = value;
              factor.e1 = e1;
              factor.e2 = e2;
              factor.e3 = e3;
              materialFactor.push(factor);
              materials.push(factor);
            }
          }

          let i = $('#measurements').children().length;

          for (let index = 0; index < $('#measurements').children().length; index++) {
            let measurement = {}

            measurement.codigo = $('#codigo' + (index + 1)).val()
            measurement.width = $('#width' + (index + 1)).val()
            measurement.height = $('#height' + (index + 1)).val()
            measurement.length = $('#length' + (index + 1)).val()

            if (`<?= $product->getCotizador(); ?>` == 2)
              measurement.pliego = $('#pliego' + (index + 1)).val()

            measurement.largoUtil = $('#largoUtil' + (index + 1)).val()
            measurement.anchoTotal = $('#anchoTotal' + (index + 1)).val()
            measurement.ventaMinimaGenerica = $('#VentaMinimaGenerica' + (index + 1)).val()
            measurement.ventaMinimaImpresa = $('#VentaMinimaImpresa' + (index + 1)).val()

            if (typeof($('#codigo' + (index + 1)).val()) != 'undefined' && $('#codigo' + (index + 1)).val() != '' &&
              typeof($('#width' + (index + 1)).val()) != 'undefinded' && $('#width' + (index + 1)).val() != '' &&
              typeof($('#height' + (index + 1)).val()) != 'undefined' && $('#height' + (index + 1)).val() != '' &&
              typeof($('#length' + (index + 1)).val()) != 'undefined' && $('#length' + (index + 1)).val() != '' &&
              typeof($('#largoUtil' + (index + 1)).val()) != 'undefined' && $('#largoUtil' + (index + 1)).val() != '' &&
              typeof($('#anchoTotal' + (index + 1)).val()) != 'undefined' && $('#anchoTotal' + (index + 1)).val() != '' &&
              typeof($('#VentaMinimaGenerica' + (index + 1)).val()) != 'undefined' && $('#VentaMinimaGenerica' + (index + 1)).val() != '' &&
              typeof($('#VentaMinimaImpresa' + (index + 1)).val()) != 'undefined' && $('#VentaMinimaImpresa' + (index + 1)).val() != '') /* && */
              measurements.push(measurement)

          }

          /* cantidades del producto */

          let cantidad = {}
          cantidad.e1min = $('#e1_min').val();
          cantidad.e1max = $('#e1_max').val();
          cantidad.e2min = $('#e2_min').val();
          cantidad.e2max = $('#e2_max').val();
          cantidad.e3min = $('#e3_min').val();
          cantidad.e3max = $('#e3_max').val();
          cantidades.push(cantidad);


          /* productos asociados */
          let productsAssoc = []
          for (let i = 1; i <= $('#productsAssoc').children().length; i++) {
            let prodAssoc = $(`#productoAssoc${i}`).val();
            if (prodAssoc != null) productsAssoc.push($(`#productoAssoc${i}`).val())
          }


          if (myDropzone.getAcceptedFiles().length > 0) {
            let responses = []
            myDropzone.getAcceptedFiles().forEach(image => {
              let response = JSON.parse(image.xhr.responseText)
              responses.push(response.link)
            })
            value = checkCategory();
            if (value == 'false') return false
            ajax(responses, uses, materials, measurements, materialFactor, cantidades, productsAssoc)
          } else {
            value = checkCategory();
            if (value == 'false') return false
            update(uses, materials, measurements, materialFactor, cantidades, productsAssoc)
          }
        } else {
          $.notify({
            message: 'Ingrese todos los campos',
            icon: 'fas fa-check-circle'
          }, {
            type: 'danger'
          })
        }
      })

      $('#btnUploadExcel').click(() => {
        $('#uploadExcel').toggle(600);
      })

      $('#hideMeasurements').click(function() {
        $('#measurements').fadeToggle()
        $(this).text(function(i, text) {
          return text === "Ocultar" ? "Ver Medidas" : "Ocultar";
        })
        $(this).toggleClass('btn-primary')
      })
    }

    $(() => {
      initialize()
    })

    $(document).ready(function() {
      let selectElement = document.querySelector(".material");
      if (selectElement == null) {
        selectElement = 1;
        return false;
      }

    });

    checkCategory = () => {
      category = $('#category').val()
      subcategory = $('#subcategory').val()
      if (category == null || subcategory == null) {
        $.notify({
          message: 'Ingrese la Categoria y Subcategoria',
          icon: 'fas fa-check-circle'
        }, {
          type: 'danger'
        })
        return 'false';
      }
    }

    function update(uses, materials, measurements, materialFactor, cantidades, productsAssoc) {

      $.post("api/update_product.php", {
        id: <?= $product->getId(); ?>,
        title: $('#title').val(),
        content: editor.html.get(),
        uses: JSON.stringify(uses),
        ref: $('#ref').val(),
        category: $('#category').val(),
        subcategory: $('#subcategory').val(),
        price: $('#price').val(),
        cotizador: $('#cotizador').val(),
        materials: JSON.stringify(materials),
        measurements: JSON.stringify(measurements),
        materialFactors: materialFactor,
        cantidades: JSON.stringify(cantidades),
        productsAssoc: productsAssoc,
      }, (data, status) => {
        location.reload();
        text = editor.html.get()
        $.notify({
          message: 'Producto actualizado',
          icon: 'fas fa-check-circle'
        }, {
          type: 'success'
        })
      })
    }

    function ajax(responses, uses, materials, measurements, materialFactor, cantidades, productsAssoc) {

      $.post("api/update_product.php", {
        id: <?= $product->getId(); ?>,
        title: $('#title').val(),
        content: editor.html.get(),
        photos: JSON.stringify(responses),
        uses: JSON.stringify(uses),
        ref: $('#ref').val(),
        category: $('#category').val(),
        subcategory: $('#subcategory').val(),
        price: $('#price').val(),
        cotizador: $('#cotizador').val(),
        materials: JSON.stringify(materials),
        measurements: JSON.stringify(measurements),
        materialFactors: JSON.stringify(materialFactor),
        cantidades: JSON.stringify(cantidades),
        productsAssoc: productsAssoc,
      }, (data, status) => {
        reloadPage()
        text = editor.html.get()

        $.notify({
          message: 'Producto actualizado',
          icon: 'fas fa-check-circle'
        }, {
          type: 'success'
        })
      })
    }
  </script>
  <script>
    indexField = <?= --$indexField; ?>;
    indexMeasurement = <?= --$indexMeasurement; ?>;
    indexMaterial = <?= --$indexMaterial; ?>;
    indexFactor = <?= --$indexFactor; ?>;

    function addField() {
      indexField++;
      $('#fields').append(`<div class="col-sm-4">
                      Uso ${indexField}:<input type="text" id="field${indexField}" class="form-control">
                    </div>`)
    }


    $(document).ready(function() {
      let cot = <?= $product->getCotizador(); ?>

      if (cot == 1)
        $('.pliego').hide();
      else
        $('.pliego').show();

    });

    function addEvaluateMeasurement() {
      let cot = <?= $product->getCotizador(); ?>

      if (cot == 1)
        addMeasurement();
      else
        addMeasurement2();
    }

    function addMeasurement() {
      $('#measurements').slideDown();
      indexMeasurement++;
      $("#measurements").append(`
        
      <li>Medida ${indexMeasurement}:
        <div class="row">
          <div class="col codigo"><label for="codigo${indexMeasurement}">Codigo:</label><input type="text" id="codigo${indexMeasurement}" class="form-control"></div>
          <div class="col"><label for="width${indexMeasurement}">Ancho:</label><input type="number" id="width${indexMeasurement}" class="form-control"></div>
          <div class="col height"><label for="height${indexMeasurement}">Alto:</label><input type="number" id="height${indexMeasurement}" class="form-control"></div>
          <div class="col length"><label for="length${indexMeasurement}">Largo:</label><input type="number" id="length${indexMeasurement}" class="form-control"></div>
          <div class="col largoUtil"><label for="">Largo Útil</label><input type="number" id="largoUtil${indexMeasurement}" value="" class="form-control" value="0"></div>
        </div>
          
        <div class="row">
          <div class="col-2 anchoTotal"><label for="">Ancho Total</label><input type="number" id="anchoTotal${indexMeasurement}" value="" class="form-control" value="0"></div>
          <div class="col-2 venta-minima-impresa"><label for="">Vta Min Impresa</label><input type="number" id="VentaMinimaImpresa${indexMeasurement}" class="form-control" value="0"></div>
          <div class="col-2 venta-minima-generica"><label for="">Vta Min Genérica</label><input type="number" id="VentaMinimaGenerica${indexMeasurement}" class="form-control" value="0"></div>
        </div>
       
      </li>`);
      if (parseInt($("#category").val()) == 6) {
        $(".height").children("label").text("Largo:");
        $(".length").css("display", "none");
        $(".window").css("display", "none");
        $(`#lenght${indexMeasurement}`).val(0);
        $(`#window${indexMeasurement}`).val(0);
      }
    }


    function FactorMaterial() {
      indexMaterial++;
      $('#materials').append(`
    
    <div class="row"> 
          <select class="form-control" style="margin-bottom: 10px; width: 30%" id="material${indexMaterial}">
            <option disabled selected>Seleccione un material</option>
          <?php
          foreach ($materials as  $material) { ?>
              <option value="<?= $material->getId(); ?>"><?= $material->getName(); ?></option>
          <?php } ?>
          </select>  
           
            <input class="col md-4 form-control ml-5 mr-5" id="e1${indexMaterial}" type="number" style="width:100px; text-align:center">
            <input class="col md-4 form-control mr-5" id="e2${indexMaterial}" type="number" style="width:100px; text-align:center">
            <input class="col md-4 form-control mr-5" id="e3${indexMaterial}" type="number" style="width:100px; text-align:center">
          </div>`);

    }
  </script>
  <script src="/vendor/bootstrap-notify.min.js"></script>
  <script src="/vendor/sleep.js"></script>
</body>

</html>