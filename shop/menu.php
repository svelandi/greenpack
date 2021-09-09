<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Greenpack | Productos</title>
  <?php include('../partials/metaproperties.html') ?>
  <link rel="stylesheet" href="/css/all.min.css">
  <link rel="stylesheet" href="/css/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="/css/linericon/style.css">
  <link rel="stylesheet" href="/css/nice-select/nice-select.css">
  <link rel="stylesheet" href="/css/nouislider/nouislider.min.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="/css/linearicons.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <!-- <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/magnific-popup.css">
  <link rel="stylesheet" href="/css/animate.min.css">
  <link rel="stylesheet" href="/css/owl.carousel.css">
  <link rel="stylesheet" href="/css/main.min.css">
  <link rel="stylesheet" href="/css/back-top.css">
  <link rel="stylesheet" href="/css/footer.css">
  <link rel="stylesheet" href="/css/spinner.css">
  <link rel="stylesheet" href="/css/solid.min.css">
  <link rel="stylesheet" href="/css/all.min.css">
  <link rel="stylesheet" href="/css/style-blog.css">
  <link rel="stylesheet" href="/css/style-accordion.css">
  <link rel="stylesheet" href="/css/basket.css">
  <link rel="stylesheet" href="/css/translate.css">
  <link rel="stylesheet" href="/css/style-shop.css">
  <script src="/js/spinner.js"></script>
  <style>
    @media(max-width: 600) {
      #container-image {
        background-attachment: scroll !important;
        background-size: contain !important;
      }
    }

    @media(min-width: 1024px) {
      #container-image {
        background-attachment: fixed !important;
      }

      .sticky-wrapper {
        height: 0 !important;
      }
    }

    .box {
      background: lightgray;
      border-radius: 1em;
      width: 60%;
      padding: 20px;
      position: relative;
      top: 250px;
      left: 480px;
      z-index: 2000;
      opacity: 0.9;
    }

    .menu {
      position: fixed;
      left: 0;
      top: 200px;
      z-index: 2000;
    }

    .menu ul {
      list-style: none;
    }

    .menu ul li {
      margin-top: 5px;
    }

    .menu ul li a {
      /* display: inline-block; */
      color: white;
      background: green;
      padding: 10px;
      border-radius: 0px 10px 10px 0px;
      width: 200px;
      font-size: 20px;

    }

    .menu ul li a:hover {
      padding: 10px 30px;
    }

    #container-image {
      background-size: cover !important;
      background-position: center;
      -webkit-background-size: cover !important;
      -moz-background-size: cover !important;
      -o-background-size: cover !important;
      background-size: cover !important;
      background-attachment: fixed;
      height: 100%;
      width: 100%;
      text-align: center;
    }

    /* .transition {
      -webkit-transform: scale(2);
      -moz-transform: scale(2);
      -o-transform: scale(2);
      transform: scale(2);
    } */

    .blog-banner-area::after {
      background: #fff !important;
    }

    .card-product__title {
      font-size: 16px;
    }

    .blog-banner div.text-center:first {
      margin: auto;
      width: 50%;
      background: #333333c2;
      color: #fff !important;
      height: auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .blog-banner div.text-center h1 {
      /* color: #fff !important; */
      color: black;
    }

    @media (max-width: 400px) {
      .blog-banner div.text-center:first h1 {
        font-size: 14px;
      }

      #title-category {
        font-size: 20px !important;

      }
    }
  </style>
</head>

