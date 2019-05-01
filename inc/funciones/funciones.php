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


    // Obtiene un contacto mediante un id
    function obtenerContacto($id){
        include 'bd.php';
        try {
        return $conn -> query("SELECT * FROM CONTACTO WHERE id = $id");
        } catch (Exception $e) {
            echo "ERROR" . $e->getMessage() . "<br>";
            return false;
        }
    
    }

?>