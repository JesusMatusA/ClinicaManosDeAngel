<?php
    include("../../DBConnection/connect.php");
    if(!empty($_POST)){
        $code = $_POST['productCode'];
        $output = $_POST['output'];
        $existence = $_POST['existence'];
        $stockMax = $_POST['stockMax'];

        $totalExistence = ($existence + $output);

        if($totalExistence == $stockMax){
            ?>
                <script>
                    alert("Advertencia: Se ha alcanzado la capacidad maxima del producto en el almacen...");
                </script>
            <?php
        }

        if($totalExistence > $stockMax){
            ?>
                <script>
                    alert("Advertencia: Se ha sobrepasado la capacidad maxima del producto en el almacen...");
                </script>
            <?php
        }

        $query = "UPDATE productos SET existencias = :total WHERE codigo_producto = :code";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(":code", $code, PDO::PARAM_INT);
        $stmt->bindParam(":total", $totalExistence, PDO::PARAM_INT);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                ?>
                    <script>
                    //Alerta que avisa que la acción fue un exito y entonces devuelve a otra pantalla
                    alert("La Existencia del Producto se ha Actualizado!");
                    location.href = "../../Screens/storageScreens/SeeProductScreen.php";
                    </script>
                <?php
            }
        }
    }
?>