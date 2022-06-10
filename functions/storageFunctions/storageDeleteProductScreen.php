<?php
    include("../../DBConnection/connect.php");
    if(!empty($_POST)){
        $code = $_POST['productCode'];
        $reason = $_POST['reason'];
        $name = $_POST['name'];

        $query = "INSERT INTO ptoseliminados VALUE(NULL, :code, :reason, :name)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(":code", $code, PDO::PARAM_INT);
        $stmt->bindParam(":reason", $reason, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);

        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $query = "DELETE FROM productos WHERE codigo_producto = :code";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":code", $code, PDO::PARAM_INT);
                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        ?>
                            <script>
                            //Alerta que avisa que la acción fue un exito y entonces devuelve a otra pantalla
                            alert("Producto Eliminado!");
                            location.href = "../../Screens/storageScreens/SeeProductScreen.php";
                            </script>
                        <?php
                    }
                }
            }
        }
    }
?>