<?php 
    include 'inc/funciones/funciones.php';
    include 'inc/layout/header.php';

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Convierte el id en un entero
    
    // Validar que se haya podido convertir el id.
    if(!$id){
        die('No es valido');
    }

    $resultado = obtenerContacto($id);
    $contacto = $resultado -> fetch_assoc();
?>


<div class="contenedor-barra">
    <div class="contenedor barra">
        <a href="index.php" class="btn volver">Volver</a>
        <h1>Editar contacto</h1>
    </div>
</div>

<div class="bg-secundario contenedor sombra">
    <form action="#" id="contacto" method="">
        <legend>Editar contacto</legend>
        
        <?php include 'inc/layout/formulario.php';?>

    </form>
</div>
<?php
    include 'inc/layout/footer.php';
?>