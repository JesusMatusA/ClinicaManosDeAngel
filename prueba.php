<?php 
    include 'DBConnection/connect.php';

    // $var="Brian Alfonso Espinoza Santa Cruz";
    // $nombre ="Brian Alfonso";
    // $aPaterno = "Espinoza";
    // $aMaterno = "Santa Cruz";
    
    // if(stristr($var, $nombre) !== false){
    //     if(stristr($var, $aPaterno) !== false){
    //         if(stristr($var, $aMaterno) !== false){
    //             echo "nombre si, aPaterno si, aMaterno si";
    //         }else{
    //             echo "nombre si, aPaterno si, aMaterno no";
    //         }
    //     } else{
    //         echo "nombre si, aPaterno no";
    //     }
    // } else{
    //     echo "nombre no";
    // }

    $date = date("Y-m-d");
    // $sql = "select fecha_cita from citas where Id_Paciente = 178";

    // if($res = $connection->query($sql)){
    //     if($res->fetchColumn() > 0){
    //         foreach($res as $fila){
    //             if($fila[0] > $date){
    //                 echo  $fila[0];
    //             }
    //         }
    //     }
    // }

        echo $date;

    
?>
<form action="">
    <input type="text" placeholder="Nombre de Usuario" pattern="[A-Za-z]{1,}" required maxlength="10" />
    <input type="submit" value="hola">
</form>