<?php

abstract class ProductType
{
    abstract public function option();
    abstract public function getLabel($column);
    abstract function getArrayToSave($generatedSku);
    public function saveItem($generatedSku){
      require "config.php";
      require "common.php";


      try {
          $connection = new PDO($dsn, $username, $password, $options);

          $new_product = $this->getArrayToSave($generatedSku);
          $sql = sprintf(
              "INSERT INTO %s (%s) values (%s)",
              "products",
              implode(", ", array_keys($new_product)),
              ":" . implode(", :", array_keys($new_product))
          );

          $statement = $connection->prepare($sql);
          $statement->execute($new_product);
          header("Location:index.php");
          exit();
      } catch (PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
      }
    }

}
?>
