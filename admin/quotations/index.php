<!-- author: Teenus SAS, github: Teenus SAS -->
<?php
include("../partials/verify-session.php");
require_once dirname(dirname(__DIR__)) . "/dao/QuotationDao.php";
require_once dirname(dirname(__DIR__)) . "/dao/AdminDao.php";
$quotationDao = new QuotationDao();
$adminDao = new AdminDao();
$quotations = $quotationDao->findAll();
$quotationsSolved = $quotationDao->findSolved();
$quotationsNoSolved = $quotationDao->findNoSolved();
$admin = unserialize($_SESSION["admin"]);
if ($admin->getRole() != 2) {
  header("Location: quotations.php");
}
?>
<!doctype html>
<html lang="es">

<head>
  <title>Cotizaciones | Greenpack</title>
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
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type='text/css' />

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.css">
  <style>
    td.highlight {
      background-color: whitesmoke !important;
    }
  </style>
  <link rel="stylesheet" href="/css/spinner.css">

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
            <li class="breadcrumb-item active">Cotizaciones</li>
          </ol>
          <!-- end breadcrumb -->

          <!-- tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color: #168c8c;">
            <li class="nav-item">
              <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Todas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="solved-tab" data-toggle="tab" href="#solved" role="tab" aria-controls="solved" aria-selected="false">Solucionadas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="no-solved-tab" data-toggle="tab" href="#no-solved" role="tab" aria-controls="no-solved" aria-selected="false">No solucionadas</a>
            </li>
          </ul>
          <!-- end tabs -->
          <!-- content tabs -->
          <div class="tab-content">
            <div class="fade tab-pane show active" id="all" role="tabpanel" aria-labelledby="all-tab">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                  Registros
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table row-border table-bordered dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th class="text-center">Id</th>
                          <th class="text-center">Nombre</th>
                          <th class="text-center">Apellido</th>
                          <th class="text-center">Empresa</th>
                          <th class="text-center">Precio</th>
                          <th class="text-center">Fecha</th>
                          <th class="text-center">Ver Cotizacion</th>
                          <th class="text-center">Editar</th>
                          <th class="text-center">Descargar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($quotations as $quotation) { ?>
                          <tr>
                            <td><?php echo $quotation->getId(); ?></td>
                            <td><?php echo $quotation->getNameClient(); ?></td>
                            <td><?php echo $quotation->getLastNameClient(); ?></td>
                            <td class="text-center"><?php echo $quotation->getCompany() == "" ? "N/A" : $quotation->getCompany(); ?> </td>
                            <td class="text-center money"><?= $quotation->calculateTotal(); ?></td>
                            <td class="text-center sorting_1"><span style="display: none"><?= date($quotation->getCreatedAt()); ?></span><?= date("d-m-Y", $quotation->getCreatedAt()); ?></td>
                            <td class="text-center"><a class="text-center" href="javascript:viewPdf(`<?= $quotation->getId(); ?>`)" title="Ver Aqui"><i class="material-icons">remove_red_eye</i> <a href="#" onclick="openWindow(`<?= $quotation->getId(); ?>`)" title="Ver en nueva Ventana"><i class="material-icons">featured_video</i></a></td>
                            <td class="text-center"><a href="edit-quotation.php?id=<?= $quotation->getId() ?>"><i class="fas fa-pen"></i></a></td>
                            <td class="text-center"><a class="text-center" target="_blank" href="/services/download-quotation.php?id=<?= $quotation->getId(); ?>"><i class="fas fa-fw fa-download"></a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="fade tab-pane" id="solved" role="tabpanel" aria-labelledby="solved-tab">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                  Cotizaciones Solucionadas
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table row-border table-bordered hover dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th id="thId-second" class="text-center">Id</th>
                          <th class="text-center">Nombre</th>
                          <th class="text-center">Apellido</th>
                          <th class="text-center">Empresa</th>
                          <th class="text-center">Precio</th>
                          <th class="text-center">Fecha</th>
                          <th class="text-center">Vendedor</th>
                          <th class="text-center">Ver Cotizacion</th>
                          <th class="text-center">Editar</th>
                          <th class="text-center">Descargar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($quotationsSolved as $quotation) {
                          $admin = $adminDao->findById($quotation->getIdAdminSolved()); ?>
                          <tr>
                            <td><?= $quotation->getId(); ?></td>
                            <td><?= $quotation->getNameClient(); ?></td>
                            <td><?= $quotation->getLastNameClient(); ?></td>
                            <td class="text-center"><?= $quotation->getCompany() == "" ? "N/A" : $quotation->getCompany(); ?> </td>
                            <td class="text-center money"><?= $quotation->calculateTotal(); ?></td>
                            <td class="text-center"><?= date("d-m-Y", $quotation->getCreatedAt()); ?></td>
                            <td class="text-center "><?= $admin->getName(); ?> <?= $admin->getLastName() ?></td>
                            <td class="text-center"><a class="text-center" onclick="viewPdf(`<?= $quotation->getId(); ?>`)" href="#load_pdf" title="Ver Aqui"><i class="material-icons">remove_red_eye</i> <a href="#" onclick="openWindow(`<?= $quotation->getId(); ?>`)" title="Ver en nueva Ventana"><i class="material-icons">featured_video</i></a></td>
                            <td class="text-center"><a href="edit-quotation.php?id=<?= $quotation->getId() ?>"><i class="fas fa-pen"></i></a></td>
                            <td class="text-center"><a class="text-center" target="_blank" href="/services/download-quotation.php?id=<?php echo $quotation->getId(); ?>"><i class="fas fa-fw fa-download"></a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="fade tab-pane" id="no-solved" role="tabpanel" aria-labelledby="no-solved-tab">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                  Cotizaciones No Solucionadas
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table row-border table-bordered hover dataTable" width="100%" cellspacing="0" id="table-no-solved">
                      <thead>
                        <tr>
                          <th id="thId-third" class="text-center">Id</th>
                          <th class="text-center">Nombre</th>
                          <th class="text-center">Apellido</th>
                          <th class="text-center">Empresa</th>
                          <th class="text-center">Precio</th>
                          <th class="text-center">Fecha</th>
                          <th class="text-center">Ver Cotizacion</th>
                          <th class="text-center">Editar</th>
                          <th class="text-center">Descargar</th>
                          <th class="text-center">Enviar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($quotationsNoSolved as $quotation) { ?>
                          <tr>
                            <td><?php echo $quotation->getId(); ?></td>
                            <td><?php echo $quotation->getNameClient(); ?></td>
                            <td><?php echo $quotation->getLastNameClient(); ?></td>
                            <td class="text-center"><?php echo $quotation->getCompany() == "" ? "N/A" : $quotation->getCompany(); ?> </td>
                            <td class="text-center money"><?php echo $quotation->calculateTotal(); ?></td>
                            <td class="text-center"><?= date("d-m-Y", $quotation->getCreatedAt()); ?></td>
                            <td class="text-center"><a class="text-center" href="javascript:viewPdf(`<?= $quotation->getId(); ?>`)" title="Ver Aqui"><i class="material-icons">remove_red_eye</i> <a href="#" onclick="openWindow(`<?= $quotation->getId(); ?>`)" title="Ver en nueva Ventana"><i class="material-icons">featured_video</i></a></td>
                            <td class="text-center"><a href="edit-quotation.php?id=<?= $quotation->getId() ?>"><i class="material-icons">create</i></a></td>
                            <td class="text-center"><a class="text-center" target="_blank" title="descargar" href="/services/download-quotation.php?id=<?php echo $quotation->getId(); ?>"><i class="material-icons">cloud_download</a></td>
                            <td class="text-center"><a class="text-center" href="javascript:sentEmail(`<?php echo $quotation->getId(); ?>`)"><i class="material-icons">email</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div id="load_pdf">
        </div>
        <?php include("../partials/footer.html"); ?>

      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalContentEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cuerpo del Mensaje</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="content"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" onclick="send()" id="btn-send-email" class="btn btn-primary">Enviar</button>
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
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/vendor/jquery.formatCurrency-1.4.0.min.js"></script>
    <script src="/vendor/jquery.formatCurrency.all.js"></script>
    <script src="/js/spinner.js"></script>
    <script src="/vendor/froala_editor.pkgd.min.js"></script>
    <script src="/js/es.js"></script>
    <script src="js/quotations.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.js"></script>
</body>

</html>