<?php 
    include("../../DBConnection/connect.php");
    if(!empty($_POST)){
        $code = $_POST['productCode'];
        $name = ucfirst(strtolower($_POST['productName']));
        $description = $_POST['productDescription'];
        $category = ucfirst(strtolower($_POST['productCategory']));
        $subcategory = ucfirst(strtolower($_POST['productSubCategory']));
        $stockmax = $_POST['stockMax'];
        $stockmin = $_POST['stockMin'];
        $existence = $_POST['existence'];
        $measure = $_POST['measure'];

        $query = "INSERT INTO productos 
            VALUE(NULL, :code, :name, :description, :existence, :category, :subcategory, 
            :stockmin, :stockmax,  :measure)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':code', $code, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':subcategory', $subcategory, PDO::PARAM_STR);
        $stmt->bindParam(':stockmax', $stockmax, PDO::PARAM_INT);
        $stmt->bindParam(':stockmin', $stockmin, PDO::PARAM_INT);
        $stmt->bindParam(':existence', $existence, PDO::PARAM_INT);
        $stmt->bindParam(':measure', $measure, PDO::PARAM_INT);

        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                ?>
                    <script>
                    //Alerta que avisa que la acción fue un exito y entonces devuelve a otra pantalla
                    alert("Producto registrado con exito!");
                    location.href = "../../Screens/storageScreens/AddProductScreen.php";
                    </script>
                <?php
            }
        }
    }
?>