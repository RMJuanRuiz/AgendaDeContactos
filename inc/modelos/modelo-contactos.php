<?php


// Para crear un usuario en la BD
if(isset($_POST['accion'])){
    if($_POST['accion'] == 'crear'){
        // Crear un nuevo registro en la BD
        require_once('../funciones/bd.php');

        //Validar entradas
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);


        try{
            $stmt = $conn -> prepare("INSERT INTO contacto (nombre, empresa, telefono) VALUES (?, ?, ?)"); //statement
            $stmt -> bind_param('sss', $nombre, $empresa, $telefono);
            $stmt -> execute(); // ejecutar script
            if($stmt -> affected_rows == 1){ // affected_rows nos permite saber si al menos 1 fila fue afectada en la BD
                $respuesta = array(
                    'Respuesta' => 'Correcto',
                    'datos' => array(
                        'nombre' => $nombre,
                        'empresa' => $empresa,
                        'telefono' => $telefono,
                        'id_insertado' => $stmt -> insert_id, //Para ver el id en la BD
                    )
                );
            }

            $stmt -> close();
            $conn -> close();
        }catch(exception $e){
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        echo json_encode($respuesta);
    }
}

// Para eliminar un usuario de la BD
if (isset($_GET["accion"])){
    if($_GET['accion'] == 'borrar'){
        // Crear un nuevo registro en la BD
        require_once('../funciones/bd.php');

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $stmt = $conn -> prepare("DELETE FROM contacto WHERE id = ?");
            $stmt -> bind_param("i", $id);
            $stmt -> execute();
            if($stmt -> affected_rows ==1){
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }

            $stmt -> close();
            $conn -> close();
        } catch (Exception $e ) {
            $respuesta = array(
                'Error' => $e -> getMessage()
            );
        }
        echo json_encode($respuesta);
    }
}

// Para editar un usuario de la BD
if (isset($_POST["accion"])){
    if($_POST['accion'] == 'editar'){
        
        require_once('../funciones/bd.php');

        //Validar entradas
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $stmt = $conn -> prepare("UPDATE contacto SET nombre = ?, empresa = ?, telefono = ? WHERE id = ?");
            $stmt -> bind_param("sssi", $nombre, $empresa, $telefono, $id);
            $stmt -> execute();

            if($stmt -> affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );    
            }

            $stmt -> close();
            $conn -> close();
        } catch (Exception $e) {
            $respuesta = array(
                'Error' => $e -> getMessage()
            );
        }

        echo json_encode($respuesta);
    }
}


?>
