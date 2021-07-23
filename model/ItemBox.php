<?php
require_once __DIR__ . "/Item.php";
class ItemBox extends Item implements JsonSerializable
{
  private $observations;
  private $numberInks;
  private $typeProduct;

  public function __construct()
  {
    parent::__construct();
    $this->numberInks = "NULL";
  }

  public function calculatePrice()
  {
    $directCost = $this->calculateDirectCost();

    $quantity = $this->getQuantity();
    $cantidades = $this->getProduct()->getCantidad();
    $e1min = $cantidades->getE1min();
    $e1max = $cantidades->getE1max();
    $e2min = $cantidades->getE2min();
    $e2max = $cantidades->getE2max();
    $e3min = $cantidades->getE3min();
    $e3max = $cantidades->getE3max();

    $material_selected = $this->getMaterial()->getId();
    $materials = $this->getProduct()->getMaterials();

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
    $grammage = $this->getMaterial()->getGrammage();
    $large = $this->getMeasurement()->getLargoUtil();
    $pliego = $this->getMeasurement()->getPliego();

    $peso = ($AT * $large * $grammage) / 10000000;
    $und = $peso / $pliego;

    $CPAPER = $und * $this->getMaterial()->getPricePerKg();

    $directCost = $CPAPER;
    return $directCost;

    //return $this->getMaterial()->getPricePerKg() / $this->getMeasurement()->getWindow();
  }

  public function setTypeProduct($typeProduct)
  {
    $this->typeProduct = $typeProduct;
  }

  public function getTypeProduct()
  {
    return $this->typeProduct;
  }

  public function setObservations($observations)
  {
    $this->observations = $observations;
  }

  public function getObservations()
  {
    return $this->observations;
  }

  public function setNumberInks($numberInks)
  {
    $this->numberInks = $numberInks;
  }

  public function getNumberInks()
  {
    return $this->numberInks;
  }
  public function jsonSerialize()
  {
    return get_object_vars($this);
  }
}
