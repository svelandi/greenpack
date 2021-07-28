<?php
require_once("db/conversor_date.php");
$conversor = new ConversorDate(); ?>
<!DOCTYPE HTML>
<html lang="es">

<head>
  <title>Greenpack | Empaques verdes</title>

  <?php include('partials/metaproperties.html') ?>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <!--CSS ============================================= -->
  <link rel="stylesheet" href="css/linearicons.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/main.min.css">
  <link rel="stylesheet" href="css/back-top.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/spinner.css">
  <link rel="stylesheet" href="css/solid.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="/css/style-counters-index.css">
  <link rel="stylesheet" href="https://teenus.com.co/css/global/global.css">
  <link rel="stylesheet" href="/css/style-index-notices.min.css">
  <link href="https://fonts.googleapis.com/css?family=Concert+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/basket.css">
  <link rel="stylesheet" href="/css/translate.css">
  <link rel="stylesheet" href="/css/notices_index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script type="text/javascript">
    $(document).ready(function($) {
      $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({
          scrollTop: $(this.hash).offset().top
        }, 1000);
      });
    });
  </script>
  <style>
    .search input.serch {
      color: #fff;
      padding-left: 5px;
      border: none;
      outline: none;
      display: inline-block;
      background: transparent;
      width: 120px;
    }

    .search {
      color: #fff;
    }

    .img-responsive {
      width: 350px;
    }

    .common-input {
      border-radius: 0.625rem !important;
    }

    .common-textarea {
      border-radius: 0.625rem !important;
    }

    @media(min-width: 300px) {
      #counters {
        height: 1000px !important;
      }
    }

    @media(min-width: 800px) {
      #counters {
        height: 600px !important;
      }
    }

    @media(max-width: 400px) {
      .row {
        margin-right: 0;
      }
    }

    .counter.js-counter {
      font-family: 'Concert One', cursive !important;
    }

    .icon {
      background-color: #00000000 !important;
    }

    #fh5co-counter .icon i {
      color: rgb(19, 109, 8);
    }
  </style>
  <script src="js/all.min.js"></script>
  <script src="js/spinner.js"></script>
</head>

