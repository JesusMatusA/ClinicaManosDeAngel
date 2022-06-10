<?php
    session_start();
    error_reporting(0);
    if(isset($_SESSION['user'])){
        if((strcasecmp($_SESSION['user'][1], "doctor")==0)) 
            header("Location: Screens/doctorScreens/firstScreen.php");
        if((strcasecmp($_SESSION['user'][1], "recepcionista")==0)) 
            header("Location: Screens/recepcionistScreens/firstScreen.php");
        if((strcasecmp($_SESSION['user'][1], "almacenista")==0)) 
            header("Location: Screens/storageScreens/firstScreen.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Styles/loginScreenStyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Roboto:wght@300&display=swap"
        rel="stylesheet" />
    <title>Login</title>
</head>

<body class="main-container">
    <div class="header">
        <h1>Manos de Ángel Clínica y Spa</h1>
    </div>
    <div class="content">
        <form action="Validation.php" class="form-container" method="post">
            <div class="title">
                <img class="logo" src="img/soloLogo.png" alt="Logo_Manos_de_Angel" />
                <h1>Iniciar Sesión</h1>
            </div>
            <div class="login-container">
                <div class="input-container">
                    <span id="icon" class="material-icons-outlined">account_circle</span>
                    <input type="text" placeholder="Nombre de Usuario" name="username" required maxlength="20" />
                </div>
                <div class="input-container">
                    <span id="icon" class="material-icons-outlined">key</span>
                    <input type="password" placeholder="Contraseña" name="password" required madxlength="6" />
                </div>
                <div class="input-button">
                    <input type="submit" name="submit" value="Ingresar" class="button" />
                </div>
            </div>
        </form>
    </div>
    <div class="footer">
        © Copyright 2022 ALUMNOS ITH - Todos los Derechos Reservados
    </div>
</body>

</html>