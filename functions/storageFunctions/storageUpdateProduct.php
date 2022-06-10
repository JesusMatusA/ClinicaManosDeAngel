<?php 
include("../../DBConnection/connect.php");
 if(!empty($_POST)){
    $code = $_POST['productCode'];
    $name = $_POST['productName'];
    $description = $_POST['productDescription'];
    $category = $_POST['productCategory'];
    $subCategory = $_POST['productSubCategory'];
    $stockMin = $_POST['stockMin'];
    $stockMax = $_POST['stockMax'];
    $measure = $_POST['measure'];

    $query = "UPDATE productos SET 
            nombre=:name,
            descripcion=:description,
            categoria=:category,
            subCategoria=:subCategory,
            stockMin=:stockMin,
            stockMax=:stockMax,
            medida=:measure
        WHERE codigo_producto = :code";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
    $stmt->bindParam(":category", $category, PDO::PARAM_STR);
    $stmt->bindParam(":subCategory", $subCategory, PDO::PARAM_STR);
    $stmt->bindParam(":stockMin", $stockMin, PDO::PARAM_INT);
    $stmt->bindParam(":stockMax", $stockMax, PDO::PARAM_INT);
    $stmt->bindParam(":measure", $measure, PDO::PARAM_INT);
    $stmt->bindParam(":code", $code, PDO::PARAM_INT);
    //comprobar que se ejecuto el comando y se actualizo con exito la cita
    if ($stmt->execute()){
        if($stmt->rowCount() > 0){
            ?>
            <script>
                //Alerta que avisa que la acción fue un exito y entonces devuelve a la pantalla de agregar cita
                alert("¡Datos del Producto Actualizados!");
                location.href = "../../Screens/storageScreens/SeeProductScreen.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                //Alerta que se debe cambiar algun dato para poder actualizar la cita
                alert("¡Debe cambiar algun dato para actualizar!");
                location.href = "../../Screens/storageScreens/UpdateProductScreen.php?Code=<?php echo $code?>";
            </script>
            <?php
        }
    }
 }
?>