<body>
  <?php include("partials/fixed-quoting.html"); ?>

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
  <?php include("partials/header_1.html") ?>

  <section class="default-banner active-blog-slider" id="banner">
  </section>

  <!-- Start about Area -->
  <section class="section-gap info-area" id="about" style="padding-bottom: 0;">
    <div class="container info-index">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="menu-content pb-40 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10" style="font-size: 2.5rem; font-weight: bold;     font-family: 'Poppins', sans-serif;color: #222222;line-height: 1.2em !important;">Con Materiales Biodegradables y Convertibles en abono</h1>
            <p style="font-size: 0.9375rem;font-family: 'Poppins', sans-serif;font-weight: 300;color: #656565;line-height: 1.6;margin-top: 0;margin-bottom: 1rem;">Un empaque innovador y totalmente ecológico.</p>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- End about Area -->
  <!-- counter Area -->
  <section class="section-gap info-area" style="padding: 0px 0 550px 0;">
    <div id="fh5co-counter" class="fh5co-bg fh5co-counter animated" style="background-image:url(/images/productos.png);   background-position-y: 50%;">
      <div class="container" id="counters">
        <div class="row align-items-center justify-content-center" style="vertical-align: middle; height: 600px;">
          <div class="col-md-3 col-sm-6 animate-box fadeInUp animated-fast">
            <div class="feature-center">
              <span class="icon">
                <i class="far fa-lightbulb" style="    color: rgb(19, 109, 8);height: 70px;font-size: -webkit-xxx-large;"></i>
              </span>

              <span class="counter js-counter notranslate" data-from="0" data-to="220" data-speed="5000" data-refresh-interval="50" id="innovations">220</span>
              <span class="counter-label">Innovaciones <br>Realizadas</span>

            </div>
          </div>
          <div class="col-md-3 col-sm-6 animate-box fadeInUp animated-fast">
            <div class="feature-center">
              <span class="icon">
                <i class="fas fa-box-open" style="color: rgb(19, 109, 8);height: 70px;font-size: -webkit-xxx-large;"></i>
              </span>
              <span class="counter js-counter notranslate" data-from="0" data-to="700" data-speed="5000" data-refresh-interval="50" id="products">700</span>
              <span class="counter-label">Productos<br>Ofertados</span>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 animate-box fadeInUp animated-fast">
            <div class="feature-center">
              <span class="icon">
                <i class="fas fa-running" style="color: rgb(19, 109, 8);height: 70px;font-size: -webkit-xxx-large;"></i>
              </span>
              <span class="counter js-counter notranslate" data-from="0" data-to="450" data-speed="5000" data-refresh-interval="50" id="clients">450</span>
              <span class="counter-label">Clientes <br>Atendidos</span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- end counter Area -->

  <!-- start blog -->
  <div class="container g-padding-y-60--xs g-padding-y-60--sm">
    <div class="g-text-center--xs g-margin-b-80--xs">
      <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Blog</p>
      <h2 class="g-font-size-32--xs g-font-size-36--md">Ultimas Noticias</h2>
    </div>
    <div class="row">
      <?php require_once "dao/NoticeDao.php";
      $noticeDao = new NoticeDao();
      $notices = $noticeDao->findlastest(3);
      foreach ($notices as $notice) { ?>
        <div class="col-sm-4 g-margin-b-30--xs g-margin-b-0--md">
          <!-- Bloque 1 -->
          <article>
            <img class="img-responsive lazyload" src="<?php echo $notice->getImage();  ?>">
            <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-text-center--xs g-padding-x-40--xs g-padding-y-40--xs" style="padding-top: 0.5rem;">

              <div class="row g-font-size-14--xs g-font-weight--700 g-color--primary">
                <div class="col text-uppercase"><i class="fas fa-eye"></i> Visitas: 0</div>
                <div class="col"><?php echo $notice->getCreatedAt()["day"];
                                  echo " de " .  " " . $conversor->monthToString($notice->getCreatedAt()["month"]) . ", " . $notice->getCreatedAt()["year"];; ?></div>
              </div>

              <hr>
              <h3 class="g-font-size-22--xs g-letter-spacing--1 notices">
                <a href="/blog/blog-post.php?id=<?php echo $notice->getId(); ?>"><?php echo $notice->getTitle(); ?></a>
              </h3>
              <p></p>
            </div>
          </article>
          <!-- Final Bloque 1 -->
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- end blog  -->
  <hr style="border-top: 3px solid rgba(0, 0, 0, 0.1);width: 80%;">

  <!-- clientes -->
  <section>
    <br><br>
    <h2 class="g-font-size-32--xs g-font-size-36--md text-center mb-3">Nuestros Clientes</h2>
    <div class="flexslider carousel">
      <ul class="slides" id="clients-slides"></ul>
    </div>
  </section>
  <!-- clientes -->

  <hr style="border-top: 3px solid rgba(0, 0, 0, 0.1);width: 80%;">
  <!-- start contact Area -->
  <section class=" contact-area section-gap" id="contact">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10" style="font-size: 40px;font-family: 'Poppins', sans-serif;margin-bottom: 10px;font-weight: bold;">Escríbenos</h1>
            <p style="font-size: 24px;margin-bottom: -20px;color:#666666;font-family: 'Poppins', sans-serif;">Haz crecer tu negocio.</p>
          </div>
        </div>
      </div>
      <form class="form-area " id="myForm" action="email.php" method="post" class="contact-form text-right">
        <div class="row">
          <div class="col-lg-6 form-group">
            <input name="name" placeholder="Nombres" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombres y Apellidos'" class="common-input mb-20 form-control" required="" type="text">
            <input name="email" placeholder="Email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" class="common-input mb-20 form-control" required="" type="email">
            <input name="subject" placeholder="De que quieres hablar" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Asunto'" class="common-input mb-20 form-control" required="" type="text">
            <input type="checkbox" name="terms" id="terms" required><label for="terms" style="display:inline"> Conozco y acepto la política de protección de datos y autorizo su manejo.</span>
          </div>
          <div class="col-lg-6 form-group">
            <textarea class="common-textarea mt-10 form-control" name="message" placeholder="Mensaje" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Dejanos aquí tu mensaje'" required=""></textarea>
            <button class="primary-btn mt-20">Enviar Mensaje<span class="lnr lnr-arrow-right"></span></button>
            <div class="alert-msg">
            </div>
          </div>
        </div>
      </form>

    </div>
  </section>
  <!-- end contact Area -->

  <?php include("partials/basket.html"); ?>

  <a href="#" id="back-to-top" title="Regresar al inicio"><i class="fas fa-arrow-up"></i></a>
  <?php include("partials/footer.html") ?>

  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/back-top.js"></script>
  <script src="js/bootstrap.min.js" async></script>
  <script src="/js/lazysizes.min.js" async></script>

  <script src="https://technext.github.io/shop/js/main.js"></script>
  <script src="https://technext.github.io/shop/js/jquery.countTo.js"></script>
  <!-- <script src="https://technext.github.io/shop/js/jquery.flexslider-min.js"></script> -->
  <script>
    $(document).ready(function() {
      $.get('/services/notify-admins.php', (data, status) => {

      })
      $('a[href^="#"]').click(function() {
        var destino = $(this.hash);
        if (destino.length == 0) {
          destino = $('a[name="' + this.hash.substr(1) + '"]');
        }
        if (destino.length == 0) {
          destino = $('html');
        }
        $('html, body').animate({
          scrollTop: destino.offset().top
        }, 500);
        return false;
      });
    });
    // store the slider in a local variable
    var $window = $(window),
      flexslider = {
        vars: {}
      };

    // tiny helper function to add breakpoints
    function getGridSize() {
      return (window.innerWidth <= 400) ? 1 :
        (window.innerWidth <= 600) ? 2 : 4;
    }
    $(window).load(() => {
      $('.flexslider').flexslider({
        animation: 'slide',
        itemWidth: 110,
        itemMargin: 10,
        minItems: getGridSize(),
        maxItems: getGridSize(),
        animationLoop: true,
        controlNav: false,
        directionNav: false,
        move: 1
      })
    })
    // check grid size on resize event
    $window.resize(function() {
      var gridSize = getGridSize();
      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
    })
    // get numbers for update
    $.get('/admin/texts/home/api/get_numbers.php', (data, status) => {
      let numbers = data
      $('#innovations').html(numbers[1].value)
      $('#products').html(numbers[0].value)
      $('#clients').html(numbers[2].value)
      $('#innovations').attr("data-to", numbers[1].value)
      $('#products').attr("data-to", numbers[0].value)
      $('#clients').attr("data-to", numbers[2].value)
    })
    $.get('/admin/texts/home/api/get_clients.php', (data, status) => {
      let clients = data
      clients.forEach(client => {
        $('#clients-slides').append(
          `<li>
            <img src="${client.image_url}" alt="Imagen de cliente" width="200" class="lazyload">
           </li>`)
      });
    })
    $.get('/admin/texts/home/api/get_banner.php', (slides, status) => {
      slides.forEach(slide => {
        $('#banner').append(`<div class="item-slider relative" style="background: url(${slide.image});background-size: cover;">
      <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
      <div class="container">
        <div class="row fullscreen justify-content-center align-items-center">
          <div class="col-md-10 col-12">
            <div class="banner-content text-center">
              <h4 class="text-white mb-20 text-uppercase">${slide.header}</h4>
              <h1 class="text-uppercase text-white">${slide.title}</h1>
              <h5 class="text-white">${slide.subtitle}</h5>
              <a href="#about" class="text-uppercase header-btn">Descubrir Ahora</a>
            </div>
          </div>
        </div>
      </div>
    </div>`)
      })
      $('.active-blog-slider').owlCarousel({
        loop: true,
        dots: true,
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        animateOut: 'fadeOut',
      })
      var s = document.createElement("script");
      s.src = '/js/main.js';
      document.querySelector("head").appendChild(s);
    })
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script src="/js/translate.js"></script>
</body>

</html>