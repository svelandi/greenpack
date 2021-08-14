<?php
require_once dirname(dirname(__DIR__)) . "/dao/QuotationDao.php";
include("../partials/verify-session.php");
$quotationDao = new QuotationDao();
$adminDao = new AdminDao();
if (!isset($_GET["id"])) {
  header("Location: /admin/materials");
}
$quotation = $quotationDao->findById($_GET["id"]);
if (isset($_GET["id"])) {
  $admin = $adminDao->findById($quotation->getIdAdminAssigned());
}
?>
<!-- author: Teenus SAS, github: Teenus SAS -->
<!doctype html>
<html lang="es">

<head>
  <title>Cotizacion No <?= $quotation->getId() ?> | Greenpack</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" href="/css/all.min.css">
  <!-- Page level plugin CSS-->
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/modal-confirm.css">
  <!-- Include Editor style. -->
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type='text/css' />
  <style>
    .alert-price {
      display: none;
    }
  </style>
</head>

<body class="white-edition">
  <div class="wrapper ">
    <?php include("../partials/sidebar.php"); ?>
    <div class="main-panel">
      <?php include("../partials/navbar.php");  ?>
      <div class="content">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a href="/admin/quotations">Cotizaciones</a></li>
            <li class="breadcrumb-item active">Editar Cotizacion</li>
          </ol>
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nameClient" class="bmd-label-floating">Nombres</label>
                  <input type="text" class="form-control" id="nameClient" value="<?= $quotation->getNameClient() ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="lastName" class="bmd-label-floating">Apellidos</label>
                  <input type="text" class="form-control" id="lastName" value="<?= $quotation->getLastNameClient() ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="company" class="bmd-label-floating">Empresa</label>
                  <input type="text" class="form-control" id="company" value="<?= $quotation->getCompany() ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="city" class="bmd-label-floating">Ciudad</label>
                  <input type="text" class="form-control" id="city" value="<?= $quotation->getCity() ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="address" class="bmd-label-floating">Dirección</label>
                  <input type="text" class="form-control" id="address" value="<?= $quotation->getAddress() ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="emailClient" class="bmd-label-floating">Correo Electronico</label>
                  <input type="email" class="form-control" id="emailClient" value="<?= $quotation->getEmail() ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label for="extraInformation">Observaciones:</label>
                <textarea class="form-control" id="extraInformation" rows="3"></textarea>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="phone" class="bmd-label-floating">Teléfono</label>
                  <input type="text" class="form-control" id="phone" value="<?= $quotation->getPhoneNumber() ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="cellphone" class="bmd-label-floating">Celular</label>
                  <input type="text" class="form-control" id="cellphone" value="<?= $quotation->getCellPhoneNumber() ?>">
                </div>
              </div>
            </div>
            <div class="card" id="products">
              <?php foreach ($quotation->getItems() as $item) {
                if ($item->getPrice() == 1) { ?>
                  <div class="alert alert-danger" role="alert">
                    Revisar con el cliente!!! Los rangos de cantidades están fuera de los límites de producción.
                  </div>
              <?php }
              } ?>
              <?php foreach ($quotation->getItems() as $item) { ?>
                <div class="row align-items-center">
                  <div class="col-md-2 text-center"><img src="<?= $item->getProduct()->getImages()[0]->getUrl() ?>" alt="" width="150" height="150"></div>
                  <div class="col-md-3 align-self-center mt-3">
                    <h5><b><?= $item->getProduct()->getName() ?></b></h5>
                    <br>
                    <p><span class="text-primary">Impresión:</span> <?= $item->isPrinting() ? "SI" : "NO" ?></p>
                    <?php if ($item->getProduct()->getCategory()->getId() == 1  && $item->getProduct()->getId() != $_ENV["id_sacos"]) { ?>
                      <!-- <p><span class="text-primary">Ventanilla:</span> <?= $item->isPla() ? "SI" : "NO" ?></p>
                      <p><span class="text-primary">Laminada:</span> <?= $item->isLam() ? "SI" : "NO" ?></p> -->
                      <p><span class="text-primary">Material:</span> <?= $item->getMaterial()->getName() ?></p>
                      <?php } else {
                      if ($item->getProduct()->getCategory()->getId() == 2 || $item->getProduct()->getCategory()->getParentcategory() == 2) {
                        if ($item->isPrinting()) { ?>
                          <p><span class="text-primary">Número de tintas:</span> <?= $item->getNumberInks() ?></p>
                      <?php }
                      } ?>
                      <p><span class="text-primary">Tipo de Producto:</span> <?= $item->getTypeProduct() ?></p>
                      <p><span class="text-primary">Material: <select class="form-control select-option-material" id="<?= $item->getId() ?>"><?php foreach ($item->getProduct()->getMaterials() as  $material) { ?>
                              <option <?= $item->getMaterial() == $material ? "selected" : "" ?> value="<?= $material->getId() ?>"><?= $material->getName() ?></option>
                            <?php } ?>
                          </select></p>
                    <?php } ?>

                    <p><span class="text-primary">Medidas:</span></p>
                    <p>
                    <ul class="measurements list-inline">
                      <li class="list-inline-item"><span class="text-primary">Ancho:</span> <?= $item->getMeasurement()->getWidth() ?></li>
                      <li class="list-inline-item"><span class="text-primary"><?= ($item->getProduct()->getCategory()->getId() == 1 ? "Fuelle" : $item->getProduct()->getCategory()->getId() == 6) ? 'Largo' : 'Alto' ?>:</span> <?= $item->getMeasurement()->getHeight() ?></li>
                      <?php if ($item->getProduct()->getCategory()->getId() != 6) { ?>
                        <li class="list-inline-item"><span class="text-primary">Largo:</span> <?= $item->getMeasurement()->getLength() ?></li>
                      <?php } ?>
                    </ul>
                    </p>
                    <?php if ($item->getProduct()->getCategory()->getId() != 1) { ?>
                      <p><span class="text-primary">Observaciones:</span> <?= $item->getObservations() ?></p>
                    <?php } ?>
                  </div>
                  <div class="col-md-2">
                    <p><span class="text-primary">Cantidad:</span></p>
                    <p><input type="number" id="quantity<?= $item->getId() ?>" value="<?= $item->getQuantity() ?>" class="form-control quantity"></p>
                  </div>
                  <div class="col-md-2">
                    <p><span class="text-primary">Precio:</span></p>
                    <p><input type="number" id="price<?= $item->getId() ?>" value="<?= $item->getPrice() ?>" class="form-control price"></p>
                  </div>
                  <div class="col">
                    <p><span class="text-primary">Total:</span></p>
                    <p class="money" id="total<?= $item->getId() ?>"><?= $item->calculateTotal() ?></p>
                  </div>
                </div>
                <div id="priceHelp<?= $item->getId() ?>" class="alert-price">

                </div>
                <hr>
              <?php } ?>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="payment-conditions">Condiciones de pago</label>
                      <textarea id="payment-conditions" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="delivery-time">Tiempos de envio</label>
                      <textarea id="delivery-time" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="validity">Vigencia</label>
                      <textarea id="validity" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row" style="margin-bottom: 20px; margin-top: 20px;">
              <!-- <div class="col text-center"><a class="btn btn-danger btn-lg" href="/admin/quotations/#no-solved"><i class="material-icons">arrow_back</i></a></div> -->
              <div class="col text-center"><button onclick="recalculate()" class="btn btn-info btn-lg"><i class="material-icons">trending_up</i> Recalcular Precios</button></div>
              <div class="col text-center"><button onclick="update()" class="btn btn-info btn-lg"><i class="material-icons md-48">update</i> Actualizar</button></div>
              <div class="col text-center"><a class="btn btn-primary btn-lg" href="<?= $file = "http://" . $_SERVER["HTTP_HOST"] . "/services/generate-quotation.php?id=" . $_GET["id"]; ?>" role="button" target="_blank"><i class="far fa-eye"></i> Ver Cotización</a> </div>
              <div class="col text-center"><button onclick="$('#modalContentEmail').modal()" class="btn btn-primary btn-lg"><i class="material-icons">email</i> Enviar Cotización</button></div>
            </div>
          </div>
        </div>
        <label id="vendedor" hidden><?= $admin->getName() ?> <?= $admin->getLastName() ?></label>
        <label id="email" hidden><?= $admin->getEmail() ?></label>
        <label id="cotiz" hidden><?= $file = "http://" . $_SERVER["HTTP_HOST"] . "/services/generate-quotation.php?id=" . $_GET["id"]; ?></label>
        <!-- <div id="load_pdf"> -->
      </div>
      <?php include("../partials/footer.html"); ?>
    </div>
  </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modalContentEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" onclick="send()" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="/js/jquery-2.2.4.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <!-- <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- <script src="../assets/demo/demo.js"></script> -->
  <script src="../assets/js/script.js"></script>
  <script src="/vendor/jquery.formatCurrency-1.4.0.min.js"></script>
  <script src="/vendor/jquery.formatCurrency.all.js"></script>
  <script src="/vendor/froala_editor.pkgd.min.js"></script>
  <script src="/js/es.js"></script>
  <script src="js/quotationsinfo.js"></script>
  <script>
    $(() => {
      $('.sidebar div.sidebar-wrapper ul.nav li:first').removeClass('active')
      $('#quotations-item').addClass('active')
      $('#extraInformation').val(`<?= $quotation->getExtraInformation() ?>`)
      $('#payment-conditions').val(`<?= $quotation->getPaymentConditions() ?>`)
      $('#delivery-time').val(`<?= $quotation->getDeliveryTime() ?>`)
      $('#validity').val(`<?= $quotation->getValidity() ?>`)
      $('#load_pdf').html('')
      $('#load_pdf').append(`<embed  src="/services/view-quotation.php?id=<?= $quotation->getId() ?>#toolbar=0&navpanes=0&scrollbar=0&statusbar=0&zoom=55" type="application/pdf" width="100%" height="600px" />`)
      formatMoney()
      $('.price').keyup(function() {
        let id = $(this).context.id.substring(5, $(this).context.id.length)

      })
      $('.quantity').keyup(function() {
        let id = $(this).context.id.substring(8, $(this).context.id.length)
        eventChangeValuesItem(id)
      })
      $('.price').change(function() {
        let id = $(this).context.id.substring(5, $(this).context.id.length)
        eventChangeValuesItem(id)
      })
      $('.quantity').change(function() {
        let id = $(this).context.id.substring(8, $(this).context.id.length)
        eventChangeValuesItem(id)
      })

    })


    function send() {
      update()
      $('#modalContentEmail').modal('hide')
      $.notify({
        message: 'Enviando Correo',
        //title: 'Greenpack',
        icon: 'email'
      }, {
        type: 'info'
      })
      $.post('api/sent_email.php', {
        id: `<?= $quotation->getId() ?>`,
        content: editor.html.get()
      }, (data, status, xhr) => {
        if (status == 'success' && xhr.readyState == 4) {
          $.notify({
            message: 'Cotización enviada',
            icon: 'email'
          }, {
            type: 'success'
          })
        }
      })
    }

    function update() {
      let products = []
      $.each($('.price'), function() {
        let id = $(this).context.id.substring(5, $(this).context.id.length)
        let product = {}
        product.price = $(this).val()
        product.quantity = $(`#quantity${id}`).val()
        product.material = $('#' + id).val()
        products.push(product)
      })
      $.post('api/update-quotation.php', {
        id: `<?= $quotation->getId() ?>`,
        name: $('#nameClient').val(),
        lastname: $('#lastName').val(),
        company: $('#company').val(),
        city: $('#city').val(),
        address: $('#address').val(),
        email: $('#emailClient').val(),
        extra: $('#extraInformation').val(),
        phone: $('#phone').val(),
        cellphone: $('#cellphone').val(),
        products: JSON.stringify(products),
        paymentConditions: $('#payment-conditions').val(),
        deliveryTime: $('#delivery-time').val(),
        validity: $('#validity').val()
      }, (data, status) => {
        if (status == 'success') {
          $.notify({
            message: 'Cotización actualizada',
            icon: 'notification_important'
          }, {
            type: 'success'
          })
          viewPdf(`<?= $quotation->getId() ?>`)
        }
        if (status == 'notmodified') {
          $.notify({
            message: 'No se ha cambiado ningun valor',
            icon: 'warning'
          }, {
            type: 'warning'
          })
        }
      })
    }
  </script>
</body>

</html>