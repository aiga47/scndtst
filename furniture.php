<?php

require_once "producttype.php";

class Furniture extends ProductType
{
    public function option()
    {
        return "
      <label for=\"height\">Height (CM)</label>
      <input type=\"number\" name=\"height\" id=\"height\">
      <label for=\"width\">Width (CM)</label>
      <input type=\"number\" name=\"width\" id=\"width\">
      <label for=\"length\">Length (CM)</label>
      <input type=\"number\" name=\"length\" id=\"length\">
      <h4>Please provide furniture dimensions in CM</h4>
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
        <p>Dimensions: {$column["height"]}x{$column["width"]}x{$column["length"]}</p>

      </div>
HTML;
    }

    public function getArrayToSave($generatedSku){
      return array(
          "sku"     => $generatedSku,
          "name"    => $_POST['name'],
          "price"   => $_POST['price'],
          "height"  => $_POST['height'],
          "width"   => $_POST['width'],
          "length"  => $_POST['length'],
          "productType" => $_POST['productType']
        );
    }
}
