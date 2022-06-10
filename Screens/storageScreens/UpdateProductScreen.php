<?php
   include("../../Components/requeriments.php ");
   include("../../Components/storageComponents/storageStyles.php");
   include("../../Components/storageComponents/nav-container.php");
  include("../../DBConnection/connect.php");

  if(empty($_GET['Code'])){
    header('Location: SeeProductScreen.php');
  } else{
    $code = $_GET['Code'];
    $query = "SELECT nombre, descripcion, categoria, subCategoria, stockMin, stockMax, medida FROM productos WHERE codigo_producto= $code";
    if($result = $connection->query($query)){
      if($result->fetchColumn() > 0){
        foreach($connection->query($query) as $fila){
          $name = $fila['nombre'];
          $description = $fila['descripcion'];
          $category = $fila['categoria'];
          $subCategory = $fila['subCategoria'];
          $stockMin = $fila['stockMin'];
          $stockMax = $fila['stockMax'];
          $measure = $fila['medida'];
        }
      }
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
                <div class="option">Actualizar Datos del Producto</div>
            </div>
            <div class="formContainer">
                <div class="storageFormAdd">
                    <form action="../../functions/storageFunctions/storageUpdateProduct.php" method="post" class="form">
                      <div class="leftBoxForm">
                            <input type="number"  value="<?php echo $code;?>" name="productCode" hidden />
                            <input type="number"  value="<?php echo $code;?>" class="inputTextDesign number" disabled/>
                            <input type="text"    required autocomplete="off" value="<?php echo $name;?>"        placeholder="Nombre del producto" name="productName"        class="inputTextDesign" />
                            <textarea type="text" required autocomplete="off" placeholder="Descripción" name="productDescription" class="inputTextDesign textarea"><?php echo $description;?></textarea>
                            <input type="text"    required autocomplete="off" value="<?php echo $category;?>"    placeholder="Categoría"           name="productCategory"    class="inputTextDesign" />
                      </div>  
                      <div class="rightoxForm">
                            <input type="text"    required autocomplete="off" value="<?php echo $subCategory;?>" placeholder="Sub Categoría"       name="productSubCategory" class="inputTextDesign" />
                            <input type="number"  required autocomplete="off" value="<?php echo $stockMin;?>"    placeholder="Stock Máximo"        name="stockMax" min="1"   class="inputTextDesign" />
                            <input type="number"  required autocomplete="off" value="<?php echo $stockMax;?>"    placeholder="Stock Mínimo"        name="stockMin" min="1"   class="inputTextDesign" />
                            <input type="text"    required autocomplete="off" value="<?php echo $measure;?>"     placeholder="Medida"              name="measure"  min="1"   class="inputTextDesign" />
                            <input type="submit" name="submit" value="Actualizar" class="buttonAdd" />
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
  include("../../Components/footer-container.php");
  include("../../Components/endCode.php");
?>