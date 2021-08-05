<?php
require_once(dirname(__DIR__) . "/db/env.php");
require_once dirname(__DIR__) . "/db/DBOperator.php";
require_once dirname(__DIR__) . "/model/product_assoc.php";
// require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/composer/vendor/autoload.php";

// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

/*****************************************************************************
/*Esta clase permite Crear, Actualizar, Buscar y Eliminar Productos Asociados
/*Desarrollada por Teenus SAS
/*Para Teenus.com.co
/*Ultima actualizacion 20/06/2020
/*****************************************************************************/

class ProductAssocDao
{
  private $db;

  function __construct()
  {
    $this->db = new DBOperator($_ENV["db_host"], $_ENV["db_user"], $_ENV["db_name"], $_ENV["db_pass"]);
  }

  function findByProduct($idProduct)
  {
    $this->db->connect();
    $productsAssoc = [];
    $productsAssocDB = $this->db->consult("SELECT * FROM `products_assoc` WHERE `product` = " . $idProduct, "yes");

    foreach ($productsAssocDB as  $productAssocDB) {
      $prod_assoc = new ProductsAssoc();
      $prod_assoc->setIdProduct($productAssocDB["product"]);
      $prod_assoc->setProductAssoc($productAssocDB["product_assoc"]);
      array_push($productsAssoc, $prod_assoc);
    }

    $this->db->close();
    return $productsAssoc;
  }


  function findById($id)
  {
    $this->db->connect();
    $query = "SELECT * FROM `products_assoc` WHERE `id` = $id";
    $productAssocDB = $this->db->consult($query, "yes");
    $productAssocDB = $productAssocDB[0];
    $measurement = new ProductsAssoc();
    $measurement->setIdProduct($productAssocDB["id"]);
    $measurement->setProductAssoc($productAssocDB["product_assoc"]);


    $this->db->close();
    return $measurement;
  }

  function save($productsAssoc)
  {
    $this->db->connect();

    $query = "SELECT * FROM `products_assoc` WHERE `product` = '" . $productsAssoc->getIdproduct() . "' ";
    $idProductAssoc = $this->db->consult($query, "yes");

    if (sizeof($idProductAssoc) == 0) {

      foreach ($idProductAssoc as $key => $val) {
        if ($val['product_assoc'] === $productsAssoc->getProductAssoc()) {
          return $key;
        }
      }

      $query = "INSERT INTO products_assoc (product, product_assoc) 
        VALUES ('" . $productsAssoc->getIdProduct() . "', '" . $productsAssoc->getProductAssoc() . "')";
      $status = $this->db->consult($query);
      $this->db->close();
      return $status;
    }
  }

  function deleteByProduct($idProduct)
  {
    $this->db->connect();
    $query = "DELETE FROM `products_assoc` WHERE `product` = $idProduct";
    $status = $this->db->consult($query);
    $this->db->close();
    return $status;
  }

  function update($productsAssoc)
  {
    $this->db->connect();

    $query = "SELECT * FROM `products_assoc` WHERE `product` = '" . $productsAssoc->getIdproduct() . "' AND '" . $productsAssoc->getProductAssoc() . "' ";
    $idProductAssoc = $this->db->consult($query, "yes");

    $query = "UPDATE `products_assoc` SET `product_assoc` = '" . $productsAssoc->getProductAssoc() . "' WHERE `products_assoc`.`product` = " . $productsAssoc->getProductAssoc();

    $status = $this->db->consult($query);
    $this->db->close();
    return $status;
    // self::$logger->info($query);
  }
}
