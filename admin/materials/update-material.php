<?php
require_once dirname(dirname(__DIR__)) . "/dao/MaterialDao.php";
include("../partials/verify-session.php");
$materialDao = new MaterialDao();
if (!isset($_GET["id"])) {
  header("Location: /admin/materials");
}
$material = $materialDao->findById($_GET["id"]);
?>
<!-- author: Teenus SAS, github: Teenus SAS -->
<!doctype html>
<html lang="es">

<head>
  <title>Materiales | GreenPack</title>
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
            <li class="breadcrumb-item"><a href="/admin/materials">Materiales</a></li>
            <li class="breadcrumb-item active">Actualizar Material</li>
          </ol>
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="nameMaterial">Nombre:</label>
                  <br>
                  <input type="text" placeholder="Ej: Bond" id="nameMaterial" class="form-control" value="<?= $material->getName(); ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="pricePerKg">Precio por Kilogramo:</label>
                  <br>
                  <input type="number" id="pricePerKg" placeholder="Ej: 2000" class="form-control" value="<?= $material->getPricePerKg(); ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="grammage">Gramaje:</label>
                  <br>
                  <input type="number" id="grammage" placeholder="Ej: 60" class="form-control" value="<?= $material->getGrammage(); ?>">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <!-- <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Precio pliego 60*90</label>
                  <input type="text" name="" id="p5400" class="form-control" placeholder="" aria-describedby="helpId" value="<?= $material->p5400 ?>">
                  <small id="helpId">Solo para materiales de bolsas laminadas</small>
                </div>
              </div> -->
              <div class="col-sm-6">
                <!--  <div class="form-group">
                  <label for="">Precio pliego 70*100:</label>
                  <input type="text" name="" id="p7000" class="form-control" placeholder="" aria-describedby="helpId" value="<?= $material->p7000 ?>">
                  <small id="helpId">Solo para materiales de bolsas laminadas</small>
                </div> -->
              </div>
            </div>
            <div class="form-group">
              <label for="description">Descripcion:</label>
              <textarea id="description" class="form-control" rows="1" placeholder="Aqui puedes ingresar la descripcíon de la materia prima que estas adicionando"></textarea>
            </div>
            <br>
            <div class="row" style="margin-bottom: 20px; margin-top: 20px;">
              <div class="col"></div>
              <div class="col text-center"><button id="submitEditor" class="btn btn-primary btn-lg">Modificar</button></div>
              <div class="col"></div>
            </div>
          </div>
        </div>
        <?php include("../partials/footer.html"); ?>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="/js/jquery-2.2.4.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <!-- <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="../assets/js/script.js"></script>
  <script>
    $(() => {
      $('#description').val(`<?= $material->getDescription(); ?>`)
      $('button#submitEditor').click(() => {
        $.post('api/update_material.php', {
          id: `<?= $material->getId(); ?>`,
          name: $('#nameMaterial').val(),
          price: $('#pricePerKg').val(),
          grammage: $('#grammage').val(),
          description: $('#description').val()
        }, (data, status) => {
          if (status == 'success') {
            $.notify({
              message: 'Materia Prima actualizada',
              icon: 'fas fa-exclamation-triangle'
            }, {
              type: 'success'
            })
          }
        })
      })
    })
  </script>
  <script>
    $(() => {
      $('.sidebar div.sidebar-wrapper ul.nav li:first').removeClass('active')
      $('#material-item').addClass('active')
    })
  </script>
</body>

</html>