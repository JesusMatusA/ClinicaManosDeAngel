<?php
    if(!empty($_POST)){
        if(preg_match('/[a-zA-Z]{1,}/',$_POST['textarea'])){
            echo "si";
        }else{
            echo "no";
        }
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
    <form action="" method="post">
        <textarea name="textarea"></textarea>
        <input type="submit" name="submit">
    </form>
</body>
</html>