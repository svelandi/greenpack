<?php
require_once __DIR__ . "/Item.php";

class ItemBag extends Item implements JsonSerializable
{
  public function __construct()
  {
    parent::__construct();
  }

  public function calculatePrice()
  {
    $directCost = $this->calculateDirectCost();
    $quantity = $this->getQuantity();
    $product = $this->getProduct();
    $cantidades = $product->getCantidad();
    $e1min = $cantidades->getE1min();
    $e1max = $cantidades->getE1max();
    $e2min = $cantidades->getE2min();
    $e2max = $cantidades->getE2max();
    $e3min = $cantidades->getE3min();
    $e3max = $cantidades->getE3max();

    $material_selected = $this->getMaterial()->getId();
    $materials = $product->getMaterials();

    foreach ($materials as $material) {
      if ($material_selected == $material->getId()) {
        $e1 = $material->getE1();
        $e2 = $material->getE2();
        $e3 = $material->getE3();
        break;
      }
    }

    if ($quantity >= $e3min &&  $quantity <= $e3max)
      $this->setPrice($directCost * $e3);
    elseif ($quantity >= $e2min &&  $quantity <= $e2max)
      $this->setPrice($directCost * $e2);
    elseif ($quantity >= $e1min &&  $quantity <= $e1max)
      $this->setPrice($directCost * $e1);
  }

  public function calculateDirectCost()
  {
    $AT = $this->getMeasurement()->getAnchoTotal();
    $paper = ($AT * $this->getMeasurement()->getLength() * $this->getMaterial()->getGrammage()) / 10000000;
    $cost_paper = $paper * $this->getMaterial()->getPricePerKg();
    $directCost = $cost_paper;
    return $directCost;
  }
  public function jsonSerialize()
  {
    return get_object_vars($this);
  }
}
