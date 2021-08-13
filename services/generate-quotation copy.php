<!DOCTYPE html>
<html>
<?php
require_once dirname(__DIR__) . "/dao/QuotationDao.php";
require_once dirname(__DIR__) . "/dao/AdminDao.php";
$quotationDao = new QuotationDao();
$adminDao = new AdminDao();
if (isset($_GET["id"])) {
  $quotation = $quotationDao->findById($_GET["id"]);
  $admin = $adminDao->findById($quotation->getIdAdminAssigned());
}
?>

<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="ProgId" content="Excel.Sheet">
  <title>Greenpack | Cotizacion No <?= $quotation->getId(); ?></title>
  <meta name="Generator" content="Microsoft Excel 15">
  <link rel="stylesheet" href="/css/style-template-quotation.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    body {
      padding-left: 50px;
      padding-right: 50px;
      padding-top: 10px;
      mso-displayed-decimal-separator: "\,";
      mso-displayed-thousand-separator: "\.";
    }

    .font010772 {
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
    }

    .font510772 {
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
    }

    .xl1510772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl6510772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: bottom;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl6610772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border: none;
      background: #C5E0B3;
      mso-pattern: #C5E0B3 none;
      white-space: nowrap;
    }

    .xl6710772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl6810772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: left;
      vertical-align: bottom;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl6910772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: "Short Date";
      text-align: center;
      vertical-align: bottom;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7010772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: middle;
      border-top: .5pt solid black;
      border-right: .5pt solid black;
      border-bottom: none;
      border-left: .5pt solid black;
      background: #C5E0B3;
      mso-pattern: #C5E0B3 none;
      white-space: normal;
    }

    .xl7110772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: middle;
      border-top: .5pt solid black;
      border-right: .5pt solid black;
      border-bottom: none;
      border-left: .5pt solid black;
      background: #C5E0B3;
      mso-pattern: #C5E0B3 none;
      white-space: nowrap;
    }

    .xl7210772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: middle;
      border: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7310772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: "_-\0022$\0022\\ * \#\,\#\#0_-\;\\-\0022$\0022\\ * \#\,\#\#0_-\;_-\0022$\0022\\ * \0022-\0022_-\;_-\@";
      text-align: center;
      vertical-align: middle;
      border: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7410772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: bottom;
      border: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7510772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7610772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: middle;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7710772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: left;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: .5pt solid black;
      background: white;
      mso-pattern: white none;
      white-space: normal;
    }

    .xl7810772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl7910772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl8010772 {
      padding: 0px;
      color: black;
      font-size: 16.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: center;
      vertical-align: bottom;
      white-space: nowrap;
    }

    .xl8110772 {
      padding: 0px;
      color: black;
      font-size: 18.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: center;
      vertical-align: middle;
      white-space: nowrap;
    }

    .xl8210772 {
      padding: 0px;
      color: #0563C1;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: underline;
      font-family: Calibri;
      text-align: left;
      vertical-align: bottom;
      white-space: nowrap;
    }

    .xl8310772 {
      padding: 0px;
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: general;
      vertical-align: bottom;
      border: none;
      background: #C5E0B3;
      white-space: nowrap;
    }

    .xl8410772 {
      padding: 0px;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: general;
      vertical-align: bottom;
      border: none;
    }

    .xl8510772 {
      padding: 0px;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: general;
      vertical-align: bottom;
      border: none;
      white-space: nowrap;
    }

    .xl8610772 {
      padding: 0px;

      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;

      text-align: center;
      vertical-align: middle;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: .5pt solid black;

      white-space: nowrap;
    }

    .xl8710772 {
      padding: 0px;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: general;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: .5pt solid black;
      border-bottom: .5pt solid black;
      border-left: none;
      white-space: nowrap;
    }

    .xl8810772 {
      padding: 0px;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: center;
      vertical-align: middle;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: .5pt solid black;
      background: white;
      white-space: normal;
    }

    .xl8910772 {
      padding: 0px;

      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      text-align: left;
      vertical-align: bottom;

      white-space: normal;
    }

    .xl9010772 {
      padding: 0px;
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: middle;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: .5pt solid black;
      background: #C5E0B3;
      mso-pattern: #C5E0B3 none;
      white-space: nowrap;
    }

    .xl9110772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 700;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: bottom;
      border: none;
      background: #D8D8D8;
      mso-pattern: #D8D8D8 none;
      white-space: nowrap;
    }

    .xl9210772 {
      padding: 0px;
      mso-ignore: padding;
      color: black;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: center;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: none;
      border-left: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9310772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: none;
      border-bottom: none;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9410772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: .5pt solid black;
      border-right: .5pt solid black;
      border-bottom: none;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9510772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: none;
      border-right: none;
      border-bottom: none;
      border-left: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9610772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: none;
      border-right: .5pt solid black;
      border-bottom: none;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9710772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: none;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: .5pt solid black;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9810772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: none;
      border-right: none;
      border-bottom: .5pt solid black;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .xl9910772 {
      padding: 0px;
      mso-ignore: padding;
      color: windowtext;
      font-size: 11.0pt;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      font-family: Calibri;
      mso-generic-font-family: auto;
      mso-font-charset: 0;
      mso-number-format: General;
      text-align: general;
      vertical-align: bottom;
      border-top: none;
      border-right: .5pt solid black;
      border-bottom: .5pt solid black;
      border-left: none;
      mso-background-source: auto;
      mso-pattern: auto;
      white-space: nowrap;
    }

    .break-word {
      -ms-word-break: break-all;
      word-break: break-all;
      word-break: break-word;

      -webkit-hyphens: auto;
      -moz-hyphens: auto;
      -ms-hyphens: auto;
      hyphens: auto;
    }
  </style>
</head>

<body>

  <div id="Plantilla_Cotizacion (3)_10772" align="center" x:publishsource="Excel">

    <div class="header">
      <img width="245" height="66" src="data:image/png;base64,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" alt="http://greenpack.com.co/wp-content/themes/greenpack/images/logo-greenpack.png" v:shapes="image1.png"></span>
      <div>
        NIT 800.025.125-8<br>
        Dirección: Cra. 5 este No.20-69 Bodega # 6<br>
        Teléfono: (57+1) 893 26 31 / 35/ 38/ 42<br>
        Mosquera - Cundinamarca - Colombia<br>
      </div>
      <div class="idCotizacion">
        Cotización No <br><?= $quotation->getId() ?>
      </div>
    </div>

    <div class="barra"></div>

    <div class="cliente">
      <label class="fs">Nombres y Apellidos</label>
      <label><?= $quotation->getNameClient() ?> <?= $quotation->getLastNameClient() ?></label>
      <label class="fs">Email</label>
      <label><a href="mailto:<?= $quotation->getEmail() ?>"><span style="color:#0563C1"><?= $quotation->getEmail() ?></span></a></label>
      <label class="fs">Fecha</label>
      <label><?= date("d/m/Y", $quotation->getCreatedAt()) ?></label>
      <label class="fs">Empresa</label>
      <label><?= $quotation->getCompany() != "" ? $quotation->getCompany() : "N/A" ?></label>
      <label class="fs">Dirección</label>
      <label><?= $quotation->getAddress() ?></label>
      <label class="fs">Ciudad</label>
      <label><?= $quotation->getCity() ?></label>
      <label class="fs">Teléfono</label>
      <label><?= $quotation->getPhoneNumber() != "" ? $quotation->getPhoneNumber() : "N/A" ?></label>
      <label class="fs">Celular</label>
      <label><?= $quotation->getCellphoneNumber() ?></label>
    </div>
    <div class="barra"></div>

    <table class="table mt-3">
      <thead>
        <tr>
          <th scope="col" class="cen">Producto</th>
          <th scope="col" class="cen">Descripción</th>
          <th scope="col" class="cen">Cantidad</th>
          <th scope="col" class="cen">Precio Unitario</th>
          <th scope="col" class="cen">Precio Total</th>
        </tr>
      </thead>
      <tbody>
        <?php setlocale(LC_MONETARY, "es_CO");
        foreach ($quotation->getItems() as $item) { ?>
          <tr>
            <td>
              <img src="<?= $item->getProduct()->getImages()[0]->getUrl() ?>" width="150" height="150" style="margin: 2px;">
              </th>
            <td class="vert">
              <label class="font510772">Referencia</label>
              <label class="font010772"> <?= $item->getProduct()->getRef() ?> </label>
              <br>
              <?php if ($item->getProduct()->getCategory()->getId() != 1 || $item->getProduct()->getId() == $_ENV["id_sacos"]) { ?>
                <label class="font510772">Tipo De Producto</label>
                <label class="font010772"> <?= $item->getTypeProduct() ?></label>
                <br>
              <?php } ?>
              <label class="font510772">Material</label>
              <label class="font010772"> <?= $item->getMaterial()->getName() ?></label>
              <br>
              <label class="font510772">Medidas</label>
              <label class="font010772"> <?= $item->getMeasurement()->getWidth() ?>*<?= $item->getMeasurement()->getHeight() ?>*<?= $item->getMeasurement()->getLength() ?></label>
              <br>
              <label class="font510772">Impresión</label>
              <label class="font010772"> <?= $item->isPrinting() ? "SI" : "NO" ?></label>
              <br>
              <?php if ($item->getProduct()->getCategory()->getId() == 1 && $item->getProduct()->getId() != $_ENV["id_sacos"]) { ?>
                <!-- <label class="font510772">Ventanilla</label>
                <label class="font010772"> <?= $item->isPla() ? "SI" : "NO" ?></label>
                <br>
                <label class="font510772">Laminada</label>
                <label class="font010772"> <?= $item->isLam() ? "SI" : "NO" ?> </label> -->

                <?php } else {
                if ($item->getProduct()->getCategory()->getId() == 2 || $item->getProduct()->getCategory()->getParentcategory() == 2) {
                  if ($item->isPrinting()) { ?>
                    <label class="font510772">Número de Tintas</label>
                    <label class="font010772"> <?= $item->getNumberInks() ?> </label>
                    <br>
                <?php }
                } ?>
                <label class="font510772">Observaciones</label>
                <label class="font010772"> <?= $item->getObservations() ?> </label>
                <br>
              <?php } ?>

              <br>
            </td>
            <td class="ori"><?= number_format($item->getQuantity(), 0, ",", ".") ?></td>
            <td class="ori">$ <?= number_format($item->getPrice(), 0, ",", ".") ?></td>
            <td colspan="2" class="ori">$ <?= number_format($item->calculateTotal(), 0, ",", ".") ?> </td>

          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="obstotal">
      <div class="obser">
        <label><b>Observaciones</b></label>
        <textarea rows="4" type="text" class="form-control" name="" id="" disabled></textarea>
      </div>

      <div class="total vert">
        <label class="align-middle"><b>Subtotal</b></label>
        <label class="font">$ <?= number_format($quotation->calculateTotal(), 0, ",", ".") ?></label>
        <label class="vert"><b>IVA 19%</b></label>
        <label class="font">$ <?= number_format($quotation->calculateTotal() * 0.19, 0, ",", ".") ?></label>
        <label class="vert"><b>Total</b></label>
        <label class="font">$ <?= number_format($quotation->calculateTotal() + $quotation->calculateTotal() * 0.19, 0, ",", ".") ?></label>
      </div>
    </div>

    <div class="barratitle mt-5">
      <div class="condiciones">
        <label class="title"><b>Condiciones de Pago</b></label>
      </div>
    </div>
    <div>
      <?= $quotation->getPaymentConditions() ?>
    </div>

    <div class="barratitle mt-3">
      <div class="condiciones">
        <label class="title"><b>Tiempo de Entrega a partir de la aprobación</b></label>
      </div>
    </div>
    <div>
      <?= $quotation->getDeliveryTime() ?>
    </div>

    <div class="barratitle mt-3">
      <div class="condiciones">
        <label class="title"><b>Vigencia</b></label>
      </div>
    </div>
    <div class="mb-3">
      <?= $quotation->getValidity() ?>
    </div>

    <div class="barra"></div>
    <div>Cordialmente,</div>
    <div><?= $admin->getName() ?>
      <?= $admin->getLastName() ?>
      <?= $admin->getEmail() ?>
      <?= $admin->getPhone() ?>
    </div>
    <div class="barra mb-50"></div>

    
    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;table-layout:fixed; width: 100%;margin: 0 auto;">
      <tbody>

        <!--  <tr height="12" style="mso-height-source:userset;height:9.0pt">
          <td height="12" class="xl6510772" style="height:9.0pt"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl6510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="20" style="height:15.0pt">
          <td height="20" class="xl1510772" colspan="2" style="height:15.0pt">Observaciones</td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="7" rowspan="3" height="63" class="xl9210772 break-word" style="border-right:.5pt solid black;border-bottom:.5pt solid black;height:47.25pt; vertical-align: top!important; overflow-wrap: break-word;white-space: pre-line;overflow: auto;text-overflow: ellipsis;">
            <p>
              <?php
              $parts = ceil(strlen($quotation->getExtraInformation()) / 60);
              $parts = $parts == 1 ? 2 : $parts;
              for ($i = 0; $i < $parts - 1; $i++) {
                echo substr($quotation->getExtraInformation(), $i * 60, ($i + 1) * 60);
                echo '<br>';
              }
              ?>
            </p>
          </td>
          <td class="xl6510772"></td>
          <td class="xl1510772">Subtotal</td>
          <td colspan="2" class="xl7310772"><span style="mso-spacerun:yes">&nbsp;</span>$<span style="mso-spacerun:yes">&nbsp;</span><?= number_format($quotation->calculateTotal(), 0, ",", ".") ?></td>
        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl6510772" style="height:15.75pt"></td>
          <td class="xl1510772">IVA 19%</td>
          <td colspan="2" class="xl7310772" style="border-top:none">&nbsp; $ <?= number_format($quotation->calculateTotal() * 0.19, 0, ",", ".") ?></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl6510772" style="height:15.75pt"></td>
          <td class="xl1510772">Total</td>
          <td colspan="2" class="xl7310772" style="border-top:none">&nbsp; $ <?= number_format($quotation->calculateTotal() + $quotation->calculateTotal() * 0.19, 0, ",", ".") ?></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr> -->
        <!-- <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl8310772" style="height:15.75pt">Condiciones de Pago</td>
        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl6810772" style="height:15.75pt"><?= $quotation->getPaymentConditions() ?></td>
        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl8310772" style="height:15.75pt">Tiempo de Entrega a partir de la aprobación</td>
        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl6810772" style="height:15.75pt"><?= $quotation->getDeliveryTime() ?></td>
        </tr> -->
        <!-- <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl6810772" style="height:15.75pt">Impresos 15
            dias</td>
        </tr> -->
        <!-- <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl8310772" style="height:15.75pt">Vigencia</td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td colspan="11" height="21" class="xl8910772" width="828" style="height:15.75pt;width:619pt">
            <span style="mso-spacerun:yes">&nbsp;&nbsp;</span><?= $quotation->getValidity() ?>
          </td>
        </tr> -->
        <!-- <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" colspan="2" style="height:15.75pt">Cordialmente,</td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td colspan="3" class="xl1510772" style="text-transform:capitalize;"><?= $admin->getName() ?> <?= $admin->getLastName() ?></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td colspan="2" class="xl1510772">Correo: <?= $admin->getEmail() ?></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772">Telefono: <?= $admin->getPhone() ?></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr>
        <tr height="21" style="mso-height-source:userset;height:15.75pt">
          <td height="21" class="xl1510772" style="height:15.75pt"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>
          <td class="xl1510772"></td>

        </tr> -->
      </tbody>
    </table>
  </div>
  <script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/vendor/jquery.formatCurrency-1.4.0.min.js"></script>
  <script type="text/javascript" src="/vendor/jquery.formatCurrency.all.js"></script>
  <script type="text/javascript">
    $('.money').formatCurrency({
      region: 'es-CO'
    })
  </script>
</body>

</html>