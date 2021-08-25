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

    /* .blog-banner div.text-center {
      margin: auto;
      width: 50%;
      background: #333333c2;
      color: #fff !important;
      height: auto;
      display: flex;
      justify-content: center;
      align-items: center;
    } */

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
    <div class="container" style="background: url(<?= $category->getImage() ?>) no-repeat center;" id="container-image">
      <div class="mt-5"> <!-- blog-banner -->
        <div class="text-center">
          <h1 id="title-category"><?= $category->getDescription() ?></h1>
        </div>
        <!-- <div class="text-center">
          <a href="#categories-section" class="btn btn-success">Tú cotización en minutos</a>
        </div> -->
      </div>
    </div>
  </section>
  <!-- ================ end banner area ================= -->


  <!-- ================ category section start ================= -->
  <section class="section-margin--small mb-5" id="categories-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Categorías</div>
            <ul class="main-categories">
              <li class="common-filter">
                <form action="#">
                  <ul>
                    <?php foreach ($categories as $catego) {
                      $categoriesChildren = $categoryDao->findChildren($catego->getId()); ?>
                      <?php if (count($categoriesChildren) > 0) { ?>
                        <li class="filter-list text-capitalize"><a href="#<?= $catego->getId() ?>" class="accordion" data-toggle="collapse" data-parent="#accordion"><?= $catego->getName() ?></a>
                          <ul id="<?= $catego->getId() ?>" class="category collapse">
                            <?php foreach ($categoriesChildren as  $cat) { ?>
                              <li class="child-category text-capitalize"><a id="<?= $cat->getId() ?>" href="category.php?id=<?= $cat->getId() ?>&page=1"><?= $cat->getName() ?> <span> (<?= count($productDao->findByCategory($cat->getId())); ?>)</span></a></li>
                            <?php }
                            ?>
                          </ul>
                        </li>
                        <?php } else {
                        if ($catego->getParentCategory() == null || $catego->getId() == 1) { ?>
                          <li class="filter-list text-capitalize"><a href="category.php?id=<?= $catego->getId() ?>&page=1"><?= $catego->getName() ?> <span> (<?= count($productDao->findByCategory($catego->getId())); ?>)</span></a>
                          </li>
                        <?php } ?>

                      <?php } ?>
                    <?php } ?>
                  </ul>
                </form>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <div class="sorting mr-auto">
            </div>
            <div>
              <div class="input-group filter-bar-search mr-auto">
                <input class="form-control" type="text" placeholder="Buscar" id="in-search">
                <div class="input-group-append">
                  <button class="btn" type="button" id="btn-search"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- End Filter Bar -->


          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row" id="products">
              <?php
              $id = $_GET["id"];
              $products = $productDao->findByCategoryWithLimit($_GET["id"], $pageInit, $productsperPage);
              if (!$products)
                $products = $productDao->findByCategoryWith($pageInit, $productsperPage);
              foreach ($products as $product) { ?>
                <div class="col-lg-3">
                  <div class="card text-center card-product zoom-in">
                    <div class="card-product__img">
                      <img class="card-img" src="<?= $product->getImages()[0]->getUrl(); ?>">
                      <ul class="card-product__imgOverlay">
                        <li><a href="product.php?id=<?= $product->getId() ?>"><i class="ti-search"></i> Cotizar</a></li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <!-- <p><?php
                              //echo strtoupper($product->getCategory()->getName());
                              ?></p> -->
                      <h4 class="card-product__title"><a href="product.php?id=<?= $product->getId() ?>"><?= $product->getName(); ?></a></h4>
                      <!-- <p class="card-product__price">$<?= $product->getPrice(); ?></p> -->
                    </div>
                  </div>
                </div>
              <?php
              } ?>
            </div>

            <!-- row -->
            <div class="row" id="pagination">

              <!-- pagination -->
              <div class="col-md-12">
                <div class="post-pagination">
                  <a href="category.php?id=<?= $_GET["id"]; ?>&page=<?= $_GET["page"] - 1 < 1 ? 1 : $_GET["page"] - 1 ?>#products" class="pagination-back pull-left btn <?= $_GET["page"] <= 1 ? "disabled" : ""; ?>">Anterior</a>
                  <ul class="pages">
                    <?php
                    for ($i = 0; $i < $pages; $i++) {
                      if ($_GET["page"] == $i + 1) {
                        echo "<li class='active'><a href='category.php?id=" . $_GET["id"] . "&page=" . ($i + 1) . "#products'>" . ($i + 1) . "</a></li>";
                      } else {
                        echo "<li><a href='category.php?id=" . $_GET["id"] . "&page=" . ($i + 1) . "#products'>" . ($i + 1) . "</a></li>";
                      }
                    }
                    ?>
                  </ul>
                  <a href="category.php?id=<?= $_GET["id"]; ?>&page=<?= $_GET["page"] + 1 >= $pages ? $pages : $_GET["page"] + 1 ?>#products" class="pagination-next pull-right btn <?= $_GET["page"] >= $pages ? "disabled" : ""; ?>">Siguiente</a>
                </div>
              </div>
              <!-- pagination -->

            </div>
            <!-- /row -->
          </section>
          <!-- End Best Seller -->

        </div>
      </div>
    </div>
  </section>
  <?php include("../partials/basket.html"); ?>
  <!-- ================ category section end ================= -->



  <?php include("../partials/footer.html"); ?>

  <script>
    $(document).ready(function() {
      $('#btn-search').click(function() {
        if ($('#in-search').val() == '') {
          location.reload()
          location.href = "#products"
        } else {
          $.get('/db/searchProducts.php', {
            search: $('#in-search').val()
          }, function(data, status) {
            console.log($('#in-search').val())
            let products = JSON.parse(data)
            renderProducts(products)
          })
        }
      })
      $('#in-search').keyup((event) => {
        if (event.which == 13) {
          if ($('#in-search').val() == '') {
            location.reload()
            location.href = "#products"
          } else {
            $.get('/db/searchProducts.php', {
              search: $('#in-search').val()
            }, function(data, status) {
              console.log($('#in-search').val())
              let products = JSON.parse(data)
              renderProducts(products)
            })
          }
        }
      })
    })

    function renderProducts(products) {
      $('#products').html('')
      if (products.length > 0) {
        products.forEach(product => {
          $('#products').append(`<div class="col-md-6 col-lg-4">
                  <div class="card text-center card-product zoom-in">
                    <div class="card-product__img">
                      <img class="card-img" src="${product.images[0].url}">
                      <ul class="card-product__imgOverlay">
                        <li><a href="product.php?id=${product.id}"><i class="ti-search"></i> Cotizar</a></li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <h4 class="card-product__title"><a href="#">${product.name}</a></h4>
                    </div>
                  </div>
                </div>`)
          $('#pagination').fadeOut()
          location.href = "#products"
        });
      } else {
        $('#notices').append('<h3>No se encontraron resultados</h3>')
        $('#pagination').fadeOut()
        location.href = "#products"
      }

    }
  </script>

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
  <!-- <script src="/js/bootstrap.min.js"></script> -->
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/categories.js"></script>
  <script>
    $(document).ready(function() {
      $('select').niceSelect()
    })
  </script>
</body>

</html>