<body>

  <?php
  require_once(dirname(__DIR__) . "/dao/ProductDao.php");
  require_once(dirname(__DIR__) . "/dao/CategoryDao.php");
  require_once(dirname(__DIR__) . "/db/env.php");
  $productDao = new ProductDao();
  $categoryDao = new CategoryDao();
  if (!$_GET) {
    header("Location: category.php?id=1&page=1");
  }
  if (!isset($_GET["page"])) {
    header("Location: category.php?id=" . $_GET['id'] . "&page=1");
  }
  $productsperPage = 8;
  $pages = ceil(count($productDao->findByCategory($_GET["id"])) / $productsperPage);
  $pageInit = ($_GET["page"] - 1) * $productsperPage;
  $category = $categoryDao->findById($_GET["id"]);
  $categories = $categoryDao->findAll();
  echo "<script>let ii='" . json_encode($categories) . "'</script>";
  ?>
  <?php include("../partials/fixed-quoting.html"); ?>
  <div class="wall-loading">
    <div class="lds-roller">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <div style="background-color: black; height: 81px;"></div>
  <?php include('../partials/header_1.html'); ?>

  <!-- ================ start banner area ================= -->
  <section class="blog-banner-area" id="category">
    <div class="container zoom" style="background: url(<?= $category->getImage() ?>) no-repeat center;" id="container-image">
      <div class="">
        <h4 class="box box0" style="margin:13px">Bolsas para repostería, dulces o chocolates. fabricadas con cartón Earth Pact, 100% en
          fíbra de caña de azúcar, este es un material resistente, reciclable y biodegradable, el cual
          puede ser laminado con PLA (Ácido Poliláctico a base de maíz), material que también es
          usado en las ventanas de la caja para que tu producto sea visible.</h4>
        <h4 class="box box1" style="margin:13px">Cajas1 para repostería, dulces o chocolates. fabricadas con cartón Earth Pact, 100% en
          fíbra de caña de azúcar, este es un material resistente, reciclable y biodegradable, el cual
          puede ser laminado con PLA (Ácido Poliláctico a base de maíz), material que también es
          usado en las ventanas de la caja para que tu producto sea visible.</h4>
        <h4 class="box box2" style="margin:13px">Cajas2 para repostería, dulces o chocolates. fabricadas con cartón Earth Pact, 100% en
          fíbra de caña de azúcar, este es un material resistente, reciclable y biodegradable, el cual
          puede ser laminado con PLA (Ácido Poliláctico a base de maíz), material que también es
          usado en las ventanas de la caja para que tu producto sea visible.</h4>
        <h4 class="box box3" style="margin:13px">Cajas3 para repostería, dulces o chocolates. fabricadas con cartón Earth Pact, 100% en
          fíbra de caña de azúcar, este es un material resistente, reciclable y biodegradable, el cual
          puede ser laminado con PLA (Ácido Poliláctico a base de maíz), material que también es
          usado en las ventanas de la caja para que tu producto sea visible.</h4>
      </div>
    </div>
  </section>

  <div class="menu">
    <ul>
      <li><a href="http://greenpack.teenustest.com/shop/category.php?id=1&page=1" class="icon-bolsas">Bolsas</a></li>
      <li><a href="http://greenpack.teenustest.com/shop/category.php?id=46&page=1" class="icon-cajasE">Cajas Exhibir</a></li>
      <li><a href="http://greenpack.teenustest.com/shop/category.php?id=64&page=1" class="icon-cajasS">Cajas Servir</a></li>
      <li><a href="http://greenpack.teenustest.com/shop/category.php?id=69&page=1" class="icon-cajasL">Cajas Llevar</a></li>
    </ul>
  </div>

  <?php include("../partials/footer.html"); ?>

  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script>
  <script src="/js/jquery.nice-select.min.js"></script>
  <script src="/js/main-shop.js"></script>

  <script src="/js/jquery.magnific-popup.min.js"></script>
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/jquery.sticky.js"></script>
  <script src="/js/jquery.counterup.min.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/back-top.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- <script src="js/categories.js"></script> -->
  <script>
    $(document).ready(function() {
      $(`.box0`).hide();
      $(`.box1`).hide();
      $(`.box2`).hide();
      $(`.box3`).hide();

      $(`.icon-bolsas`).mouseenter(function() {
        $(`.box0`).show();
      });

      $(`.icon-cajasE`).mouseenter(function() {
        $(`.box1`).show();
      });

      $(`.icon-cajasS`).mouseenter(function() {
        $(`.box2`).show();
      });

      $(`.icon-cajasL`).mouseenter(function() {
        $(`.box3`).show();
      });

      $(`.icon-bolsas, .icon-cajasE, .icon-cajasS, .icon-cajasL`).mouseleave(function() {
        $(`.box0`).hide();
        $(`.box1`).hide();
        $(`.box2`).hide();
        $(`.box3`).hide();
      });

    });
    $(document).ready(function() {
      $('.zoom').hover(function() {
        $(this).addClass('transition');
      }, function() {
        $(this).removeClass('transition');
      });
    });
  </script>
</body>

</html>