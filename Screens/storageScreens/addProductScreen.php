<?php
  include("../../Components/requeriments.php ");
  include("../../Components/storageComponents/storageStyles.php");
  include("../../Components/storageComponents/nav-container.php");
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Login.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "almacenista")==0)){
      header("Location:../../Login.php");
    }
  }
?>
<div class="bodyContainer">
    <div class="optionsContainer">
        <?php
          include("../../Components/storageComponents/barOptions-container.php")
        ?>
    </div>
    <div class="showsContainer">
        <div class="screenOptionContainer">
            <div class="nameOptionContainer">
                <div class="option">Agregar Un Nuevo Producto</div>
            </div>
            <div class="formContainer">
                <div class="storageFormAdd">
                  <form class="form" action="../../functions/storageFunctions/storageAddProductScreen.php" method="post">
                    <div class="leftBoxForm">
                      <input type="number"  min="1" max="9999999999999" autocomplete="off" required placeholder="Código del producto" name="productCode" class="inputTextDesign number" />
                      <input type="text"    maxlength="100" autocomplete="off" required placeholder="Nombre del producto" name="productName"        class="inputTextDesign" />
                      <textarea type="text" maxlength="500" autocomplete="off" required placeholder="Descripción" name="productDescription" class="inputTextDesign textarea"></textarea>
                      <input type="text"    maxlength="50" autocomplete="off" required placeholder="Categoría" name="productCategory"    class="inputTextDesign" />
                      <input type="text"    maxlength="50" autocomplete="off" required placeholder="Sub Categoría" name="productSubCategory" class="inputTextDesign" />
                    </div>
                    <div class="rightoxForm">
                      <input type="number"  mautocomplete="off" required placeholder="Stock Máximo" name="stockMax" min="100" max="200"   class="inputTextDesign" />
                      <input type="number"  autocomplete="off" required placeholder="Stock Mínimo" name="stockMin" min="1"  max="100" class="inputTextDesign" />
                      <input type="number"  autocomplete="off" required placeholder="Existencia" name="existence" min="1" max="100" class="inputTextDesign" />
                      <input type="text"    maxlength="20" autocomplete="off" required placeholder="Medida" name="measure" class="inputTextDesign" />
                      <input type="submit"  name="submit" value="Agregar" class="buttonAdd" />
                    </div>
                  </form>
                </div>
            </div>
            <div class="underContainer"></div>
        </div>
    </div>
</div>
<?php
  include("../../Components/footer-container.php");
  include("../../Components/endCode.php");
?>