<?php

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
if (isset($_GET["accion"])){
    if($_GET['accion'] == 'borrar'){
        echo json_encode($_GET);
    }
}

?>
