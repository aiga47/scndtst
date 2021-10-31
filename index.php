<?php
       require_once "typehandler.php";
       require "common.php";
       require "templates/header.php";
?>

<h1>Product List</h1>
<div action="button-container">
  <button onclick="window.location.href='addproduct.php'">ADD</button>
  <button onclick="onDelete()" id="delete-product-btn">MASS DELETE</button>
</div>
<div class="block_0"></div> <hr></hr>

<script>
  function onDelete() {
    var checkedVals = $('.delete-checkbox:checkbox:checked').map(function() {
      return this.value;
    }).get();

    $.ajax({
      type: "POST",
      data: {
        delete:checkedVals
      },
      url: "typehandler.php",
      dataType: "html",
      async: false,
      success: function(data) {
        if(data == true){
          location.href = "index.php";
        }

      }
    });
  }
</script>
<?php

$type_handler = new TypeHandler();



try {
    require "config.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM products
    ORDER BY id";

    $statement = $connection->query($sql);
    $result = $statement->fetchAll();

    if ($result && $statement->columnCount() > 0) { ?>




      <div class="grid-container">
        <?php foreach ($result as $column) {
        $type_handler->getLabel($column);
    } ?>
      </div>
      <?php } else { ?>
        > No results found for.
      <?php }
} catch (PDOException $error) {
    echo $error->getMessage();
}

?>

<?php require "templates/footer.php"; ?>
