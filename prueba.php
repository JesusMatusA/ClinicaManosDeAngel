<?php 
    include 'DBConnection/connect.php';

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM usuarios WHERE usuario=:user AND contrasena=:pass";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':user', $username);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $connection= null;
        if($result){echo "si";}
        if(!$result){echo "no";}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form class="form-container" method="post">
            <div class="title">
                <h1>Iniciar Sesión</h1>
            </div>
            <div>
                <div>
                    <input
                        type="text"
                        placeholder="Nombre de Usuario"
                        name="username"
                    />
                </div>
                <div>
                    <input
                        type="password"
                        placeholder="Contraseña"
                        name="password"
                    />
                </div>
                <div>
                    <input
                        type="submit"
                        name="submit"
                        value="Ingresar"
                        class="button"
                    />
                </div>
            </div>
        </form>
    </div>
</body>
</html>