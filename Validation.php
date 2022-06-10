<?php
    include 'DBConnection/connect.php';
    session_start();
    if(!empty($_POST)){
        //comprobar que hay datos en los input de usuario y contraseña
        if(!empty($_POST['username']) & !empty($_POST['password'])){
            //obtener el usuario y la contraseña
            $username = $_POST['username'];
            $password = $_POST['password'];
            //consulta para obtener el Id del empleado, su usuario y su puesto
            $query = "SELECT e.Id_Empleado, usuario, puesto FROM usuarios u 
                INNER JOIN empleados e on e.Id_Empleado = u.Id_Empleado 
                WHERE BINARY u.usuario=:user AND BINARY u.contrasena=:pass";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':user', $username, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    //guarda el Id del empleado, su usuario y puesto
                    $_SESSION['user'][0]= $result["usuario"];
                    $_SESSION['user'][1]= $result["puesto"];
                    $_SESSION['user'][2]= $result['Id_Empleado'];
                    //redirecciona a la pantalla principal dependiendo del puesto del usuario
                    if((strcasecmp($result["puesto"], "doctor")==0)){ header("Location: Screens/doctorScreens/firstScreen.php");}
                    if((strcasecmp($result["puesto"], "recepcionista")==0)){ header("Location: Screens/recepcionistScreens/firstScreen.php");}
                    if((strcasecmp($result["puesto"], "almacenista")==0)){ header("Location: Screens/storageScreens/firstScreen.php");}
                }else{
                    ?>
                        <script>
                            alert("Error: Usuario y/o Contraseña incorrectos");
                            location.href = "Index.php";
                        </script>
                    <?php
                }
            }
        }
    }
?>