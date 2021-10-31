<?php require "book.php"; ?>
<?php require "dvd.php"; ?>
<?php require "furniture.php"; ?>

<?php

  $handler = new TypeHandler();
  $items = $handler->getItemList();

   if (isset($_POST["type"])) {
       $productTypeKey=$_POST["type"];
       $productItem = $items[$productTypeKey];
       $options = $productItem->option();
       echo $options;
   }

   if (isset($_POST["sku"])) {
       $productTypeKey=$_POST["productType"];
       $sku = $_POST["sku"];
       $result = $handler->saveItem($sku, $productTypeKey);
       echo $result;
   }

   if (isset($_POST["delete"])) {
       $array=$_POST['delete'];
       $handler->deleteBySku($array);
       echo true;
   }

   class TypeHandler
   {
       public function getItemList()
       {
           return  [
          "dvd" =>  new DVD(),
          "book" => new Book(),
          "furniture" => new Furniture(),
        ];
       }

       public function getLabel($column)
       {
           $itemList = $this->getItemList();
           $itemKey = $column["productType"];
           $item = $itemList[$itemKey];
           $htmlValue = $item->getLabel($column);
           echo $htmlValue;
       }

       public function saveItem($generatedSku, $productType)
       {
           if ($productType == null) {
               return false;
           }
           $itemList = $this->getItemList();
           $item = $itemList[$productType];
           $arrayToSave = $item->getArrayToSave($generatedSku);
           $nullInArray = in_array(null, $arrayToSave);

           if ($nullInArray) {
               return false;
           }

           $result = $item->saveItem($generatedSku);
           return true;
       }

       public function deleteBySku($skuArray)
       {
           require_once "config.php";

           try {
               $connection = new PDO($dsn, $username, $password, $options);

               foreach ($skuArray as $sku) {
                   $sql = "DELETE FROM products WHERE sku = :sku";
                   $statement = $connection->prepare($sql);
                   $statement->bindValue(':sku', $sku);
                   $statement->execute();
               }
           } catch (PDOException $error) {
               print_r($sql . "<br>" . $error->getMessage());
           }
       }
   }


?>
