<?php

require_once "producttype.php";

class DVD extends ProductType
{
    public function option()
    {
        return "
        <label for=\"size\">Size (MB)</label>
        <input type=\"number\" name=\"size\" id=\"size\">
        <h4>Please provide disc space in MB</h4>
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
        <p>Size: {$column["size"]} MB</p>
      </div>
HTML;

    }

    public function getArrayToSave($generatedSku){
      return array(
          "sku"     => $generatedSku,
          "name"    => $_POST['name'],
          "price"   => $_POST['price'],
          "size"    => $_POST['size'],
          "productType" => $_POST['productType']
        );
    }
}
