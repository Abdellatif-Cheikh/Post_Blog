<?php
    try{
        $maBase = new PDO('mysql:host=localhost; dbname=blog' , 'root', '' );
        $maBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Connection failed: " .$e->getMessage();
    }

?>



