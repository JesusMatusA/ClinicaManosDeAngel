<?php
  include("../../Components/requeriments.php");
  include("../../Components/storageComponents/storageStyles.php");
  include("../../Components/storageComponents/nav-container.php");
  include("../../DBConnection/connect.php");

   if(empty($_GET['Code'])){
    header('Location: SeeProductSscreen.php');
   } else{
     $productCode = $_GET['Code'];
     $query = "SELECT existencias, nombre, stockMax FROM productos WHERE codigo_producto = $productCode";
     if($result = $connection->query($query)){
       if($result->fetchColumn() > 0){
         foreach($connection->query($query) as $fila){
           $existence = $fila['existencias'];
           $name = $fila['nombre'];
           $stockMax = $fila['stockMax'];
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
                <div class="option">Registrar Entrada de Producto</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form class="formG" action="../../functions/storageFunctions/storageInputProduct.php" method="post">
                      <div class="formG">
                        <input type="text"  value="<?php echo $productCode;?>"  name="productCode" hidden/>
                        <input type="text"  value="<?php echo $existence;?>"    name="existence" hidden/>
                        <input type="text"  value="<?php echo $stockMax;?>"     name="stockMax" hidden/>
                        <input type="text"  value="<?php echo $productCode;?>" class="inputTextDesign" disabled/>
                        <input type="text"  value="<?php echo $name;?>"        class="inputTextDesign" disabled/>
                        <input type="text"  value="<?php echo $existence;?>"   class="inputTextDesign" disabled/>
                        <input type="text"  value="<?php echo $stockMax;?>"     class="inputTextDesign" disabled/>
                        <input type="number" maxlength="3" pattern="[0-9]{1,}" name="output" placeholder="Cantidad de entrada" min="1" max="160" class="inputTextDesign"/>
                        <input type="submit" name="submit" value="Guardar" class="buttonAdd" />
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