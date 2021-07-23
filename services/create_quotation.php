<?php
require_once dirname(__DIR__) . "/model/Quotation.php";
require_once dirname(__DIR__) . "/model/Item.php";
require_once dirname(__DIR__) . "/model/ItemBox.php";
require_once dirname(__DIR__) . "/dao/QuotationDao.php";
require_once(dirname(__DIR__) . "/dao/ProductDao.php");
require_once(dirname(__DIR__) . "/dao/MeasurementDao.php");
require_once(dirname(__DIR__) . "/dao/MaterialDao.php");
session_start();
if (isset($_SESSION["cart"])) {
  $quotationDao = new QuotationDao();
  $cart = unserialize($_SESSION["cart"]);
  $cart->setNameClient($_POST["name"]);
  $cart->setLastNameClient($_POST["lastname"]);
  $cart->setCompany($_POST["company"]);
  $cart->setAddress($_POST["address"]);
  $cart->setCity($_POST["city"]);
  $cart->setEmail($_POST["email"]);
  $cart->setPhoneNumber($_POST["phone"]);
  $cart->setCellPhoneNumber($_POST["cellphone"]);
  $cart->setExtraInformation($_POST["extra"]);
  foreach ($cart->getItems() as $item) {
    $item->calculatePrice();
  }
  echo json_encode($cart);
  $quotationDao->save($cart);
  session_destroy();
} else {
  http_response_code(404);
}
