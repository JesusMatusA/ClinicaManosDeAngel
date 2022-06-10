<?php
   include("../../Components/requeriments.php ");
   include("../../Components/storageComponents/storageStyles.php");
   include("../../Components/storageComponents/nav-container.php");
  include("../../DBConnection/connect.php");

  if(empty($_GET['Code'])){
    header('Location: SeeProductScreen.php');
  } else{
    $code = $_GET['Code'];
    $query = "SELECT nombre, descripcion FROM productos WHERE codigo_producto= $code";
    if($result = $connection->query($query)){
      if($result->fetchColumn() > 0){
        foreach($connection->query($query) as $fila){
          $name = $fila['nombre'];
          $description = $fila['descripcion'];
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
                <div class="option">Eliminar Producto</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/storageFunctions/storageDeleteProductScreen.php" method="post" class="formG">
                        <div class="formG">
                            <input name="productCode" value="<?php echo $code;?>" hidden />
                            <input disabled value="<?php echo $code;?>" class="inputTextDesign" />
                            <input name="name" value="<?php echo $name;?>" hidden/>
                            <input disabled value="<?php echo $name;?>" class="inputTextDesign" />
                            <textarea type="text" disabled placeholder="<?php echo $description;?>" name="productDescription" class="inputTextDesign textarea"></textarea>
                            <textarea type="text" placeholder="Razón de la eliminación" name="reason" class="inputTextDesign textarea"></textarea>
                            <input type="submit" name="submit" value="Eliminar" class="buttonAdd" />
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