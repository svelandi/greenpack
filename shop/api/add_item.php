<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/model/Quotation.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/dao/QuotationDao.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/model/Item.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/model/ItemBag.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/model/ItemBox.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/model/ItemIndividual.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/model/ItemSheet.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/model/ItemFondoAutomatico.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/model/ItemBolsasLaminadas.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/dao/ProductDao.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/dao/MeasurementDao.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/dao/MaterialDao.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/db/env.php");
session_start();
if (
  isset($_POST["idProduct"]) && isset($_POST["width"])
  && isset($_POST["height"]) && isset($_POST["length"])
  && isset($_POST["printing"]) && isset($_POST["material"])
  && isset($_POST["quantity"])
) {
  $materialDao = new MaterialDao();
  $measurementDao = new MeasurementDao();
  $productDao = new ProductDao();

  if (isset($_SESSION["cart"]))
    $cart = unserialize($_SESSION["cart"]);
  else {
    $cart = new Quotation();
    $cart->setItems([]);
  }

  $product = $productDao->findById($_POST["idProduct"]);

  if ($product->getCategory()->getName() == 'bolsas' && $product->getCotizador() == '1') {
    $item = new ItemBag();
    $item->setMaterial($materialDao->findById($_POST["material"]));
  } else {
    $item = new ItemBox();
    $item->setLam(false);
    $item->setPla(false);
    $item->setObservations($_POST["observations"]);
    if (isset($_POST["numInks"])) {
      $item->setNumberInks($_POST["numInks"]);
    }
    $item->setMaterial($product->getMaterials()[0]);
    $item->setTypeProduct($_POST["material"]);
  }
  $item->setProduct($product);
  $item->setMeasurement($measurementDao->searchMeasurementByProduct($item->getProduct(), $_POST["height"], $_POST["width"], $_POST["length"]/* , $_POST["codigo"] */));
  $item->setPrinting(filter_var($_POST["printing"], FILTER_VALIDATE_BOOLEAN));
  $item->setQuantity($_POST["quantity"]);
  $items = $cart->addItem($item);
  $_SESSION["cart"] = serialize($cart);
  http_response_code(200);
  echo get_class($item);
} else {
  http_response_code(400);
}
