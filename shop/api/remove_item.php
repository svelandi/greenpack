<?php
session_start();
require_once(dirname(dirname(__DIR__)) . "/model/Quotation.php");
require_once(dirname(dirname(__DIR__)) . "/model/Item.php");
require_once(dirname(dirname(__DIR__)) . "/model/ItemBox.php");
require_once(dirname(dirname(__DIR__)) . "/dao/ProductDao.php");
require_once(dirname(dirname(__DIR__)) . "/dao/MeasurementDao.php");
require_once(dirname(dirname(__DIR__)) . "/dao/MaterialDao.php");
if (isset($_POST["id_item"])) {
  $cart = unserialize($_SESSION["cart"]);
  if ($cart->removeItem($_POST["id_item"])) {
    $_SESSION["cart"] = serialize($cart);
    http_response_code(200);
  } else {
    http_response_code(500);
  }
} else {
  http_response_code(400);
}
