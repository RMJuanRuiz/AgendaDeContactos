<?php
    

    function obtenerContactos(){
        include 'bd.php';
        try {
            return $conn -> query("SELECT * FROM CONTACTO");
        } catch (Exception $e) {
            echo "ERROR" . $e->getMessage() . "<br>";
            return false;
        }
    }

?>