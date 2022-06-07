<?php 
include("./connect.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

<script src="../Alert/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../Alert/sweetalert.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

 <!-- ESTILO CURSOS DE PROGRAMACION -->
 <link rel="stylesheet" href="../css/style_cp.css">

 <!-- importante -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<title>Buscador</title>
</head>
<body>


<!-- NAVBAR -->
<!-- <?php include("../Admin/navbar.php"); ?> -->
<!-- END NAVBAR -->



<!-- buscador basico -->
<nav class="navigatorBarContainer">
      <div class="logoContainer">
        <img src="../img/logo.png" alt="" class="imgLogo" />
      </div>
      <div class="nameContainer">Manos de Angel Clínica y Spa</div>
    </nav>
<div class="center">
        <div class="card pt-2 test2" >
                <p style="font-weight: bold; color: #0F6BB7; font-size: 22px;">Buscar Cliente</p>
                <div class="container-fluid  p-4">
                        <div class=" col-12 mt-2">
                                <div class="table-responsive">
                                        <div class="mb-3"> 
                                                <label class="form-label">Nombre del cliente</label>
                                                <input onkeyup="buscar_ahora($('#buscar_1').val());" type="text" class="form-control" id="buscar_1" name="buscar_1">
                                        </div>
                                        <div class="card col-12 mt-5">
                                                <div class="card-body">
                                                        <div id="datos_buscador" class="container pl-5 pr-5" style="border: none;"></div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<!-- END buscador basico -->
<footer class="footerContainer">
      <div class="textFooter">
        © Copyright 2022 ALUMNOS ITH - Todos los Derechos Reservados
      </div>
    </footer>



<script type="text/javascript">
        function buscar_ahora(buscar) {
        var parametros = {"buscar":buscar};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'buscador.php',
        success: function(data) {
        document.getElementById("datos_buscador").innerHTML = data;
        }
        });
        }
      
</script>






</body>
</html>