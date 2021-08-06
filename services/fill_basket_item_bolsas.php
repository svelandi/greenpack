<div class="cont-info-item ng-star-inserted"><strong><?= $item->getProduct()->getName(); ?></strong>
    <p class="description-product">
        <span class="text-primary">Impresion: </span><span>&nbsp;<?= $item->isPrinting() ? "SI" : "NO"; ?></span>
        <br>
        <span class="text-primary"><?= $item->getProduct()->getCotizador() != 1 ? "Tipo de producto:" : "Material:" ?></span><span>&nbsp;<?= $item->getProduct()->getCotizador() != 1 ? $item->getTypeProduct() : $item->getMaterial()->getName() ?></span>
        <br>
        <span class="text-primary">Medidas:</span>
        <br>
        &nbsp;&nbsp;
        <span class="text-primary">Ancho:</span><span>&nbsp; <?= $item->getMeasurement()->getWidth(); ?></span>&nbsp;
        <span class="text-primary">Alto:</span><span>&nbsp; <?= $item->getMeasurement()->getHeight(); ?></span>&nbsp;
        <span class="text-primary">largo:</span><span>&nbsp; <?= $item->getMeasurement()->getLength(); ?></span>&nbsp;
    </p>
    <span class="topping-product"></span>
    <span class="delete" onclick="deleteItem('<?= $item->getId() ?>')">Eliminar</span>
</div>