<?php
    $host = "localhost";
    $bd =   "clinicamanosdeangel";
    $user=  "root";
    $pass=  "";

    try{
        $connection = new PDO("mysql:host=$host; dbname=$bd",$user, $pass);
        $opt=array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        if($connection) echo "<script>console.log('Successful Connection')</script>";
    } catch (Exception $ex){
        echo $ex->getMessage();
    }
?>