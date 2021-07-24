<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/dao/ProductDao.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/db/env.php");

if (!$_GET) {
  header("Location: /shop");
}
$productDao = new ProductDao();
$product = $productDao->findById($_GET["id"]);

if ($product->getCotizador() == 1)
  include_once('product_bolsas.php');
else
  include_once('product_copy.php');
