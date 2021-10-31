<?php

require_once "producttype.php";

class Book extends ProductType
{
    public function option()
    {
        return "
      <label for=\"weight\">Weight (KG)</label>
      <input type=\"number\" name=\"weight\" id=\"weight\">
      <h4>Please provide book weight in KG</h4>
      ";
    }

    public function getLabel($column)
    {
        return <<<HTML
     <div class="grid-item">
      <input type="checkbox" class="delete-checkbox" value="{$column["sku"]}">
      <p>{$column["sku"]}</p>
      <p>{$column["name"]}</p>
      <p>{$column["price"]}$</p>
      <p>Weight: {$column["weight"]}KG</p>

    </div>
HTML;
    }

    public function getArrayToSave($generatedSku)
    {
        return array(
          "sku"     => $generatedSku,
          "name"    => $_POST['name'],
          "price"   => $_POST['price'],
          "weight"  => $_POST['weight'],
          "productType" => $_POST['productType']
        );
    }
}
