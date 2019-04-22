<?php 
    include 'inc/layout/header.php';
?>
<div class="contenedor-barra">
    <h1>Agenda de Contactos</h1>
</div>

<div class="bg-secundario contenedor sombra">
    <form action="#" id="contacto" method="">
        <legend>Agregar un contacto <span>Todos los campos son obligatorios</span></legend>

        <div class="campos">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Nombre del contacto" id="nombre">
            </div>

            <div class="campo">
                <label for="empresa">Empresa:</label>
                <input type="text" placeholder="Nombre de la empresa" id="empresa">
            </div>

            <div class="campo">
                <label for="telefono">Teléfono:</label>
                <input type="tel" placeholder="Teléfono del contacto" id="telefono">
            </div>
        </div>

        <div class="campo enviar ">
            <input type="submit" value="Agregar contacto">
        </div>
    

    </form>
</div>







<?php
    include 'inc/layout/footer.php';
?>