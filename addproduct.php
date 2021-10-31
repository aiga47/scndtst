<?php  require "templates/header.php";
       require "typehandler.php";
?>

<h1>Product Add</h1>

<?php $generatedSku =  generateUniqueSku();
      $typeHandler = new TypeHandler();
?>
<div action="button-container">
  <input type="submit" name="cancel" value="Cancel" onclick="onCancel()">
  <input type="submit" name="save" value="Save" onclick="onSubmit()">
</div>
<form method="post" id="product_form">
      <hr></hr>
    	<label for="sku">SKU</label>
    	<input type="text" name="sku" id="sku" placeholder="<?php echo $generatedSku?>">
    	<label for="name">Name</label>
    	<input type="text" name="name" id="name">
    	<label for="price">Price ($)</label>
    	<input type="number" name="price" id="price">
      <!-- <label for="productType">Type Switcher</label>
    	<input type="text" name="productType" id="productType"> -->

    Type Switcher
    <select id="productType" name="productType">
        <option value="" disabled selected></option>
        <option value="dvd">DVD</option>
        <option value="book">Book</option>
        <option value="furniture">Furniture</option>
    </select>
<div id="options">
</div>
</form>

  <script>
    $(function() {
      $('#productType').change(
          function() {
              var item = this.value;
              $.ajax({
                type: "POST",
                data: {
                  type:item
                },
                url: "typehandler.php",
                dataType: "html",
                async: false,
                success: function(data) {
                  $("#options").html(data);
                }
              });

          }
      );
    });

    function onCancel() {
        location.href = "index.php";
      }
    function onSubmit() {
      var phpSku = "<?php echo $generatedSku;?>";
      var type = $('#productType').val();
      $.ajax({
        type: "POST",
        data: {
          sku:phpSku,
          name: $('#name').val(),
          price: $('#price').val(),
          size: $('#size').val(),
          productType: type,
          weight: $('#weight').val(),
          height: $('#height').val(),
          width: $('#width').val(),
          length: $('#length').val(),
        },
        url: "typehandler.php",
        dataType: "html",
        async: false,
        success: function(data) {
          // console.log(data);
          if(data == false){
            alert('Please, submit required data');
          }
          else{
              location.href = "index.php";
          }
        }
      });
    }
  </script>

<?php

function generateUniqueSku()
{
    $data = random_bytes(16);
    assert(strlen($data) == 16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
?>

<?php require "templates/footer.php"; ?>


<!-- CTRL+ALT+B   =  formatē kodu lai ir skaists un viegli lasāms -->
